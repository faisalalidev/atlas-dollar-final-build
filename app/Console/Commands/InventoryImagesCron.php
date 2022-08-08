<?php

namespace App\Console\Commands;

use App\Jobs\InventoryImagesSyncJob;
use App\Models\CronLog;
use App\Models\Inventory;
use App\Models\InventoryImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InventoryImagesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventories:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Inventory Images.';

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
        Log::info('Inventory Images Cron started');

        dispatch(new InventoryImagesSyncJob());

        Log::info('Inventory Images Cron ended');
    }
}
