<?php

namespace App\Models;

use App\Libraries\WindWard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'address', 'customer_id', 'address2', 'city', 'country', 'state', 'postal', 'phone2', 'phone3',
        'app_discount', 'app_discount_rule', 'app_discount_days', 'currency_code', 'duty', 'fed_tax', 'auto_discount', 'due_days', 'price_schedule',
        'contract_date', 'salesman', 'cs_type', 'terms', 'interest', 'tax_status', 'tax_number', 'bank_info', 'ship_no', 'search_contract', 'credit_limit',
        'standing_po', 'po_expiry_date', 'po_maximum_value', 'department', 'po_billed_so_far', 'gst_exempt', 'tax_code', 'number', 'dis_nv', 'dis_stat',
        'retail_type', 'foreign', 'last_visit', 'web_comments', 'password', 'e_commerce', 'eft_account', 'eft_bank', 'eft_name', 'timezone_id', 'balances',
        'free_form_group', 'shipping_address','active'];

    protected $appends = ['created'];

    public function getEmailAttribute($value)
    {
        return $value ? $value : '-';
    }

    public function getPhoneAttribute($value)
    {
        return $value ? $value : '-';
    }

    public function getCreatedAttribute($value)
    {
        return date('m/d/y H:i:s',strtotime($this->created_at));
    }

    public function getNameAttribute($value)
    {
        return $value ? $value : '-';
    }

    public function contacts()
    {
        return $this->hasMany(StoreContact::class,'customer_id','customer_id');
    }

    public function insertDataFromApi($customer_id = '')
    {
        $wind_ward_api = new WindWard();

        try {

            $params = $customer_id ? '/' . $customer_id : '';

            $response = $wind_ward_api->getDataRequest('get-customers', $params);

            if (!isset($response->Customers) && !isset($response->result)){

                ApplicationSetting::sendErrorResponseToAdminEmails('get-customers -----> Response is invalid. Response : '.json_encode($response));
            }

            $customers = [];

            if (isset($response->result)) {

                $customers = isset($response->result[0]->Customers) ? $response->result[0]->Customers : [];

            } elseif (isset($response->Customers)) {

                $customers = $response->Customers;
            }

            $store_contacts_model = new StoreContact();

            foreach ($customers as $customer) {

                if (empty($customer->Name) || $customer->Name == '-'){
                    continue;
                }

                $data = [
                    'name' => $customer->Name ? $customer->Name : '-',
                    'email' => $customer->Email,
                    'phone' => $customer->Phone1,
                    'address' => $customer->Addr1,
                    'address2' => $customer->Addr2,
                    'city' => $customer->City,
                    'country' => $customer->Country,
                    'state' => $customer->State,
                    'postal' => $customer->Postal,
                    'phone2' => $customer->Phone2,
                    'phone3' => $customer->Phone3,
                    'app_discount' => $customer->APDiscount,
                    'app_discount_rule' => $customer->APDiscountRule,
                    'app_discount_days' => $customer->APDiscountDays,
                    'currency_code' => $customer->CurrencyCode,
                    'duty' => $customer->Duty,
                    'fed_tax' => $customer->FedTax,
                    'auto_discount' => $customer->AutoDiscount,
                    'due_days' => $customer->DueDays,
                    'price_schedule' => $customer->PriceSchedule,
                    'contract_date' => $customer->ContractDate,
                    'salesman' => $customer->Salesman,
                    'cs_type' => $customer->CSType,
                    'terms' => $customer->Terms,
                    'interest' => $customer->Interest,
                    'tax_status' => $customer->TaxStatus,
                    'tax_number' => $customer->TaxNumber,
                    'bank_info' => $customer->BankInfo,
                    'ship_no' => $customer->ShipNo,
                    'search_contract' => $customer->SearchContract,
                    'credit_limit' => $customer->CreditLimit,
                    'standing_po' => $customer->StandingPO,
                    'po_expiry_date' => $customer->POExpiryDate,
                    'po_maximum_value' => $customer->POMaximumValue,
                    'department' => $customer->Department,
                    'po_billed_so_far' => $customer->POBilledSoFar,
                    'gst_exempt' => $customer->GSTExempt,
                    'tax_code' => $customer->TaxCode,
                    'number' => $customer->Number,
                    'dis_nv' => $customer->DisNv,
                    'dis_stat' => $customer->DisStat,
                    'retail_type' => $customer->RetailType,
                    'foreign' => $customer->Foreign,
                    'last_visit' => $customer->LastVisit,
                    'web_comments' => $customer->WebComments,
                    'password' => $customer->Password,
                    'e_commerce' => $customer->ECommerce,
                    'eft_account' => $customer->EFTAccount,
                    'eft_bank' => $customer->EFTBank,
                    'eft_name' => $customer->EFTName,
                    'timezone_id' => $customer->TimeZoneID,
                    'balances' => $customer->Balances,
                    'free_form_group' => json_encode($customer->FreeFormGroup),
                    'shipping_address' => json_encode($customer->ShippingAddress),
                ];

                $this->updateOrCreate(
                    ['customer_id' => $customer->Unique],
                    $data
                );

                $store_contacts_model->createStoreContacts($customer->Contacts, $customer->Unique);

            }

            if (!$customer_id) {

                CronLog::create([
                    'module_type' => 'stores',
                    'page_size' => count($customers),
                ]);

            }

        } catch (\Exception $e) {

            CronErrorLog::create([
                'module_type' => 'stores',
                'error' => $e->getMessage()
            ]);
        }

    }

    public function getDataTableColumns()
    {
        return [
            [
                'title' => 'ID',
                'data' => 'customer_id'
            ],
            [
                'title' => 'Name',
                'data' => 'name'
            ],
            [
                'title' => 'Email',
                'data' => 'email'
            ],
            [
                'title' => 'Phone',
                'data' => 'phone'
            ],
            [
                'title' => 'Address',
                'data' => 'address'
            ],
            [
                'title' => 'Show',
                'data' => 'show',
                'searchable' => 'false'
            ],
            [
                'title' => 'Created At',
                'data' => 'created',
                'searchable' => 'false'
            ],
            [
                'title' => 'Created At',
                'data' => 'created_at',
                'visible' => false
            ],
            [
                'title' => 'Actions',
                'data' => 'actions'
            ]
        ];
    }

    public function ajaxListing()
    {
        return $this->query();
    }

}
