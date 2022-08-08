<?php

namespace App\Http\Livewire\Header;

use App\Models\Category;
use App\Models\Inventory;
use Livewire\Component;

class Search extends Component
{
    public $query;
    public $products = [];
    public $category;
    public $category_id;
    public $parent_category;
    public $limitPerPageProduct = 10;

    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->inventory_model = new Inventory();
    }

    protected $listeners = [
        'load-more-products-for-search' => 'loadMoreProducts'
    ];

    public function loadMoreProducts()
    {
        $this->limitPerPageProduct = $this->limitPerPageProduct + 10;

        $this->searchProduct();
    }

    public function updatedCategory()
    {
        $category = Category::where('name', 'like', '%' . $this->category . '%')->with('inventories')->where('active',1)->first();

        if ($category) {

            $this->category_id = $category->id;

            $this->parent_category = is_null($category->parent);

            $this->searchProduct();
        }

    }

    public function searchProduct()
    {
        if (!$this->query){
            $this->products = [];
            return;
        }

        if ($this->query) {

            $this->products = $this->inventory_model->getPublishedInventories($this->limitPerPageProduct, [
                'category_id' => $this->category_id,
                'parent_category' => $this->parent_category,
                'search' => $this->query
            ], false);
        }
    }

    public function sendToSearchPage() {
        $this->redirect(route(config('constants.WEB_PREFIX') . 'shop' , [
            'category_name' => $this->category_id,
            'parent_category' => $this->parent_category,
            'search' => $this->query
        ]));
    }

    public function updatedQuery()
    {
        $this->searchProduct();
    }

    public function render()
    {
        if(!empty($this->products)) {
            $this->dispatchBrowserEvent('searchItemsFound');
        }

        $categories = Category::whereNull('parent')->with(['childs','childs.inventories'])->where('active',1)->get();

        return view('livewire.header.search', ['categories' => $categories]);
    }
}
