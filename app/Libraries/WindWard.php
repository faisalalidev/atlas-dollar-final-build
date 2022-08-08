<?php

namespace App\Libraries;

use App\Models\ApplicationSetting;
use Illuminate\Support\Facades\Log;

class WindWard
{
    public function __construct()
    {
        $this->apiURL = env('WINDWARD_URL');

        $this->user_name = env('WINDWARD_USER_NAME');

        $this->password = env('WINDWARD_PASSWORD');
    }

    private $api_end_points = [
        'get-inventories' => '/Windward/WebAPI/Inventory/Inventory',
        'get-inventory_images' => '/Windward/WebAPI/TServerMethodsWebAPI/PartImages_Fetch',
        'get-parent-categories' => '/Windward/WebAPI/TServerMethodsWebAPI/Get_Main_Categories',
        'get-child-categories' => '/Windward/WebAPI/TServerMethodsWebAPI/Get_Categories',
        'get-inventory_changes' => '/Windward/WebAPI/TServerMethodsWebAPI/RecState_FetchChanges',
        'check-connection' => '/Windward/WebAPI/TServerMethodsWebAPI/Connect',
        'get-customers' => '/Windward/WebAPI/Customer/Customers',
        'get-invoices' => '/Windward/WebAPI/Invoice/Invoices',
        'get-invoice-changes' => '/Windward/WebAPI/TServerMethodsWebAPI/RecState_FetchChanges',
        'add-invoice' => '/Windward/WebAPI/Invoice/addInvoice',
        'get-parts' => '/Windward/WebAPI/TServerMethodsWebAPI/Get_Parts',
    ];

    public function getDataRequest($slug,$params = '',$form_data = [])
    {
        try {

            if (!empty($form_data)){

                $this->apiURL = $form_data['url'];

                $this->user_name = $form_data['user_name'];

                $this->password = $form_data['password'];
            }

            $header = $this->getHeaders();

            $response = $this->getRequest($this->apiURL . $this->api_end_points[$slug] . $params,$header);

            return json_decode($response);

        } catch (\Exception $e) {
            //handle exception

            ApplicationSetting::sendErrorResponseToAdminEmails($slug.' -----> '.$e->getMessage());

            throw new \Exception($e->getMessage());
        }
    }

    public function postDataRequest($slug,$params,$post_data)
    {
        try {

            $header = $this->getHeaders();

            $response = $this->postRequest($this->apiURL . $this->api_end_points[$slug] . $params,$header,$post_data);

            return json_decode($response);

        } catch (\Exception $e) {
            //handle exception

            ApplicationSetting::sendErrorResponseToAdminEmails($slug.' -----> '.$e->getMessage());

            throw new \Exception($e->getMessage());
        }
    }

    public function getHeaders()
    {
        $credentials = $this->user_name . ":" . $this->password;

        $base64Credentials = base64_encode($credentials);

        $authentication = "Authorization: Basic " . $base64Credentials;

        return array(
            $authentication,
            'Accept: application/json'
        );
    }

    public function getRequest($apiURL, $headers)
    {
        try {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiURL);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_FAILONERROR, true);

            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {

                $error_msg = curl_error($ch);

                throw new \Exception($error_msg);
            }

            curl_close($ch);

        }catch (\Exception $e){

            throw new \Exception($e->getMessage());
        }

        return $response;
    }

    public function postRequest($apiURL, $headers,$post_data)
    {
        try {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiURL);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {

                $error_msg = curl_error($ch);

                throw new \Exception($error_msg);
            }

            curl_close($ch);

        }catch (\Exception $e){

            throw new \Exception($e->getMessage());
        }

        return $response;
    }
}
