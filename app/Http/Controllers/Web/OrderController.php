<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->primary_model = new Order();
        $this->order_product_model = new OrderProduct();
        $this->cart_model = new Cart();
        $this->module_name = 'orders';
    }

    public function placeOrder(Request $request)
    {
        $order = $this->primary_model->createOrder($request->all());

        if (!$order) {

            return back();
        }

        return redirect()->route(config('constants.WEB_PREFIX') . 'order_view', ['id' => $order->id]);
    }

    public function view($id)
    {
        $this->dataAssign['page_title'] = ucfirst($this->module_name);

        $this->dataAssign['close_dropdown'] = true;

        $this->dataAssign['data'] = $this->primary_model->findOrFail($id);

        return view($this->module_directory . '.' . $this->module_name . '.' . __FUNCTION__, $this->dataAssign);
    }

    public function bulkOrder()
    {
        $this->dataAssign['page_title'] = 'Bulk Order';

        $this->dataAssign['close_dropdown'] = true;

        return view($this->module_directory . '.' . $this->module_name . '.bulk_order', $this->dataAssign);
    }

    public function quickOrder()
    {
        $this->dataAssign['page_title'] = 'Quick Order';

        $this->dataAssign['close_dropdown'] = true;

        return view($this->module_directory . '.' . $this->module_name . '.quick_order', $this->dataAssign);
    }
}
