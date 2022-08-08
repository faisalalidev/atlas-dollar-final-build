<?php

namespace App\Jobs;

use App\Models\CronLog;
use App\Models\CronSyncQueue;
use App\Models\Inventory;
use App\Models\InventoryImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InventoryImagesSyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        CronSyncQueue::create(['module' => 'inventory-images']);

        $inventory_model = new Inventory();

        $inventory_image_model = new InventoryImage();

        $inventories = $inventory_model->whereDoesntHave('images')->get();

        foreach ($inventories as $inventory) {
            $inventory_image_model->getImageFromApi($inventory->inventory_id);
        }

        CronLog::create([
            'module_type' => 'inventory-images',
            'page_size' => count($inventories->toArray())
        ]);

        CronSyncQueue::where('module','inventory-images')->update(['synced' => 1]);
    }
}
