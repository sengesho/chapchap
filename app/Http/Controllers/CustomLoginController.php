<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    public function showLoginForm()
        {
            return view('auth.login'); 
        }

    public function login(Request $request)
        {
            $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $userType = Auth::user()->usertype;

        if ($userType == 1) {
            return redirect()->route('admin');
        } else {
            return redirect()->intended('home');
        }
        }

        return back()->withErrors([
        'email' => 'Email cyangwa ijambo ry’ibanga ntabwo ari byo.',
        ]);
        }


    public function logout(Request $request)
        {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

        return redirect('/home');
        }
    
}
