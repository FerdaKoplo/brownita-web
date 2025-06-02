<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8|max:255'
        ]);

        $credentials = ['email' => $request->email, 'password' => $request->password];

        if(auth()->attempt($credentials)){
            $request->session()->regenerate();

            if(Auth::user()->role == 'admin'){
                return redirect()->route('dashboard.admin');
            }
        }

         return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }
}
