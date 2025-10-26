{{-- Giscus Comments Component --}}
<div class="mt-12 pt-8 border-t border-charcoal-100 dark:border-charcoal-800">
    <h3 class="font-display text-3xl font-bold text-charcoal-900 dark:text-cream-50 mb-6 flex items-center">
        <svg class="w-7 h-7 mr-3 text-terracotta-600 dark:text-terracotta-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        Join the Discussion
    </h3>
    
    <div class="giscus-container bg-white dark:bg-charcoal-800 rounded-2xl p-6 shadow-lg border-2 border-charcoal-100 dark:border-charcoal-700">
        <script src="https://giscus.app/client.js"
                data-repo="{{ $repo ?? 'RozanRamadani/Blogger' }}"
                data-repo-id="{{ $repoId ?? 'R_kgDONhMV5Q' }}"
                data-category="{{ $category ?? 'General' }}"
                data-category-id="{{ $categoryId ?? 'DIC_kwDONhMV5c4Cl1YG' }}"
                data-mapping="pathname"
                data-strict="0"
                data-reactions-enabled="1"
                data-emit-metadata="0"
                data-input-position="top"
                data-theme="preferred_color_scheme"
                data-lang="en"
                data-loading="lazy"
                crossorigin="anonymous"
                async>
        </script>
    </div>

    {{-- Instructions for setting up Giscus --}}
    <details class="mt-6 p-6 bg-cream-50 dark:bg-charcoal-900/50 rounded-xl border-2 border-terracotta-100 dark:border-terracotta-900/30">
        <summary class="cursor-pointer text-sm font-semibold text-terracotta-700 dark:text-terracotta-300 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            How to configure Giscus for your repository
        </summary>
        <div class="mt-4 text-sm text-charcoal-700 dark:text-cream-300 space-y-3">
            <p class="font-semibold text-charcoal-900 dark:text-cream-50">Steps to enable comments:</p>
            <ol class="list-decimal list-inside space-y-2 ml-2">
                <li>Go to your GitHub repository settings</li>
                <li>Enable <strong>Discussions</strong> tab</li>
                <li>Visit <a href="https://giscus.app" target="_blank" class="text-terracotta-600 dark:text-terracotta-400 hover:text-terracotta-700 dark:hover:text-terracotta-300 font-medium underline">giscus.app</a></li>
                <li>Enter your repository name: <code class="bg-cream-100 dark:bg-charcoal-800 text-terracotta-700 dark:text-terracotta-300 px-2 py-1 rounded font-mono text-xs">RozanRamadani/Blogger</code></li>
                <li>Copy the generated script configuration values</li>
                <li>Update this component with your <code class="bg-cream-100 dark:bg-charcoal-800 text-terracotta-700 dark:text-terracotta-300 px-2 py-1 rounded font-mono text-xs">data-repo-id</code> and <code class="bg-cream-100 dark:bg-charcoal-800 text-terracotta-700 dark:text-terracotta-300 px-2 py-1 rounded font-mono text-xs">data-category-id</code></li>
            </ol>
            <div class="mt-4 p-3 bg-olive-50 dark:bg-olive-900/20 border border-olive-200 dark:border-olive-800 rounded-lg">
                <p class="text-xs text-olive-900 dark:text-olive-300 flex items-start">
                    <svg class="w-4 h-4 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span><strong>Tip:</strong> Comments will sync with your theme automatically (light/dark mode)</span>
                </p>
            </div>
        </div>
    </details>
</div>

@push('scripts')
<script>
    // Auto-update Giscus theme when dark mode toggles
    function updateGiscusTheme() {
        const theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        const iframe = document.querySelector('iframe.giscus-frame');
        if (iframe) {
            iframe.contentWindow.postMessage({
                giscus: {
                    setConfig: {
                        theme: theme === 'dark' ? 'dark_dimmed' : 'light'
                    }
                }
            }, 'https://giscus.app');
        }
    }

    // Listen for theme changes
    const observer = new MutationObserver(updateGiscusTheme);
    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class']
    });
</script>
@endpush
