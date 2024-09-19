<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class ContactUsController extends Controller
{
    public function contact_us_form(){
        return view('user.contact_us_form');
    }

    public function contact_us(Request $request){

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to submit the contact form.');
        }
        $contact_us = new ContactUs();
        $contact_us->user_id = Auth::id();
        $contact_us->name = $request->input('name');
        $contact_us->email = $request->input('email');
        $contact_us->message = $request->input('message');

        $contact_us->save();

        return redirect()->route('user_Dashboard');
    }
}
