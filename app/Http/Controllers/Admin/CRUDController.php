<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CRUDController extends Controller
{
    protected $primary_model;
    protected $module_name;
    protected $module_directory;
    protected $data_assign = [];
    //Datatable data
    protected $actions = ['add', 'edit', 'delete'];
    protected $raw_columns = ['actions'];
    protected $actions_view = 'includes.datatable_buttons';

    final function getElementViews()
    {
        //return ['image', 'toggle', 'url', 'dropdown', 'comment'];
        return ['image'];
    }

    public function __construct()
    {
        $this->module_directory = 'admin_panel';
        $this->data_assign['add_enabled'] = true;
    }

    public function show()
    {
        return view($this->module_directory . '.' . $this->module_name . '.' . Str::snake(__FUNCTION__), $this->data_assign);
    }

    public function edit($id)
    {
        $this->data_assign['data'] = $this->primary_model->find($id);

        return view($this->module_directory . '.' . $this->module_name . '.' . Str::snake(__FUNCTION__), $this->data_assign);
    }

    public function view(Request $request)
    {
        $this->data_assign['data'] = $this->primary_model->findOrFail($request->id);

        return view($this->module_directory . '.' . $this->module_name . '.' . Str::snake(__FUNCTION__), $this->data_assign);
    }

    public function add()
    {
        return view($this->module_directory . '.' . $this->module_name . '.' . Str::snake(__FUNCTION__), $this->data_assign);
    }

    public function dtListing()
    {
        $data = $this->primary_model->ajaxListing();
        return $this->makeDataTable($data, $this->actions, $this->module_name);
    }

    final function makeDataTable($data, $actions, $module, $is_order = true)
    {
        $buttons = $this->makeCustomActionButtons($module);

        $data_table = Datatables::of($data)->order(function ($query) use ($is_order) {
            $query->orderBy('created_at', 'desc');
        });

        if (!empty($this->raw_columns)) {
            foreach ($this->raw_columns as $raw_column) {
                $compact_arr = $raw_column == 'actions' ? compact('module', 'buttons', 'actions') : compact('module');
                $view = $this->module_directory . '.' . $this->{$raw_column . '_view'};
                $data_table->addColumn($raw_column, function ($row) use ($view, $compact_arr, $module) {
                    $compact_arr['row'] = $row;
                    $compact_arr['module'] = $module;
                    return View::make($view, $compact_arr)->render();
                });
            }
        }

        $data_table->editColumn('created_at', function ($row) {
            return Carbon::make($row->created_at)->format('Y-m-d H:i'); // human readable format
        });

        $final_data_table = $data_table->rawColumns($this->raw_columns)->make(true);
        return $final_data_table;
    }

    protected function makeCustomActionButtons($module)
    {
        return [
            'edit' => ['route' => config('constants.ADMIN_PREFIX') . $module . '_edit'],
            'delete' => ['route' => config('constants.ADMIN_PREFIX') . $module . '_delete'],
            'view' => ['route' => config('constants.ADMIN_PREFIX') . $module . '_view']
        ];
    }
}
