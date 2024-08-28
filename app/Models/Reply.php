<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'from_email',
        'to_email',
        'ip',
        'ticket_id',
    ];

    /**
     * * Relation
     * ? With Ticket ( One Ticket Has Many Reply ) ( 1 - M )
     */

    /**
     * ! Relation With Ticket
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }
}
