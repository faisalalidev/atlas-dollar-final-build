<?php

namespace App\Http\Livewire\Inventory;

use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;

class ShopListing extends Component
{
    use WithPagination;

    protected $listeners = ['selectCategory' => 'getProductByCategory'];

    public $sort_by = 'updated_at DESC';

    public $limit = 80;

    public $categories;

    public $category_name;

    public $category_id;

    public $parent_category;

    public $search;

    protected $queryString = ['category_name', 'sort_by', 'limit', 'search', 'category_id' , 'parent_category'];

    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->inventory_model = new Inventory();

        $this->limit = Session::get('home_list_limit', 80);
    }

    public function getCategoryByName()
    {
        if ($this->category_name) {

            $category = Category::where('name', 'like', '%' . $this->category_name . '%')->where('active', 1)->first();

            if ($category) {

                $this->category_id = $category->id;

                $this->parent_category = is_null($category->parent);
            }
        }
    }

    public function getProductByCategory($value)
    {
        $this->category_name = $value;

        $this->getCategoryByName();

        $this->resetPage();
    }

    public function updatedLimit($value)
    {
        Session::put('home_list_limit', $value);
    }

    public function mount()
    {
        $this->categories = Category::whereNull('parent')->with(['childs'])->where('active', 1)->orderBy('name', 'ASC')->get();

        $this->category_name = request('category_name');

        $this->getCategoryByName();
    }

    public function paginationView()
    {
        return 'livewire.inventory.pagination';
    }

    public function render()
    {
        $this->dispatchBrowserEvent('images-incoming');

        $inventories = $this->inventory_model->getPublishedInventories($this->limit, [
            'sort_by' => $this->sort_by,
            'category_id' => $this->category_id,
            'parent_category' => $this->parent_category,
            'search' => $this->search
        ], true, $this->page);

        return view('livewire.inventory.shop.shop-listing', [
            'inventories' => $inventories,
            'categories' => $this->categories,
            'inventories_array' => $inventories->toArray(),
        ]);
    }
}
