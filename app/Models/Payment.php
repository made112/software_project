<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\FilterTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use FilterTrait;

    protected $table = 'payments';
    protected $fillable = ['package_id','payment_id','license_id','refrence_no','redirect_url','package_price_id','api_key','client_id','support_duration','product_id','status','price','domain','ip','duration','support_type','validation_error','error'];
    protected $likeFilterFields = [];
    protected $boolFilterFields = [];

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id', 'id')->select('id', 'name', 'email', 'phone_number');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
