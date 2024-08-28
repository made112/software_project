<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientUserProduct extends Model
{
    protected $table = 'client_user_product';

    public function user(){
        return $this->belongsTo(ClientUser::class,'client_user_id','id')->select('id','first_name', 'email');
    }
}
