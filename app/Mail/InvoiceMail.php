<?php

namespace App\Mail;

use App\Models\ApplicationSetting;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $order;
    private $message;
    private $redirect_url;
    private $admin_email;
    private $application_name;
    private $file_path;

    public function __construct($order_id, $message, $redirect_url, $admin_email, $file_path = '')
    {
        $this->order = Order::find($order_id);

        $this->message = $message;

        $this->redirect_url = $redirect_url;

        $this->admin_email = $admin_email;

        $this->file_path = $file_path;

        $this->application_name = ApplicationSetting::where('setting_name', 'application_name')->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $store_address = [];

        $store_name = '';

        $user = $this->order->user;

        $subject = $this->admin_email ? 'New Order #' . $this->order->id : 'Order Successfully #' . $this->order->id;

        if ($user && $user->store && count($user->store->contacts)) {

            $store_address = $user->store->contacts[0]->toArray();

            $store_name = $user->store->name;
        }

        if ($this->admin_email) {

            return $this->view('emails.order_email')->with([
                'order' => $this->order,
                'message' => $this->message,
                'store_name' => $store_name,
                'application_name' => $this->application_name->setting_value,
                'redirect_url' => $this->redirect_url,
                'store_address' => $store_address,
                'admin_email' => $this->admin_email,
            ])->subject($subject)->attach(asset($this->file_path));

        } else {

            $pdf = Pdf::loadView('admin_panel.orders.view_iframe', ['data' => $this->order,'address' => $this->order->user->store->contacts[0]]);

            return $this->view('emails.order_email')->with([
                'order' => $this->order,
                'message' => $this->message,
                'store_name' => $store_name,
                'application_name' => $this->application_name->setting_value,
                'redirect_url' => $this->redirect_url,
                'store_address' => $store_address,
                'admin_email' => $this->admin_email,
            ])->subject($subject)->attachData($pdf->output(), str_replace(' ', '-', $store_name) . ".pdf");


        }


    }
}
