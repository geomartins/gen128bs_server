<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailer;
use App\Models\Contact;

use Illuminate\Support\Facades\Mail;


class ContactController extends Controller
{
    public function __invoke(){

        //Validate Incoming request
        $this->validate(request(), array(
        	'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'company' => 'required',
            'reason' => 'required',

        ));

        $data = array(
            "firstname" => request()->firstname,
            "lastname" => request()->lastname,
            "email" => request()->email,
            "company" => request()->company,
            "reason" => request()->reason
        );

      
        $tola = new Contact;
        $tola->firstname = $data['firstname'];
        $tola->lastname = $data['lastname'];
        $tola->email = $data['email'];
        $tola->company = $data['company'];
        $tola->reason = $data["reason"];
        $tola->save();

        //Send Mail
        Mail::to("clement@gen128bs.com")
                    ->send(new ContactMailer($data));

        return response()->json(['message' => 'successfully']);
    }
}
