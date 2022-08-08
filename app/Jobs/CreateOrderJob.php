<?php

namespace App\Jobs;

use App\Libraries\WindWard;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\CronErrorLog;
use App\Models\Email;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $order_id;
    private $cart;
    private $user_address;

    public function __construct($order_id,$cart,$user_address)
    {
        $this->order_id = $order_id;
        $this->cart = $cart;
        $this->user_address = $user_address;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order_model = new Order();

        $order = $order_model->find($this->order_id);

        $txt_file = 'txtFiles/' . ($this->user_address ? str_replace(' ','-',$this->user_address->first_name) . '-' : '') . ($this->user_address ? str_replace(' ','-',$this->user_address->last_name) . '-' : '') . $order->id . '.txt';

        $txt_file_path = public_path($txt_file);

        $order->update(['txt_file_path' => $txt_file]);

        $fp = fopen($txt_file_path, "wb");

        foreach ($this->cart as $item) {

            OrderProduct::create([
                'order_id' => $order->id,
                'inventory_id' => $item->inventory_id,
                'quantity' => $item->quantity,
                'price' => isset($item->inventory->prices[0]) ? (double)$item->inventory->prices[0]->regular : $item->inventory->float_price,
            ]);

            fwrite($fp, $item->inventory->part_number . "\n");

            fwrite($fp, $item->quantity . "\n");

        }

        fclose($fp);

        $order = $order_model->find($order->id);

        $admin_msg = 'You’ve received the following order from ' . $order->user->store->name . ':';

        $email = Email::where('slug', 'new_order')->first();

        $emails = explode(',', $email->recipients);

        if (count($emails)) {

            dispatch(new OrderEmailJob(
                $order->id,
                $admin_msg,
                route(config('constants.ADMIN_PREFIX') . 'orders_view', ['id' => $order->id]),
                1,
                $emails,
                $order->txt_file_path));

        }

        dispatch(new OrderEmailJob(
            $order->id,
            'Your Order has been successfully placed.',
            route(config('constants.WEB_PREFIX') . 'order_view', ['id' => $order->id, 'view' => '1']),
            0,
            $order->user->email));

        $cart_model = new Cart();

        session()->remove('order_items');

        $default_cart = $cart_model->where('user_id', $order->user_id)->where('default', true)->first();

        CartItem::where('cart_id', $default_cart->id)->delete();

        $default_cart->delete();
    }
}
