<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Permission\Traits\HasRoles;

class GroupRole extends Pivot
{
    use HasFactory;

    protected $fillable = ['group_id', 'role_id'];

    public $table = ['group_roles'];

    public $incrementing = true;

}
