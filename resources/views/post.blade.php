<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Schema.org Structured Data --}}
    @php
        $articleSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => Str::limit(strip_tags($post->body), 160),
            'image' => $post->image ? asset('storage/' . $post->image) : asset('img/default-post.jpg'),
            'author' => [
                '@type' => 'Person',
                'name' => $post->author->name,
                'url' => url('/posts?author=' . $post->author->username),
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('img/logo.png'),
                ],
            ],
            'datePublished' => $post->created_at->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => url('/posts/' . $post->slug),
            ],
            'articleSection' => $post->category->name,
            'keywords' => $post->category->name . ', blog, article',
            'wordCount' => str_word_count($post->body),
            'inLanguage' => 'en-US',
        ];

        $breadcrumbSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => url('/'),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'Blog',
                    'item' => url('/posts'),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $post->category->name,
                    'item' => url('/posts?category=' . $post->category->slug),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 4,
                    'name' => $post->title,
                    'item' => url('/posts/' . $post->slug),
                ],
            ],
        ];
    @endphp

    <script type="application/ld+json">{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    {{-- Article Content --}}
    <article class="bg-white dark:bg-charcoal-900">
        {{-- Back Navigation --}}
        <div class="border-b border-charcoal-100 dark:border-charcoal-800 bg-cream-50 dark:bg-charcoal-950">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <a href="/posts" class="inline-flex items-center text-sm font-medium text-charcoal-600 dark:text-cream-300 hover:text-terracotta-600 dark:hover:text-terracotta-400 transition-colors group">
                        <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Back to articles
                    </a>
                    @can('update', $post)
                        <a href="{{ route('articles.edit', $post->slug) }}" class="inline-flex items-center text-sm px-4 py-2 rounded-lg bg-cream-100 dark:bg-charcoal-800 text-charcoal-700 dark:text-cream-200 hover:bg-cream-200 dark:hover:bg-charcoal-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Post
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        {{-- Article Header --}}
        <header class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8">
            {{-- Category & Read Time --}}
            <div class="flex items-center gap-4 mb-6">
                <a href="/posts?category={{ $post->category->slug }}" class="inline-block px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-terracotta-100 dark:bg-terracotta-900/30 text-terracotta-800 dark:text-terracotta-300 hover:bg-terracotta-200 dark:hover:bg-terracotta-900/50 transition-colors">
                    {{ $post->category->name }}
                </a>
                <span class="text-sm text-charcoal-500 dark:text-cream-400">
                    {{ ceil(str_word_count($post->body) / 200) }} min read
                </span>
            </div>

            {{-- Title --}}
            <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-charcoal-900 dark:text-cream-50 leading-tight mb-8">
                {{ $post->title }}
            </h1>

            {{-- Author & Meta --}}
            <div class="flex items-center justify-between pb-8 border-b border-charcoal-100 dark:border-charcoal-800">
                <a href="/posts?author={{ $post->author->username }}" class="flex items-center space-x-4 group/author">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-terracotta-500 to-olive-600 flex items-center justify-center text-cream-50 font-semibold text-lg shadow-lg">
                        {{ strtoupper(substr($post->author->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="font-semibold text-lg text-charcoal-900 dark:text-cream-50 group-hover/author:text-terracotta-600 dark:group-hover/author:text-terracotta-400 transition-colors">
                            {{ $post->author->name }}
                        </div>
                        <div class="text-sm text-charcoal-500 dark:text-cream-400">
                            {{ $post->created_at->format('F d, Y') }}
                            @if($post->created_at != $post->updated_at)
                                <span class="mx-1">•</span>
                                <span>Updated {{ $post->updated_at->diffForHumans() }}</span>
                            @endif
                        </div>
                    </div>
                </a>

                {{-- Share Buttons --}}
                <div class="flex items-center gap-2" x-data="shareButtons">
                    <span class="text-sm font-medium text-charcoal-600 dark:text-cream-400 mr-2">Share</span>
                    <button @click="shareTwitter" title="Share on Twitter" class="p-2 rounded-lg bg-cream-100 dark:bg-charcoal-800 hover:bg-[#1DA1F2] hover:text-white text-charcoal-600 dark:text-cream-300 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </button>
                    <button @click="shareLinkedIn" title="Share on LinkedIn" class="p-2 rounded-lg bg-cream-100 dark:bg-charcoal-800 hover:bg-[#0077b5] hover:text-white text-charcoal-600 dark:text-cream-300 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </button>
                    <button @click="copyLink" title="Copy link" class="p-2 rounded-lg bg-cream-100 dark:bg-charcoal-800 hover:bg-terracotta-600 hover:text-white text-charcoal-600 dark:text-cream-300 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        {{-- Featured Image --}}
        @if($post->image)
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
                <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                    <img 
                        src="{{ asset('storage/' . $post->image) }}" 
                        alt="{{ $post->title }}"
                        class="w-full h-auto object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-charcoal-900/30 to-transparent"></div>
                </div>
            </div>
        @endif

        {{-- Article Body --}}
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="prose prose-lg prose-charcoal dark:prose-invert max-w-none">
                <div class="text-charcoal-700 dark:text-cream-200 leading-relaxed text-lg font-serif">
                    {!! nl2br(e($post->body)) !!}
                </div>
            </div>

            {{-- Tags (Optional - if you add tags later) --}}
            <div class="mt-12 pt-8 border-t border-charcoal-100 dark:border-charcoal-800">
                <div class="flex flex-wrap gap-2 items-center">
                    <span class="text-sm font-semibold text-charcoal-600 dark:text-cream-400">Topics:</span>
                    <a href="/posts?category={{ $post->category->slug }}" class="px-3 py-1 text-sm rounded-full bg-cream-100 dark:bg-charcoal-800 text-charcoal-700 dark:text-cream-300 hover:bg-terracotta-100 dark:hover:bg-terracotta-900/30 hover:text-terracotta-700 dark:hover:text-terracotta-300 transition-colors">
                        {{ $post->category->name }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Related Posts --}}
        @if($relatedPosts->count() > 0)
        <section class="border-t border-charcoal-100 dark:border-charcoal-800 bg-cream-50 dark:bg-charcoal-950 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="font-display text-3xl font-bold text-charcoal-900 dark:text-cream-50 mb-8">
                    Continue Reading
                </h3>
                <div class="grid gap-8 md:grid-cols-3">
                    @foreach($relatedPosts as $relatedPost)
                    <article class="group">
                        @if($relatedPost->image)
                            <a href="/posts/{{ $relatedPost->slug }}" class="block mb-4 overflow-hidden rounded-xl">
                                <img 
                                    src="{{ asset('storage/' . $relatedPost->image) }}" 
                                    alt="{{ $relatedPost->title }}"
                                    loading="lazy"
                                    class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-500">
                            </a>
                        @endif

                        <a href="/posts?category={{ $relatedPost->category->slug }}" 
                           class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-terracotta-100 dark:bg-terracotta-900/40 text-terracotta-800 dark:text-terracotta-300 border border-terracotta-200 dark:border-terracotta-800 mb-3">
                            {{ $relatedPost->category->name }}
                        </a>

                        <a href="/posts/{{ $relatedPost->slug }}">
                            <h4 class="font-display text-xl font-bold text-charcoal-900 dark:text-cream-50 mb-2 leading-snug group-hover:text-terracotta-600 dark:group-hover:text-terracotta-400 transition-colors line-clamp-2">
                                {{ $relatedPost->title }}
                            </h4>
                        </a>

                        <p class="text-sm text-charcoal-600 dark:text-cream-300 mb-3 line-clamp-2">
                            {{ Str::limit($relatedPost->body, 100) }}
                        </p>

                        <div class="flex items-center text-xs text-charcoal-500 dark:text-cream-400">
                            <span>{{ $relatedPost->author->name }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $relatedPost->created_at->diffForHumans() }}</span>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- Comments Section --}}
        <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <x-giscus-comments />
        </section>
    </article>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('shareButtons', () => ({
                pageUrl: window.location.href,
                pageTitle: '{{ addslashes($post->title) }}',
                
                shareTwitter() {
                    const url = `https://twitter.com/intent/tweet?url=${encodeURIComponent(this.pageUrl)}&text=${encodeURIComponent(this.pageTitle)}`;
                    window.open(url, '_blank', 'width=600,height=400');
                },
                
                shareLinkedIn() {
                    const url = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(this.pageUrl)}`;
                    window.open(url, '_blank', 'width=600,height=400');
                },
                
                async copyLink() {
                    try {
                        await navigator.clipboard.writeText(this.pageUrl);
                        // Toast notification
                        const toast = document.createElement('div');
                        toast.className = 'fixed bottom-4 right-4 px-6 py-3 bg-terracotta-600 text-cream-50 rounded-lg shadow-xl z-50 font-medium';
                        toast.textContent = '✓ Link copied!';
                        document.body.appendChild(toast);
                        setTimeout(() => {
                            toast.style.opacity = '0';
                            toast.style.transform = 'translateY(10px)';
                            toast.style.transition = 'all 0.3s ease';
                            setTimeout(() => toast.remove(), 300);
                        }, 2000);
                    } catch (err) {
                        alert('Failed to copy link');
                    }
                }
            }));
        });
    </script>
    @endpush
</x-layout>
