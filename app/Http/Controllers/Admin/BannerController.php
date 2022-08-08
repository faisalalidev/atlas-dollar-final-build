<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Requests\Admin\Banner\Add;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends CRUDController
{
    public function __construct()
    {
        parent::__construct();
        $this->primary_model = new Banner();
        $this->module_name = 'banners';
        $this->raw_columns = ['display_image', 'actions'];
        $this->actions = ['add', 'edit', 'delete'];
        $this->display_image_view = $this->module_name . '.image_view';
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
        $request->merge(['image' => 'files/'. $this->uploadImage($request->file('photo'))]);

        $this->primary_model->create($request->only($this->primary_model->getFillable()));

        return redirect()->route(config('constants.ADMIN_PREFIX') . $this->data_assign['module_name'] . '_show');
    }

    public function update(Request $request)
    {
        if ($request->hasFile('photo')){

            $request->merge(['image' => 'files/'. $this->uploadImage($request->file('photo'))]);
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
