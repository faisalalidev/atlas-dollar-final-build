<?php

namespace App\Console\Commands;

use App\Jobs\CategorySyncJob;
use App\Jobs\InventorySyncCronJob;
use App\Models\Category;
use App\Models\CronLog;
use App\Models\Inventory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InventoriesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventories:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Inventories and Categories From Windward api.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Inventory Cron Started');

        dispatch(New InventorySyncCronJob());

        dispatch(new CategorySyncJob());

        Log::info('Inventory Cron ended');
    }
}
