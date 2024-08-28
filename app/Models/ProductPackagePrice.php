<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPackagePrice extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $guarded = ['id'];
    protected $appends = ['price_type'];

    /**
     * define PRICES_TYPES
     *
     * @var [type]
     */
    const PRICES_TYPES = [
        [
            'id' => 1,
            'name'=>'Product',
            'key' => 'product'
        ],
        [
            'id' => 2,
            'name'=>'Remotely',
            'key' => 'remote_support'
        ],
        [
            'id' => 3,
            'name'=>'Prim',
            'key' => 'prim_support'
        ],
    ];

    /**
     * define product relation
     *
     * @return BelongsTo
     *
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function getPriceTypeAttribute()
    {
        if($this->related_to and isset(ProductPackagePrice::PRICES_TYPES[$this->related_to-1])){
            return ProductPackagePrice::PRICES_TYPES[$this->related_to-1];
        }else{
            return '';
        }
    } 
}
