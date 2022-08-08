<?php

namespace App\Console\Commands;

use App\Jobs\DetectChangesJob;
use App\Models\Inventory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InventoryChangesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inventories:changes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Detect Inventory changes api.';

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
        Log::info('Inventory changes Cron started');

        dispatch(new DetectChangesJob());

        Log::info('Inventory changes Cron ended');
    }
}
