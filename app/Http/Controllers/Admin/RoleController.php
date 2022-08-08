<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Role\Add;
use App\Http\Requests\Admin\Role\Update;
use App\Models\PortalUserModulePermission;
use App\Models\PortalUserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends CRUDController
{
    public function __construct()
    {
        parent::__construct();
        $this->primary_model = new PortalUserRole();
        $this->role_permission_model = new PortalUserModulePermission();
        $this->module_name = 'role_management';
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

    public function store(Add $request)
    {
        $request->merge([
            'role_slug' => Str::slug($request->role_name, '_')
        ]);

        $this->primary_model->create($request->only($this->primary_model->getFillable()));

        $this->role_permission_model->storeDate($request->all());

        $request->session()->flash('success', $this->data_assign['module_add_title'] . ' Added');

        return redirect()->route(config('constants.ADMIN_PREFIX') . $this->data_assign['module_name'] . '_show');
    }

    public function update(Update $request)
    {
        $request->merge([
            'role_slug' => Str::slug($request->role_name, '_')
        ]);

        $this->primary_model->where('id', $request->id)->update($request->only($this->primary_model->getFillable()));

        $this->role_permission_model->storeDate($request->all());

        $request->session()->flash('success', $this->data_assign['module_add_title'] . ' Updated');

        return redirect()->route(config('constants.ADMIN_PREFIX') . $this->data_assign['module_name'] . '_show');
    }


    public function delete(Request $request, $id)
    {
        $data = $this->primary_model->find($id);

        $data->delete();

        $this->role_permission_model->where('role_slug', $data->role_slug)->delete();

        $request->session()->flash('success', $this->data_assign['module_add_title'] . ' Deleted');

        return back();
    }
}
