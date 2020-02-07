<?php

namespace App\Models;

use App\Traits\MorphToManyTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    use MorphToManyTags;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
