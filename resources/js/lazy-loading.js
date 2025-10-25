// Advanced Lazy Loading with Intersection Observer
export function initAdvancedLazyLoading() {
    // Check if browser supports Intersection Observer
    if (!('IntersectionObserver' in window)) {
        // Fallback for older browsers
        loadAllImages();
        return;
    }

    // Configuration for the observer
    const config = {
        root: null, // viewport
        rootMargin: '50px', // Start loading 50px before element enters viewport
        threshold: 0.01
    };

    // Callback function when intersection occurs
    const onIntersection = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                
                // Load the image
                if (img.dataset.src) {
                    loadImage(img);
                    observer.unobserve(img);
                }
            }
        });
    };

    // Create the observer
    const observer = new IntersectionObserver(onIntersection, config);

    // Get all lazy images
    const lazyImages = document.querySelectorAll('img[data-src], img[loading="lazy"]');
    
    lazyImages.forEach(img => {
        // Add blur-up effect class
        if (img.dataset.src) {
            img.classList.add('lazy-loading');
        }
        observer.observe(img);
    });

    // Preload images above the fold immediately
    const aboveFoldImages = document.querySelectorAll('img[data-priority="high"]');
    aboveFoldImages.forEach(img => {
        if (img.dataset.src) {
            loadImage(img);
        }
    });
}

function loadImage(img) {
    const src = img.dataset.src;
    const srcset = img.dataset.srcset;

    if (!src) return;

    // Create a temporary image to load
    const tempImg = new Image();
    
    tempImg.onload = () => {
        // Set the actual image source
        img.src = src;
        if (srcset) {
            img.srcset = srcset;
        }
        
        // Remove blur and add fade-in animation
        img.classList.remove('lazy-loading');
        img.classList.add('lazy-loaded');
        
        // Remove data attributes
        delete img.dataset.src;
        delete img.dataset.srcset;
    };

    tempImg.onerror = () => {
        console.error('Failed to load image:', src);
        img.classList.remove('lazy-loading');
        img.classList.add('lazy-error');
    };

    tempImg.src = src;
    if (srcset) {
        tempImg.srcset = srcset;
    }
}

function loadAllImages() {
    // Fallback for browsers without Intersection Observer
    const lazyImages = document.querySelectorAll('img[data-src]');
    lazyImages.forEach(img => {
        if (img.dataset.src) {
            img.src = img.dataset.src;
            if (img.dataset.srcset) {
                img.srcset = img.dataset.srcset;
            }
            delete img.dataset.src;
            delete img.dataset.srcset;
        }
    });
}

// Add CSS for lazy loading effects
const style = document.createElement('style');
style.textContent = `
    img.lazy-loading {
        filter: blur(10px);
        opacity: 0.5;
        transition: filter 0.3s ease, opacity 0.3s ease;
    }
    
    img.lazy-loaded {
        filter: blur(0);
        opacity: 1;
        animation: fadeIn 0.5s ease;
    }
    
    img.lazy-error {
        opacity: 0.3;
        filter: grayscale(100%);
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0.5;
        }
        to {
            opacity: 1;
        }
    }
`;
document.head.appendChild(style);

// Initialize on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAdvancedLazyLoading);
} else {
    initAdvancedLazyLoading();
}
