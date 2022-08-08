<?php

namespace App\Http\Livewire\Cart\Listing;

use App\Models\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class Header extends Component
{
    use WithPagination;

    public $count;

    public $total_amount;

    public $items;

    protected $listeners = [
        'cart:update' => 'updateCart',
        'cart-list:update' => 'updateCartList',
        'cart:remove' => 'removeProductFromCart',
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->cart_model = new Cart();
    }

    public function getQueryString()
    {
        return [];
    }

    public function updateCartList()
    {
        $this->render();
    }

    public function mount()
    {
        $this->items = $this->cart_model->getDefaultCartItems();

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();

    }

    public function updateCart($cart_item)
    {
        $this->dispatchBrowserEvent('cartItemAdded',$cart_item);

        $this->emit('updateCartMobile');

        $this->items = $this->cart_model->getDefaultCartItems();

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();
    }

    public function removeProductFromCart($cart_item_id)
    {
        $cart_item = $this->cart_model->removeItemFromCart($cart_item_id);

        $this->dispatchBrowserEvent('cartItemRemoved',$cart_item);

        $this->emit('updateCartPage');

        $this->emit('updateCartMobile');

        $this->items = $this->cart_model->getDefaultCartItems();

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();
    }

    public function render()
    {
        return view('livewire.cart.listing.header');
    }
}
