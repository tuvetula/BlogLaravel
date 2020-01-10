<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        //Enregistrement en base de données
        $contact = new \App\Contact;
        $contact->name = $request->name;
        $contact->first_name = $request->first_name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        //Envoi mail
        Mail::to('admin@blog.fr')
            ->send(new Contact($request->except('_token')));
        return view('Pages/contactConfirmation');
    }
}
