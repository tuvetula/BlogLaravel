<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Post;
use App\Models\User;
use App\UserModel;
use Egulias\EmailValidator\Warning\Comment;
use http\Env\Response;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;


class AccountController extends Controller
{
    /**
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        $posts = $user->posts->sortByDesc('created_at');
        if($user->id == Auth::user()->id){
            return view('Pages/accountShow' , compact('user' , 'posts'));
        }
    }

    /**
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        return view('Pages/accountEdit', compact('user'));
    }

    /**
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        if(isset($_FILES) && $_FILES['avatar']['error'] == 0){
            if(!empty($user->avatar)){
                Storage::move('public/'.$user->avatar , 'public/old/'.$user->avatar);
            }
            $path = $request->file('avatar')
                ->store('avatars' , 'public');
            $user->avatar = $path;
        }
        $user->first_name = $request->first_name;
        $user->name = $request->name;
        $user->update();
        return redirect()->route('account.show' , $user->id)->with('info' , 'Votre compte a bien été modifié.');
    }
}
