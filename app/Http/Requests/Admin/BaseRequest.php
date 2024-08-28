<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{

    public function failedValidation(Validator $validator){
        $all = collect($validator->errors()->getMessages())->map(function($item){
            return $item[0];
        });
          $strs = [];
        foreach ($all as $value) {
            $strs[]=  $value;
        }
        throw new HttpResponseException(response()->json([
        'data' => $strs,
        'status' => false
        ], 200));
    }

}