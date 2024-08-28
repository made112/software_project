<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;

class Versions extends Model
{
    use FilterTrait;
    use SoftDeletes;
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected $table = 'versions';
    protected $fillable = ['name', 'branch', 'product_id','block','date', 'user_id','downloads','notification_summry', 'change_log', 'main_files', 'sql_files', 'publish_version'];
    protected $likeFilterFields = ['name'];
    protected $boolFilterFields = [];

    const PUBLISHED = 1;
    const UNPUBLISHED = 0;

    public function getMainFilesAttribute($main_files)
    {
        if ($main_files) {
            return asset('uploads/' . $main_files);
        } else {
            return '';
        }
    }

    public function getSqlFilesAttribute($sql_files)
    {
        if ($sql_files) {
            return asset('uploads/' . $sql_files);
        } else {
            return '';
        }
    }

    /**
     * override log description message
     *
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return " has {$eventName} version " . $this->getAttribute('name');
    }

    /**
     * define product relation
     *
     * @return BelongsTo
     *
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    /**
     * ! Check If Version Name Already Exists
     * @param $type
     * @param $name
     * @param $id
     * @return mixed
     */
    public function checkVersion($type, $name, $product_id)
    {
        if ($type == 1) {
            return $this->where('name', $name)->where('product_id', $product_id)->count();
        }
    }
}
