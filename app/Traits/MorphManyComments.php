<?php

namespace App\Traits;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait MorphManyComments
{
    /**
     * Récupérer tous les commentaires d'un admin ou d'un user
     * @return MorphMany
     */
    public function userComments()
    {
        return $this->morphMany(Comment::class , 'commentable');
    }
}
