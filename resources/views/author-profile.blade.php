<x-layout>
    <x-slot:title>{{ $author->name }}</x-slot:title>

    {{-- Author Hero Section --}}
    <section class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 dark:from-primary-800 dark:via-primary-900 dark:to-charcoal-900 py-16 md:py-20">
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                {{-- Profile Photo --}}
                <div class="relative group">
                    @if($author->profile_photo)
                        <img src="{{ asset('storage/' . $author->profile_photo) }}" 
                             alt="{{ $author->name }}"
                             class="w-32 h-32 md:w-40 md:h-40 rounded-full object-cover border-4 border-white dark:border-charcoal-800 shadow-2xl">
                    @else
                        <div class="w-32 h-32 md:w-40 md:h-40 rounded-full bg-white dark:bg-charcoal-800 flex items-center justify-center text-primary-600 dark:text-primary-400 font-bold text-5xl shadow-2xl border-4 border-white dark:border-charcoal-700">
                            {{ strtoupper(substr($author->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                {{-- Author Info --}}
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-3">
                        {{ $author->name }}
                    </h1>
                    <p class="text-xl text-primary-100 dark:text-primary-200 mb-4">
                        @<span>{{ $author->username }}</span>
                    </p>
                    
                    @if($author->bio)
                        <p class="text-lg text-white/90 max-w-2xl mb-6 leading-relaxed">
                            {{ $author->bio }}
                        </p>
                    @endif

                    {{-- Social Links --}}
                    @if($author->twitter_url || $author->github_url || $author->linkedin_url || $author->website_url)
                        <div class="flex flex-wrap justify-center md:justify-start gap-3 mb-6">
                            @if($author->website_url)
                                <a href="{{ $author->website_url }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white rounded-lg transition-all border border-white/20">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd"></path>
                                    </svg>
                                    Website
                                </a>
                            @endif
                            
                            @if($author->twitter_url)
                                <a href="{{ $author->twitter_url }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white rounded-lg transition-all border border-white/20">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path>
                                    </svg>
                                    Twitter
                                </a>
                            @endif
                            
                            @if($author->github_url)
                                <a href="{{ $author->github_url }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white rounded-lg transition-all border border-white/20">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                                    </svg>
                                    GitHub
                                </a>
                            @endif
                            
                            @if($author->linkedin_url)
                                <a href="{{ $author->linkedin_url }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white rounded-lg transition-all border border-white/20">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path>
                                    </svg>
                                    LinkedIn
                                </a>
                            @endif
                        </div>
                    @endif

                    {{-- Stats --}}
                    <div class="flex flex-wrap justify-center md:justify-start gap-6 text-white">
                        <div class="text-center">
                            <div class="text-3xl font-bold">{{ $stats['total_posts'] }}</div>
                            <div class="text-sm text-primary-100">Artikel</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold">{{ number_format($stats['total_views']) }}</div>
                            <div class="text-sm text-primary-100">Total Views</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold">{{ number_format($stats['total_likes']) }}</div>
                            <div class="text-sm text-primary-100">Total Likes</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold">{{ $author->created_at->format('Y') }}</div>
                            <div class="text-sm text-primary-100">Bergabung</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Author's Posts --}}
    <section class="py-12 md:py-16 bg-cream-50 dark:bg-charcoal-950">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex items-center justify-between">
                <h2 class="text-3xl font-bold text-charcoal-900 dark:text-white">
                    Artikel oleh {{ $author->name }}
                </h2>
                <span class="text-charcoal-600 dark:text-charcoal-400">
                    {{ $posts->total() }} artikel
                </span>
            </div>

            @if($posts->count() > 0)
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($posts as $post)
                        <x-post-card :post="$post" />
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($posts->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-cream-100 dark:bg-charcoal-800 flex items-center justify-center">
                        <svg class="w-12 h-12 text-charcoal-300 dark:text-charcoal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-charcoal-900 dark:text-white mb-2">
                        Belum Ada Artikel
                    </h3>
                    <p class="text-charcoal-600 dark:text-charcoal-400">
                        {{ $author->name }} belum mempublikasikan artikel.
                    </p>
                </div>
            @endif
        </div>
    </section>
</x-layout>
