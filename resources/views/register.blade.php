@vite('resources/css/app.css', 'resources/js/app.js')
<section class="min-h-screen bg-gradient-to-br from-cream-50 via-white to-cream-100 dark:from-charcoal-950 dark:via-charcoal-900 dark:to-charcoal-950">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen">
        <div class="w-full bg-white dark:bg-charcoal-800 rounded-3xl shadow-2xl border-2 border-charcoal-100 dark:border-charcoal-700 md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-8 space-y-6">
                <div class="text-center">
                    <h1 class="font-display text-3xl font-bold text-charcoal-900 dark:text-cream-50 mb-2">
                        Create Account
                    </h1>
                    <p class="text-charcoal-600 dark:text-cream-300">
                        Join our community today
                    </p>
                </div>

                <form method="POST" class="space-y-5" action="{{ route('register') }}">
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

                    <div>
                        <label for="name" class="block mb-2 text-sm font-semibold text-charcoal-700 dark:text-cream-200">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                            placeholder="Your name" required>
                        @error('name')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="username" class="block mb-2 text-sm font-semibold text-charcoal-700 dark:text-cream-200">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                            class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                            placeholder="Your username" required>
                        @error('username')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-semibold text-charcoal-700 dark:text-cream-200">Email</label>
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

                    <div>
                        <label for="password_confirmation" class="block mb-2 text-sm font-semibold text-charcoal-700 dark:text-cream-200">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••"
                            class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                            required>
                    </div>

                    <button type="submit"
                        class="w-full py-3 px-5 bg-terracotta-600 hover:bg-terracotta-700 text-cream-50 font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                        Sign up
                    </button>

                    <p class="text-sm text-center text-charcoal-600 dark:text-cream-400">
                        Already have account? 
                        <a href="/login" class="font-semibold text-terracotta-600 dark:text-terracotta-400 hover:text-terracotta-700 dark:hover:text-terracotta-300 transition-colors">
                            Sign in
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
