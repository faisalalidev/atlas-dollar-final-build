<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmailController extends CRUDController
{
    public function __construct()
    {
        parent::__construct();
        $this->primary_model = new Email();
        $this->module_name = 'emails';
        $this->actions = ['edit'];
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

    public function edit($id)
    {
        return parent::edit($id);
    }

    public function update(Request $request)
    {
        $this->primary_model->where('id', $request->id)->update($request->only($this->primary_model->getFillable()));

        return redirect()->route(config('constants.ADMIN_PREFIX') . $this->data_assign['module_name'] . '_show');
    }
}
