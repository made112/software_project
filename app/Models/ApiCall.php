<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class ApiCall extends Model
{
    use FilterTrait;
    use SoftDeletes;
//    use LogsActivity;

    protected $table = 'api_calls';
    protected $fillable = ['client_id', 'product_id','download_url','function','version_id','api_key', 'license_code', 'ip', 'status', 'validation_error', 'errors'];
    protected $likeFilterFields = [];
    protected $boolFilterFields = ['status'];
    protected $appends = ['function_name'];

    protected static $logAttributes = ['*'];

    const GetLastVersion = 1;
    const CheckAvailabilityLicense = 2;
    const ActivateLicense = 3;
    const DeactivateLicense = 4;
    const CheckUpdate = 5;
    const UpdateDownloads = 6;
    const ViewPackage = 7;
    const SignIn = 8;
    const SignOut = 9;
    const CreateTicket = 10;

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id', 'id')->select('id', 'name', 'email');
    }

    public function version()
    {
        return $this->belongsTo(Versions::class, 'version_id', 'id')->select('id', 'name');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id')->select('id', 'name');
    }

    public function getStatusNameAttribute($status)
    {
        if ($status == 1) {
            return trans('lang.success');
        } else if ($status == 0) {
            return trans('lang.faild');
        }
    }

    public function getFunctionNameAttribute()
    {
        if ($this->function == 1) {
            return 'Get Last Version';
        } else if ($this->function == 2) {
            return 'Check Availability License';
        } else if ($this->function == 3) {
            return 'Activate License';
        } else if ($this->function == 4) {
            return 'Deactivate License';
        } else if ($this->function == 5) {
            return 'Check Update';
        }else if ($this->function == 6) {
            return 'Update Downloads';
        }else if ($this->function == 7) {
            return 'View Package';
        }else if ($this->function == 8) {
            return 'Sign In';
        }else if ($this->function == 9) {
            return 'Sign Out';
        }else if ($this->function == 10) {
            return 'Create Ticket';
        }
    }

    public function scopeActivations($query){
        return $query->orderBy('id', 'desc')->whereIn('function', [self::ActivateLicense, self::DeactivateLicense]);
    }


}
