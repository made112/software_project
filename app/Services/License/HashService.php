<?php

namespace App\Services\License;

use App\Models\Products;
use App\Models\Clients;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use Spatie\Crypto\Rsa\KeyPair;
use Spatie\Crypto\Rsa\PrivateKey;
use Spatie\Crypto\Rsa\PublicKey;

class HashService {
    public function encryption($file_name,$type,$data=array()){
        if($type == 1){
            $contents = file_get_contents(public_path('uploads/').$file_name);
            $contents = json_decode($contents,true);
            if(isset($data['license_code'])){
                $contents['LicenseCode'] = $data['license_code'];
            }
            $contents['startDate'] = date('Y-m-d');
            if(isset($data['date'])){
                $contents['endDate'] = $data['date'];
            }
            if(isset($data['days'])){
                $contents['days'] = $data['days'];
            }
            if(isset($data['product_id'])){
                $product = Products::find($data['product_id']);
                if($product){
                    $contents['productId'] = $product->product_id;
                }
            }
            if(isset($data['client_id'])){
                $client = Clients::find($data['client_id']);
                if($client){
                    $contents['clientId'] = $client->client_id;
                }
            }

        }else if($type == 2){
            $contents = $file_name;
        }

        $str = '';
        $inc=0;
        if($contents){
            foreach($contents as $key=>$element){
                $inc++;
                $key_hexa = bin2hex($key);
                $element_hexa = bin2hex($element);
                $str .= str_pad(strlen($key_hexa),4,0,STR_PAD_LEFT).$key_hexa.str_pad(strlen($element_hexa),4,0,STR_PAD_LEFT).$element_hexa;
                if(count($contents) != $inc){
                    $str .= ' ';
                }
            }
        }
        return base64_encode($str);
    }

    public function decryption($file,$type=null){
        if($type == 1){
            $str = $file;
        }else{
            $str = $file->getContent();
        }
        $str = base64_decode($str);
        $array = explode(' ',$str);
        $contents = array();
        foreach($array as $ar){
            $hash = substr($ar,4);
            $key_length = intVal(substr($ar,0,4));
            $key = substr($hash,0,$key_length);
            $hash = substr($hash,$key_length);
            $element_length = intVal(substr($hash,0,4));
            $element = substr($hash,4);
            $contents[hex2bin($key)] = hex2bin($element);
        }
        return $contents;
    }


    public function SSLEncrypt(string $data): array
    {
        [$privateKey, $publicKey] = (new KeyPair())->generate();

        $privateKey = PrivateKey::fromString($privateKey);

        $data = $privateKey->encrypt($data);

        $data = $this->encryption(['data' => $data] , 2);

        return ['encrypted_data' => $data, 'public_key' => $publicKey];
    }

    public function SSLDecrypt(string $data, $publicKey): array
    {
        $data = $this->decryption($data , 1);

        $publicKey = PublicKey::fromString($publicKey);

        $data = $publicKey->decrypt($data['data']);

        return json_decode($data , true) ;
    }
}
