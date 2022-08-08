<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PortalUser\Add;
use App\Http\Requests\Admin\PortalUser\Update;
use App\Models\PortalUser;
use App\Models\PortalUserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortalUserController extends CRUDController
{
    public function __construct()
    {
        parent::__construct();
        $this->primary_model = new PortalUser();
        $this->role_model = new PortalUserRole();
        $this->module_name = 'portal_user_management';
        $this->data_assign['page_title'] = ucwords(str_replace('_', ' ', Str::singular($this->module_name)));
        $this->data_assign['module_name'] = $this->module_name;
        $this->data_assign['module_add_title'] = ucfirst(explode('_', Str::singular($this->module_name))[1]);
    }

    public function show()
    {
        $this->data_assign['module_ajax_listing_url'] = config('constants.ADMIN_PREFIX') . $this->module_name . '_dtListing';

        $this->data_assign['primary_dt_columns'] = $this->primary_model->getDataTableColumns();

        return parent::show();
    }

    public function add()
    {
        $this->data_assign['portal_roles'] = $this->role_model->where('role_slug', '!=', config('constants.ALL_PRIVILEGE_ROLE_SLUG'))->get();

        return parent::add();
    }

    public function store(Add $request)
    {
        $request->merge(['password' => bcrypt($request->password), 'portal_login' => 1]);

        $this->primary_model->create($request->only($this->primary_model->getFillable()));

        return redirect()->route(config('constants.ADMIN_PREFIX') . $this->data_assign['module_name'] . '_show');
    }

    public function edit($id)
    {
        $this->data_assign['portal_roles'] = $this->role_model->where('role_slug', '!=', config('constants.ALL_PRIVILEGE_ROLE_SLUG'))->get();

        return parent::edit($id);
    }

    public function update(Update $request)
    {
        if ($request->password) {

            $request->merge(['password' => bcrypt($request->password)]);

        } else {

            $request->request->remove('password');
        }

        $this->primary_model->where('id', $request->id)->update($request->only($this->primary_model->getFillable()));

        return redirect()->route(config('constants.ADMIN_PREFIX') . $this->data_assign['module_name'] . '_show');
    }


    public function delete(Request $request, $id)
    {
        $data = $this->primary_model->find($id);

        $data->delete();

        $request->session()->flash('success', $this->data_assign['module_add_title'] . ' Deleted');

        return back();
    }
}
