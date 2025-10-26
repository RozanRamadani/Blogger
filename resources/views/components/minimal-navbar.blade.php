{{-- Minimalist Professional Navbar --}}
<nav class="sticky top-0 z-50 bg-cream-50/95 dark:bg-charcoal-950/95 backdrop-blur-md border-b border-charcoal-200/20 dark:border-cream-100/10 transition-all duration-300" x-data="{ mobileMenuOpen: false, searchOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            {{-- Logo / Brand --}}
            <div class="flex-shrink-0">
                <a href="/" class="group flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-terracotta-500 to-olive-600 rounded-full flex items-center justify-center transform group-hover:scale-105 transition-transform duration-200">
                        <span class="text-cream-50 font-display font-bold text-lg">B</span>
                    </div>
                    <span class="font-display text-2xl font-bold text-charcoal-900 dark:text-cream-50 tracking-tight">
                        Blogger
                    </span>
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center space-x-1">
                <a href="/" 
                   class="px-4 py-2 text-sm font-medium text-charcoal-700 dark:text-cream-200 hover:text-terracotta-600 dark:hover:text-terracotta-400 transition-colors duration-200 rounded-lg hover:bg-cream-100 dark:hover:bg-charcoal-900">
                    Home
                </a>
                <a href="/posts" 
                   class="px-4 py-2 text-sm font-medium text-charcoal-700 dark:text-cream-200 hover:text-terracotta-600 dark:hover:text-terracotta-400 transition-colors duration-200 rounded-lg hover:bg-cream-100 dark:hover:bg-charcoal-900">
                    Articles
                </a>
                <a href="/about" 
                   class="px-4 py-2 text-sm font-medium text-charcoal-700 dark:text-cream-200 hover:text-terracotta-600 dark:hover:text-terracotta-400 transition-colors duration-200 rounded-lg hover:bg-cream-100 dark:hover:bg-charcoal-900">
                    About
                </a>
                <a href="/kontak" 
                   class="px-4 py-2 text-sm font-medium text-charcoal-700 dark:text-cream-200 hover:text-terracotta-600 dark:hover:text-terracotta-400 transition-colors duration-200 rounded-lg hover:bg-cream-100 dark:hover:bg-charcoal-900">
                    Contact
                </a>
            </div>

            {{-- Actions --}}
            <div class="flex items-center space-x-3">
                {{-- Search Toggle Button --}}
                <button @click="searchOpen = !searchOpen" 
                        type="button" 
                        class="p-2.5 text-charcoal-600 dark:text-cream-300 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-all duration-200"
                        aria-label="Search">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                {{-- Theme Toggle --}}
                <button onclick="toggleTheme()" 
                        class="p-2.5 text-charcoal-600 dark:text-cream-300 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-all duration-200"
                        aria-label="Toggle theme">
                    <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>

                @auth
                    {{-- User Menu Dropdown (Desktop) --}}
                    <div class="hidden md:block relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                class="flex items-center space-x-2 p-2 text-charcoal-700 dark:text-cream-200 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-all duration-200">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-terracotta-500 to-olive-600 flex items-center justify-center text-cream-50 text-sm font-semibold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 bg-white dark:bg-charcoal-800 rounded-xl shadow-2xl border border-charcoal-100 dark:border-charcoal-700 py-2 z-50">
                            <div class="px-4 py-3 border-b border-charcoal-100 dark:border-charcoal-700">
                                <p class="text-sm text-charcoal-500 dark:text-cream-400">Signed in as</p>
                                <p class="text-sm font-semibold text-charcoal-900 dark:text-cream-50 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="/about" class="flex items-center px-4 py-2.5 text-sm text-charcoal-700 dark:text-cream-200 hover:bg-cream-100 dark:hover:bg-charcoal-900 hover:text-terracotta-600 dark:hover:text-terracotta-400 transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Your Profile
                            </a>
                            <a href="/profile/edit" class="flex items-center px-4 py-2.5 text-sm text-charcoal-700 dark:text-cream-200 hover:bg-cream-100 dark:hover:bg-charcoal-900 hover:text-terracotta-600 dark:hover:text-terracotta-400 transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Settings
                            </a>
                            <div class="border-t border-charcoal-100 dark:border-charcoal-700 my-2"></div>
                            <a href="/logout" class="flex items-center px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Sign out
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Login/Register Buttons (Desktop) --}}
                    <a href="/login" 
                       class="hidden md:inline-flex items-center px-4 py-2 text-sm font-medium text-charcoal-700 dark:text-cream-200 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-all duration-200">
                        Sign in
                    </a>
                    <a href="/register" 
                       class="hidden md:inline-flex items-center px-5 py-2.5 text-sm font-medium text-cream-50 bg-terracotta-600 hover:bg-terracotta-700 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                        Sign up
                    </a>
                @endauth

                {{-- Mobile menu button --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        type="button" 
                        class="md:hidden p-2.5 text-charcoal-600 dark:text-cream-300 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-all duration-200"
                        aria-label="Toggle menu">
                    <svg class="w-6 h-6" :class="{ 'hidden': mobileMenuOpen, 'block': !mobileMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="w-6 h-6" :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Search Bar (Full Width) --}}
    <div x-show="searchOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="border-t border-charcoal-200/20 dark:border-cream-100/10 bg-cream-50 dark:bg-charcoal-950 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="/posts" method="GET" class="relative">
                <input type="search" 
                       name="search" 
                       placeholder="Search articles..." 
                       class="w-full pl-12 pr-4 py-3 text-charcoal-900 dark:text-cream-50 bg-white dark:bg-charcoal-900 border-2 border-charcoal-200 dark:border-charcoal-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                       autofocus>
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-charcoal-400 dark:text-cream-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </form>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden border-t border-charcoal-200/20 dark:border-cream-100/10 bg-cream-50 dark:bg-charcoal-950">
        <div class="px-4 pt-2 pb-4 space-y-1">
            <a href="/" class="block px-4 py-3 text-base font-medium text-charcoal-700 dark:text-cream-200 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-colors duration-200">
                Home
            </a>
            <a href="/posts" class="block px-4 py-3 text-base font-medium text-charcoal-700 dark:text-cream-200 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-colors duration-200">
                Articles
            </a>
            <a href="/about" class="block px-4 py-3 text-base font-medium text-charcoal-700 dark:text-cream-200 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-colors duration-200">
                About
            </a>
            <a href="/kontak" class="block px-4 py-3 text-base font-medium text-charcoal-700 dark:text-cream-200 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-colors duration-200">
                Contact
            </a>
            
            @auth
                <div class="border-t border-charcoal-200/20 dark:border-cream-100/10 my-2 pt-2">
                    <div class="px-4 py-2">
                        <p class="text-xs text-charcoal-500 dark:text-cream-400">Signed in as</p>
                        <p class="text-sm font-semibold text-charcoal-900 dark:text-cream-50">{{ Auth::user()->name }}</p>
                    </div>
                    <a href="/about" class="block px-4 py-3 text-base font-medium text-charcoal-700 dark:text-cream-200 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-colors duration-200">
                        Your Profile
                    </a>
                    <a href="/profile/edit" class="block px-4 py-3 text-base font-medium text-charcoal-700 dark:text-cream-200 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-colors duration-200">
                        Settings
                    </a>
                    <a href="/logout" class="block px-4 py-3 text-base font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors duration-200">
                        Sign out
                    </a>
                </div>
            @else
                <div class="border-t border-charcoal-200/20 dark:border-cream-100/10 my-2 pt-2 space-y-2">
                    <a href="/login" class="block px-4 py-3 text-base font-medium text-center text-charcoal-700 dark:text-cream-200 bg-cream-100 dark:bg-charcoal-900 hover:bg-cream-200 dark:hover:bg-charcoal-800 rounded-lg transition-all duration-200">
                        Sign in
                    </a>
                    <a href="/register" class="block px-4 py-3 text-base font-medium text-center text-cream-50 bg-terracotta-600 hover:bg-terracotta-700 rounded-lg transition-all duration-200">
                        Sign up
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
