// Infinite Scroll Implementation
export function initInfiniteScroll() {
    const postsContainer = document.getElementById('posts-container');
    const loadingIndicator = document.getElementById('loading-indicator');
    const endMessage = document.getElementById('end-message');

    if (!postsContainer) return;

    let currentPage = 1;
    let isLoading = false;
    let hasMorePages = true;
    let observer;

    // Get current URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const searchQuery = urlParams.get('search') || '';
    const categorySlug = urlParams.get('category') || '';
    const authorUsername = urlParams.get('author') || '';

    // Create intersection observer for the sentinel element
    const sentinel = document.createElement('div');
    sentinel.id = 'scroll-sentinel';
    sentinel.className = 'h-20';
    postsContainer.parentElement.appendChild(sentinel);

    // Fallback button for manual load (helps when IntersectionObserver fails or errors occur)
    const loadMoreBtn = document.createElement('button');
    loadMoreBtn.type = 'button';
    loadMoreBtn.id = 'load-more-btn';
    loadMoreBtn.className = 'hidden mt-6 px-4 py-2 rounded-lg bg-primary-600 text-white font-semibold hover:bg-primary-700 transition-colors';
    loadMoreBtn.textContent = 'Muat lagi';
    postsContainer.parentElement.appendChild(loadMoreBtn);

    const errorMessage = document.createElement('div');
    errorMessage.id = 'load-more-error';
    errorMessage.className = 'hidden mt-3 text-sm text-red-600 dark:text-red-400';
    errorMessage.textContent = 'Gagal memuat. Coba lagi.';
    postsContainer.parentElement.appendChild(errorMessage);

    loadMoreBtn.addEventListener('click', () => {
        errorMessage.classList.add('hidden');
        loadMoreBtn.disabled = true;
        loadMorePosts().finally(() => {
            loadMoreBtn.disabled = false;
        });
    });

    observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !isLoading && hasMorePages) {
                    loadMorePosts();
                }
            });
        },
        {
            rootMargin: '100px',
            threshold: 0.1
        }
    );

    observer.observe(sentinel);

    async function loadMorePosts() {
        if (isLoading || !hasMorePages) return;

        isLoading = true;
        loadingIndicator?.classList.remove('hidden');

        try {
            currentPage++;

            // Build URL with filters
            let url = `/posts/load-more?page=${currentPage}`;
            if (searchQuery) url += `&search=${encodeURIComponent(searchQuery)}`;
            if (categorySlug) url += `&category=${encodeURIComponent(categorySlug)}`;
            if (authorUsername) url += `&author=${encodeURIComponent(authorUsername)}`;

            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Network response was not ok');

            const data = await response.json();

            if (data.posts && data.posts.length > 0) {
                // Append HTML directly from server
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = data.html;

                while (tempDiv.firstChild) {
                    postsContainer.appendChild(tempDiv.firstChild);
                }

                // Re-initialize AOS for new elements
                if (typeof AOS !== 'undefined') {
                    AOS.refresh();
                }

                hasMorePages = data.hasMore;
            } else {
                hasMorePages = false;
            }

            if (!hasMorePages) {
                observer.disconnect();
                loadingIndicator?.classList.add('hidden');
                loadMoreBtn.classList.add('hidden');
                endMessage?.classList.remove('hidden');
            } else {
                // Hide fallback button when auto-load works
                loadMoreBtn.classList.add('hidden');
            }

        } catch (error) {
            console.error('Error loading more posts:', error);
            hasMorePages = true; // allow retry
            loadMoreBtn.classList.remove('hidden');
            errorMessage.classList.remove('hidden');
            observer.disconnect();
        } finally {
            isLoading = false;
            loadingIndicator?.classList.add('hidden');
        }
    }
}

// Initialize on page load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initInfiniteScroll);
} else {
    initInfiniteScroll();
}
