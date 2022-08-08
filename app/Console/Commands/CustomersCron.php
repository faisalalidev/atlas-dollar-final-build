<?php

namespace App\Console\Commands;

use App\Jobs\CustomersCronJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CustomersCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customers:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get All Customers from api.';

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
        Log::info('Customer Cron Started');

        dispatch(New CustomersCronJob());

        Log::info('Customer Cron ended');
    }
}
