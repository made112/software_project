<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class Ticket extends Model
{
    use HasFactory;
    use FilterTrait;

   protected $fillable = [
       'title',
       'description',
       'email',
       'priority',
       'status',
       'type',
       'condition',
       'client_id',
       'group_id',
       'ip',
   ];

    protected $likeFilterFields = [];
    protected $boolFilterFields = [];

   /**
    * * Relations
    * ? With Client ( Company ) [ Many Ticket Belongs To One Client ] ( 1 - M )
    * ? With Group ( Many Ticket Belongs To One Group ) ( 1 - M )
    * ? With Reply ( One Tickets Has Many Replies )
    */

   /**
    * ! Relation With Client ( 1 - M )
    */
   public function client(): BelongsTo
   {
       return $this->belongsTo(Clients::class, 'client_id', 'id');
   }

    /**
     * ! Relation With Group ( 1 - M )
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    /**
     * ! Relation With Reply
     */
    public function reply(): HasMany
    {
        return $this->hasMany(Reply::class, 'ticket_id', 'id');
    }

}
