// Live Search with Debounce
export function initLiveSearch() {
    const searchInput = document.getElementById('live-search');
    const searchResults = document.getElementById('search-results');
    
    if (!searchInput) return;

    let debounceTimer;
    
    searchInput.addEventListener('input', (e) => {
        clearTimeout(debounceTimer);
        const query = e.target.value.trim();
        
        if (query.length < 2) {
            searchResults.classList.add('hidden');
            return;
        }
        
        debounceTimer = setTimeout(() => {
            performSearch(query);
        }, 300);
    });

    // Close results when clicking outside
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.add('hidden');
        }
    });
}

async function performSearch(query) {
    const searchResults = document.getElementById('search-results');
    searchResults.classList.remove('hidden');
    searchResults.innerHTML = '<div class="p-4 text-center text-gray-500"><svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><p class="mt-2">Searching...</p></div>';
    
    try {
        const response = await fetch(`/api/search?q=${encodeURIComponent(query)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        });
        
        if (!response.ok) {
            throw new Error('Search failed');
        }
        
        const data = await response.json();
        displaySearchResults(data);
    } catch (error) {
        searchResults.innerHTML = '<div class="p-4 text-center text-red-500">Search error. Please try again.</div>';
    }
}

function displaySearchResults(posts) {
    const searchResults = document.getElementById('search-results');
    
    if (posts.length === 0) {
        searchResults.innerHTML = '<div class="p-4 text-center text-gray-500 dark:text-gray-400">No results found</div>';
        return;
    }
    
    const resultsHTML = posts.map(post => `
        <a href="/posts/${post.slug}" class="block p-4 hover:bg-cream-50 dark:hover:bg-charcoal-700 transition-colors border-b border-charcoal-100 dark:border-charcoal-700 last:border-0">
            <h3 class="font-semibold text-charcoal-900 dark:text-cream-50 mb-1">${escapeHtml(post.title)}</h3>
            <p class="text-sm text-charcoal-600 dark:text-cream-300 line-clamp-2">${escapeHtml(post.excerpt || post.body).substring(0, 120)}...</p>
            <div class="flex items-center gap-2 mt-2 text-xs text-charcoal-500 dark:text-cream-400">
                <span class="px-2 py-0.5 rounded-full bg-terracotta-100 dark:bg-terracotta-900/40 text-terracotta-800 dark:text-terracotta-300 border border-terracotta-200 dark:border-terracotta-800">${post.category_name}</span>
                <span>•</span>
                <span>${post.author_name}</span>
            </div>
        </a>
    `).join('');
    
    searchResults.innerHTML = resultsHTML;
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}
