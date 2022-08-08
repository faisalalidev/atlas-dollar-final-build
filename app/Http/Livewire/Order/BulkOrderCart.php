<?php

namespace App\Http\Livewire\Order;

use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;

class BulkOrderCart extends Component
{

    public $total_amount;

    public $items;

    protected $listeners = [
        'updateBulkCartPage' => 'renderCart',
        'clearBulkCart' => 'clearCart',
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->cart_model = new Cart();
    }

    public function updateCart($form_data)
    {
        foreach ($form_data as $key => $qty){

            $item_id = explode('-',$key)[1];

            if(!(int) $qty) {
                $this->cart_model->removeItemFromCart($item_id);
            }

            CartItem::find($item_id)->with(['inventory','inventory.category','inventory.images' , 'inventory.prices'])->update(['quantity' => (int)$qty]);
        }

        $this->items = $this->cart_model->getDefaultCartItems();

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();
    }

    public function removeProductFromCart($cart_item_id)
    {
        $this->cart_model->removeItemFromCart($cart_item_id);

        $this->items = $this->cart_model->getDefaultCartItems();

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();
    }

    public function clearCart()
    {
        $default_cart = $this->cart_model->getDefaultCart();

        CartItem::where('cart_id',$default_cart->id)->with(['inventory','inventory.category','inventory.images' , 'inventory.prices'])->delete();

        $default_cart->delete();

        $this->items = $this->cart_model->getDefaultCartItems();

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();
    }

    public function renderCart($cart_item_id)
    {
        $this->dispatchBrowserEvent('contentChanged',['id' => $cart_item_id]);

        $this->items = $this->cart_model->getDefaultCartItems();

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();
    }

    public function mount()
    {
        $this->items = $this->cart_model->getDefaultCartItems();

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();
    }

    public function render()
    {
        return view('livewire.order.bulk-order-cart');
    }
}
