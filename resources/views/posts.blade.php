<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Hero Section with Search --}}
    <section class="relative bg-gradient-to-br from-cream-50 via-white to-cream-100 dark:from-charcoal-950 dark:via-charcoal-900 dark:to-charcoal-950 border-b border-charcoal-100 dark:border-charcoal-800 py-16 md:py-24">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMwMDAiIGZpbGwtb3BhY2l0eT0iMC4wMiI+PHBhdGggZD0iTTM2IDEzNGg3djFoLTd6bTAtMWg3di0xaC03em0wIDNoN3YtMWgtN3ptMCAzaDd2LTFoLTd6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-40"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-bold text-charcoal-900 dark:text-cream-50 mb-6 leading-tight">
                    Explore <span class="text-terracotta-600 dark:text-terracotta-500">Articles</span>
                </h1>
                <p class="text-xl md:text-2xl text-charcoal-600 dark:text-cream-300 max-w-3xl mx-auto leading-relaxed">
                    Discover insightful stories, expert perspectives, and creative ideas from our community of writers.
                </p>
            </div>

            {{-- Search Bar --}}
            <form class="max-w-3xl mx-auto">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <div class="flex gap-3">
                    <div class="relative flex-1">
                        <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-charcoal-400 dark:text-cream-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                        <input
                            type="search" 
                            id="search" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Search for articles..."
                            class="w-full pl-14 pr-6 py-4 text-lg rounded-2xl border-2 border-charcoal-200 dark:border-charcoal-700 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 placeholder-charcoal-400 dark:placeholder-cream-500 focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all shadow-sm hover:shadow-md">
                    </div>
                    <button type="submit"
                        class="px-10 py-4 bg-terracotta-600 hover:bg-terracotta-700 text-cream-50 text-lg font-semibold rounded-2xl transition-all duration-200 shadow-md hover:shadow-xl whitespace-nowrap transform hover:-translate-y-0.5">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </section>

    {{-- Posts Grid --}}
    <section class="py-16 md:py-24 bg-white dark:bg-charcoal-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Featured Post (First post if exists) --}}
            @if($posts->count() > 0 && !request('search') && !request('category') && !request('author'))
                @php $featured = $posts->first(); @endphp
                <article class="mb-20 pb-16 border-b-2 border-charcoal-100 dark:border-charcoal-800">
                    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                        @if($featured->image)
                            <div class="relative overflow-hidden rounded-3xl group shadow-2xl">
                                <img 
                                    src="{{ asset('storage/' . $featured->image) }}" 
                                    alt="{{ $featured->title }}"
                                    class="w-full h-[450px] object-cover transform group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-charcoal-900/60 to-transparent"></div>
                            </div>
                        @endif
                        
                        <div class="space-y-6">
                            <div class="flex items-center gap-4">
                                <span class="inline-block px-5 py-2 rounded-full text-sm font-bold uppercase tracking-wider bg-terracotta-100 dark:bg-terracotta-900/40 text-terracotta-800 dark:text-terracotta-300 border border-terracotta-200 dark:border-terracotta-800">
                                    {{ $featured->category->name }}
                                </span>
                                <span class="text-sm text-charcoal-500 dark:text-cream-400 font-medium">
                                    Featured Article
                                </span>
                            </div>
                            
                            <a href="/posts/{{ $featured->slug }}">
                                <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-charcoal-900 dark:text-cream-50 leading-tight hover:text-terracotta-600 dark:hover:text-terracotta-400 transition-colors">
                                    {{ $featured->title }}
                                </h2>
                            </a>
                            
                            <p class="text-xl text-charcoal-600 dark:text-cream-300 leading-relaxed">
                                {{ Str::limit($featured->body, 250) }}
                            </p>
                            
                            <div class="flex items-center justify-between pt-6">
                                <a href="/posts?author={{ $featured->author->username }}" class="flex items-center space-x-4 group/author">
                                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-terracotta-500 to-olive-600 flex items-center justify-center text-cream-50 font-bold text-lg shadow-lg">
                                        {{ strtoupper(substr($featured->author->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-lg text-charcoal-900 dark:text-cream-50 group-hover/author:text-terracotta-600 dark:group-hover/author:text-terracotta-400 transition-colors">
                                            {{ $featured->author->name }}
                                        </div>
                                        <div class="text-sm text-charcoal-500 dark:text-cream-400">
                                            {{ $featured->created_at->format('M d, Y') }} • {{ ceil(str_word_count($featured->body) / 200) }} min read
                                        </div>
                                    </div>
                                </a>
                                
                                <div class="flex items-center gap-3">
                                    <a href="/posts/{{ $featured->slug }}" 
                                       class="inline-flex items-center px-8 py-3 bg-terracotta-600 hover:bg-terracotta-700 text-cream-50 font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        Read Now
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                    @can('update', $featured)
                                        <a href="{{ route('articles.edit', $featured->slug) }}" 
                                           class="inline-flex items-center px-5 py-3 bg-cream-100 dark:bg-charcoal-800 text-charcoal-700 dark:text-cream-200 hover:bg-cream-200 dark:hover:bg-charcoal-700 rounded-xl transition-colors shadow-md">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @endif

            {{-- Posts Grid Header --}}
            @if($posts->count() > 0)
                <div class="mb-12">
                    <h3 class="font-display text-3xl font-bold text-charcoal-900 dark:text-cream-50">
                        @if(request('search'))
                            Search results for "{{ request('search') }}"
                        @elseif(request('category'))
                            Category: {{ ucfirst(request('category')) }}
                        @elseif(request('author'))
                            By {{ ucfirst(request('author')) }}
                        @else
                            Latest Articles
                        @endif
                    </h3>
                </div>
            @endif

            {{-- Regular Posts Grid --}}
            <div id="posts-container" class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
                @php 
                    $displayPosts = ($posts->count() > 0 && !request('search') && !request('category') && !request('author')) 
                        ? $posts->skip(1) 
                        : $posts;
                @endphp
                
                @forelse ($displayPosts as $post)
                    <article class="group bg-white dark:bg-charcoal-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-charcoal-100 dark:border-charcoal-700">
                        @if($post->image)
                            <a href="/posts/{{ $post->slug }}" class="block overflow-hidden">
                                <img 
                                    src="{{ asset('storage/' . $post->image) }}" 
                                    alt="{{ $post->title }}"
                                    loading="lazy"
                                    class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-700">
                            </a>
                        @endif

                        <div class="p-8">
                            <div class="flex items-center justify-between mb-4">
                                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-terracotta-100 dark:bg-terracotta-900/40 text-terracotta-800 dark:text-terracotta-300 border border-terracotta-200 dark:border-terracotta-800">
                                    {{ $post->category->name }}
                                </span>
                                <span class="text-sm text-charcoal-500 dark:text-cream-400 font-medium">
                                    {{ $post->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <a href="/posts/{{ $post->slug }}">
                                <h3 class="font-display text-2xl font-bold text-charcoal-900 dark:text-cream-50 mb-4 leading-tight group-hover:text-terracotta-600 dark:group-hover:text-terracotta-400 transition-colors line-clamp-2">
                                    {{ $post->title }}
                                </h3>
                            </a>

                            <p class="text-charcoal-600 dark:text-cream-300 mb-6 leading-relaxed line-clamp-3">
                                {{ Str::limit($post->body, 140) }}
                            </p>

                            <div class="flex items-center justify-between pt-6 border-t border-charcoal-100 dark:border-charcoal-700">
                                <a href="/posts?author={{ $post->author->username }}" class="flex items-center space-x-3 group/author">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-terracotta-500 to-olive-600 flex items-center justify-center text-cream-50 text-sm font-semibold shadow-md">
                                        {{ strtoupper(substr($post->author->name, 0, 2)) }}
                                    </div>
                                    <span class="text-sm font-semibold text-charcoal-700 dark:text-cream-200 group-hover/author:text-terracotta-600 dark:group-hover/author:text-terracotta-400 transition-colors">
                                        {{ $post->author->name }}
                                    </span>
                                </a>

                                <div class="flex items-center gap-2">
                                    <a href="/posts/{{ $post->slug }}" 
                                       class="inline-flex items-center text-sm font-semibold text-terracotta-600 dark:text-terracotta-400 hover:text-terracotta-700 dark:hover:text-terracotta-300 transition-colors">
                                        Read more
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                    @can('update', $post)
                                        <a href="{{ route('articles.edit', $post->slug) }}" 
                                           class="p-2 text-charcoal-500 dark:text-cream-400 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-700 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-3 text-center py-24">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 mx-auto mb-8 rounded-full bg-cream-100 dark:bg-charcoal-800 flex items-center justify-center">
                                <svg class="w-12 h-12 text-charcoal-300 dark:text-charcoal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"></path>
                                </svg>
                            </div>
                            <h3 class="font-display text-3xl font-bold text-charcoal-900 dark:text-cream-50 mb-4">
                                No articles found
                            </h3>
                            <p class="text-lg text-charcoal-600 dark:text-cream-400 mb-8">
                                Try adjusting your search or explore all articles.
                            </p>
                            <a href="/posts" 
                               class="inline-flex items-center px-8 py-4 bg-terracotta-600 hover:bg-terracotta-700 text-cream-50 font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                View all articles
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($posts->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>
</x-layout>
