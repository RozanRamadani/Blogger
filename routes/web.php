<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Mail\WelcomeMail;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Jobs\ProcessWelcomeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SitemapController;
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
        return view('about');
    });

    Route::get('/profile/edit', function () {
        return view('edit-profile', ['user' => Auth::user()]);
    })->middleware(['auth', 'verified'])->name('profile.edit');

    Route::post('/profile/edit', [AuthController::class, 'updateProfile'])->middleware(['auth', 'verified'])->name('profile.update');

    Route::post('/kontak', function (Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Save to database
        $contact = App\Models\Contact::create($data);

    // Send notification to admin (queued)
    Mail::to(config('mail.from.address'))->queue(new App\Mail\ContactReceived($contact));

        return back()->with('success', 'Your message has been sent!');
    })->name('kontak.send');

    Route::get('/posts', function () {
        $posts = Post::filter(request(['search', 'category', 'author']))
            ->with(['author', 'category']) // Eager loading
            ->latest()
            ->paginate(6)
            ->withQueryString();
        
        return view('posts', ['title' => 'Blog', 'posts' => $posts]);
    });

    // Infinite scroll endpoint
    Route::get('/posts/load-more', function (Request $request) {
        $posts = Post::filter($request->only(['search', 'category', 'author']))
            ->with(['author', 'category'])
            ->latest()
            ->paginate(6);

        $postsData = $posts->map(function ($post) {
            return [
                'slug' => $post->slug,
                'title' => $post->title,
                'excerpt' => Str::limit($post->body, 120),
                'body' => $post->body,
                'image' => $post->image,
                'image_url' => $post->image ? asset('storage/' . $post->image) : null,
                'created_at' => $post->created_at->toDateTimeString(),
                'created_at_human' => $post->created_at->diffForHumans(),
                'author_name' => $post->author->name,
                'author_username' => $post->author->username,
                'author_initials' => strtoupper(substr($post->author->name, 0, 2)),
                'category_name' => $post->category->name,
                'category_slug' => $post->category->slug,
                'can_update' => auth()->check() && auth()->user()->can('update', $post),
            ];
        });

        return response()->json([
            'posts' => $postsData,
            'hasMore' => $posts->hasMorePages(),
            'currentPage' => $posts->currentPage(),
            'lastPage' => $posts->lastPage(),
        ]);
    });

    Route::get('/posts/{post:slug}', function (Post $post) {
        // Quick instrumentation to measure server-side render time and query count for this route.
        $start = microtime(true);
        DB::enableQueryLog();

        // Get related posts from same category, excluding current post
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->with(['author', 'category'])
            ->latest()
            ->take(3)
            ->get();

        $duration = round((microtime(true) - $start) * 1000, 2); // ms
        $queries = count(DB::getQueryLog());
        Log::info('Route /posts/{post} render', ['slug' => $post->slug, 'duration_ms' => $duration, 'db_queries' => $queries]);

        return view('post', [
            'title' => 'Single Post', 
            'post' => $post,
            'relatedPosts' => $relatedPosts
        ]);
    });

    // Edit, update, delete post routes
    Route::get('/posts/{post:slug}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/posts/{post:slug}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/posts/{post:slug}', [ArticleController::class, 'destroy'])->name('articles.destroy');

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

    // Live Search API
    Route::get('/api/search', function (Request $request) {
        $query = $request->input('q');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        
        $posts = Post::with(['author', 'category'])
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('body', 'LIKE', "%{$query}%")
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($post) {
                return [
                    'slug' => $post->slug,
                    'title' => $post->title,
                    'body' => $post->body,
                    'excerpt' => Str::limit($post->body, 120),
                    'author_name' => $post->author->name,
                    'category_name' => $post->category->name,
                ];
            });
        
        return response()->json($posts);
    })->name('api.search');
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

Route::get('/send-welcome-mail', function () {
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

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/robots.txt', [SitemapController::class, 'robots']);

