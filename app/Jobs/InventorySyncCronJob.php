<?php

namespace App\Jobs;

use App\Models\CronLog;
use App\Models\CronSyncQueue;
use App\Models\Inventory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InventorySyncCronJob implements ShouldQueue
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
        CronSyncQueue::create(['module' => 'inventory']);

        $inventory_model = new Inventory();

        $inventory_model->insertDataFromApi();

        CronSyncQueue::where('module','inventory')->update(['synced' => 1]);
    }
}
