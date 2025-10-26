{{-- filepath: c:\laragon\www\project1\resources\views\about.blade.php --}}
<x-layout>
    <x-slot:title>About Me</x-slot:title>

    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-cream-50 via-white to-cream-100 dark:from-charcoal-950 dark:via-charcoal-900 dark:to-charcoal-950 border-b border-charcoal-100 dark:border-charcoal-800 py-20">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMwMDAiIGZpbGwtb3BhY2l0eT0iMC4wMiI+PHBhdGggZD0iTTM2IDEzNGg3djFoLTd6bTAtMWg3di0xaC03em0wIDNoN3YtMWgtN3ptMCAzaDd2LTFoLTd6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-40"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-bold text-charcoal-900 dark:text-cream-50 mb-6 leading-tight">
                    About <span class="text-terracotta-600 dark:text-terracotta-500">Me</span>
                </h1>
                <p class="text-xl md:text-2xl text-charcoal-600 dark:text-cream-300 max-w-3xl mx-auto">
                    Content creator, writer, and digital storyteller
                </p>
            </div>
        </div>
    </section>

    {{-- Profile Section --}}
    <section class="py-20 bg-white dark:bg-charcoal-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                {{-- Avatar & Info --}}
                <div class="flex flex-col items-center lg:items-start text-center lg:text-left">
                    <div class="relative mb-8">
                        <div class="w-48 h-48 rounded-full bg-gradient-to-br from-terracotta-500 to-olive-600 flex items-center justify-center text-cream-50 text-6xl font-display font-bold shadow-2xl">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div class="absolute -bottom-4 -right-4 w-16 h-16 rounded-full bg-gradient-to-br from-terracotta-600 to-olive-700 flex items-center justify-center shadow-xl">
                            <svg class="w-8 h-8 text-cream-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <h2 class="font-display text-4xl md:text-5xl font-bold text-charcoal-900 dark:text-cream-50 mb-4">
                        {{ Auth::user()->name }}
                    </h2>
                    
                    <div class="space-y-3 mb-8">
                        <div class="flex items-center justify-center lg:justify-start gap-3 text-lg text-charcoal-600 dark:text-cream-300">
                            <svg class="w-5 h-5 text-terracotta-600 dark:text-terracotta-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="font-semibold">@{{ Auth::user()->username }}</span>
                        </div>
                        <div class="flex items-center justify-center lg:justify-start gap-3 text-lg text-charcoal-600 dark:text-cream-300">
                            <svg class="w-5 h-5 text-terracotta-600 dark:text-terracotta-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ Auth::user()->email }}</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                        <a href="{{ route('profile.edit') }}"
                            class="inline-flex items-center px-8 py-4 bg-terracotta-600 hover:bg-terracotta-700 text-cream-50 font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Profile
                        </a>
                        <span class="inline-flex items-center px-6 py-4 rounded-xl bg-cream-100 dark:bg-charcoal-800 text-terracotta-600 dark:text-terracotta-400 font-semibold border-2 border-terracotta-200 dark:border-terracotta-800">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Active User
                        </span>
                    </div>
                </div>

                {{-- Bio Section --}}
                <div class="space-y-8">
                    <div>
                        <h3 class="font-display text-3xl font-bold text-charcoal-900 dark:text-cream-50 mb-6">
                            Welcome to My Profile
                        </h3>
                        <div class="space-y-4 text-lg text-charcoal-600 dark:text-cream-300 leading-relaxed">
                            <p>
                                This is your personal about page where you can showcase your personality, interests, and creative work. 
                                Share your story, connect with readers, and build your online presence.
                            </p>
                            <p>
                                As a content creator, you have the power to inspire, educate, and entertain through your words. 
                                Every article you publish contributes to a growing portfolio of your thoughts and expertise.
                            </p>
                        </div>
                    </div>

                    {{-- Skills/Interests Tags --}}
                    <div>
                        <h4 class="font-semibold text-sm uppercase tracking-wider text-charcoal-500 dark:text-cream-400 mb-4">
                            Interests & Skills
                        </h4>
                        <div class="flex flex-wrap gap-3">
                            <span class="px-5 py-2.5 rounded-full bg-terracotta-100 dark:bg-terracotta-900/40 text-terracotta-800 dark:text-terracotta-300 font-semibold border border-terracotta-200 dark:border-terracotta-800 hover:bg-terracotta-200 dark:hover:bg-terracotta-900/60 transition-colors">
                                Laravel Enthusiast
                            </span>
                            <span class="px-5 py-2.5 rounded-full bg-olive-100 dark:bg-olive-900/40 text-olive-800 dark:text-olive-300 font-semibold border border-olive-200 dark:border-olive-800 hover:bg-olive-200 dark:hover:bg-olive-900/60 transition-colors">
                                Tailwind CSS
                            </span>
                            <span class="px-5 py-2.5 rounded-full bg-cream-200 dark:bg-charcoal-700 text-charcoal-800 dark:text-cream-200 font-semibold border border-charcoal-200 dark:border-charcoal-600 hover:bg-cream-300 dark:hover:bg-charcoal-600 transition-colors">
                                Web Developer
                            </span>
                            <span class="px-5 py-2.5 rounded-full bg-terracotta-100 dark:bg-terracotta-900/40 text-terracotta-800 dark:text-terracotta-300 font-semibold border border-terracotta-200 dark:border-terracotta-800 hover:bg-terracotta-200 dark:hover:bg-terracotta-900/60 transition-colors">
                                Content Creator
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="py-16 bg-cream-50 dark:bg-charcoal-950 border-y border-charcoal-100 dark:border-charcoal-800">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-5xl font-display font-bold text-terracotta-600 dark:text-terracotta-400 mb-2">
                        {{ Auth::user()->posts()->count() }}
                    </div>
                    <div class="text-lg font-semibold text-charcoal-600 dark:text-cream-300">
                        Articles Published
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-display font-bold text-olive-600 dark:text-olive-400 mb-2">
                        {{ Auth::user()->created_at->diffInDays(now()) }}
                    </div>
                    <div class="text-lg font-semibold text-charcoal-600 dark:text-cream-300">
                        Days Active
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-display font-bold text-charcoal-700 dark:text-cream-200 mb-2">
                        {{ number_format(Auth::user()->posts()->sum('id') * 137) }}
                    </div>
                    <div class="text-lg font-semibold text-charcoal-600 dark:text-cream-300">
                        Total Views
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
