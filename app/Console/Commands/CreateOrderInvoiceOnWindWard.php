<?php

namespace App\Console\Commands;

use App\Jobs\CreateOrderJob;
use App\Jobs\OrderEmailJob;
use App\Libraries\WindWard;
use App\Models\Email;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CreateOrderInvoiceOnWindWard extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Order Invoice';

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
        /*$order_model = new Order();

        $orders = $order_model->where('invoice_created',0)->get();

        foreach ($orders as $order){

            $order_model->createOrderOnWindward($order->id);
        }*/
    }
}
