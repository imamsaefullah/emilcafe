<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Profile
{
    //
    public function index()
    {
        $user = User::where("email","=", Auth::user()->email)->first();
        return view('dashboard.profile.index', compact('user'));
    }
    public function store(Request $request)
    {

    }
//  login
    public function login()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }

        return view('login.index');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau password salah.');
    }


//    daftar
    public function  signup(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('login.signup');
    }
    public function signupUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Login langsung setelah registrasi (opsional)
//        auth()->login($user);

        // Redirect ke dashboard atau halaman utama
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Selamat datang!');
    }
}
