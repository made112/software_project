<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;

class Country extends Model
{

    use LogsActivity;

    protected $guarded = ['id'];

    protected $table = 'countries';

    public $appends = ['country_name'];

    protected static $logAttributes = ['*'];


    public function getFlagAttribute($img)
    {
        if ($img) {
            $img = strtolower($img);
            return asset('flag/' . $img) . '.png';
        } else {
            return '';
        }
    }

    /**
     * return name base on localization
     *
     * @return string
     *
     */
    public function getCountryNameAttribute(): string
    {
        return object_get($this , 'name_' . app()->getLocale() , '-');
    }

    /**
     * override log description message
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return " has {$eventName} country" . $this->getCountryNameAttribute();
    }

    /**
     * define countries relation
     *
     * @return HasMany
     *
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Clients::class, 'country_id', 'id');
    }
}
