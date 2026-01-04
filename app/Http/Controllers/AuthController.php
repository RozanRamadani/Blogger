<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Jobs\ProcessWelcomeMail;

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

        // fire the Registered event (email verification) and dispatch a queued welcome mail
        event(new Registered($user));

        // Dispatch welcome mail job with the User model (safe serialization)
        ProcessWelcomeMail::dispatch($user)->onQueue('send-email');

        return redirect('/')->with('success', 'Registration successful! Please verify your email.');
    }


    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string|max:1000',
            'website_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->bio = $validated['bio'] ?? null;
        $user->website_url = $validated['website_url'] ?? null;
        $user->twitter_url = $validated['twitter_url'] ?? null;
        $user->github_url = $validated['github_url'] ?? null;
        $user->linkedin_url = $validated['linkedin_url'] ?? null;

        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo && file_exists(public_path('storage/' . $user->profile_photo))) {
                unlink(public_path('storage/' . $user->profile_photo));
            }

            // Store new photo
            $fileName = time() . '_' . $request->file('profile_photo')->getClientOriginalName();
            $request->file('profile_photo')->move(public_path('storage/profile-photos'), $fileName);
            $user->profile_photo = 'profile-photos/' . $fileName;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
