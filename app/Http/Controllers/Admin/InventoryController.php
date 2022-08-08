<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Inventory\Add;
use App\Jobs\DetectChangesJob;
use App\Jobs\InventoryImagesSyncJob;
use App\Jobs\InventorySyncCronJob;
use App\Models\Category;
use App\Models\CronSyncQueue;
use App\Models\Inventory;
use App\Models\InventoryImage;
use App\Models\InventoryPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InventoryController extends CRUDController
{
    public function __construct()
    {
        parent::__construct();
        $this->primary_model = new Inventory();
        $this->category_model = new Category();
        $this->image_model = new InventoryImage();
        $this->cron_queue_model = new CronSyncQueue();
        $this->inventory_price_model = new InventoryPrice();
        $this->actions = ['delete', 'view','sync'];
        $this->module_name = 'inventories';
        $this->raw_columns = ['display_image','stock_view', 'actions','status_view','created_at_view'];
        $this->display_image_view = $this->module_name . '.image_view';
        $this->stock_view_view = $this->module_name . '.stock_view';
        $this->status_view_view = $this->module_name . '.status_view';
        $this->created_at_view_view = $this->module_name . '.created_at_view';
        $this->data_assign['page_title'] = ucwords(str_replace('_', ' ', Str::singular($this->module_name)));
        $this->data_assign['module_name'] = $this->module_name;
        $this->data_assign['module_add_title'] = ucfirst(explode('_', Str::singular($this->module_name))[0]);
    }

    public function show()
    {
        $this->data_assign['module_ajax_listing_url'] = config('constants.ADMIN_PREFIX') . $this->module_name . '_dtListing';

        $this->data_assign['primary_dt_columns'] = $this->primary_model->getDataTableColumns();

        $this->data_assign['categories'] = $this->category_model->where('active',1)->whereNotNull('parent')->get();

        return parent::show();
    }

    public function add()
    {
        $this->data_assign['categories'] = $this->category_model->where('active',1)->whereNotNull('parent')->get();

        return parent::add();
    }

    public function edit($id)
    {
        $this->data_assign['categories'] = $this->category_model->where('active',1)->whereNotNull('parent')->get();

        return parent::edit($id);
    }

    public function store(Add $request)
    {
        $request->merge(['inventory_id' => rand(1000000, 2000000)]);

        $data = $this->primary_model->create($request->only($this->primary_model->getFillable()));

        $this->inventory_price_model->create([
            'inventory_id' => $data->inventory_id,
            'level' => 0,
            'department' => 0,
            'regular' => $request->price,
            'sale' => $request->price
        ]);

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $image = $this->uploadImage($file);

            $this->image_model->create([
                'inventory_id' => $data->inventory_id,
                'image' => $image,
                'image_name' => $file->getClientOriginalName()
            ]);
        }

        return redirect()->route(config('constants.ADMIN_PREFIX') . $this->data_assign['module_name'] . '_show');
    }

    public function update(Add $request)
    {
        $data = $this->primary_model->where('id', $request->id)->first();

        $data->update($request->only($this->primary_model->getFillable()));

        $this->inventory_price_model->where('level', 0)->where('inventory_id', $data->inventory_id)->delete();

        $this->inventory_price_model->create([
            'inventory_id' => $data->inventory_id,
            'level' => 0,
            'department' => 0,
            'regular' => $request->price,
            'sale' => $request->price
        ]);

        if ($request->hasFile('photo')) {

            $this->image_model->where('inventory_id', $data->inventory_id)->delete();

            $file = $request->file('photo');

            $image = $this->uploadImage($file);

            $this->image_model->create([
                'inventory_id' => $data->inventory_id,
                'image' => $image,
                'image_name' => $file->getClientOriginalName()
            ]);
        }

        return redirect()->route(config('constants.ADMIN_PREFIX') . $this->data_assign['module_name'] . '_show');
    }

    public function delete(Request $request, $id)
    {
        $data = $this->primary_model->find($id);

        $data->delete();

        $this->image_model->where('inventory_id', $data->inventory_id)->delete();

        $request->session()->flash('success', $this->data_assign['module_add_title'] . ' Deleted');

        return back();
    }

    public function syncNow()
    {
        dispatch(new InventorySyncCronJob());

        return back();
    }

    public function syncImagesNow()
    {
        dispatch(new InventoryImagesSyncJob());

        return back();
    }

    public function syncChangesNow()
    {
        dispatch(new DetectChangesJob());

        return back();
    }

    public function syncSingleInventory($id)
    {
        $inventory = $this->primary_model->find($id);

        $this->primary_model->insertDataFromApi($inventory->inventory_id);

        return back();
    }
}
