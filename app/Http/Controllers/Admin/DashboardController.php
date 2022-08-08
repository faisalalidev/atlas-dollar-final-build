<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\WindWard;
use App\Models\Category;
use App\Models\CronLog;
use App\Models\CronSyncQueue;
use App\Models\Inventory;
use App\Models\InventoryImage;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Store;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->module_name = 'dashboard';
        $this->module_directory = 'admin_panel';
        $this->cron_log_model = new CronLog();
        $this->inventory_model = new Inventory();
        $this->invoice_model = new Invoice();
        $this->store_model = new Store();
        $this->inventory_image_model = new InventoryImage();
        $this->category_model = new Category();
        $this->cron_queue_model = new CronSyncQueue();
        $this->order_model = new Order();
        $this->data_assign = [
            'page_title' => ucfirst($this->module_name)
        ];
    }

    public function index()
    {
        $this->data_assign['inventories_synced'] = $this->cron_log_model->where('module_type', 'inventory')->orderBy('created_at', 'DESC')->first();

        $this->data_assign['category_synced'] = $this->cron_log_model->where('module_type', 'category')->orderBy('created_at', 'DESC')->first();

        $this->data_assign['inventory_images_synced'] = $this->cron_log_model->where('module_type', 'inventory-images')->orderBy('created_at', 'DESC')->first();

        $this->data_assign['inventory_changes_synced'] = $this->cron_log_model->where('module_type', 'inventory-changes')->orderBy('created_at', 'DESC')->first();

        $this->data_assign['invoices_changes_synced'] = $this->cron_log_model->where('module_type', 'invoice-changes')->orderBy('created_at', 'DESC')->first();

        $this->data_assign['stores_synced'] = $this->cron_log_model->where('module_type', 'stores')->orderBy('created_at', 'DESC')->first();

        $this->data_assign['inventories_images_count'] = $this->inventory_image_model->count();

        $this->data_assign['inventories_count'] = $this->inventory_model->count();

        $this->data_assign['invoices_count'] = $this->invoice_model->count();

        $this->data_assign['stores_count'] = $this->store_model->count();

        $this->data_assign['category_synced_count'] = $this->data_assign['category_synced'] ?
            $this->category_model->whereDate('created_at', $this->data_assign['category_synced']->created_at)->whereNotNull('parent')->count() : 0;

        $this->data_assign['category_count'] = $this->category_model->count();

        $this->data_assign['inventory_cron_synced'] = $this->cron_queue_model->where('module', 'inventory')->where('synced', 0)->count();

        $this->data_assign['category_cron_synced'] = $this->cron_queue_model->where('module', 'categories')->where('synced', 0)->count();

        $this->data_assign['images_cron_synced'] = $this->cron_queue_model->where('module', 'inventory-images')->where('synced', 0)->count();

        $this->data_assign['changes_cron_synced'] = $this->cron_queue_model->where('module', 'inventory-changes')->where('synced', 0)->count();

        $this->data_assign['invoice_changes_cron_synced'] = $this->cron_queue_model->where('module', 'invoice-changes')->where('synced', 0)->count();

        $this->data_assign['stores_cron_synced'] = $this->cron_queue_model->where('module', 'customers')->where('synced', 0)->count();

        $this->data_assign['orders'] = $this->order_model->orderBy('created_at','desc')->limit(10)->get();

        $this->data_assign['orders_module'] = 'orders';

        return view($this->module_directory . '.' . $this->module_name . '.' . __FUNCTION__, $this->data_assign);
    }

    public function checkApiConnection()
    {
        $windward = new WindWard();

        try {

            $response = $windward->getDataRequest('check-connection');

            $response = $response->result[0];

            if ($response->Response == 'Success') {

                return response()->json([
                    'Connected' => 'Success',
                    'data' => $response,
                ]);
            } else {

                return response()->json([
                    'error' => 'Not Connected'
                ], 400);
            }

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
