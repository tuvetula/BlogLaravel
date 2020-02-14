<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\CustomAuth;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
    public function index()
    {
        $users = User::where('id','!=',CustomAuth::id());
        return view('Pages/friends/friendsIndex' , compact('users'));
    }
}
