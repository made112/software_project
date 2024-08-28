<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class NotificationsClients extends Model
{
    use FilterTrait;
    use SoftDeletes;

    protected $table = 'notifications_clients';
    protected $fillable = ['notification_id', 'client_id'];
    protected $likeFilterFields = [];
    protected $boolFilterFields = [];

    public function notification()
    {
        return $this->belongsTo(Notifications::class, 'notification_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Clients::class, 'client_id', 'id')->select('id', 'name');
    }
}
