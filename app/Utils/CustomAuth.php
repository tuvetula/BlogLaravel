<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;

class CustomAuth
{
    static public function user()
    {
        return Auth::guard(static::activeGuard())->user() ?: null;
    }

    static public function id()
    {
        return static::user()->id ?: null;
    }

    static public function activeGuard()
    {

        foreach (array_keys(config('auth.guards')) as $guard) {

            if (auth()->guard($guard)->check()) return $guard;

        }
        return null;
    }

    static public function getClass()
    {
        return get_class(static::user());
    }
}
