<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductLicenseStatistic extends Model
{
    use HasFactory;
    protected $table = 'product_license_statistics';
    protected $fillable = ['id','client_id','product_id','license_id','data','public_key'];

    protected $cast = [
      'created_at'=>'date',
      'updated_at'=>'date'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
    public function license(): BelongsTo
    {
        return $this->belongsTo(License::class, 'license_id', 'id');
    }
    public function license_use(): BelongsTo
    {
        return $this->belongsTo(LicensesUse::class, 'license_id', 'id');
    }

}
