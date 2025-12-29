<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="py-16 bg-cream-50 dark:bg-charcoal-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="font-display text-4xl font-bold text-charcoal-900 dark:text-white mb-2">
                    📚 My Favorites
                </h1>
                <p class="text-charcoal-600 dark:text-charcoal-300">
                    Artikel yang Anda simpan ({{ $posts->total() }} artikel)
                </p>
            </div>

            @if($posts->count() > 0)
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($posts as $post)
                        <x-post-card :post="$post" />
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if($posts->hasPages())
                    <div class="mt-12">
                        {{ $posts->links() }}
                    </div>
                @endif
            @else
                {{-- Empty State --}}
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-charcoal-300 dark:text-charcoal-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                    <h3 class="font-display text-2xl font-bold text-charcoal-900 dark:text-white mb-2">
                        Belum Ada Favorit
                    </h3>
                    <p class="text-charcoal-600 dark:text-charcoal-400 mb-6 max-w-md mx-auto">
                        Anda belum menyimpan artikel apapun. Click icon bookmark (📑) pada artikel untuk menyimpannya.
                    </p>
                    <a href="/posts" class="inline-flex items-center px-6 py-3 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Jelajahi Artikel
                    </a>
                </div>
            @endif
        </div>
    </section>
</x-layout>
