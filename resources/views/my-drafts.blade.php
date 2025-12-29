<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="min-h-screen bg-cream-50 dark:bg-charcoal-950 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="mb-8">
                <h1 class="font-display text-4xl font-bold text-charcoal-900 dark:text-white mb-2">
                    My Drafts & Scheduled Posts
                </h1>
                <p class="text-charcoal-600 dark:text-charcoal-400">
                    Manage your unpublished content
                </p>
            </div>

            {{-- Draft Posts --}}
            <section class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-charcoal-900 dark:text-white">
                        📝 Drafts ({{ $drafts->total() }})
                    </h2>
                </div>

                @if($drafts->count() > 0)
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($drafts as $draft)
                            <article class="bg-white dark:bg-charcoal-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-charcoal-200 dark:border-charcoal-700">
                                <div class="p-6">
                                    <div class="flex items-start justify-between mb-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                            Draft
                                        </span>
                                        <span class="text-xs text-charcoal-500 dark:text-charcoal-400">
                                            {{ $draft->updated_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    <h3 class="text-xl font-bold text-charcoal-900 dark:text-white mb-3 leading-tight line-clamp-2">
                                        {{ $draft->title }}
                                    </h3>

                                    <p class="text-charcoal-600 dark:text-charcoal-300 mb-4 leading-relaxed line-clamp-3 text-sm">
                                        {{ Str::limit($draft->body, 120) }}
                                    </p>

                                    <div class="flex items-center gap-2 mb-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border border-primary-200 dark:border-primary-800 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300">
                                            {{ $draft->category->name }}
                                        </span>
                                        @if($draft->tags && $draft->tags->count() > 0)
                                            <span class="text-xs text-charcoal-500 dark:text-charcoal-400">
                                                +{{ $draft->tags->count() }} tags
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2 pt-4 border-t border-charcoal-200 dark:border-charcoal-700">
                                        <a href="/posts/{{ $draft->slug }}"
                                           class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg bg-charcoal-100 dark:bg-charcoal-700 text-charcoal-700 dark:text-charcoal-200 hover:bg-charcoal-200 dark:hover:bg-charcoal-600 font-medium text-sm transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Preview
                                        </a>
                                        <a href="{{ route('articles.edit', $draft->slug) }}"
                                           class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-medium text-sm shadow-md hover:shadow-lg transition-all">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-8">
                        {{ $drafts->links() }}
                    </div>
                @else
                    <div class="bg-white dark:bg-charcoal-800 rounded-lg p-12 text-center border border-charcoal-200 dark:border-charcoal-700">
                        <svg class="w-16 h-16 mx-auto text-charcoal-300 dark:text-charcoal-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-xl font-bold text-charcoal-900 dark:text-white mb-2">No Drafts Yet</h3>
                        <p class="text-charcoal-600 dark:text-charcoal-400 mb-6">Start writing and save as draft</p>
                        <a href="/" class="inline-flex items-center px-6 py-3 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-semibold shadow-md hover:shadow-lg transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create New Post
                        </a>
                    </div>
                @endif
            </section>

            {{-- Scheduled Posts --}}
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-charcoal-900 dark:text-white">
                        📅 Scheduled ({{ $scheduled->total() }})
                    </h2>
                </div>

                @if($scheduled->count() > 0)
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($scheduled as $post)
                            <article class="bg-white dark:bg-charcoal-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-charcoal-200 dark:border-charcoal-700">
                                <div class="p-6">
                                    <div class="flex items-start justify-between mb-3">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">
                                            Scheduled
                                        </span>
                                    </div>

                                    <div class="mb-3 p-3 rounded-lg bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-800">
                                        <div class="flex items-center text-sm text-blue-700 dark:text-blue-400">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="font-semibold">{{ $post->published_at->format('M d, Y g:i A') }}</span>
                                        </div>
                                        <div class="text-xs text-blue-600 dark:text-blue-500 mt-1 ml-6">
                                            {{ $post->published_at->diffForHumans() }}
                                        </div>
                                    </div>

                                    <h3 class="text-xl font-bold text-charcoal-900 dark:text-white mb-3 leading-tight line-clamp-2">
                                        {{ $post->title }}
                                    </h3>

                                    <p class="text-charcoal-600 dark:text-charcoal-300 mb-4 leading-relaxed line-clamp-3 text-sm">
                                        {{ Str::limit($post->body, 120) }}
                                    </p>

                                    <div class="flex items-center gap-2 mb-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border border-primary-200 dark:border-primary-800 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300">
                                            {{ $post->category->name }}
                                        </span>
                                        @if($post->tags && $post->tags->count() > 0)
                                            <span class="text-xs text-charcoal-500 dark:text-charcoal-400">
                                                +{{ $post->tags->count() }} tags
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2 pt-4 border-t border-charcoal-200 dark:border-charcoal-700">
                                        <a href="/posts/{{ $post->slug }}"
                                           class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg bg-charcoal-100 dark:bg-charcoal-700 text-charcoal-700 dark:text-charcoal-200 hover:bg-charcoal-200 dark:hover:bg-charcoal-600 font-medium text-sm transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Preview
                                        </a>
                                        <a href="{{ route('articles.edit', $post->slug) }}"
                                           class="flex-1 inline-flex items-center justify-center px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-medium text-sm shadow-md hover:shadow-lg transition-all">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-8">
                        {{ $scheduled->links() }}
                    </div>
                @else
                    <div class="bg-white dark:bg-charcoal-800 rounded-lg p-12 text-center border border-charcoal-200 dark:border-charcoal-700">
                        <svg class="w-16 h-16 mx-auto text-charcoal-300 dark:text-charcoal-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-xl font-bold text-charcoal-900 dark:text-white mb-2">No Scheduled Posts</h3>
                        <p class="text-charcoal-600 dark:text-charcoal-400">Schedule your posts for future publishing</p>
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-layout>
