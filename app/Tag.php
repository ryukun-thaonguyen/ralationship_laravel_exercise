<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function tag()
    {
        return $this->hasOne('App\Taggable', 'tag_id', 'id');
    }
}
