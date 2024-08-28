<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class ClientUser extends Model
{
    use Notifiable;
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $guarded = ['id'];

    protected static $logAttributes = ['*'];
    protected $appends = ['name'];

    /**
     * define client relation
     *
     * @return BelongsTo
     *
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Clients::class, 'client_id', 'id');
    }

    /**
     * define products relation
     *
     * @return BelongsToMany
     *
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Products::class, 'client_user_product', 'client_user_id', 'product_id');
    }

    /**
     * get fullpath for user image
     *
     * @param mixed $img
     *
     * @return [type]
     *
     */
    public function getPhotoAttribute($img)
    {
        if ($img) {
            return asset('uploads/' . $img);
        } else {
            return asset('admin-assets/assets/app/media/img/users/client.png');
        }
    }

    public function getStatusNameAttribute()
    {
        if ($this->getAttribute('status') == 1) {
            return __('lang.active');
        } elseif ($this->getAttribute('status') == 2) {
            return __('lang.inactive');
        } else {
            return "-";
        }
    }

    public function getStatusColorAttribute()
    {
        if ($this->getAttribute('status') == 1) {
            return 'success';
        } elseif ($this->getAttribute('status') == 2) {
            return 'warning';
        } else {
            return "";
        }
    }

    public function scopeTableFilter($query)
    {
        return $query->when(request()->input('status', false), function ($query, $status) {
            return $query->where('status', $status);
        })->when(request()->input('product_id', false), function ($query, $product) {
            return $query->whereHas('products', function ($query) {
                return $query->where('id', request()->input('product_id'));
            });
        })->when(request()->input('job_title', false), function ($query, $jobTitle) {
            return $query->where('job_title', 'like', "%{$jobTitle}%");
        });
    }

    /**
     * override log description message
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return " has {$eventName} client user " . $this->getAttribute('name');
    }

    /**
     * define country relation
     *
     * @return BelongsTo
     *
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
