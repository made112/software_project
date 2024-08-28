<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Notifications extends Model
{
    use FilterTrait;
    use SoftDeletes;
    use LogsActivity;

    protected $table = 'notifications_sys';
    protected $fillable = ['notification_type', 'date', 'product_id', 'notification_title', 'job_id', 'user_id','is_send', 'notification_content', 'channel_id', 'status'];
    protected $likeFilterFields = ['notification_type', 'notification_title'];
    protected $boolFilterFields = [];

    protected static $logAttributes = ['*'];

    const EMAIL = 1;
    const MOBILE = 2;

    public function clients()
    {
        return $this->hasMany(NotificationsClients::class, 'notification_id', 'id')->select('id', 'notification_id', 'client_id');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id')->select('id', 'name');
    }


    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function getChannelAttribute($channel_id)
    {
        if ($channel_id == 1) {
            return trans('lang.email');
        } else if ($channel_id == 2) {
            return trans('lang.mobile');
        } else {
            return '';
        }
    }

    public function getStatusNameAttribute($status)
    {
        if ($status == 1) {
            return trans('lang.published');
        } else if ($status == 2) {
            return trans('lang.unpublished');
        } else {
            return '';
        }
    }

    /**
     * override log description message
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return " has {$eventName} notification " . $this->getAttribute('notification_title');
    }
}
