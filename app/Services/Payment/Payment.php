<?php

namespace App\Services\Payment;
use App\Models\Setting;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;

class Payment {

    public function payment($client,$package,$package_price,$support_type_price,$price,$domain,$refrence_no){
        $setting = Setting::first();
        $apiKey = $setting->api_key;

        $endpointURL = 'https://apitest.myfatoorah.com/v2/ExecutePayment';
        $ipPostFields = ['InvoiceAmount' => $price, 'CurrencyIso' => 'SAR'];
        $url = \URL::to('/');
        // $url = 'https://example.com';
        $paymentMethodId = 2;
        $postFields = [
            'paymentMethodId' => $paymentMethodId,
            'InvoiceValue'    => $price,
            'CallBackUrl'     => "$url/api/payments/success?domain=$domain&refrence_no=$refrence_no",
            'ErrorUrl'        => "$url/api/payments/faild?domain=$domain&refrence_no=$refrence_no", //or 'https://example.com/error.php'    
            'CustomerName'       => "$client->name",
            'DisplayCurrencyIso' => 'SAR',
            'MobileCountryCode'  => "$client->country_code",
            'CustomerMobile'     => $client->mobile,
            'CustomerEmail'      => $client->email,
            'Language'           => \App::getLocale(), //or 'ar'
        ];

        $curl = curl_init($endpointURL);
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => json_encode($postFields),
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));
        $response = curl_exec($curl);
        $curlErr  = curl_error($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    public function getPaymentStatus($paymentId){
        $setting = Setting::first();
        $apiKey = $setting->api_key;
        $KeyType = 'paymentId';
        $postFields = [
            'Key'     => $paymentId,
            'KeyType' => $KeyType
        ];
        $endpointURL = 'https://apitest.myfatoorah.com/v2/getPaymentStatus';
        $curl = curl_init($endpointURL);
        curl_setopt_array($curl, array(
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => json_encode($postFields),
            CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
            CURLOPT_RETURNTRANSFER => true,
        ));
    
        $response = curl_exec($curl);
        $curlErr  = curl_error($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

}