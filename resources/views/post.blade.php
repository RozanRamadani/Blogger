<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- SEO Meta Tags for Social Sharing --}}
    <x-slot:metaDescription>{{ Str::limit(strip_tags($post->body), 160) }}</x-slot:metaDescription>
    <x-slot:metaKeywords>{{ $post->category->name }}, blog, article, {{ $post->author->name }}</x-slot:metaKeywords>
    <x-slot:metaAuthor>{{ $post->author->name }}</x-slot:metaAuthor>
    <x-slot:ogImage>{{ $post->image ? asset('storage/' . $post->image) : asset('img/og-default.jpg') }}</x-slot:ogImage>

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

    {{-- Reading Progress Bar --}}
    <div id="reading-progress-bar" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-primary-500 via-primary-600 to-primary-700 transition-all duration-150 ease-out z-50" style="width: 0%"></div>

    {{-- Scroll to Top Button --}}
    <button
        id="scroll-to-top"
        class="fixed bottom-8 right-8 w-12 h-12 bg-primary-600 hover:bg-primary-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center opacity-0 invisible z-40"
        aria-label="Scroll to top">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    {{-- Article Content --}}
    <article class="bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50">
        {{-- Back Navigation --}}
        <div class="border-b border-charcoal-200 dark:border-charcoal-700 bg-white dark:bg-charcoal-900">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <a href="/posts" class="inline-flex items-center text-sm font-semibold px-3 py-2 rounded-lg border border-primary-200 dark:border-primary-800 text-primary-700 dark:text-primary-300 bg-primary-50 dark:bg-primary-900/15 hover:bg-primary-100 dark:hover:bg-primary-900/30 hover:text-primary-800 transition-colors group">
                        <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke artikel
                    </a>
                    @can('update', $post)
                        <a href="{{ route('articles.edit', $post->slug) }}" class="inline-flex items-center text-sm px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-semibold shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-charcoal-900">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Artikel
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        {{-- Article Header --}}
        <header class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8">
            {{-- Category & Read Time --}}
            <div class="flex items-center gap-4 mb-6">
                <a href="/posts?category={{ $post->category->slug }}" class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 hover:bg-primary-200 dark:hover:bg-primary-900/50 transition-colors">
                    {{ $post->category->name }}
                </a>
                <span class="text-sm text-charcoal-500 dark:text-charcoal-400">
                    {{ ceil(str_word_count($post->body) / 200) }} menit baca
                </span>
                <span class="inline-flex items-center text-sm text-charcoal-500 dark:text-charcoal-400" title="{{ number_format($post->views_count) }} views">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    {{ number_format($post->views_count) }} views
                </span>
            </div>

            {{-- Title --}}
            <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-charcoal-900 dark:text-white leading-[1.05] mb-8 tracking-tight">
                {{ $post->title }}
            </h1>

            {{-- Author & Meta --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-8 border-b border-charcoal-200 dark:border-charcoal-700">
                <a href="/posts?author={{ $post->author->username }}" class="flex items-center space-x-4 group/author">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold text-lg shadow-lg">
                        {{ strtoupper(substr($post->author->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="font-semibold text-lg text-charcoal-900 dark:text-white group-hover/author:text-primary-600 dark:group-hover/author:text-primary-400 transition-colors">
                            {{ $post->author->name }}
                        </div>
                        <div class="text-sm text-charcoal-500 dark:text-charcoal-400">
                            {{ $post->created_at->format('F d, Y') }}
                            @if($post->created_at != $post->updated_at)
                                <span class="mx-1">•</span>
                                <span>Diubah {{ $post->updated_at->diffForHumans() }}</span>
                            @endif
                        </div>
                    </div>
                </a>

                <div class="flex items-center gap-4">
                    @auth
                        {{-- Like Button --}}
                        <button
                            onclick="toggleLike({{ $post->id }}, '{{ $post->slug }}')"
                            id="like-btn-{{ $post->id }}"
                            class="inline-flex items-center px-3 py-1.5 rounded-lg border text-sm transition-all {{ $post->isLikedBy(auth()->user()) ? 'border-red-500 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400' : 'border-charcoal-300 dark:border-charcoal-600 text-charcoal-600 dark:text-charcoal-300 hover:border-red-500 hover:text-red-600' }}"
                            title="{{ $post->isLikedBy(auth()->user()) ? 'Unlike' : 'Like' }}">
                            <svg class="w-4 h-4 mr-1.5 {{ $post->isLikedBy(auth()->user()) ? 'fill-current' : '' }}" fill="{{ $post->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span id="likes-count-{{ $post->id }}" class="font-medium">{{ $post->likes()->count() }}</span>
                        </button>

                        {{-- Bookmark Button --}}
                        <button
                            onclick="toggleBookmark({{ $post->id }}, '{{ $post->slug }}')"
                            id="bookmark-btn-{{ $post->id }}"
                            class="inline-flex items-center px-3 py-1.5 rounded-lg border text-sm transition-all {{ $post->isBookmarkedBy(auth()->user()) ? 'border-yellow-500 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400' : 'border-charcoal-300 dark:border-charcoal-600 text-charcoal-600 dark:text-charcoal-300 hover:border-yellow-500 hover:text-yellow-600' }}"
                            title="{{ $post->isBookmarkedBy(auth()->user()) ? 'Remove bookmark' : 'Bookmark' }}">
                            <svg class="w-4 h-4 mr-1.5 {{ $post->isBookmarkedBy(auth()->user()) ? 'fill-current' : '' }}" fill="{{ $post->isBookmarkedBy(auth()->user()) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                            <span class="font-medium">{{ $post->isBookmarkedBy(auth()->user()) ? 'Saved' : 'Save' }}</span>
                        </button>
                    @endauth
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

        {{-- Gallery Images --}}
        @if($post->images && count($post->images) > 0)
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-12" x-data="imageGallery()">
                <h3 class="text-xl font-bold text-charcoal-900 dark:text-white mb-4">Gallery</h3>

                {{-- Main Gallery Grid --}}
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                    @foreach($post->images as $index => $img)
                        <div @click="openImage({{ $index }})" class="cursor-pointer group relative overflow-hidden rounded-xl shadow-md hover:shadow-xl transition-all">
                            <img src="{{ asset('storage/' . $img) }}" alt="Gallery image {{ $index + 1 }}" class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity"></div>
                            <div class="absolute top-2 right-2 bg-black/60 text-white text-xs px-2 py-1 rounded-full">
                                {{ $index + 1 }}/{{ count($post->images) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Lightbox Modal --}}
                <div x-show="isOpen"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="closeImage"
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-sm"
                     style="display: none;">

                    {{-- Close Button --}}
                    <button @click="closeImage" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    {{-- Previous Button --}}
                    <button @click.stop="previousImage" class="absolute left-4 text-white hover:text-gray-300 transition-colors z-10 bg-black/50 hover:bg-black/70 rounded-full p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>

                    {{-- Image --}}
                    <div class="max-w-6xl max-h-[90vh] mx-4" @click.stop>
                        <img :src="currentImageUrl"
                             alt="Full size gallery image"
                             class="max-w-full max-h-[90vh] w-auto h-auto object-contain rounded-lg shadow-2xl">
                        <div class="text-center text-white mt-4 text-sm">
                            <span x-text="currentIndex + 1"></span> / <span x-text="totalImages"></span>
                        </div>
                    </div>

                    {{-- Next Button --}}
                    <button @click.stop="nextImage" class="absolute right-4 text-white hover:text-gray-300 transition-colors z-10 bg-black/50 hover:bg-black/70 rounded-full p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>

                <script>
                    function imageGallery() {
                        return {
                            isOpen: false,
                            currentIndex: 0,
                            images: @json(array_map(fn($img) => asset('storage/' . $img), $post->images)),
                            totalImages: {{ count($post->images) }},

                            get currentImageUrl() {
                                return this.images[this.currentIndex];
                            },

                            openImage(index) {
                                this.currentIndex = index;
                                this.isOpen = true;
                                document.body.style.overflow = 'hidden';
                            },

                            closeImage() {
                                this.isOpen = false;
                                document.body.style.overflow = 'auto';
                            },

                            nextImage() {
                                this.currentIndex = (this.currentIndex + 1) % this.totalImages;
                            },

                            previousImage() {
                                this.currentIndex = (this.currentIndex - 1 + this.totalImages) % this.totalImages;
                            },

                            init() {
                                // Keyboard navigation
                                this.$watch('isOpen', (value) => {
                                    if (value) {
                                        document.addEventListener('keydown', this.handleKeyboard.bind(this));
                                    } else {
                                        document.removeEventListener('keydown', this.handleKeyboard.bind(this));
                                    }
                                });
                            },

                            handleKeyboard(e) {
                                if (e.key === 'Escape') this.closeImage();
                                if (e.key === 'ArrowLeft') this.previousImage();
                                if (e.key === 'ArrowRight') this.nextImage();
                            }
                        }
                    }
                </script>
            </div>
        @endif

        {{-- Article Body --}}
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="prose prose-lg prose-charcoal dark:prose-invert max-w-none">
                <div class="text-charcoal-800 dark:text-cream-100 leading-relaxed text-lg font-normal tracking-normal">
                    {!! nl2br(e($post->body)) !!}
                </div>
            </div>

            {{-- Tags --}}
            <div class="mt-12 pt-8 border-t border-charcoal-200 dark:border-charcoal-700">
                <div class="flex flex-wrap gap-2 items-center">
                    <span class="text-sm font-semibold text-charcoal-600 dark:text-charcoal-400">Kategori:</span>
                    <a href="/posts?category={{ $post->category->slug }}" class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 hover:bg-primary-200 dark:hover:bg-primary-900/50 transition-colors">
                        {{ $post->category->name }}
                    </a>
                </div>

                @if($post->tags && $post->tags->count() > 0)
                    <div class="flex flex-wrap gap-2 items-center mt-4">
                        <span class="text-sm font-semibold text-charcoal-600 dark:text-charcoal-400">Tags:</span>
                        @foreach($post->tags as $tag)
                            <a href="/posts?tag={{ $tag->slug }}"
                               class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold transition-all hover:shadow-md"
                               style="background-color: {{ $tag->color }}15; color: {{ $tag->color }}; border: 1.5px solid {{ $tag->color }}40;">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Social Share Section (Bottom) --}}
            <div class="mt-12 pt-8 border-t border-charcoal-200 dark:border-charcoal-700">
                <div class="flex items-center justify-center sm:justify-end">
                    {{-- Social Share Buttons --}}
                    <x-social-share
                        :url="url('/posts/' . $post->slug)"
                        :title="$post->title"
                        :description="Str::limit(strip_tags($post->body), 160)" />
                </div>
            </div>
        </div>

        {{-- Related Posts --}}
        @if($relatedPosts->count() > 0)
        <section class="border-t border-charcoal-200 dark:border-charcoal-700 bg-cream-50 dark:bg-charcoal-950 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="font-display text-3xl font-bold text-charcoal-900 dark:text-white">
                            Artikel Terkait
                        </h3>
                        <p class="text-charcoal-600 dark:text-charcoal-400 mt-2">
                            Artikel lain dalam kategori <span class="font-semibold text-primary-600 dark:text-primary-400">{{ $post->category->name }}</span>
                        </p>
                    </div>
                    <a href="/posts?category={{ $post->category->slug }}" class="hidden md:inline-flex items-center text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                        Lihat semua
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                    @foreach($relatedPosts as $relatedPost)
                    <article class="group bg-white dark:bg-charcoal-800 rounded-xl overflow-hidden border border-charcoal-200 dark:border-charcoal-700 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        @if($relatedPost->image)
                            <a href="/posts/{{ $relatedPost->slug }}" class="block overflow-hidden relative">
                                <img
                                    src="{{ asset('storage/' . $relatedPost->image) }}"
                                    alt="{{ $relatedPost->title }}"
                                    loading="lazy"
                                    class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </a>
                        @endif

                        <div class="p-5">
                            <div class="flex items-center justify-between mb-3">
                                <a href="/posts?category={{ $relatedPost->category->slug }}"
                                   class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 hover:bg-primary-200 dark:hover:bg-primary-900/50 transition-colors">
                                    {{ $relatedPost->category->name }}
                                </a>
                                <span class="inline-flex items-center text-xs text-charcoal-500 dark:text-charcoal-400" title="{{ number_format($relatedPost->views_count) }} views">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ $relatedPost->views_count >= 1000 ? number_format($relatedPost->views_count / 1000, 1) . 'k' : $relatedPost->views_count }}
                                </span>
                            </div>

                            <a href="/posts/{{ $relatedPost->slug }}">
                                <h4 class="text-lg font-bold text-charcoal-900 dark:text-white mb-3 leading-tight group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">
                                    {{ $relatedPost->title }}
                                </h4>
                            </a>

                            <p class="text-sm text-charcoal-600 dark:text-charcoal-300 mb-4 line-clamp-2 leading-relaxed">
                                {{ Str::limit($relatedPost->body, 100) }}
                            </p>

                            <div class="flex items-center justify-between pt-3 border-t border-charcoal-100 dark:border-charcoal-700">
                                <div class="flex items-center text-xs text-charcoal-500 dark:text-charcoal-400">
                                    <div class="w-6 h-6 rounded-full bg-primary-600 flex items-center justify-center text-white text-xs font-semibold mr-2">
                                        {{ strtoupper(substr($relatedPost->author->name, 0, 1)) }}
                                    </div>
                                    <span class="font-medium">{{ $relatedPost->author->name }}</span>
                                </div>
                                <span class="text-xs text-charcoal-400 dark:text-charcoal-500">
                                    {{ $relatedPost->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </section>
        @else
        {{-- Fallback when no related posts --}}
        <section class="border-t border-charcoal-200 dark:border-charcoal-700 bg-cream-50 dark:bg-charcoal-950 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <svg class="w-16 h-16 mx-auto text-charcoal-300 dark:text-charcoal-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <h3 class="font-display text-2xl font-bold text-charcoal-900 dark:text-white mb-2">
                    Belum Ada Artikel Terkait
                </h3>
                <p class="text-charcoal-600 dark:text-charcoal-400 mb-6">
                    Saat ini belum ada artikel lain dalam kategori ini
                </p>
                <a href="/posts" class="inline-flex items-center px-6 py-3 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                    </svg>
                    Kembali ke Semua Artikel
                </a>
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
                        toast.className = 'fixed bottom-4 right-4 px-6 py-3 bg-primary-600 text-white rounded-lg shadow-xl z-50 font-medium';
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

    {{-- Reading Progress & Scroll to Top Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const progressBar = document.getElementById('reading-progress-bar');
            const scrollToTopBtn = document.getElementById('scroll-to-top');
            const article = document.querySelector('article');

            // Update reading progress on scroll
            function updateReadingProgress() {
                const windowHeight = window.innerHeight;
                const documentHeight = document.documentElement.scrollHeight;
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const scrollPercentage = (scrollTop / (documentHeight - windowHeight)) * 100;

                // Cap at 100%
                const progress = Math.min(scrollPercentage, 100);
                progressBar.style.width = progress + '%';
            }

            // Show/hide scroll to top button
            function toggleScrollButton() {
                if (window.pageYOffset > 500) {
                    scrollToTopBtn.classList.remove('opacity-0', 'invisible');
                    scrollToTopBtn.classList.add('opacity-100', 'visible');
                } else {
                    scrollToTopBtn.classList.add('opacity-0', 'invisible');
                    scrollToTopBtn.classList.remove('opacity-100', 'visible');
                }
            }

            // Scroll to top with smooth animation
            scrollToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Listen to scroll events
            let ticking = false;
            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        updateReadingProgress();
                        toggleScrollButton();
                        ticking = false;
                    });
                    ticking = true;
                }
            });

            // Initial update
            updateReadingProgress();
            toggleScrollButton();
        });
    </script>
    @endpush
</x-layout>
