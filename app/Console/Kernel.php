<?php

namespace App\Console;

use App\Console\Commands\CheckCustomCronTime;
use App\Console\Commands\CheckWindwardConnection;
use App\Console\Commands\CreateOrderInvoiceOnWindWard;
use App\Console\Commands\EnsureQueueListenerIsRunning;
use App\Console\Commands\InventoriesCron;
use App\Console\Commands\InventoryChangesCron;
use App\Console\Commands\InventoryImagesCron;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        InventoriesCron::class,
        InventoryImagesCron::class,
        InventoryChangesCron::class,
        CheckCustomCronTime::class,
        CheckWindwardConnection::class,
        EnsureQueueListenerIsRunning::class,
        //CreateOrderInvoiceOnWindWard::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('run:custom-cron')->everyMinute();

        $schedule->command('queue:checkup');

        $schedule->command('check:connection')->everyTwoHours()->withoutOverlapping();

        //$schedule->command('create:invoice')->everyThirtyMinutes()->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
