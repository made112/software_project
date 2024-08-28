<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientsProducts extends Model
{
    use SoftDeletes;
    protected $table = 'clients_products';
    protected $fillable = ['client_id','product_id','user_id', 'gitlab_link', 'gitlab_username', 'gitlab_access_token'];

    public function product(){
        return $this->belongsTo(Products::class, 'product_id');
    }
}
