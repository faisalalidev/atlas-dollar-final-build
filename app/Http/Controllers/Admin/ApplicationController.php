<?php

namespace App\Http\Controllers\Admin;


use App\Models\ApplicationSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApplicationController extends CRUDController
{
    public function __construct()
    {
        parent::__construct();
        $this->primary_model = new ApplicationSetting();
        $this->module_name = 'application_management';
        $this->data_assign['page_title'] = ucwords(str_replace('_', ' ', Str::singular($this->module_name)));
        $this->data_assign['module_name'] = $this->module_name;
        $this->data_assign['module_add_title'] = ucfirst(explode('_', Str::singular($this->module_name))[0]);
    }

    public function show()
    {
        $this->data_assign['data'] = $this->primary_model->get();

        return parent::add();
    }

    public function store(Request $request)
    {
        $text_fields = $request->post();

        $files = $request->files;

        foreach ($files as $setting_name => $file){

            $this->primary_model->where('setting_name',$setting_name)->update(['setting_value' => 'files/'.$this->uploadImage($request->file($setting_name))]);
        }

        foreach ($text_fields as $setting_name => $setting) {

            $this->primary_model->where('setting_name',$setting_name)->update(['setting_value' => $setting]);
        }

        $request->session()->flash('success', $this->data_assign['module_add_title'] . ' Updated');

        return back();
    }
}
