<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    function login()
    {   
        return view('login', ['title' => 'Login']);
    }

    function authenticate(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirect to intended page or home
            return redirect()->intended('/')->with('success', 'Login successful!');
        }
        

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'Email atau Password yang anda masukkan salah!',
        ])->withInput();
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'You have been logged out successfully!');
    }

    function register()
    {
        return view('register', ['title' => 'Register']);
    }

    function createUser(Request $request)
    {
        // Validate the request
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        Auth::login($user);

        event(new Registered($user));

        return redirect('/')->with('success', 'Registration successful! Please verify your email.');
    }
}
