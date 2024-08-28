<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaticPage extends Model
{
    use SoftDeletes;
    protected $table = 'static_page';

    public function getPhotoAttribute($img){
        if($img){
            return asset('uploads/' . $img);
        }else{
            return '';
        }
    }

}