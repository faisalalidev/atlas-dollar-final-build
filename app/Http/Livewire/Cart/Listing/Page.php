<?php

namespace App\Http\Livewire\Cart\Listing;

use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;

class Page extends Component
{
    public $total_amount;

    public $items;
    public $all_items_selected_for_removal;
    public $items_selected_for_removal;

    protected $listeners = [
        'updateCartPage' => 'renderCart',
    ];


    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->cart_model = new Cart();
    }

    public function updateCart($form_data)
    {
        foreach ($form_data as $key => $qty) {

            $item_id = explode('-', $key)[1];

            if (!(int)$qty) {
                $this->cart_model->removeItemFromCart($item_id);
            } else {
                CartItem::find($item_id)->update(['quantity' => (int)$qty]);
            }
        }

        $this->emit('cart-list:update');

        $this->items = $this->cart_model->getDefaultCartItems();

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();
    }

    public function selectAllItemsForRemoval()
    {
        foreach ($this->items_selected_for_removal as $key => $item) {
            $this->items_selected_for_removal[$key] = !$item;
        }
    }

    public function renderCart()
    {
        $this->items = $this->cart_model->getDefaultCartItems();

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();
    }

    public function selectItemForRemoval($cart_id)
    {
        $this->items_selected_for_removal[$cart_id] = !$this->items_selected_for_removal[$cart_id];

    }

    public function removeSelectedItems()
    {
        $cart_item_ids = [];

        foreach ($this->items_selected_for_removal as $cart_item_id => $valid) {
            if ($valid) {
                $cart_item_ids[] = $cart_item_id;
            }
        }

        $this->cart_model->removeItemsFromCart($cart_item_ids);

        $this->emit('updateCartPage');

        $this->emit('updateCartMobile');

        $this->mount();
    }

    public function mount()
    {
        $this->items = $this->cart_model->getDefaultCartItems();

        $this->items->each(function ($current) {
            $this->items_selected_for_removal[$current['id']] = false;
        });

        $this->total_amount = $this->cart_model->getDefaultCartTotalAmount();
    }

    public function render()
    {
        return view('livewire.cart.listing.page');
    }
}
