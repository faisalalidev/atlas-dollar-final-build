<?php

namespace App\Models;

use App\Libraries\WindWard;
use App\Mail\InvoiceMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_sub_total', 'invoice_tax_total', 'invoice_number', 'invoice_ordered', 'invoice_date', 'invoice_type',
        'invoice_department', 'invoice_book_month', 'invoice_customer', 'invoice_ship_to', 'invoice_salesman', 'invoice_shipping', 'invoice_status'];

    protected $appends = ['total_amount'];

    public function insertDataFromApi($invoice_id = '', $send_mail_to_customer = true)
    {
        $wind_ward_api = new WindWard();

        $invoice_status = [
            'A' => 'Final Invoice',
            'E' => 'Estimate',
            'W' => 'Work Order',
        ];

        try {

            $params = $invoice_id ? '/' . $invoice_id : '';

            $response = $wind_ward_api->getDataRequest('get-invoices', $params);

            if (!isset($response->Invoice) && !isset($response->result)) {

                ApplicationSetting::sendErrorResponseToAdminEmails('get-invoices -----> Response is invalid. Response : ' . json_encode($response));
            }

            $invoices = [];

            if (isset($response->result)) {

                $invoices = isset($response->result[0]->Invoice) ? $response->result[0]->Invoice : [];

            } elseif (isset($response->Invoice)) {

                $invoices = $response->Invoice;
            }

            $invoice_product_model = new InvoiceProduct();

            $invoice_tender_model = new InvoiceTender();

            $invoice_billing_model = new InvoiceBilling();

            $store_model = new Store();

            foreach ($invoices as $invoice) {

                $data = [
                    'invoice_sub_total' => $invoice->InvoiceHeader->InvoiceSubTotal,
                    'invoice_tax_total' => $invoice->InvoiceHeader->InvoiceTaxTotal,
                    'invoice_ordered' => $invoice->InvoiceHeader->InvoiceOrdered,
                    'invoice_date' => $invoice->InvoiceHeader->InvoiceDate,
                    'invoice_type' => $invoice->InvoiceHeader->InvoiceType,
                    'invoice_department' => $invoice->InvoiceHeader->InvoiceDepartment,
                    'invoice_book_month' => $invoice->InvoiceHeader->InvoiceBookMonth,
                    'invoice_customer' => $invoice->InvoiceHeader->InvoiceCustomer,
                    'invoice_ship_to' => $invoice->InvoiceHeader->InvoiceShipTo,
                    'invoice_salesman' => $invoice->InvoiceHeader->InvoiceSalesman,
                    'invoice_shipping' => json_encode($invoice->InvoiceShipping),
                    'invoice_status' => $invoice_status[$invoice->InvoiceHeader->InvoiceType],
                ];


                $this->updateOrCreate(
                    ['invoice_number' => $invoice->InvoiceHeader->InvoiceNumber],
                    $data
                );

                $customer = $store_model->where('customer_id', $data['invoice_customer'])->count();

                if (!$customer) {

                    $store_model->insertDataFromApi($data['invoice_customer']);
                }

                $invoice_product_model->createInvoiceProducts($invoice->InvoiceLines, $invoice->InvoiceHeader->InvoiceNumber);

                $invoice_tender_model->createInvoiceTender($invoice->InvoiceTenders, $invoice->InvoiceHeader->InvoiceNumber);

                $invoice_billing_model->createInvoiceBillings($invoice->InvoiceBilling, $invoice->InvoiceHeader->InvoiceNumber);

                /*$order = Order::where('invoice_id', $invoice->InvoiceHeader->InvoiceNumber)->first();

                if ($order) {

                    $order->update([
                        'status' => $invoice_status[$invoice->InvoiceHeader->InvoiceType],
                        'price' => (double)$invoice->InvoiceHeader->InvoiceSubTotal + (double)$invoice->InvoiceHeader->InvoiceTaxTotal
                    ]);

                    OrderProduct::where('order_id', $order->id)->delete();

                    foreach ($invoice->InvoiceLines as $product) {

                        OrderProduct::create([
                            'order_id' => $order->id,
                            'inventory_id' => $product->PartUnique,
                            'price' => $product->Price,
                            'quantity' => $product->Ordered
                        ]);
                    }

//                    if ($send_mail_to_customer) {
//
//                        Mail::to($order->user->email)->send(new InvoiceMail(
//                            $order->id,
//                            'Your order has been updated by admin.',
//                            route(config('constants.WEB_PREFIX') . 'order_view', ['id' => $order->id, 'view' => '1']),
//                            0));
//
//                    }
                }*/
            }

            if (!$invoice_id) {

                CronLog::create([
                    'module_type' => 'invoices',
                    'page_size' => count($invoices),
                ]);

            }

        } catch (\Exception $e) {

            CronErrorLog::create([
                'module_type' => 'invoices',
                'error' => $e->getMessage()
            ]);
        }

    }

    public function detectChangesFromApi()
    {
        $wind_ward_api = new WindWard();

        try {
            $cron_log = CronLog::where('module_type', 'invoice-changes')->orderBy('created_at', 'DESC')->first();

            if ($cron_log) {

                $date = date('Y-m-d', strtotime($cron_log->created_at));

            } else {

                $date = date('Y-m-d', strtotime(date('Y-m-d') . ' -1 day'));
            }

            $response = $wind_ward_api->postDataRequest('get-invoice-changes', '', ['FileNumber' => 9, 'EffectiveDate' => $date]);

            if (!isset($response->result)) {

                ApplicationSetting::sendErrorResponseToAdminEmails('get-invoice-changes -----> Response is invalid. Response : ' . json_encode($response));
            }

            $response = $response->result[0];

            if ($response->Response == 'Success') {

                $changes = $response->Results;

                CronLog::create([
                    'module_type' => 'invoice-changes',
                    'page_size' => count($changes),
                ]);

                foreach ($changes as $change) {

                    $this->insertDataFromApi($change->RecordID);
                }
            }

        } catch (\Exception $e) {

            CronErrorLog::create([
                'module_type' => 'invoice-changes',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getTotalAmountAttribute()
    {
        return '$' . ((double)$this->invoice_sub_total + (double)$this->invoice_tax_total);
    }

    public function customer()
    {
        return $this->belongsTo(Store::class, 'invoice_customer', 'customer_id');
    }

    public function products()
    {
        return $this->hasMany(InvoiceProduct::class, 'invoice_number', 'invoice_number');
    }

    public function billedTo()
    {
        return $this->hasMany(InvoiceBilling::class, 'invoice_number', 'invoice_number');
    }

    public function getDataTableColumns()
    {
        return [
            [
                'title' => 'Invoice',
                'data' => 'invoice_title'
            ],
            [
                'title' => 'Invoice Number',
                'data' => 'invoice_number',
                'visible' => false
            ],
            [
                'title' => 'Invoice Type',
                'data' => 'invoice_type'
            ],
            [
                'title' => 'Total Amount',
                'data' => 'total_amount',
                'searchable' => 'false'
            ],
            [
                'title' => 'Invoice Type',
                'data' => 'invoice_status',
                'visible' => false
            ],
            [
                'title' => 'Customer',
                'data' => 'customer.name',
                'visible' => false
            ],
            [
                'title' => 'Invoice Date',
                'data' => 'invoice_date'
            ],
            [
                'title' => 'Invoice Ordered Date',
                'data' => 'invoice_ordered'
            ],
            [
                'title' => 'Actions',
                'data' => 'actions'
            ]
        ];
    }

    public function totalQuantity()
    {
        $quantity = 0;

        foreach ($this->products as $product) {

            $quantity += $product->ordered;
        }

        return $quantity;
    }

    public function ajaxListing()
    {
        return $this->query()->where('invoice_status', 'Final Invoice')->with('customer');
    }
}
