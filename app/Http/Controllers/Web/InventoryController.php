<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\RecentlyViewedProduct;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->module_name = 'inventories';

        $this->category_model = new Category();
        $this->primary_model = new Inventory();
        $this->recently_viwed_model = new RecentlyViewedProduct();
    }

    public function index()
    {
        $this->dataAssign['page_title'] = "Shop";

        $this->dataAssign['close_dropdown'] = true;

        return view($this->module_directory . '.' . $this->module_name . '.' . __FUNCTION__ , $this->dataAssign);
    }

    public function products()
    {
        $this->dataAssign['page_title'] = "Products";

        $this->dataAssign['close_dropdown'] = true;

        $this->dataAssign['inventories'] = $this->primary_model->getPublishedInventories(80, ['sort_by' => 'created_at DESC'], false);

        return view($this->module_directory . '.' . $this->module_name . '.' . __FUNCTION__ , $this->dataAssign);
    }

    public function addToRecentlyViewed($inventory_id)
    {
        $this->recently_viwed_model->where('user_id',getLoggedInUser()->id)->where('product_id',$inventory_id)->delete();

        $this->recently_viwed_model->create([
            'user_id' => getLoggedInUser()->id,
            'product_id' => $inventory_id
        ]);
    }
}
