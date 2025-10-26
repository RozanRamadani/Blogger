// Infinite Scroll Implementation
export function initInfiniteScroll() {
    const postsContainer = document.getElementById('posts-container');
    const loadingIndicator = document.getElementById('loading-indicator');
    const endMessage = document.getElementById('end-message');
    
    if (!postsContainer) return;

    let currentPage = 1;
    let isLoading = false;
    let hasMorePages = true;

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

    const observer = new IntersectionObserver(
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
                // Add posts to container
                data.posts.forEach((post, index) => {
                    const postElement = createPostElement(post, (currentPage - 1) * 6 + index);
                    postsContainer.appendChild(postElement);
                });

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
                endMessage?.classList.remove('hidden');
            }

        } catch (error) {
            console.error('Error loading more posts:', error);
            hasMorePages = false;
        } finally {
            isLoading = false;
            loadingIndicator?.classList.add('hidden');
        }
    }

    function createPostElement(post, index) {
        const article = document.createElement('article');
        article.className = 'group bg-white dark:bg-charcoal-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-charcoal-100 dark:border-charcoal-700';
        article.setAttribute('data-aos', 'fade-up');
        article.setAttribute('data-aos-delay', (index % 6) * 50);

        article.innerHTML = `
            ${post.image ? `
                <a href="/posts/${post.slug}" class="block overflow-hidden">
                    <img 
                        src="${post.image_url}" 
                        alt="${escapeHtml(post.title)}"
                        loading="lazy"
                        class="w-full h-64 object-cover transform group-hover:scale-110 transition-transform duration-700"
                    >
                </a>
            ` : ''}

            <div class="p-8">
                <div class="flex items-center justify-between mb-4">
                    <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-terracotta-100 dark:bg-terracotta-900/40 text-terracotta-800 dark:text-terracotta-300 border border-terracotta-200 dark:border-terracotta-800">
                        ${escapeHtml(post.category_name)}
                    </span>
                    <span class="text-sm text-charcoal-500 dark:text-cream-400 font-medium">${post.created_at_human}</span>
                </div>

                <a href="/posts/${post.slug}">
                    <h3 class="font-display text-2xl font-bold text-charcoal-900 dark:text-cream-50 mb-4 leading-tight group-hover:text-terracotta-600 dark:group-hover:text-terracotta-400 transition-colors line-clamp-2">
                        ${escapeHtml(post.title)}
                    </h3>
                </a>

                <p class="text-charcoal-600 dark:text-cream-300 mb-6 leading-relaxed line-clamp-3">
                    ${escapeHtml(post.excerpt)}
                </p>

                <div class="flex items-center justify-between pt-6 border-t border-charcoal-100 dark:border-charcoal-700">
                    <a href="/posts?author=${post.author_username}" class="flex items-center space-x-3 group/author">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-terracotta-500 to-olive-600 flex items-center justify-center text-cream-50 text-sm font-semibold shadow-md">
                            ${post.author_initials}
                        </div>
                        <span class="text-sm font-semibold text-charcoal-700 dark:text-cream-200 group-hover/author:text-terracotta-600 dark:group-hover/author:text-terracotta-400 transition-colors">
                            ${escapeHtml(post.author_name)}
                        </span>
                    </a>

                    <div class="flex items-center gap-2">
                        <a href="/posts/${post.slug}" 
                           class="inline-flex items-center text-sm font-semibold text-terracotta-600 dark:text-terracotta-400 hover:text-terracotta-700 dark:hover:text-terracotta-300 transition-colors">
                            Read more
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                        ${post.can_update ? `
                            <a href="/posts/${post.slug}/edit" 
                               class="p-2 text-charcoal-500 dark:text-cream-400 hover:text-terracotta-600 dark:hover:text-terracotta-400 hover:bg-cream-100 dark:hover:bg-charcoal-700 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                        ` : ''}
                    </div>
                </div>
            </div>
        `;

        return article;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Initialize on page load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initInfiniteScroll);
} else {
    initInfiniteScroll();
}
