<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class Tag extends Model
{
    use FilterTrait;
    use HasRoles;

    use HasFactory;

    protected $fillable = ['id','name_ar','name_en','created_by'];

    /**
     * define country relation
     *
     * @return BelongsTo
     *
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'tag_id', 'id');
    }
    public function getTag($id)
    {
        return $this->where('id', $id)->first();
    }
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


}
