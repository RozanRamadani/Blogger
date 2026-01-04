@props(['selectedTags' => []])

<div x-data="tagInput({{ json_encode($selectedTags) }})" class="space-y-3">
    {{-- Selected Tags Display --}}
    <div x-show="selectedTags.length > 0" class="flex flex-wrap gap-2">
        <template x-for="(tag, index) in selectedTags" :key="tag.id || tag.name">
            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 rounded-full text-sm font-medium border border-primary-200 dark:border-primary-800 animate-fadeIn">
                <span class="text-base">#</span>
                <span x-text="tag.name"></span>
                <button type="button" @click="removeTag(index)"
                        class="ml-1 hover:bg-primary-200 dark:hover:bg-primary-800 rounded-full p-0.5 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </template>
    </div>

    {{-- Tag Input Field --}}
    <div class="relative">
        <div class="relative">
            <input type="text"
                   x-model="searchQuery"
                   @input="searchTags"
                   @keydown.enter.prevent="addTagFromInput"
                   @keydown.comma.prevent="addTagFromInput"
                   @focus="showSuggestions = true"
                   placeholder="Ketik tag dan tekan Enter... (max 10 tags)"
                   :disabled="selectedTags.length >= 10"
                   class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white placeholder-charcoal-400 dark:placeholder-charcoal-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-charcoal-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
        </div>

        {{-- Tag Suggestions Dropdown --}}
        <div x-show="showSuggestions && (suggestions.length > 0 || searchQuery.length > 0)"
             x-transition
             @click.away="showSuggestions = false"
             class="absolute z-50 w-full mt-2 bg-white dark:bg-charcoal-800 rounded-lg shadow-xl border border-charcoal-200 dark:border-charcoal-700 max-h-64 overflow-y-auto">

            {{-- Create New Tag Option --}}
            <div x-show="searchQuery.length > 0 && !suggestions.find(s => s.name.toLowerCase() === searchQuery.toLowerCase())"
                 @click="createNewTag"
                 class="px-4 py-3 hover:bg-primary-50 dark:hover:bg-primary-900/20 cursor-pointer border-b border-charcoal-100 dark:border-charcoal-700 transition-colors">
                <div class="flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="text-charcoal-600 dark:text-charcoal-300">Buat tag baru:</span>
                    <span class="font-semibold text-primary-600 dark:text-primary-400">#<span x-text="searchQuery"></span></span>
                </div>
            </div>

            {{-- Existing Tags --}}
            <template x-for="tag in suggestions" :key="tag.id">
                <div @click="addTag(tag)"
                     class="px-4 py-3 hover:bg-primary-50 dark:hover:bg-primary-900/20 cursor-pointer border-b border-charcoal-100 dark:border-charcoal-700 last:border-0 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="text-primary-600 dark:text-primary-400 font-medium">#</span>
                            <span class="text-sm font-medium text-charcoal-900 dark:text-white" x-text="tag.name"></span>
                        </div>
                        <span class="text-xs text-charcoal-500 dark:text-charcoal-400" x-text="tag.posts_count + ' posts'"></span>
                    </div>
                </div>
            </template>

            {{-- No Results --}}
            <div x-show="suggestions.length === 0 && searchQuery.length === 0" class="px-4 py-6 text-center">
                <svg class="w-10 h-10 mx-auto text-charcoal-300 dark:text-charcoal-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <p class="text-sm text-charcoal-500 dark:text-charcoal-400">Ketik untuk mencari atau buat tag baru</p>
            </div>
        </div>
    </div>

    {{-- Helper Text --}}
    <p class="text-xs text-charcoal-500 dark:text-charcoal-400">
        <span x-text="selectedTags.length"></span>/10 tags •
        Tekan <kbd class="px-1.5 py-0.5 bg-charcoal-100 dark:bg-charcoal-800 rounded text-xs">Enter</kbd> atau <kbd class="px-1.5 py-0.5 bg-charcoal-100 dark:bg-charcoal-800 rounded text-xs">,</kbd> untuk menambah tag
    </p>

    {{-- Hidden Inputs for Form Submission --}}
    <template x-for="(tag, index) in selectedTags" :key="tag.id || tag.name">
        <input type="hidden" name="tags[]" :value="tag.id || tag.name">
    </template>
</div>

@push('scripts')
<script>
function tagInput(initialTags = []) {
    return {
        selectedTags: initialTags,
        searchQuery: '',
        suggestions: [],
        showSuggestions: false,
        searchTimeout: null,

        async searchTags() {
            if (this.searchQuery.length < 1) {
                this.suggestions = [];
                return;
            }

            // Clear previous timeout
            if (this.searchTimeout) {
                clearTimeout(this.searchTimeout);
            }

            // Debounce search
            this.searchTimeout = setTimeout(async () => {
                try {
                    const response = await fetch(`/api/tags/search?q=${encodeURIComponent(this.searchQuery)}`);
                    const data = await response.json();

                    // Filter out already selected tags
                    this.suggestions = data.filter(tag =>
                        !this.selectedTags.some(selected => selected.id === tag.id)
                    );

                    this.showSuggestions = true;
                } catch (error) {
                    console.error('Tag search error:', error);
                }
            }, 300);
        },

        addTag(tag) {
            if (this.selectedTags.length >= 10) {
                alert('Maksimal 10 tags per artikel');
                return;
            }

            if (!this.selectedTags.some(t => t.id === tag.id)) {
                this.selectedTags.push(tag);
                this.searchQuery = '';
                this.suggestions = [];
                this.showSuggestions = false;
            }
        },

        createNewTag() {
            if (this.selectedTags.length >= 10) {
                alert('Maksimal 10 tags per artikel');
                return;
            }

            const tagName = this.searchQuery.trim().toLowerCase();

            if (tagName.length === 0) return;

            // Check if tag already exists in selected tags
            if (this.selectedTags.some(t => t.name.toLowerCase() === tagName)) {
                alert('Tag sudah ditambahkan');
                return;
            }

            // Add as new tag (will be created on server)
            this.selectedTags.push({
                id: null,
                name: tagName,
                slug: tagName.replace(/\s+/g, '-')
            });

            this.searchQuery = '';
            this.suggestions = [];
            this.showSuggestions = false;
        },

        addTagFromInput() {
            if (this.searchQuery.trim().length === 0) return;

            // Check if exact match in suggestions
            const exactMatch = this.suggestions.find(
                tag => tag.name.toLowerCase() === this.searchQuery.toLowerCase()
            );

            if (exactMatch) {
                this.addTag(exactMatch);
            } else {
                this.createNewTag();
            }
        },

        removeTag(index) {
            this.selectedTags.splice(index, 1);
        }
    }
}
</script>
@endpush

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
}

.animate-fadeIn {
    animation: fadeIn 0.2s ease-out;
}

kbd {
    font-family: monospace;
    font-size: 0.75rem;
}
</style>
