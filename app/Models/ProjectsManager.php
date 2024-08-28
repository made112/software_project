<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;

class ProjectsManager extends Model
{
    use FilterTrait;
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected $table = 'projects_manager';
    protected $fillable = ['client_id','manager_id', 'user_id'];

    protected $likeFilterFields = [];
    protected $boolFilterFields = [];

    public function manager(){
        return $this->belongsTo(User::class, 'manager_id', 'id')->select('id', 'name');
    }
}