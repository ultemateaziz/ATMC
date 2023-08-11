<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if(Auth::user()->restricted == 'Y')
            {
                return back()->withErrors([
                    'restricted' => 'You are restricted.',
                ])->onlyInput('restricted');
            }

            if(Auth::user()->user_level == 1){
                return redirect('/staff');
            }

            if(Auth::user()->user_level == 2){
                return redirect('/student');
            }

        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}
