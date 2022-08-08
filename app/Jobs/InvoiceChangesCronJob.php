<?php

namespace App\Jobs;

use App\Models\CronSyncQueue;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InvoiceChangesCronJob implements ShouldQueue
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
        CronSyncQueue::create(['module' => 'invoice-changes']);

        $invoice_model = new Invoice();

        $invoice_model->detectChangesFromApi();

        CronSyncQueue::where('module','invoice-changes')->update(['synced' => 1]);
    }
}
