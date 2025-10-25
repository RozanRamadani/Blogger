import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import { initTheme, toggleTheme } from './theme';
import { initLiveSearch } from './search';
import { initInfiniteScroll } from './infinite-scroll';
import { initAdvancedLazyLoading } from './lazy-loading';

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Make theme toggle available globally
window.toggleTheme = toggleTheme;

// Initialize features
initTheme();

// Initialize features when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initLiveSearch();
        initInfiniteScroll();
        initAdvancedLazyLoading();
    });
} else {
    initLiveSearch();
    initInfiniteScroll();
    initAdvancedLazyLoading();
}

// Smooth scroll behavior
document.documentElement.style.scrollBehavior = 'smooth';

// Performance optimization: Prefetch links on hover
document.addEventListener('mouseover', (e) => {
    const link = e.target.closest('a[href^="/posts/"]');
    if (link && !link.dataset.prefetched) {
        const prefetchLink = document.createElement('link');
        prefetchLink.rel = 'prefetch';
        prefetchLink.href = link.href;
        document.head.appendChild(prefetchLink);
        link.dataset.prefetched = 'true';
    }
});

// Service Worker registration for offline support (optional)
if ('serviceWorker' in navigator && import.meta.env.PROD) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch(() => {
            // Service worker registration failed, continue without it
        });
    });
}
