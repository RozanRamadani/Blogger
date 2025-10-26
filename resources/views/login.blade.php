@vite('resources/css/app.css', 'resources/js/app.js')
<section class="min-h-screen bg-gradient-to-br from-cream-50 via-white to-cream-100 dark:from-charcoal-950 dark:via-charcoal-900 dark:to-charcoal-950">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen">
        <div class="w-full bg-white dark:bg-charcoal-800 rounded-3xl shadow-2xl border-2 border-charcoal-100 dark:border-charcoal-700 md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-8 space-y-6">
                <div class="text-center">
                    <h1 class="font-display text-3xl font-bold text-charcoal-900 dark:text-cream-50 mb-2">
                        Welcome Back
                    </h1>
                    <p class="text-charcoal-600 dark:text-cream-300">
                        Sign in to continue to your account
                    </p>
                </div>

                <form method="POST" class="space-y-5" action="{{ route('login') }}">
                    @csrf
                    @if ($errors->any())
                        <div class="bg-red-50 dark:bg-red-900/30 border-2 border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-xl" role="alert">
                            <ul class="space-y-1 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="bg-terracotta-50 dark:bg-terracotta-900/30 border-2 border-terracotta-200 dark:border-terracotta-800 text-terracotta-800 dark:text-terracotta-200 px-4 py-3 rounded-xl" role="alert">
                            <p class="text-sm">{{ session('status') }}</p>
                        </div>
                    @endif

                    <div>
                        <label for="email" class="block mb-2 text-sm font-semibold text-charcoal-700 dark:text-cream-200">Your email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                            placeholder="name@company.com" required>
                        @error('email')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-semibold text-charcoal-700 dark:text-cream-200">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                            required>
                        @error('password')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" name="remember" type="checkbox"
                                    class="w-4 h-4 border-2 border-charcoal-300 dark:border-charcoal-600 rounded bg-white dark:bg-charcoal-800 focus:ring-2 focus:ring-terracotta-500 text-terracotta-600">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember" class="text-charcoal-600 dark:text-cream-300">Remember me</label>
                            </div>
                        </div>
                        <a href="/forgot-password" class="text-sm font-medium text-terracotta-600 dark:text-terracotta-400 hover:text-terracotta-700 dark:hover:text-terracotta-300 transition-colors">
                            Forgot password?
                        </a>
                    </div>

                    <button type="submit"
                        class="w-full py-3 px-5 bg-terracotta-600 hover:bg-terracotta-700 text-cream-50 font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                        Sign in
                    </button>

                    <p class="text-sm text-center text-charcoal-600 dark:text-cream-400">
                        Don't have an account yet? 
                        <a href="/register" class="font-semibold text-terracotta-600 dark:text-terracotta-400 hover:text-terracotta-700 dark:hover:text-terracotta-300 transition-colors">
                            Sign up
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
