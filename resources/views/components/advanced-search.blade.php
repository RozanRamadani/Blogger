@props(['categories', 'tags', 'authors'])

<div class="bg-white dark:bg-charcoal-800 rounded-xl shadow-lg border border-charcoal-200 dark:border-charcoal-700 p-6 mb-8" x-data="searchComponent()">
    {{-- Search Input with Live Autocomplete --}}
    <div class="relative mb-6">
        <div class="relative">
            <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none">
                <svg class="w-5 h-5 text-charcoal-400 dark:text-charcoal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <input type="text"
                   x-model="searchQuery"
                   @focus="showSuggestions = true"
                   placeholder="Cari artikel... (minimal 2 karakter)"
                   class="w-full pl-12 pr-12 py-3.5 rounded-lg border-2 border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white placeholder-charcoal-400 dark:placeholder-charcoal-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all text-base">

            {{-- Loading Indicator --}}
            <div x-show="loading" class="absolute right-4 top-1/2 -translate-y-1/2">
                <svg class="animate-spin h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        </div>

        {{-- Search Suggestions Dropdown --}}
        <div x-show="showSuggestions && suggestions.length > 0 && searchQuery.length >= 2"
             x-transition
             @click.away="showSuggestions = false"
             class="absolute z-50 w-full mt-2 bg-white dark:bg-charcoal-800 rounded-lg shadow-xl border border-charcoal-200 dark:border-charcoal-700 max-h-96 overflow-y-auto">
            <template x-for="(post, index) in suggestions" :key="post.id">
                <a :href="'/posts/' + post.slug"
                   class="block px-4 py-3 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors border-b border-charcoal-100 dark:border-charcoal-700 last:border-0">
                    <div class="flex items-start gap-3">
                        <div x-show="post.image" class="flex-shrink-0">
                            <img :src="post.image" :alt="post.title" class="w-16 h-16 object-cover rounded">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-semibold text-charcoal-900 dark:text-white line-clamp-1" x-html="highlightText(post.title, searchQuery)"></h4>
                            <p class="text-xs text-charcoal-600 dark:text-charcoal-300 line-clamp-2 mt-1" x-html="highlightText(post.excerpt, searchQuery)"></p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-xs px-2 py-0.5 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300" x-text="post.category"></span>
                                <span class="text-xs text-charcoal-500 dark:text-charcoal-400" x-text="post.date"></span>
                            </div>
                        </div>
                    </div>
                </a>
            </template>

            <div x-show="searchQuery.length >= 2 && suggestions.length === 0 && !loading" class="px-4 py-8 text-center">
                <svg class="w-12 h-12 mx-auto text-charcoal-300 dark:text-charcoal-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm text-charcoal-500 dark:text-charcoal-400">No results found</p>
            </div>
        </div>
    </div>

    {{-- Advanced Filters --}}
    <div x-data="{ showFilters: false }" class="space-y-4">
        <button @click="showFilters = !showFilters"
                class="inline-flex items-center gap-2 text-sm font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors group">
            <svg class="w-5 h-5 transition-transform duration-200" :class="showFilters ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
            </svg>
            <span x-text="showFilters ? 'Sembunyikan Filter Lanjutan' : 'Tampilkan Filter Lanjutan'"></span>
            <svg class="w-4 h-4 transition-transform duration-200" :class="showFilters ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="showFilters"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-cream-50 dark:bg-charcoal-900/50 rounded-lg border border-charcoal-200 dark:border-charcoal-700">

            {{-- Category Filter --}}
            <div>
                <label class="block text-sm font-semibold text-charcoal-700 dark:text-charcoal-300 mb-2">
                    📁 Kategori
                </label>
                <select x-model="selectedCategory" @change="applyFilters"
                        class="w-full px-4 py-2.5 rounded-lg border-2 border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tag Filter --}}
            <div>
                <label class="block text-sm font-semibold text-charcoal-700 dark:text-charcoal-300 mb-2">
                    🏷️ Tag
                </label>
                <select x-model="selectedTag" @change="applyFilters"
                        class="w-full px-4 py-2.5 rounded-lg border-2 border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">
                    <option value="">Semua Tag</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->slug }}" {{ request('tag') == $tag->slug ? 'selected' : '' }}>
                            #{{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Author Filter --}}
            <div>
                <label class="block text-sm font-semibold text-charcoal-700 dark:text-charcoal-300 mb-2">
                    ✍️ Penulis
                </label>
                <select x-model="selectedAuthor" @change="applyFilters"
                        class="w-full px-4 py-2.5 rounded-lg border-2 border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">
                    <option value="">Semua Penulis</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->username }}" {{ request('author') == $author->username ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Clear Filters --}}
            <div class="md:col-span-3 flex flex-wrap justify-end gap-3 pt-2">
                <button @click="clearFilters"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg border-2 border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-700 dark:text-charcoal-300 hover:bg-charcoal-50 dark:hover:bg-charcoal-800 text-sm font-semibold transition-all hover:border-charcoal-400 dark:hover:border-charcoal-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Hapus Semua Filter
                </button>
                <button @click="applyFilters"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white text-sm font-semibold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Terapkan Filter
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('searchComponent', () => ({
        searchQuery: '{{ request("search") }}',
        selectedCategory: '{{ request("category") }}',
        selectedTag: '{{ request("tag") }}',
        selectedAuthor: '{{ request("author") }}',
        suggestions: [],
        showSuggestions: false,
        loading: false,
        searchTimeout: null,

        init() {
            console.log('Search component initialized');
            // Watch for input changes
            this.$watch('searchQuery', (value) => {
                console.log('Search query changed:', value);
                this.handleSearchInput();
            });
        },

        handleSearchInput() {
            // Clear previous timeout
            if (this.searchTimeout) {
                clearTimeout(this.searchTimeout);
            }

            // Reset suggestions if query too short
            if (this.searchQuery.length < 2) {
                this.suggestions = [];
                this.showSuggestions = false;
                return;
            }

            // Debounce search
            this.searchTimeout = setTimeout(() => {
                this.searchPosts();
            }, 300);
        },

        async searchPosts() {
            console.log('Searching for:', this.searchQuery);

            if (this.searchQuery.length < 2) {
                this.suggestions = [];
                this.showSuggestions = false;
                return;
            }

            this.loading = true;

            try {
                const response = await fetch(`/api/search-posts?q=${encodeURIComponent(this.searchQuery)}`);

                if (!response.ok) {
                    throw new Error('Search failed');
                }

                const data = await response.json();
                console.log('Search results:', data);

                this.suggestions = data;
                this.showSuggestions = true;
            } catch (error) {
                console.error('Search error:', error);
                this.suggestions = [];
            } finally {
                this.loading = false;
            }
        },

        highlightText(text, query) {
            if (!query || !text) return text;
            const regex = new RegExp(`(${this.escapeRegex(query)})`, 'gi');
            return text.replace(regex, '<mark class="bg-yellow-200 dark:bg-yellow-900/50 text-charcoal-900 dark:text-white px-0.5 rounded">$1</mark>');
        },

        escapeRegex(str) {
            return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        },

        applyFilters() {
            const params = new URLSearchParams();
            if (this.searchQuery) params.set('search', this.searchQuery);
            if (this.selectedCategory) params.set('category', this.selectedCategory);
            if (this.selectedTag) params.set('tag', this.selectedTag);
            if (this.selectedAuthor) params.set('author', this.selectedAuthor);

            window.location.href = '/posts?' + params.toString();
        },

        clearFilters() {
            this.searchQuery = '';
            this.selectedCategory = '';
            this.selectedTag = '';
            this.selectedAuthor = '';
            window.location.href = '/posts';
        }
    }))
});
</script>
@endpush
