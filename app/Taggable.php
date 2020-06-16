<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taggable extends Model
{
    //
    public function photo()
    {
        return $this->belongsToMany('App\Photo', 'photos', 'photo_id', 'tag_id');
    }
    public function tag()
    {
        return $this->hasOne('App\Taggble');
    }
}
