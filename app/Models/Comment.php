<?php

namespace App\Models;

use App\Traits\MorphToManyTags;
use App\Traits\TagsRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    use MorphToManyTags;
    use TagsRequest;

    protected $with=['tags'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
