<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Schema.org Structured Data for Article and Breadcrumb (encoded to avoid Blade directive collisions) --}}
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
            'commentCount' => 0,
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

    {{-- <article class="py-5 max-w-screen-md">
        <h2 class="mb-1 text-3xl tracking-tight font-bold text-gray-800">{{ $post['title'] }}</h2>
        <div>
            By
            <a href="/author/{{ $post->author->username }}" 
                class="hover:underline text-base text-gray-500">{{ $post->author->name }}</a>
            in
            <a href="/categories/{{ $post->category->slug }}" 
                class="hover:underline text-base text-gray-500">{{ $post->category->name }}</a>
                |
            {{ $post->created_at->diffForHumans() }}
        </div>
        <p class="my-4 font-light">{{ $post['body'] }}</p>
        <a href="/posts" class="font-medium text-blue-600 hover:underline">&laquo; Back to Article</a>
    </article> --}}

    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl">
            <article
                class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-8 lg:mb-10 not-format">
                    <a href="/posts" class="inline-flex items-center text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline mb-4 group">
                        <svg class="w-4 h-4 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Back to all posts
                    </a>
                    @can('update', $post)
                        <a href="{{ route('articles.edit', $post->slug) }}" class="ml-4 inline-flex items-center text-sm px-3 py-1.5 rounded-lg bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 hover:bg-yellow-200 dark:hover:bg-yellow-800 transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Post
                        </a>
                    @endcan

                    {{-- Featured Image --}}
                    @if($post->image)
                        <div class="my-8 rounded-2xl overflow-hidden shadow-2xl">
                            <img 
                                src="{{ asset('storage/' . $post->image) }}" 
                                alt="{{ $post->title }}"
                                class="w-full h-auto object-cover"
                            >
                        </div>
                    @endif

                    <h1 class="mb-6 text-4xl font-extrabold leading-tight text-gray-900 lg:mb-8 lg:text-5xl dark:text-white bg-clip-text">
                        {{ $post->title }}
                    </h1>

                    {{-- Author & Meta Info --}}
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-bold text-2xl shadow-lg mr-4">
                                {{ strtoupper(substr($post->author->name, 0, 2)) }}
                            </div>
                            <div>
                                <a href="/posts?author={{ $post->author->username }}" rel="author"
                                    class="text-xl font-bold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    {{ $post->author->name }}
                                </a>
                                <div class="flex items-center gap-3 mt-2 text-sm text-gray-600 dark:text-gray-400">
                                    <a href="/posts?category={{ $post->category->slug }}" class="group">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-{{ $post->category->color }}-100 dark:bg-{{ $post->category->color }}-900 text-{{ $post->category->color }}-800 dark:text-{{ $post->category->color }}-200 shadow-sm group-hover:shadow-md transition-all">
                                            {{ $post->category->name }}
                                        </span>
                                    </a>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $post->created_at->format('M d, Y') }}
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        5 min read
                                    </span>
                                </div>
                            </div>
                        </div>
                    </address>

                    {{-- Social Share Buttons --}}
                    <div class="flex items-center gap-3 py-4 border-y border-gray-200 dark:border-gray-700">
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Share:</span>
                        <div class="flex gap-2" x-data="shareButtons">
                            <button @click="shareTwitter" class="p-2 rounded-lg bg-[#1DA1F2] hover:bg-[#1a8cd8] text-white transition-all transform hover:scale-110 shadow-md">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </button>
                            <button @click="shareFacebook" class="p-2 rounded-lg bg-[#4267B2] hover:bg-[#365899] text-white transition-all transform hover:scale-110 shadow-md">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </button>
                            <button @click="shareLinkedIn" class="p-2 rounded-lg bg-[#0077b5] hover:bg-[#006396] text-white transition-all transform hover:scale-110 shadow-md">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </button>
                            <button @click="shareWhatsApp" class="p-2 rounded-lg bg-[#25D366] hover:bg-[#20bd5a] text-white transition-all transform hover:scale-110 shadow-md">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </button>
                            <button @click="copyLink" class="p-2 rounded-lg bg-gray-600 hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 text-white transition-all transform hover:scale-110 shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </header>

                {{-- Article Content --}}
                <div class="prose prose-lg dark:prose-invert max-w-none">
                    <p class="lead text-xl text-gray-700 dark:text-gray-300 leading-relaxed">{{ $post['body'] }}</p>
                </div>

                {{-- Tags Section (if you have tags) --}}
                <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-wrap gap-2">
                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Tags:</span>
                        <a href="#" class="px-3 py-1 text-sm rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">#Laravel</a>
                        <a href="#" class="px-3 py-1 text-sm rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">#WebDev</a>
                        <a href="#" class="px-3 py-1 text-sm rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">#PHP</a>
                    </div>
                </div>

                {{-- Related Posts Section --}}
                @if($relatedPosts->count() > 0)
                <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Related Articles
                    </h3>
                    <div class="grid gap-6 md:grid-cols-3">
                        @foreach($relatedPosts as $relatedPost)
                        <article class="group p-4 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            @if($relatedPost->image)
                                <div class="mb-3 overflow-hidden rounded-lg">
                                    <img 
                                        src="{{ asset('storage/' . $relatedPost->image) }}" 
                                        alt="{{ $relatedPost->title }}"
                                        loading="lazy"
                                        class="w-full h-32 object-cover transform group-hover:scale-110 transition-transform duration-500"
                                    >
                                </div>
                            @endif
                            <a href="/posts?category={{ $relatedPost->category->slug }}">
                                <span class="px-2 py-1 text-xs font-bold rounded-full bg-{{ $relatedPost->category->color }}-100 dark:bg-{{ $relatedPost->category->color }}-900 text-{{ $relatedPost->category->color }}-800 dark:text-{{ $relatedPost->category->color }}-200">
                                    {{ $relatedPost->category->name }}
                                </span>
                            </a>
                            <a href="/posts/{{ $relatedPost->slug }}">
                                <h4 class="mt-3 font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">
                                    {{ $relatedPost->title }}
                                </h4>
                            </a>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                {{ Str::limit($relatedPost->body, 80) }}
                            </p>
                            <div class="mt-3 flex items-center text-xs text-gray-500 dark:text-gray-400">
                                <span>{{ $relatedPost->author->name }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $relatedPost->created_at->diffForHumans() }}</span>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Giscus Comments Section --}}
                <x-giscus-comments />
            </article>
        </div>
    </main>

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
                
                shareFacebook() {
                    const url = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(this.pageUrl)}`;
                    window.open(url, '_blank', 'width=600,height=400');
                },
                
                shareLinkedIn() {
                    const url = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(this.pageUrl)}`;
                    window.open(url, '_blank', 'width=600,height=400');
                },
                
                shareWhatsApp() {
                    const url = `https://wa.me/?text=${encodeURIComponent(this.pageTitle + ' ' + this.pageUrl)}`;
                    window.open(url, '_blank');
                },
                
                async copyLink() {
                    try {
                        await navigator.clipboard.writeText(this.pageUrl);
                        // Show toast notification
                        const toast = document.createElement('div');
                        toast.className = 'fixed bottom-4 right-4 px-6 py-3 bg-green-500 text-white rounded-lg shadow-lg z-50 animate-slide-up';
                        toast.textContent = '✓ Link copied to clipboard!';
                        document.body.appendChild(toast);
                        setTimeout(() => toast.remove(), 3000);
                    } catch (err) {
                        alert('Failed to copy link');
                    }
                }
            }));
        });
    </script>
    @endpush
</x-layout>
