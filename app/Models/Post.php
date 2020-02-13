<?php

namespace App\Models;

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
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at' , 'updated_at' , 'created_at','id'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at' , 'desc');
    }

    public function postable() : MorphTo
    {
        return $this->morphTo();
    }

}
