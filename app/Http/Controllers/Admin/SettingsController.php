<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingsController extends CRUDController
{
    public function __construct()
    {
        parent::__construct();
        $this->module_name = 'settings';
        $this->data_assign['page_title'] = ucwords(str_replace('_', ' ', Str::singular($this->module_name)));
        $this->data_assign['module_name'] = $this->module_name;
    }

    public function index()
    {
        return view($this->module_directory . '.' . $this->module_name . '.' . Str::snake(__FUNCTION__), $this->data_assign);
    }
}
