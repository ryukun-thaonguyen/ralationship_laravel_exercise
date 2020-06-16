<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    public function photo_description(){
        return $this->hasOne("App\PhotoDescription");
    }
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }
    public function tag()
    {
        return $this->hasMany('App\Taggable');
    }
}
