<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

class AdminHomeController
{
    public function index()
    {
        return view('admin.home');
    }
}
