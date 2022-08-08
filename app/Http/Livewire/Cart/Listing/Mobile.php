<?php

namespace App\Http\Livewire\Cart\Listing;

use App\Models\Cart;
use Livewire\Component;

class Mobile extends Component
{
    public $total_amount;

    public $items;

    protected $listeners = [
        'updateCartMobile' => 'renderCart',
    ];


    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->cart_model = new Cart();
    }

    public function mount()
    {
        $this->items = $this->cart_model->getDefaultCartItems();

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();
    }

    public function renderCart()
    {
        $this->dispatchBrowserEvent('resetScrollBar');

        $this->items = $this->cart_model->getDefaultCartItems();

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();
    }

    public function render()
    {
        return view('livewire.cart.listing.mobile');
    }
}
