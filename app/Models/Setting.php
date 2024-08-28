<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use LogsActivity, Notifiable;


    protected static $logAttributes = ['*'];

    protected $table = 'setting';
    protected $fillable = [
        'name', 'image', 'email', 'mobile', 'address', 'user_id', 'license_code', 'time_zone', 'blacklist_domain_attempts', 'blacklist_ip_attempts', 'activation_attempts', 'download_attempts',
        'api_request_rate_limiting_methond', 'api_request_rate_limit', 'api_blacklisted_domain', 'api_blacklisted_ips',
        'twitter','instagram','linkedin', 'freshdesk_api_key','remain_days_license'
    ];

    /**
     * override log description message
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return " has {$eventName} settings " . $this->getAttribute('name');
    }
}
