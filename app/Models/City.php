<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public $appends = ['name'];

    public function getNameAttribute()
    {
        return $this->getAttribute('name_' . app()->getLocale(), '-');
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


    public function scopeIndexFilter($query)
    {
        if (!is_null(request()->input('status'))) {
            $query = $query->where('status', request()->input('status'));
        }
        return $query->when(request()->input('name', false), function ($query, $name) {
            $query->where(function ($query) use ($name) {
                $query->where('name_en', 'like', "%{$name}%")->orWhere('name_ar', 'like', "%{$name}%");
            });
        })->when(request()->input('country', false), function ($query, $country) {
            $query->where('country_id', $country);
        });
    }
}
