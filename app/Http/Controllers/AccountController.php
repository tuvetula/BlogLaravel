<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Utils\CustomAuth;
use http\Env\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AccountController extends Controller
{
    /**
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        $posts = $user->userPosts->sortByDesc('created_at');
        if($user->id == CustomAuth::id()){
            return view('Pages/account/accountShow' , compact('user' , 'posts'));
        }
    }

    /**
     * @param User $user
     * @return Factory|View
     */
    public function edit(User $user)
    {
        return view('Pages/account/accountEdit', compact('user'));
    }

    /**
     * @param UserRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        if($request->ajax())
        {
            $user->first_name = $request->first_name;
            $user->name = $request->name;
            $user->update();
            return response()->json($user);
        }
        abort(404);
    }
}
