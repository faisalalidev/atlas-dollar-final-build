<?php

namespace App\Models;

use App\Jobs\CreateOrderJob;
use App\Jobs\OrderEmailJob;
use App\Libraries\WindWard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'user_id', 'store_id', 'invoice_created', 'status', 'customer_notes', 'order_type', 'txt_file_path'
        , 'items_to_insert', 'items_inserted','price'];

    protected $appends = ['total_amount', 'created'];

    public function getCreatedAttribute($value)
    {
        return date('m/d/y H:i:s', strtotime($this->created_at));
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_number');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(PortalUser::class, 'user_id');
    }

    public function getTotalAmount()
    {
        if ($this->price){

            return $this->price;
        }

        $amount = 0;

        if (!count($this->products) && session()->has('order_items')){

            foreach (session()->get('order_items') as $item) {

                $amount += $item->quantity * (isset($item->inventory->prices[0]) ? $item->inventory->prices[0]->regular : $item->inventory->price);
            }

        }else{

            foreach ($this->products as $item) {

                $amount += $item->quantity * $item->price;
            }

        }

        return $amount;

    }

    public function createOrder($params)
    {
        $cart_model = new Cart();

        $cart = $cart_model->getDefaultCartItems();

        if (!count($cart)) {

            return false;
        }

        $order = $this->create([
            'customer_notes' => isset($params['customer_notes']) ? $params['customer_notes'] : '',
            'order_type' => isset($params['order_type']) ? $params['order_type'] : '',
            'user_id' => getLoggedInUser()->id,
            'store_id' => getLoggedInUser()->store_id,
            'status' => 'Estimate',
            'items_to_insert' => count($cart)
        ]);

        $user_address = getUserStoreAddress();

        $cart_items = $cart;

        session()->put('order_items',$cart_items);

        dispatch(new CreateOrderJob($order->id,$cart_items,$user_address));

        $default_cart = $cart_model->getDefaultCart();

        $default_cart->update(['in_process' => 1]);

        return $order;
    }

    public function getInvoiceIdAttribute($value)
    {
        return $value ? $value : '-';
    }

    public function getTotalAmountAttribute()
    {
        return '$' . $this->getTotalAmount();
    }

    public function getDataTableColumns()
    {
        return [
            [
                'title' => 'Order ID',
                'data' => 'id'
            ],
            [
                'title' => 'User',
                'data' => 'user.name'
            ],
            [
                'title' => 'Store',
                'data' => 'store.name'
            ],

            [
                'title' => 'Order Date',
                'data' => 'created',
                'searchable' => 'false'
            ],
            [
                'title' => 'Created At',
                'data' => 'created_at',
                'visible' => false
            ],
            [
                'title' => 'price',
                'data' => 'price',
                'visible' => false
            ],
            [
                'title' => 'Total Amount',
                'data' => 'total_amount',
                'searchable' => 'false'
            ],
            [
                'title' => 'Order Type',
                'data' => 'order_type'
            ],
            [
                'title' => 'Actions',
                'data' => 'actions'
            ]
        ];
    }

    public function ajaxListing()
    {
        return $this->query()->with(['user', 'store']);
    }

    public function createOrderOnWindward($order_id){

        try {

            $wind_ward_api = new WindWard();

            $order = $this->findOrFail($order_id);

            $user_address = getUserStoreAddress($order->user);

            $windward_item = [];

            $total_products_count = $order->products()->count();

            Log::info('$total_products_count ---->  ' . $total_products_count);

            for ($i = $order->items_inserted; $i < $total_products_count; $i++) {

                $item = $order->products[$i];

                $windward_item[] = [
                    'PartUnique' => $item->inventory_id,
                    'Ordered' => $item->quantity,
                    'Price' => $item->inventory->float_price,
                    'Description' => $item->inventory->description,
                ];
            }

            $windward_item = array_chunk($windward_item, 4);

            $invoice_id = !$order->invoice_id || $order->invoice_id == '-' ? '' : $order->invoice_id;

            foreach ($windward_item as $products) {

                $data = [
                    'Invoice' => [
                        [
                            'InvoiceHeader' => [
                                'InvoiceOrdered' => date('Y-m-d', strtotime($order->created_at)),
                                'InvoiceNumber' => $invoice_id,
                                'InvoiceDate' => date('Y-m-d', strtotime($order->created_at)),
                                'InvoiceType' => 'E',
                                'InvoiceSubType' => 'E',
                                'InvoiceDepartment' => 0,
                                'InvoiceBookMonth' => date('Y-m-d', strtotime($order->created_at)),
                                'InvoiceCustomer' => $order->user->store_id,
                                'InvoiceShipTo' => 0,
                                'InvoiceSalesman' => 0,
                                'ReferenceNo' => $order->id . '-' . uniqid(),
                                'order_type' => $order->order_type,
                                'InvoiceComment' => $order->customer_notes,
                            ],
                            'InvoiceTenders' => [
                                [
                                    'Type' => 'string',
                                    'Amount' => 0,
                                ]
                            ],
                            'InvoiceLines' => $products,
                            'InvoiceShipping' => [
                                'AName' => '-',
                                'FirstName' => $user_address ? $user_address->first_name : '',
                                'LastName' => $user_address ? $user_address->last_name : '',
                                'Address' => $user_address ? $user_address->address1 . ' ' . $user_address->address2 : '',
                                'City' => $user_address ? $user_address->city : '',
                                'StateProvince' => $user_address ? $user_address->state : '',
                                'Country' => $user_address ? $user_address->country : '',
                                'ZipPostal' => $user_address ? $user_address->postal : ''
                            ],
                            'InvoiceBilling' => [
                                'AName' => '-',
                                'FirstName' => $user_address ? $user_address->first_name : '',
                                'LastName' => $user_address ? $user_address->last_name : '',
                                'Address' => $user_address ? $user_address->address1 . ' ' . $user_address->address2 : '',
                                'City' => $user_address ? $user_address->city : '',
                                'StateProvince' => $user_address ? $user_address->state : '',
                                'Country' => $user_address ? $user_address->country : '',
                                'ZipPostal' => $user_address ? $user_address->postal : ''
                            ]
                        ]
                    ],
                    'ConnectionInfo' => [
                        'TerminalNumber' => 0
                    ]
                ];

                Log::info('windward api call');
                Log::info(json_encode($data));

                $response = $wind_ward_api->postDataRequest('add-invoice', '', $data);

                if(isset($response->Invoice[0])) {
                    //created
                    $response_data = $response->Invoice[0];
                } else if(isset($response->result[0]->Invoice[0])) {
                    //updated
                    $response_data = $response->result[0]->Invoice[0];
                } else {
                    $response_data = false;
                }

                if ($response_data) {

                    $order->items_inserted = $order->items_inserted + count($products);

                    $order->invoice_id = $response_data->RecordDesc;

                    $invoice_id = $response_data->RecordDesc;

                    Log::info('items inserted -----> ' . $order->items_inserted);

                    Log::info('items to insert -----> ' . count($products));

                    $order->save();
                }

                Log::info('windward response');
                Log::info(json_encode($response));

            }

            if ($total_products_count == $order->items_inserted) {

                $order->update(['invoice_created' => true]);

                $invoice_model = new Invoice();

                $invoice_model->insertDataFromApi($invoice_id, false);

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

            }
        } catch (\Exception $e) {

            Log::info($e->getMessage());
        }
    }
}
