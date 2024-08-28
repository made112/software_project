<?php

namespace App\Models;

use App\Traits\ChartFilter;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FilterTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class LicensesUse extends Model
{
    use FilterTrait;
    // use LogsActivity;
    use ChartFilter;
    protected $table = 'licenses_uses';
    protected $fillable = ['ip','is_used','is_activate','license_id' , 'public_key' , 'uuid' , 'os_type' , 'mac_address','port' , 'others'];

    public function license()
    {
        return $this->belongsTo(License::class, 'license_id');
    }
}
