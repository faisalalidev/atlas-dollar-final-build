<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->module_name = 'home';
        $this->banner_model = new Banner();
        $this->category_model = new Category();
        $this->order_product_model = new OrderProduct();
    }

    public function index()
    {
        $this->dataAssign['page_title'] = ucfirst($this->module_name);

        $this->dataAssign['full_banners'] = $this->banner_model->where('type','full_banner')->get();

        $this->dataAssign['small_banners'] = $this->banner_model->where('type','small_banner')->get();

        $this->dataAssign['top_products1'] = $this->order_product_model->with(['inventory','inventory.category','inventory.images' , 'inventory.prices'])->orderBy('created_at','DESC')->limit(4)->get();

        $this->dataAssign['top_products2'] = $this->order_product_model->with([ 'inventory','inventory.category','inventory.images' , 'inventory.prices'])->orderBy('created_at','DESC')->limit(4)->skip(4)->get();

        $this->dataAssign['recently_viewed_products'] = auth(config('constants.WEB_GUARD_NAME'))->check() ? getLoggedInUser()->recentlyViewedProducts()->with(['product','product.category','product.images' , 'product.prices'])->orderBy('created_at','desc')->limit(20)->get() : [];

        return view($this->module_directory . '.' . $this->module_name . '.' . __FUNCTION__ , $this->dataAssign);
    }
}
