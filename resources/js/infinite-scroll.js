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
        article.className = 'group relative p-6 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden';
        article.setAttribute('data-aos', 'fade-up');
        article.setAttribute('data-aos-delay', (index % 6) * 50);

        article.innerHTML = `
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-purple-500/5 to-pink-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
            
            ${post.image ? `
                <div class="relative mb-4 -mx-6 -mt-6 overflow-hidden rounded-t-2xl">
                    <img 
                        src="${post.image_url}" 
                        alt="${escapeHtml(post.title)}"
                        loading="lazy"
                        class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-700"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
            ` : ''}

            <div class="flex justify-between items-center mb-4 text-gray-500 relative z-10">
                <a href="/posts?category=${post.category_slug}" class="group/cat">
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-${post.category_color}-100 dark:bg-${post.category_color}-900 text-${post.category_color}-800 dark:text-${post.category_color}-200 shadow-sm hover:shadow-md transition-all duration-300 transform group-hover/cat:scale-110">
                        ${escapeHtml(post.category_name)}
                    </span>
                </a>
                <span class="text-sm text-gray-500 dark:text-gray-400">${post.created_at_human}</span>
            </div>

            <a href="/posts/${post.slug}" class="relative z-10">
                <h2 class="mb-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:via-purple-600 group-hover:to-pink-600 transition-all duration-300">
                    ${escapeHtml(post.title)}
                </h2>
            </a>

            <p class="mb-5 font-light text-gray-600 dark:text-gray-400 line-clamp-3 relative z-10">
                ${escapeHtml(post.excerpt)}
            </p>

            <div class="flex justify-between items-center relative z-10">
                <a href="/posts?author=${post.author_username}" class="group/author">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-semibold text-sm transform group-hover/author:scale-110 transition-transform duration-300 shadow-md">
                            ${post.author_initials}
                        </div>
                        <span class="font-medium text-sm dark:text-white group-hover/author:text-primary-600 dark:group-hover/author:text-primary-400 transition-colors">
                            ${escapeHtml(post.author_name)}
                        </span>
                    </div>
                </a>

                <div class="flex items-center gap-2">
                    <a href="/posts/${post.slug}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                        Read
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    ${post.can_update ? `
                        <a href="/posts/${post.slug}/edit" class="inline-flex items-center text-sm px-3 py-1.5 rounded-lg bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 hover:bg-yellow-200 dark:hover:bg-yellow-800 transition-colors duration-300">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                    ` : ''}
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
