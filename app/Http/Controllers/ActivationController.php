<?php

namespace App\Http\Controllers;

use App\ActivationCode;
use App\Events\ActivationCodeEvent;
use App\Mail\ActivationEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ActivationController extends Controller
{
    //
    public function activation(ActivationCode $code){

        $code->delete();

        $code->user()->update([
           'is_active'=> true
        ]);

        Auth::login($code->user);

        return redirect('/');
    }

    public function coderesend(Request $request){


        $user = User::whereEmail($request->email)->firstOrFail();


        if($user->userIsActivated()){

            return redirect('/admin');

        }


        event(new ActivationCodeEvent($user));


        return redirect('/login')->withSuccess('Your code has been sent, please check your email');



    }
}
