<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Country;
use App\Models\Order;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->module_name = 'cart';
        $this->primary_model = new Cart();
        $this->cart_items_model = new CartItem();
        $this->order_model = new Order();
    }

    public function index(Request $request)
    {
        $this->dataAssign['page_title'] = ucfirst($this->module_name);

        $this->dataAssign['close_dropdown'] = true;

        $this->dataAssign['quick_order_errors'] = [];

        if ($request->session()->has('quick_order_errors')) {
            $this->dataAssign['quick_order_errors'] = $request->session()->get('quick_order_errors');
            $request->session()->remove('quick_order_errors');
        }

        return view($this->module_directory . '.' . $this->module_name . '.' . __FUNCTION__, $this->dataAssign);
    }

    public function saveCart(Request $request)
    {
        $cart = $this->primary_model->getDefaultCart();

        $cart->name = $request->cart_name;

        $cart->saved = true;

        $cart->default = 0;

        $cart->save();
    }

    public function checkout()
    {
        $this->dataAssign['page_title'] = ucfirst('checkout');

        $this->dataAssign['close_dropdown'] = true;

        $this->dataAssign['cart_items'] = $this->primary_model->getDefaultCartItems();

        $this->dataAssign['total_amount'] = $this->primary_model->getDefaultCartTotalAmount();

        $this->dataAssign['store_address'] = getUserStoreAddress();

        $this->dataAssign['previous_order'] = $this->order_model->with(['products'])->where('user_id', getLoggedInUser()->id)->latest()->first();

        return view($this->module_directory . '.' . $this->module_name . '.' . __FUNCTION__, $this->dataAssign);
    }

    public function clearCart()
    {
        $default_cart = $this->primary_model->getDefaultCart();

        $this->cart_items_model->where('cart_id', $default_cart->id)->delete();

        $default_cart->delete();

        return redirect()->route(config('constants.WEB_PREFIX') . 'home');
    }

    public function viewSavedCart($id)
    {
        $this->dataAssign['page_title'] = ucfirst($this->module_name);

        $this->dataAssign['cart'] = $this->primary_model->findOrFail($id);

        $this->dataAssign['items'] = $this->primary_model->getSavedCartItems($id);

        if (!count($this->dataAssign['items'])) {
            abort(404);
        }

        return view($this->module_directory . '.' . $this->module_name . '.saved_cart', $this->dataAssign);
    }

    public function loadSavedCart($id)
    {
        $cart = $this->primary_model->findOrFail($id);

        $this->primary_model->where('user_id', getLoggedInUser()->id)->update([
            'default' => 0
        ]);

        $cart->default = 1;

        $cart->save();

        return redirect()->to(route(config('constants.WEB_PREFIX') . 'cart'));
    }

    public function removeSavedCart($id)
    {
        $cart = $this->primary_model->findOrFail($id);

        $cart->delete();

        return back();
    }
}
