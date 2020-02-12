<?php

namespace App\Models;

use App\Traits\MorphManyComments;
use App\Traits\MorphManyPosts;
use App\Traits\MorphToManyTags;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use MorphToManyTags;
    use MorphManyPosts;
    use MorphManyComments;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'deleted_at' , 'updated_at' , 'created_at', 'email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Récupérer tous les commentaires d'un user
     * @return HasManyThrough
     */
    public function comments() : HasManyThrough
    {
       return $this->hasManyThrough(
           'App\Models\Comment',
           'App\Models\Post',
           'user_id',
           'post_id');
    }
}
