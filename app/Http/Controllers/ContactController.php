<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function postInfos(Request $request)
    {
        Mail::to('test@test.com')
            ->send(new Contact($request->except('_token')));
        return view('Pages/contactConfirmation');
    }
}
