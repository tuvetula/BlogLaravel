<?php

namespace App\Models\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Retourne vrai si l'id du user connecté est différent du user auquel on s'adresse
     * @param User $user
     * @param User $to
     * @return bool
     */
    public function talkTo(User $user , User $to)
    {
        return $user->id !== $to->id;
    }
}
