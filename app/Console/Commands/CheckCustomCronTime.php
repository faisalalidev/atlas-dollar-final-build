<?php

namespace App\Console\Commands;

use App\Models\CustomCronJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CheckCustomCronTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:custom-cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $custom_cron = CustomCronJob::where('time_to_execute',date('H:i'))->get();

        foreach ($custom_cron as $data){

            Artisan::call($data->command);

        }
    }
}
