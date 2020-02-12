<?php

namespace App\Http\Controllers;

use App\Jobs\ResizeImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function update(Request $request , User $user)
    {
        request()->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if(!empty($user->avatar)){
                Storage::move('public/'.$user->avatar , 'public/old/'.$user->avatar);
                Storage::delete('public/avatarsMiniatures50x50/'.basename($user->avatar));
                Storage::delete('public/avatarsMiniatures100x100/'.basename($user->avatar));
            }

        if ($files = $request->file('avatar')) {
            $path = $request->avatar->store('avatars' , 'public');
            ResizeImage::dispatch($path);
            $user->avatar = $path;
            $user->update();
            return Response()->json($path);
        }

        return Response()->json();

    }
}
