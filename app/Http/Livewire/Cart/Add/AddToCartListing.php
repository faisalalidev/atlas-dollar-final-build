<?php

namespace App\Http\Livewire\Cart\Add;

use App\Models\Cart;
use Livewire\Component;

class AddToCartListing extends Component
{
    public $inventory_id;

    public $quantity = 0;

    public $btn_type;

    public $added_to_cart = false;

    public $quantity_added = 0;

    public function mount($inventory_id, $type)
    {
        $this->inventory_id = $inventory_id;

        $this->btn_type = $type;
    }

    public function addToCart()
    {
        if (!$this->quantity) {
            return;
        }
        $cart_model = new Cart();

        $cart_item = $cart_model->addToCart($this->inventory_id, $this->quantity);

        $this->emit('cart:update', $cart_item);

        $this->emit('updateCartMobile');

        $this->emit('updateQuantityOnMultiple', $this->id, 0, $this->inventory_id);
    }

    public function decrementQuantity()
    {
        $this->quantity = $this->quantity < 1 ? 0 : $this->quantity - 1;

        $this->emit('updateQuantityOnMultiple', $this->id, $this->quantity, $this->inventory_id);
    }

    public function changeQuantity($value)
    {
        $this->quantity = (int)$value;

        $this->emit('updateQuantityOnMultiple', $this->id, $this->quantity, $this->inventory_id);
    }

    public function updatedQuantity()
    {
        $this->emit('updateQuantityOnMultiple', $this->id, $this->quantity, $this->inventory_id);
    }

    public function incrementQuantity()
    {
        $this->quantity++;

        $this->emit('updateQuantityOnMultiple', $this->id, $this->quantity, $this->inventory_id);
    }

    public function render()
    {
        $cart_model = new Cart();

        $cart = $cart_model->getDefaultCart(false);

        if (!is_null($cart)) {
            $this->added_to_cart = $cart->items()->where('inventory_id', $this->inventory_id)->first();

            if ($this->added_to_cart) {
                $this->quantity_added = $this->added_to_cart->quantity;
            }
        }

        return view('livewire.cart.add.add-to-cart-listing');
    }
}
