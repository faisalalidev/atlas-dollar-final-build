<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\OrderEmailJob;
use App\Models\Email;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends CRUDController
{
    public function __construct()
    {
        parent::__construct();
        $this->primary_model = new Order();
        $this->module_name = 'orders';
        $this->actions = ['delete', 'view','order_file','re_order_mail'];
        $this->raw_columns = ['actions','order_status'];
        $this->order_status_view = $this->module_name . '.order_status';
        $this->data_assign['page_title'] = ucwords(str_replace('_', ' ', Str::singular($this->module_name)));
        $this->data_assign['module_name'] = $this->module_name;
        $this->data_assign['module_add_title'] = ucfirst(explode('_', Str::singular($this->module_name))[0]);
    }

    public function show()
    {
        $this->data_assign['module_ajax_listing_url'] = config('constants.ADMIN_PREFIX') . $this->module_name . '_dtListing';

        $this->data_assign['primary_dt_columns'] = $this->primary_model->getDataTableColumns();

        return parent::show();
    }

    public function view(Request $request)
    {
        $this->data_assign['data'] = $this->primary_model->findOrFail($request->id);

        $this->data_assign['address'] = null;

        if ($this->data_assign['data']->user && $this->data_assign['data']->user->store){

            $this->data_assign['address'] = $this->data_assign['data']->user->store->contacts[0];
        }

        return view($this->module_directory . '.' . $this->module_name . '.' . Str::snake(__FUNCTION__), $this->data_assign);
    }

    public function viewIframe(Request $request)
    {
        $this->data_assign['data'] = $this->primary_model->findOrFail($request->id);

        $this->data_assign['address'] = null;

        if ($this->data_assign['data']->user && $this->data_assign['data']->user->store){

            $this->data_assign['address'] = $this->data_assign['data']->user->store->contacts[0];
        }

        return view($this->module_directory . '.' . $this->module_name . '.view_iframe' , $this->data_assign);
    }

    public function delete(Request $request, $id)
    {
        $data = $this->primary_model->find($id);

        $data->products()->delete();

        $data->delete();

        $request->session()->flash('success', $this->data_assign['module_add_title'] . ' Deleted');

        return back();
    }

    public function reMail($id)
    {
        $order = $this->primary_model->findOrFail($id);

        $admin_msg = 'You’ve received the following order from ' . $order->user->store->name . ':';

        $email = Email::where('slug', 'new_order')->first();

        $emails = explode(',', $email->recipients);

        if (count($emails)) {

            dispatch(new OrderEmailJob(
                $id,
                $admin_msg,
                route(config('constants.ADMIN_PREFIX') . 'orders_view', ['id' => $order->id]),
                1,
                $emails,
                $order->txt_file_path));

        }

        return back();
    }
}
