<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPackage extends Model
{
    use HasFactory;
    use FilterTrait;
    // use SoftDeletes;

    public $table = 'product_packages';
    protected $fillable = ['id', 'name', 'description', 'type', 'duration', 'time', 'duration_days', 'type_price', 'support_type', 'support_price', 'prime_type', 'prime_price', 'status', 'product_id', 'created_at', 'updated_at'];
//    public $appends = ['type_name'];

    protected $likeFilterFields = ['name'];
    protected $boolFilterFields = ['status'];

    /**
     * define types of package is that free or paid
     *
     * @var array
     */
    const TYPES = [
        [
            'id' => 1,
            'name_en' => 'Free',
            'name_ar' => 'مجاني',
        ],
        [
            'id' => 2,
            'name_en' => 'Paid',
            'name_ar' => 'مدفوع',
        ]
    ];

    const DURATION_TYPES = [
        [
            'id' => 1,
            'name_en' => 'Anual',
            'name_ar' => 'سنوي',
            'days' => 365
        ],
        [
            'id' => 2,
            'name_en' => 'Monthly',
            'name_ar' => 'شهري',
            'days' => 30
        ],
        // [
        //     'id' => 3,
        //     'name_en' => 'weakly',
        //     'name_ar' => 'اسبوعي',
        //     'days' => 7
        // ],

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

    /**
     * define prices relation
     *
     * @return HasMany
     *
     */
    public function prices(): HasMany
    {
        return $this->hasMany(ProductPackagePrice::class, 'package_id', 'id');
    }

    /**
     * get name of package type if paid of free
     *
     * @return string
     *
     */
    public function getTypeNameAttribute(): string
    {
        $type = $this->getAttribute('type');
        return collect(self::TYPES)->where('id', $type)->first()['name_' . app()->getLocale()] ?? "-";
    }

    /**
     * ! Check If Package Name Already Exists
     * @param $type
     * @param $name
     * @param $id
     * @return mixed
     */
    public function checkPackage($type, $name, $product_id,$id = '')
    {
        if ($type == 1) {
            return $this->where('name', $name)->where('product_id', $product_id)->count();
        } else {
            return $this->where('name', $name)->where('id', '!=', $id)->count();
        }
    }


//    public function getDurationStringAttribute(): string
//    {
//        switch ($this->getAttribute('type')) {
//            case self::TYPES[0]['id']:
//                return $this->getAttribute('duration') . ' ' . ucwords(trans_choice('days', $this->getAttribute('duration')));
//            case self::TYPES[1]['id']:
//                $durationType = $this->getAttribute('duration_type');
//                return collect(self::DURATION_TYPES)->where('id', $durationType)->first()['name_' . app()->getLocale()] ?? "-";
//            default:
//                return "-";
//        }
//    }

//    public function getSupportedTypeAttribute()
//    {
//        $support_type = '';
//        $remotly = $this->getAttribute('remotly_support_type') ? __('lang.remotely') : "-";
//        $prim = $this->getAttribute('prime_support_type') ? __('lang.prim') : "-";
//        if ($remotly != '-') {
//            $support_type = $remotly;
//        }
//        if ($prim != '-' and $support_type) {
//            $support_type .= ', ' . $prim;
//        } elseif ($prim != '-') {
//            $support_type = $prim;
//        }
//        return $support_type;
//    }
}
