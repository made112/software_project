<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;

class Products extends Model
{
    use FilterTrait;
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected $table = 'products';
    protected $fillable = ['name', 'product_id','color', 'status', 'user_id', 'download_update', 'details', 'gitlab_link', 'gitlab_username', 'gitlab_access_token'];

    protected $likeFilterFields = ['name'];
    protected $boolFilterFields = [];

    public function last_version(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Versions::class, 'product_id', 'id')->where('block',0)->latest();
    }

    /**
     * override log description message
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return " has {$eventName} product " . $this->getAttribute('name');
    }

    public function clients_products()
    {
        return $this->hasMany(ClientsProducts::class, 'product_id', 'id');
    }

    /**
     * define clients relation
     *
     * @return BelongsToMany
     *
     */
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Clients::class, 'clients_products', 'product_id', 'client_id');
    }


    /**
     * define licenses relation
     *
     * @return HasMany
     *
     */
    public function licenses(): HasMany
    {
        return $this->hasMany(License::class, 'product_id', 'id');
    }

    public function licensesActive(): HasMany
    {
        return $this->hasMany(License::class, 'product_id', 'id')->where('usage',1)->where(function ($q) {
                $q->where('date','>',date('Y-m-d'))->orWhereNull('date');
            });
    }
    /**
     * define packages relation
     *
     * @return HasMany
     *
     */
    public function packages(): HasMany
    {
        return $this->hasMany(ProductPackage::class, 'product_id', 'id');
    }

    /**
     * define prices relation
     *
     * @return HasMany
     *
     */
    public function prices(): HasMany
    {
        return $this->hasMany(ProductPackagePrice::class, 'product_id', 'id');
    }

    /**
     * define support users relation for product
     *
     * @return BelongsToMany
     *
     */
    public function supportUsers(): BelongsToMany
    {
        return $this->belongsToMany(ClientUser::class, 'client_user_product', 'product_id', 'client_user_id');
    }

    /**
     * @return HasMany
     */
    public function clientUserProduct(): HasMany
    {
        return $this->hasMany(ClientUserProduct::class,'product_id','id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function checkProduct($type, $name, $id = '')
    {
        if ($type == 1) {
            return $this->where('name', $name)->count();
        } else {
            return $this->where('name', $name)->where('id', '!=', $id)->count();
        }
    }
}
