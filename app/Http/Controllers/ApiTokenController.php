<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ApiTokenController extends Controller
{
    /**
     * Update the authenticated user's API token.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function update(User $user)
    {
        $token = Str::random(60);
        $user->api_token = hash('sha256', $token);
        $user->update();

        return redirect()->route('account.show' , $user->id)
            ->with('token',$token);
    }
}
