<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Group extends Model
{
    use FilterTrait;
    use HasFactory;
    use HasRoles;

    protected $fillable = ['id', 'name', 'name_ar'];

    protected $guard_name = 'web';

    protected $likeFilterFields = ['name', 'name_ar'];
    protected $boolFilterFields = [];

    /**
     * * Relation
     * ? With Ticket ( One Group Has Many Tickets ) ( 1 - M )
     * ? With Roles ( Many To Many ) ( M - M )
     */

    /**
     * ! Relation With Tickets
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'group_id', 'id');
    }

    /**
     * ? Get Collection Of Group From ID
     * @param $id
     * @return mixed
     */
    public function getGroup($id)
    {
        return $this->where('id', $id)->first();
    }

    /**
     * ? Check Count Of Group
     * @param $type
     * @param $name
     * @param $id
     * @return mixed
     */
    public function checkGroup($type, $name, $name_ar,$id = '')
    {
        if ($type == 1) {
            return $this->where('name', $name)->orWhere('name_ar', $name_ar)->count();
        } else {
            return $this->where('name', $name)->where('id', '!=', $id)->count();
        }
    }


    public function addGroup($name, $name_ar, $role_id)
    {
        $this->name = $name;
        $this->name_ar = $name_ar;

        $this->save();
        $last_group = Group::latest('id')->first();

        for ( $i = 0; $i < count($role_id);) {
            DB::table('group_roles')->insert([
                'group_id' => $last_group->id,
                'role_id' => (int) $role_id[$i],
            ]);
            $i++;
        }
        return $this;
    }

    /**
     * ? Update Group
     * @param $obj
     * @param $name
     * @param $name_ar
     * @param $role
     * @return mixed
     */
    public function updateGroup($obj, $name, $name_ar, $role)
    {
        $obj->name = $name;
        $obj->name_ar = $name_ar;

        $deleted = DB::table('group_roles')->where('group_id', $obj->id)->delete();

        for ( $i = 0; $i < count($role);) {
            DB::table('group_roles')->insert([
                'group_id' => $obj->id,
                'role_id' => (int) $role[$i],
            ]);
            $i++;
        }

        return $obj->save();
    }

    /**
     * ? Delete Group
     * @param $obj
     * @return mixed
     */
    public function deleteGroup($obj)
    {
        return $obj->delete();
    }

//    public function role()
//    {
//        return $this->belongsTo(Role::class, 'role_id', 'id');
//    }
}
