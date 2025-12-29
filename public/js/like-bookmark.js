// Like and Bookmark functionality
function toggleLike(postId, postSlug) {
    fetch(`/posts/${postSlug}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update all like buttons for this post (could be multiple on page)
            updateLikeButton(postId, data.liked, data.likes_count);
            updateLikeButton(`bottom-${postId}`, data.liked, data.likes_count);
        }
    })
    .catch(error => console.error('Error:', error));
}

function updateLikeButton(elementId, isLiked, count) {
    const likeBtn = document.getElementById(`like-btn-${elementId}`);
    if (!likeBtn) return;

    const likesCount = document.getElementById(`likes-count-${elementId}`);
    const svg = likeBtn.querySelector('svg');

    if (isLiked) {
        likeBtn.classList.remove('text-charcoal-500', 'dark:text-charcoal-400', 'hover:text-red-500', 'border-charcoal-300', 'dark:border-charcoal-600');
        likeBtn.classList.add('text-red-500', 'text-red-600', 'dark:text-red-400', 'border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
        svg.classList.add('fill-current');
        svg.setAttribute('fill', 'currentColor');
        likeBtn.setAttribute('title', 'Unlike');
    } else {
        likeBtn.classList.remove('text-red-500', 'text-red-600', 'dark:text-red-400', 'border-red-500', 'bg-red-50', 'dark:bg-red-900/20');
        likeBtn.classList.add('text-charcoal-500', 'dark:text-charcoal-400', 'hover:text-red-500', 'border-charcoal-300', 'dark:border-charcoal-600');
        svg.classList.remove('fill-current');
        svg.setAttribute('fill', 'none');
        likeBtn.setAttribute('title', 'Like');
    }

    if (likesCount) {
        likesCount.textContent = count;
    }
}

function toggleBookmark(postId, postSlug) {
    fetch(`/posts/${postSlug}/bookmark`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update all bookmark buttons for this post
            updateBookmarkButton(postId, data.bookmarked);
            updateBookmarkButton(`bottom-${postId}`, data.bookmarked);

            // Show toast notification
            if (data.bookmarked) {
                showToast('Artikel disimpan ke favorit!', 'success');
            } else {
                showToast('Artikel dihapus dari favorit', 'info');
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

function updateBookmarkButton(elementId, isBookmarked) {
    const bookmarkBtn = document.getElementById(`bookmark-btn-${elementId}`);
    if (!bookmarkBtn) return;

    const svg = bookmarkBtn.querySelector('svg');
    const textSpan = bookmarkBtn.querySelector('span');

    if (isBookmarked) {
        bookmarkBtn.classList.remove('text-charcoal-500', 'dark:text-charcoal-400', 'hover:text-yellow-500', 'border-charcoal-300', 'dark:border-charcoal-600');
        bookmarkBtn.classList.add('text-yellow-500', 'text-yellow-600', 'dark:text-yellow-400', 'border-yellow-500', 'bg-yellow-50', 'dark:bg-yellow-900/20');
        svg.classList.add('fill-current');
        svg.setAttribute('fill', 'currentColor');
        bookmarkBtn.setAttribute('title', 'Remove bookmark');
        if (textSpan) textSpan.textContent = 'Saved';
    } else {
        bookmarkBtn.classList.remove('text-yellow-500', 'text-yellow-600', 'dark:text-yellow-400', 'border-yellow-500', 'bg-yellow-50', 'dark:bg-yellow-900/20');
        bookmarkBtn.classList.add('text-charcoal-500', 'dark:text-charcoal-400', 'hover:text-yellow-500', 'border-charcoal-300', 'dark:border-charcoal-600');
        svg.classList.remove('fill-current');
        svg.setAttribute('fill', 'none');
        bookmarkBtn.setAttribute('title', 'Bookmark');
        if (textSpan) textSpan.textContent = 'Save';
    }
}

function showToast(message, type = 'success') {
    const existingToast = document.getElementById('toast-notification');
    if (existingToast) {
        existingToast.remove();
    }

    const colors = {
        success: 'bg-green-500',
        info: 'bg-blue-500',
        error: 'bg-red-500'
    };

    const toast = document.createElement('div');
    toast.id = 'toast-notification';
    toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 z-50 text-white ${colors[type] || colors.success}`;
    toast.innerHTML = `
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="font-medium">${message}</span>
        </div>
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.transform = 'translateY(0)';
    }, 10);

    setTimeout(() => {
        toast.style.transform = 'translateY(100px)';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
