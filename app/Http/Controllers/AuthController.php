<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function viewRegister()
    {
        return view('auth.register');
    }

    public function viewLogin()
    {
        return view('auth.login');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255|confirmed'
        ], [
            'email.unique' => 'Email sudah digunakan.',
            'password.confirmed' => 'Password dan konfirmasi password tidak sama.',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');

    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255',
            'password' => 'required|string|min:8|max:255'
        ]);

        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard.admin');
            } else {
                return redirect()->route('produk-kami');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->with('fail', 'Login gagal. Silakan periksa kembali email dan password Anda.');
        ;
    }

    public function logoutPost(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
