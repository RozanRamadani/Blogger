
<nav class="sticky top-0 z-50 bg-white/95 dark:bg-charcoal-900/95 backdrop-blur-sm border-b border-charcoal-200 dark:border-charcoal-700 transition-all" x-data="{ mobileMenuOpen: false, searchOpen: false }">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <div class="flex-shrink-0">
                <a href="/" class="group flex items-center space-x-2">
                    <div class="w-9 h-9 bg-primary-600 rounded-lg flex items-center justify-center transform group-hover:scale-105 transition-transform">
                        <span class="text-white font-bold text-lg">B</span>
                    </div>
                    <span class="text-xl font-bold text-charcoal-900 dark:text-white">
                        Blog Pribadi
                    </span>
                </a>
            </div>

            
            <div class="hidden md:flex items-center space-x-1">
                <a href="/"
                   class="px-4 py-2 text-sm font-medium text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors rounded-lg hover:bg-cream-50 dark:hover:bg-charcoal-800">
                    Beranda
                </a>
                <a href="/posts"
                   class="px-4 py-2 text-sm font-medium text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors rounded-lg hover:bg-cream-50 dark:hover:bg-charcoal-800">
                    Artikel
                </a>
                <a href="/users"
                   class="px-4 py-2 text-sm font-medium text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors rounded-lg hover:bg-cream-50 dark:hover:bg-charcoal-800">
                    Penulis
                </a>
                <a href="/about"
                   class="px-4 py-2 text-sm font-medium text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors rounded-lg hover:bg-cream-50 dark:hover:bg-charcoal-800">
                    Tentang
                </a>
                <a href="/kontak"
                   class="px-4 py-2 text-sm font-medium text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors rounded-lg hover:bg-cream-50 dark:hover:bg-charcoal-800">
                    Kontak
                </a>
            </div>

            
            <div class="flex items-center space-x-2">
                
                <button @click="searchOpen = !searchOpen"
                        type="button"
                        class="p-2 text-charcoal-600 dark:text-charcoal-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-cream-50 dark:hover:bg-charcoal-800 rounded-lg transition-all"
                        aria-label="Cari">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                
                <button onclick="toggleTheme()"
                        class="p-2 text-charcoal-600 dark:text-charcoal-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-cream-50 dark:hover:bg-charcoal-800 rounded-lg transition-all"
                        aria-label="Ganti tema">
                    <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>

                <?php if(auth()->guard()->check()): ?>
                    
                    <div class="hidden md:block relative" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center space-x-2 p-2 text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-cream-50 dark:hover:bg-charcoal-800 rounded-lg transition-all">
                            <?php if(Auth::user()->profile_photo): ?>
                                <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="Profile" class="w-8 h-8 rounded-full object-cover border-2 border-primary-200 dark:border-primary-600">
                            <?php else: ?>
                                <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center text-white text-sm font-semibold">
                                    <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                                </div>
                            <?php endif; ?>
                            <span class="text-sm font-medium"><?php echo e(Auth::user()->name); ?></span>
                            <svg class="w-4 h-4" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                             class="absolute right-0 mt-2 w-64 bg-white dark:bg-charcoal-800 rounded-xl shadow-xl border border-charcoal-200 dark:border-charcoal-700 py-2 z-50">
                            
                            <div class="px-4 py-3 border-b border-charcoal-200 dark:border-charcoal-700">
                                <div class="flex items-center space-x-3">
                                    <?php if(Auth::user()->profile_photo): ?>
                                        <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="Profile" class="w-12 h-12 rounded-full object-cover border-2 border-primary-200 dark:border-primary-600">
                                    <?php else: ?>
                                        <div class="w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center text-white text-lg font-semibold">
                                            <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-medium text-charcoal-500 dark:text-charcoal-400 uppercase tracking-wide">Akun</p>
                                        <p class="text-sm font-semibold text-charcoal-900 dark:text-white truncate mt-1"><?php echo e(Auth::user()->name); ?></p>
                                        <p class="text-xs text-charcoal-600 dark:text-charcoal-400 truncate"><?php echo e(Auth::user()->email); ?></p>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="py-2">
                                <a href="/about" class="flex items-center px-4 py-2.5 text-sm font-medium text-charcoal-700 dark:text-charcoal-200 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profil Saya
                                </a>
                                <a href="/my-favorites" class="flex items-center px-4 py-2.5 text-sm font-medium text-charcoal-700 dark:text-charcoal-200 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                    </svg>
                                    My Favorites
                                </a>
                                <a href="/my-drafts" class="flex items-center px-4 py-2.5 text-sm font-medium text-charcoal-700 dark:text-charcoal-200 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    My Drafts
                                </a>
                                <a href="/posts" class="flex items-center px-4 py-2.5 text-sm font-medium text-charcoal-700 dark:text-charcoal-200 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                    Artikel Saya
                                </a>
                            </div>

                            <div class="border-t border-charcoal-100 dark:border-charcoal-700"></div>

                            
                            <div class="py-2">
                                <a href="/profile/edit" class="flex items-center px-4 py-2.5 text-sm font-medium text-charcoal-700 dark:text-charcoal-200 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit Profil
                                </a>
                            </div>

                            <div class="border-t border-charcoal-100 dark:border-charcoal-700"></div>

                            
                            <div class="py-2">
                                <a href="/logout" class="flex items-center px-4 py-2.5 text-sm font-semibold text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Keluar
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    
                          <a href="/login"
                              class="hidden md:inline-flex items-center px-4 py-2 text-sm font-medium text-charcoal-700 dark:text-cream-200 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-all duration-200">
                        Sign in
                    </a>
                    <a href="/register"
                              class="hidden md:inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                        Sign up
                    </a>
                <?php endif; ?>

                
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    type="button"
                    class="md:hidden p-2.5 text-charcoal-600 dark:text-cream-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-cream-100 dark:hover:bg-charcoal-900 rounded-lg transition-all duration-200"
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

    
    <div x-show="searchOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="border-t border-charcoal-200/20 dark:border-cream-100/10 bg-cream-50 dark:bg-charcoal-950 py-4"
         x-data="{ searchType: 'posts', searchQuery: '', searchResults: [], searching: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex gap-2 mb-3">
                <button @click="searchType = 'posts'; searchQuery = ''; searchResults = []"
                        :class="searchType === 'posts' ? 'bg-primary-600 text-white' : 'bg-white dark:bg-charcoal-900 text-charcoal-700 dark:text-cream-100'"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all hover:shadow-md">
                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Artikel
                </button>
                <button @click="searchType = 'users'; searchQuery = ''; searchResults = []"
                        :class="searchType === 'users' ? 'bg-primary-600 text-white' : 'bg-white dark:bg-charcoal-900 text-charcoal-700 dark:text-cream-100'"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all hover:shadow-md">
                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Orang
                </button>
            </div>

            
            <div class="relative">
                <input type="search"
                       x-model="searchQuery"
                       @input.debounce.300ms="
                           if (searchQuery.length >= 2) {
                               searching = true;
                               fetch(`/api/search?q=${encodeURIComponent(searchQuery)}&type=${searchType}`)
                                   .then(res => res.json())
                                   .then(data => {
                                       searchResults = data;
                                       searching = false;
                                   })
                                   .catch(() => searching = false);
                           } else {
                               searchResults = [];
                           }
                       "
                       :placeholder="searchType === 'posts' ? 'Cari artikel...' : 'Cari orang berdasarkan nama, username, atau email...'"
                       class="w-full pl-12 pr-4 py-3 text-charcoal-900 dark:text-cream-50 bg-white dark:bg-charcoal-900 border-2 border-charcoal-200 dark:border-charcoal-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                       autofocus>
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-charcoal-400 dark:text-cream-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <div x-show="searching" class="absolute right-4 top-1/2 -translate-y-1/2">
                    <svg class="animate-spin h-5 w-5 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>

            
            <div x-show="searchResults.length > 0"
                 x-transition
                 class="mt-3 bg-white dark:bg-charcoal-900 rounded-xl shadow-lg border border-charcoal-200 dark:border-charcoal-700 overflow-hidden">

                
                <template x-if="searchType === 'posts'">
                    <div class="divide-y divide-charcoal-100 dark:divide-charcoal-800">
                        <template x-for="post in searchResults" :key="post.slug">
                            <a :href="`/posts/${post.slug}`"
                               class="block px-4 py-3 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors">
                                <h4 class="font-semibold text-charcoal-900 dark:text-cream-50" x-text="post.title"></h4>
                                <p class="text-sm text-charcoal-600 dark:text-cream-200 mt-1 line-clamp-2" x-text="post.excerpt"></p>
                                <div class="flex items-center gap-3 mt-2 text-xs text-charcoal-500 dark:text-cream-400">
                                    <span x-text="post.author_name"></span>
                                    <span>•</span>
                                    <span x-text="post.category_name"></span>
                                </div>
                            </a>
                        </template>
                    </div>
                </template>

                
                <template x-if="searchType === 'users'">
                    <div class="divide-y divide-charcoal-100 dark:divide-charcoal-800">
                        <template x-for="user in searchResults" :key="user.id">
                            <a :href="`/posts?author=${user.username}`"
                               class="block px-4 py-3 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold">
                                        <span x-text="user.name.charAt(0).toUpperCase()"></span>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-charcoal-900 dark:text-cream-50" x-text="user.name"></h4>
                                        <p class="text-sm text-charcoal-600 dark:text-cream-200" x-text="'@' + user.username"></p>
                                    </div>
                                    <div class="text-xs text-charcoal-500 dark:text-cream-400">
                                        <span x-text="user.posts_count"></span> artikel
                                    </div>
                                </div>
                            </a>
                        </template>
                    </div>
                </template>
            </div>

            
            <div x-show="searchQuery.length >= 2 && searchResults.length === 0 && !searching"
                 x-transition
                 class="mt-3 px-4 py-8 text-center text-charcoal-500 dark:text-cream-400 bg-white dark:bg-charcoal-900 rounded-xl border border-charcoal-200 dark:border-charcoal-700">
                <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p x-text="searchType === 'posts' ? 'Tidak ada artikel yang ditemukan' : 'Tidak ada pengguna yang ditemukan'"></p>
            </div>
        </div>
    </div>

    
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden border-t border-charcoal-200 dark:border-charcoal-700 bg-white dark:bg-charcoal-900">
        <div class="px-4 pt-2 pb-4 space-y-1">
            
            <a href="/" class="block px-4 py-3 text-base font-medium text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-colors">
                Beranda
            </a>
            <a href="/posts" class="block px-4 py-3 text-base font-medium text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-colors">
                Artikel
            </a>
            <a href="/users" class="block px-4 py-3 text-base font-medium text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-colors">
                Penulis
            </a>
            <a href="/about" class="block px-4 py-3 text-base font-medium text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-colors">
                Tentang
            </a>
            <a href="/kontak" class="block px-4 py-3 text-base font-medium text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-colors">
                Kontak
            </a>

            <?php if(auth()->guard()->check()): ?>
                
                <div class="border-t border-charcoal-200 dark:border-charcoal-700 my-2 pt-2">
                    <div class="px-4 py-3 flex items-center space-x-3">
                        <?php if(Auth::user()->profile_photo): ?>
                            <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="Profile" class="w-12 h-12 rounded-full object-cover border-2 border-primary-200 dark:border-primary-600">
                        <?php else: ?>
                            <div class="w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center text-white text-lg font-semibold">
                                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                            </div>
                        <?php endif; ?>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-charcoal-500 dark:text-charcoal-400 uppercase tracking-wide">Akun</p>
                            <p class="text-sm font-semibold text-charcoal-900 dark:text-white truncate mt-1"><?php echo e(Auth::user()->name); ?></p>
                            <p class="text-xs text-charcoal-600 dark:text-charcoal-400 truncate"><?php echo e(Auth::user()->email); ?></p>
                        </div>
                    </div>
                    <a href="/about" class="flex items-center px-4 py-3 text-base font-medium text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profil Saya
                    </a>
                    <a href="/profile/edit" class="flex items-center px-4 py-3 text-base font-medium text-charcoal-700 dark:text-charcoal-200 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Profil
                    </a>
                    <a href="/logout" class="flex items-center px-4 py-3 text-base font-semibold text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Keluar
                    </a>
                </div>
            <?php else: ?>
                
                <div class="border-t border-charcoal-200 dark:border-charcoal-700 my-2 pt-2 space-y-2">
                    <a href="/login" class="block px-4 py-3 text-center font-medium text-charcoal-700 dark:text-charcoal-200 border border-charcoal-300 dark:border-charcoal-600 hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:border-primary-600 dark:hover:border-primary-400 rounded-lg transition-colors">
                        Masuk
                    </a>
                    <a href="/register" class="block px-4 py-3 text-center font-semibold text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors shadow-md">
                        Daftar
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>
<?php /**PATH C:\laragon\www\project1\resources\views/components/minimal-navbar.blade.php ENDPATH**/ ?>