<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;

    public function posts()
    {
        return $this->morphedByMany('App\Models\Post' , 'taggable');
    }

    public function comments()
    {
        return $this->morphedByMany('App\Models\Comment' , 'taggable');
    }

    public function users()
    {
        return $this->morphedByMany('App\Models\User' , 'taggable');
    }
}
