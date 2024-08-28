<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\FilterTrait;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use LogsActivity;
    use FilterTrait;


    protected static $logAttributes = ['*'];
    protected $likeFilterFields = ['name'];
    protected $boolFilterFields = [];

    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'country_code',
        'photo',
        'mobile',
        'type',
        'mobile_prefix',
        'mobile_country',
        'city_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getPhotoAttribute($img)
    {
        if ($img) {
            return asset('uploads/' . $img);
        } else {
            return asset('uploads/default-image.png');
        }
    }

    public function checkUser($type, $name, $id = '')
    {
        if ($type == 1) {
            return $this->where('username', $name)->count();
        } else {
            return $this->where('username', $name)->where('id', '!=', $id)->count();
        }
    }

    public function checkEmail($type, $email, $id = '')
    {
        if ($type == 1) {
            return $this->where('email', $email)->count();
        } else {
            return $this->where('email', $email)->where('id', '!=', $id)->count();
        }
    }

    public function getUsers($name,$status)
    {
        $users = $this->with('role')->OrderBy('id', 'desc');
        if ($name != '') {
            $users =  $users->where('name', 'like', '%' .  $name . '%');
        }
        if ($status != '') {
            $users =  $users->where('status',$status);
        }
        return $users = $users->paginate(20);
    }

    public function getUser($id)
    {
        return $this->where('id', $id)->first();
    }


    public function addUser($name, $password, $status, $fullname, $email, $type)
    {
        $this->username = $name;
        $this->name = $fullname;
        $this->email = $email;
        $this->type = $type;
        $this->status = $status;
        $this->password = \Hash::make($password);
        $this->user_id = \Auth::user()->id;
        $this->save();
        return $this;
    }

    public function updateUser($obj, $name,$password, $status, $fullname, $email, $type)
    {
        $obj->username = $name;
        $obj->name = $fullname;
        $obj->status = $status;
        $obj->email = $email;
        $obj->type = $type;
        if ($password != '') {
            $obj->password = \Hash::make($password);
        }
        return $obj->save();
    }

    public function UpdateStatus($obj)
    {
        if ($obj->status == 0) {
            $obj->status = 1;
        } else {
            $obj->status = 0;
        }
        return  $obj->save();
    }

    public function deleteUser($obj)
    {
        return $obj->delete();
    }

    public function changePassword($obj, $password)
    {
        $obj->password = \Hash::make($password);
        return $obj->save();
    }

    /**
     * define country relation
     *
     * @return
     *
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_code', 'id');
    }

    /**
     * override log description message
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return " has {$eventName}  user " . $this->getAttribute('username');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'type', 'id');
    }
}
