<?php

namespace App\Console\Commands;

use App\Jobs\InvoiceChangesCronJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InvoiceChangesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:changes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Invoice Changes api';

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
        Log::info('Invoice changes Cron started');

        dispatch(new InvoiceChangesCronJob());

        Log::info('Invoice changes Cron ended');
    }
}
