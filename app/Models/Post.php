<?php

namespace App\Models;

use App\Presenters\DatePresenter;
use App\Traits\MorphToManyTags;
use App\Traits\TagsRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use MorphToManyTags;
    use TagsRequest;

    protected $with=['postable'];

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at' , 'desc');
    }

    public function postable() : MorphTo
    {
        return $this->morphTo();
    }

}
