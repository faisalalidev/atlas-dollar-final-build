<?php

namespace App\Jobs;

use App\Mail\InvoiceMail;
use App\Models\ApplicationSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $order_id;
    private $message;
    private $redirect_url;
    private $admin_email;
    private $emails;
    private $file_path;

    public function __construct($order_id, $message, $redirect_url, $admin_email, $emails,$file_path = '')
    {
        $this->order_id = $order_id;

        $this->message = $message;

        $this->redirect_url = $redirect_url;

        $this->admin_email = $admin_email;

        $this->emails = $emails;

        $this->file_path = $file_path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->emails)->send(new InvoiceMail($this->order_id, $this->message, $this->redirect_url, $this->admin_email,$this->file_path));
    }
}
