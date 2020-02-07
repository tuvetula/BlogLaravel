<?php

namespace App\Traits;

use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphManyPosts
{
    /**
     * Récupérer tous les posts d'un admin ou d'un user
     * @return MorphMany
     */
    public function posts()
    {
        return $this->morphMany(Post::class , 'postable');
    }

}
