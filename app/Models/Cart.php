<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'default', 'saved', 'name','in_process'];

    protected $table = 'cart';

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function getDefaultCartItems()
    {
        $cart = $this->getDefaultCart();

        if ($cart) {

            return $cart->items()->with(['inventory', 'inventory.category', 'inventory.images', 'inventory.prices'])->orderBy('updated_at', 'DESC')->get();
        }

        return CartItem::whereNull('cart_id')->with(['inventory', 'inventory.category', 'inventory.images', 'inventory.prices'])->get();
    }

    public function getSavedCartItems($id)
    {
        $cart = $this->getSavedCarts($id);

        return $cart->items()->with(['inventory', 'inventory.category', 'inventory.images', 'inventory.prices'])->orderBy('updated_at', 'DESC')->get();
    }

    public function getDefaultCartTotalAmount()
    {
        $cart = $this->getDefaultCart();

        if ($cart) {

            $amount = 0;

            foreach ($cart->items as $item) {

                $amount += $item->quantity * (isset($item->inventory->prices[0]) ? (double)$item->inventory->prices[0]->regular : $item->inventory->float_price);
            }

            return $amount;
        }

        return 0;
    }

    public function addToCart($inventory_id, $quantity, $addQuantity = false)
    {
        $inventory = Inventory::where('inventory_id', $inventory_id)->count();

        if (!$inventory && !$quantity) {
            return false;
        }

        $cart = $this->getDefaultCart();

        if (!$cart) {

            $cart = $this->create([
                'user_id' => getLoggedInUser()->id,
                'default' => true,
                'saved' => false
            ]);
        }

        $cart_item = $cart->items()->with(['inventory', 'inventory.category', 'inventory.images', 'inventory.prices'])->where('inventory_id', $inventory_id)->where('cart_id', $cart->id)->first();

        if (!$cart_item) {

            $cart_item = $cart->items()->create([
                'inventory_id' => $inventory_id,
                'quantity' => $quantity,
                'cart_id' => $cart->id,
            ]);

            $cart_item = $cart->items()->with(['inventory', 'inventory.category', 'inventory.images', 'inventory.prices'])->find($cart_item->id);

        } else {

            if ($addQuantity) {

                $quantity = $quantity + $cart_item->quantity;
            }

            $cart_item->update(['quantity' => $quantity]);
        }

        return $cart_item;
    }

    public function getDefaultCart($related_query = true)
    {
        if (!auth(config('constants.WEB_GUARD_NAME'))->check()) {
            return null;
        }

        $query = $this->where('user_id', getLoggedInUser()->id)->where('default', true)->where('in_process',0);

        if ($related_query) {
            $query = $query->with(['items', 'items.inventory', 'items.inventory.prices']);
        }

        return $query->orderBy('created_at' , 'DESC')->first();

    }

    public function getSavedCarts($id = false)
    {
        if (!auth(config('constants.WEB_GUARD_NAME'))->check()) {
            return null;
        }

        $query = $this->where('user_id', getLoggedInUser()->id)->where('saved', true)->with(['items', 'items.inventory', 'items.inventory.prices']);

        if (!$id) {
            return $query->get();
        }

        return $query->where('id', $id)->first();

    }

    public function removeItemFromCart($cart_item_id)
    {
        $item = CartItem::with(['inventory', 'inventory.category', 'inventory.images', 'inventory.prices'])->find($cart_item_id);

        $item->delete();

        return $item;
    }

    public function removeItemsFromCart($cart_item_ids)
    {
        CartItem::whereIn('id' , $cart_item_ids)->delete();
    }
}
