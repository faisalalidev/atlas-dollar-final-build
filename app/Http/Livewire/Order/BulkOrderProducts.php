<?php

namespace App\Http\Livewire\Order;

use App\Models\Cart;
use App\Models\Inventory;
use Livewire\Component;

class BulkOrderProducts extends Component
{
    public $query;
    public $limitPerPageProduct = 20;
    public $inventories;

    protected $listeners = [
        'load-more-products' => 'loadMoreProducts'
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->inventory_model = new Inventory();
    }

    public function clearFilter()
    {
        $this->query = '';

        $this->search();
    }

    public function search()
    {
        $this->inventories = $this->inventory_model->getPublishedInventories($this->limitPerPageProduct, [
            'search' => $this->query
        ],false);
    }

    public function updatedQuery($value)
    {
        $this->query = $value;

        $this->search();
    }

    public function addToCart($id)
    {
        $cart_model = new Cart();

        $cart_item = $cart_model->addToCart($id,1,true);

        //$this->emit('updateBulkCartPage',$cart_item->id);

        $this->dispatchBrowserEvent('addItemInCart',$cart_item);
    }

    public function loadMoreProducts()
    {
        $this->limitPerPageProduct = $this->limitPerPageProduct + 10;

        $this->search();
    }

    public function mount()
    {
        $this->search();
    }

    public function render()
    {
        $this->emit('inventoryLoaded');

        return view('livewire.order.bulk-order-products');
    }
}
