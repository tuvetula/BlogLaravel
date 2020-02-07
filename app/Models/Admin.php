<?php

namespace App\Models;

use App\Traits\MorphManyComments;
use App\Traits\MorphManyPosts;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    use MorphManyPosts;
    use MorphManyComments;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'first_name','email', 'password',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password' , 'remember_token'
    ];




}
