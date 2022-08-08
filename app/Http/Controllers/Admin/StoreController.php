<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\Add;
use App\Jobs\CustomersCronJob;
use App\Models\CronSyncQueue;
use App\Models\Invoice;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreController extends CRUDController
{
    public function __construct()
    {
        parent::__construct();
        $this->primary_model = new Store();
        $this->invoice_model = new Invoice();
        $this->actions = ['delete','view'];
        $this->module_name = 'stores';
        $this->raw_columns = ['show', 'actions'];
        $this->show_view = $this->module_name . '.show_view';
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

    public function add()
    {
        return parent::add();
    }

    public function edit($id)
    {
        return parent::edit($id);
    }

    public function store(Add $request)
    {
        $request->merge(['customer_id' => rand(1000000, 2000000)]);

        $this->primary_model->create($request->only($this->primary_model->getFillable()));

        return redirect()->route(config('constants.ADMIN_PREFIX') . $this->data_assign['module_name'] . '_show');
    }

    public function update(Add $request)
    {
        $this->primary_model->where('id', $request->id)->update($request->only($this->primary_model->getFillable()));

        return redirect()->route(config('constants.ADMIN_PREFIX') . $this->data_assign['module_name'] . '_show');
    }

    public function delete(Request $request, $id)
    {
        $data = $this->primary_model->find($id);

        $data->delete();

        $this->invoice_model->where('invoice_customer',$data->customer_id)->delete();

        $request->session()->flash('success', $this->data_assign['module_add_title'] . ' Deleted');

        return back();
    }

    public function syncChangesNow()
    {
        dispatch(new CustomersCronJob());

        return back();
    }

    public function changeStatus(Request $request)
    {
        $this->primary_model->find($request->id)->update(['active' => $request->active]);
    }
}
