<?php
namespace App\Traits;

trait MorphToManyTags
{
    public function tags()
    {
        return $this->morphToMany('App\Models\Tag' , 'taggable');
    }
}
