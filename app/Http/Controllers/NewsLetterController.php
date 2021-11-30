<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UserSubscribed;
use Illuminate\Support\Facades\Session;

class NewsLetterController extends Controller
{
    public function subscribe(Request $request)
    {
        //! Validate request
        $request->validate([
            'email' => 'required|unique:newsletter,email'
        ]);

        //! Fire a event with the event() method add the new object, here new UserSubscribed
        //! The User need to resieve a email inside ()
        event(new UserSubscribed($request->input('email')));

        Session::flash('created_newsletter', 'Thank you for joining us!');

        return redirect()->back();
    }
}
