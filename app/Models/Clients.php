<?php

namespace App\Models;

use App\Http\Helpers\Helpers;
use App\Traits\ChartFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterTrait;
use App\Traits\LogDetails;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class Clients extends Model
{
    use Notifiable;
    use FilterTrait;
    use SoftDeletes;
    use LogsActivity;
    use ChartFilter;

    protected $table = 'clients';
    protected $fillable = ['name', 'client_id', 'email', 'phone_number', 'user_id', 'status', 'country_code', 'country_id', 'city_id','image', 'twitter_link', 'website_link', 'last_seen_at'];
    protected $likeFilterFields = ['name', 'email'];
    protected $boolFilterFields = ['status'];

    protected static $logAttributes = ['name', 'client_id', 'email', 'phone_number', 'user_id', 'status', 'country_code', 'country_id', 'city_id'];

    public function projects_manager()
    {
        return $this->hasMany(ProjectsManager::class, 'client_id', 'id');
    }


    /**
     * define users relation
     *
     * @return HasMany
     *
     */


    public function users(): HasMany
    {
        return $this->hasMany(ClientUser::class, 'client_id', 'id');
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

    /**
     * define licenses relation
     *
     * @return HasMany
     *
     */
    public function licenses(): HasMany
    {
        return $this->hasMany(License::class, 'client_id', 'id');
    }

    public function licensesActive(): HasMany
    {
        return $this->hasMany(License::class, 'client_id', 'id')->where('usage',1)->where(function ($q) {
                $q->where('date','>',date('Y-m-d'))->orWhereNull('date');
            });
    }
    /**
     * define product relation
     *
     *
     */
    public function products()
    {
        // return Products::whereIn('id', $this->licenses()->pluck('product_id')->toArray())->get();

        return $this->belongsToMany(Products::class, 'clients_products', 'client_id', 'product_id');
    }

    /**
     * override log description message
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return " has {$eventName} client " . $this->getAttribute('name');
    }

    /**
     * @TODO define downloads relations
     *
     * @return [type]
     *
     */
    public function downloads()
    {
        return $this->hasMany(License::class, 'client_id', 'id');
    }

    /**
     * @TODO define apiCalls relations
     *
     * @return [type]
     *
     */
    public function apiCalls()
    {
        return $this->hasMany(ApiCall::class, 'client_id', 'id');
    }

    /**
     * define country relation
     *
     * @return BelongsTo
     *
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }


    /**
     * get fullpath for Company image
     *
     * @return [type]
     *
     */
    public function getLogoAttribute($img)
    {
//        if ($img) {
//            return asset('uploads/' . $img);
//        } else {
//            return asset('admin-assets/assets/default-image.png');
//        }

        if (!$this->image) {
            return asset('admin-assets/assets/default-image.png');
        }

        return asset('uploads/' . $this->image);
    }

    /**
     * define activations and deactivation api calls relation
     *
     * @return HasMany
     *
     */
    public function activations(): HasMany
    {
        return $this->hasMany(ApiCall::class, 'client_id', 'id')->whereIn('function', [ApiCall::ActivateLicense, ApiCall::DeactivateLicense]);
    }

    /**
     * * Relation
     * ? With Ticket ( One Group Has Many Tickets ) ( 1 - M )
     */

    /**
     * ! Relation With Tickets
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'client_id', 'id')->latest();
    }

    /**
     * ! Check If Name Already Exists
     * @param $type
     * @param $name
     * @param $id
     * @return mixed
     */
    public function checkCompany($type, $name, $id = '')
    {
        if ($type == 1) {
            return $this->where('name', $name)->count();
        } else {
            return $this->where('name', $name)->where('id', '!=', $id)->count();
        }
    }
}
