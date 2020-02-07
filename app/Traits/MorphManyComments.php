<?php

namespace App\Traits;

use App\Models\Comment;

trait MorphManyComments
{
    /**
     * Récupérer tous les commentaires d'un admin ou d'un user
     */
    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable');
    }
}
