<?php

namespace App\Services\License;


use App\Models\LicensesUse;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ProductStatistic
{
    public $target_url;
    public $token ;
   public function __construct($target_url,$token) {
       $this->target_url=$target_url  ;
       $this->token=$token  ;
    }
    public  function  fetchData(){
        $client = new Client();
        $headers = [
            'token' => $this->token
        ];

        $port = LicensesUse::where('token',$this->token)->first();
        $request = new Request('GET', $this->target_url, $headers);
        $res = $client->sendAsync($request)->wait();
        $res = $res->getBody();
        $res = json_decode($res,true);
        $res['ip'] =  Request()->ip();
        return $res['data'] ;

    }

}
