<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class ApiKey extends Model
{
    use FilterTrait;
    use SoftDeletes;
//    use LogsActivity;

    protected $table = 'api_key';
    protected $fillable = ['api_key', 'api_key_type', 'special_permission', 'user_id'];
    protected $likeFilterFields = [''];
    protected $boolFilterFields = [];

//    protected static $logAttributes = ['*'];

}
