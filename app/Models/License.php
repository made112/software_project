<?php

namespace App\Models;

use App\Traits\ChartFilter;
use App\Traits\FileUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class License extends Model
{
    use FilterTrait;
    use SoftDeletes;
    use LogsActivity;
    use ChartFilter;

    protected $table = 'licenses';
    protected $appends = ['is_available','license_status','remain_day'];

    protected static $logAttributes = ['*'];


    protected $fillable = [
        'license_code', 'client_id', 'use_limit', 'parallel_use_limit', 'type', 'support_type', 'file', 'domains', 'ip', 'date', 'days',
        'grace_end_days', 'hash_code','uuid', 'product_id','payment_type','price', 'usage', 'parallel_use_limit', 'invoice_no', 'machine_id', 'comments', 'block', 'user_id',
        'public_key', 'generated_file_date', 'product_package_id', 'package_support_type'
    ];
    protected $likeFilterFields = [];
    protected $boolFilterFields = ['block'];

    const BLOCK = 1;
    const UNBLOCK = 0;
    const ACTIVATE = 1;
    const DEACTIVATE = 0;


    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id', 'id')->select('id', 'name', 'email','image');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id')->select('id', 'name','color','statistic_end_point');
    }

    public function getStatusNameAttribute($status)
    {
        if ($status == 1) {
            return trans('lang.blocked');
        } else if ($status == 0) {
            return trans('lang.not_blocked');
        } else {
            return trans('lang.valid');
        }
    }

    public function getUseLimitLinAttribute($limit)
    {
        if ($limit == '') {
            return trans('lang.unlimited');
        } else {
            return $limit;
        }
    }

    public function getIsAvailableAttribute()
    {
        $is_available = 0;
        if ($this->date > date('Y-m-d')) {
            $is_available = 1;
        }
        return $is_available;
    }

    /**
     * override log description message
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return " has {$eventName} license " . $this->getAttribute('license_code');
    }

    public function getLicenseStatusAttribute(){
        if($this->date != '' and $this->date <= date('Y-m-d')){
            return array('status'=>trans('lang.expired'),'color'=>'btn-warning');
        }elseif($this->usage == 1){
            return array('status'=>trans('lang.active'),'color'=>'btn-success');
        }elseif($this->usage == 0){
            return array('status'=>trans('lang.inactive'),'color'=>'btn-danger');
        }
    }

    public function license_use(){
        return $this->hasMany(LicensesUse::class,'license_id','id')->where('is_used',1)->select('license_id','is_used','is_activate');
    }

    public function getRemainDayAttribute(){
        if($this->date){
            $now = time();
            $your_date = strtotime($this->date);
            $datediff = $your_date - $now;
            if($datediff<0){
                $datediff = 0;
            }
            return round($datediff / (60 * 60 * 24));
        }else{
            return trans('lang.unlimited');
        }
    }

    /**
     * @return BelongsTo
     */
    public function product_package(): BelongsTo
    {
        return $this->belongsTo(ProductPackage::class, 'product_package_id', 'id');
    }
}
