{{-- Modern Sticky Navbar with Transparent Effect --}}
<nav x-data="{ 
    isScrolled: false, 
    mobileMenuOpen: false,
    searchOpen: false 
}" 
     x-init="window.addEventListener('scroll', () => { isScrolled = window.scrollY > 20 })"
     :class="{ 
        'bg-white/80 dark:bg-gray-900/80 backdrop-blur-md shadow-lg': isScrolled, 
        'bg-transparent': !isScrolled 
     }"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            {{-- Logo / Brand --}}
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500 rounded-lg flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                        Laravel Blog
                    </span>
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden md:block">
                <div class="ml-10 flex items-center space-x-6">
                    <a href="/" class="px-3 py-2 rounded-md text-sm font-medium hover:text-primary-600 dark:hover:text-primary-400 transition-colors {{ request()->is('/') ? 'text-primary-600 dark:text-primary-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">
                        Home
                    </a>
                    <a href="/posts" class="px-3 py-2 rounded-md text-sm font-medium hover:text-primary-600 dark:hover:text-primary-400 transition-colors {{ request()->is('posts*') ? 'text-primary-600 dark:text-primary-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">
                        Articles
                    </a>
                    <a href="/about" class="px-3 py-2 rounded-md text-sm font-medium hover:text-primary-600 dark:hover:text-primary-400 transition-colors {{ request()->is('about') ? 'text-primary-600 dark:text-primary-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">
                        About
                    </a>
                    <a href="/kontak" class="px-3 py-2 rounded-md text-sm font-medium hover:text-primary-600 dark:hover:text-primary-400 transition-colors {{ request()->is('kontak') ? 'text-primary-600 dark:text-primary-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">
                        Contact
                    </a>
                </div>
            </div>

            {{-- Right Side: Search, Theme Toggle, Profile --}}
            <div class="flex items-center space-x-3">
                {{-- Live Search Toggle --}}
                <button @click="searchOpen = !searchOpen" 
                        class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                {{-- Dark Mode Toggle --}}
                <button onclick="window.toggleTheme()" 
                        class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors group">
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-400 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-400 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>

                {{-- Profile Dropdown --}}
                @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-semibold text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 rounded-lg shadow-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden"
                         style="display: none;">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="/profile/edit" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                            Edit Profile
                        </a>
                        <a href="/logout" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                            Logout
                        </a>
                    </div>
                </div>
                @else
                <a href="/login" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                    Login
                </a>
                @endauth

                {{-- Mobile Menu Button --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800">
                    <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden pb-4"
             style="display: none;">
            <div class="space-y-1 px-2">
                <a href="/" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('/') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                    Home
                </a>
                <a href="/posts" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('posts*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                    Articles
                </a>
                <a href="/about" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('about') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                    About
                </a>
                <a href="/kontak" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('kontak') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                    Contact
                </a>
            </div>
        </div>
    </div>

    {{-- Live Search Modal --}}
    <div x-show="searchOpen" 
         @click.away="searchOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40"
         style="display: none;">
        
        <div class="flex items-start justify-center min-h-screen pt-20 px-4">
            <div @click.stop 
                 class="w-full max-w-2xl bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 -translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" 
                               id="live-search"
                               placeholder="Search articles..." 
                               class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-900 border-0 rounded-lg focus:ring-2 focus:ring-primary-500 text-gray-900 dark:text-white"
                               autofocus>
                    </div>
                </div>
                
                <div id="search-results" 
                     class="max-h-96 overflow-y-auto">
                    <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <p class="text-sm">Start typing to search articles...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

{{-- Spacer to prevent content from going under fixed navbar --}}
<div class="h-16"></div>
