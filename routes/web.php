<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Mail\WelcomeMail;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Jobs\ProcessWelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ArticleController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        $categories = Category::all();
        return view('home', [
            'title' => 'Home Page',
            'categories' => $categories
        ]);
    });

    Route::get('/about', function () {
        return view('about', ['title' => 'About', 'nama' => 'Rozan Aiman Ramadani']);
    });

    Route::get('/posts', function () {
        return view('posts', ['title' => 'Blog', 'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(6)->withQueryString()]);
    });

    Route::get('/posts/{post:slug}', function (Post $post) {
        return view('post', ['title' => 'Single Post', 'post' => $post]);
    });

    Route::get('/author/{user:username}', function (User $user) {
        return view('posts', ['title' => count($user->posts) . ' Articles by ' . $user->name, 'posts' => $user->posts]);
    });

    Route::get('/categories/{category:slug}', function (Category $category) {
        return view('posts', ['title' => ' Articles in ' . $category->name, 'posts' => $category->posts]);
    });

    Route::get('/kontak', function () {
        return view('kontak', ['title' => 'Kontak']);
    });

    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'createUser'])->name('register');

    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    })->name('password.email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    })->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email', ['title' => 'Verify Email']);
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/')->with('success', 'Email verified successfully!');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::get('/send-welcome-mail', function() {
    $users = [
        ['email' => 'shnfsjb@gmail.com', 'password' => '123456'],
        ['email' => 'hdsvcfgdsv@gmail.com', 'password' => '123456'],
        ['email' => 'ksdhnciudsbhc@gmail.com', 'password' => '123456'],
        ['email' => 'sdhfdsb@gmail.com', 'password' => '123456'],
        ['email' => 'ksdncn@gmail.com', 'password' => '123456'],
    ];

    foreach ($users as $user) {
        ProcessWelcomeMail::dispatch($user)->onQueue('send-email');
    }
});


