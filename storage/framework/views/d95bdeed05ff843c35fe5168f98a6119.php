
<div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        Comments
    </h3>
    
    <div class="giscus-container bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
        <script src="https://giscus.app/client.js"
                data-repo="<?php echo e($repo ?? 'RozanRamadani/Blogger'); ?>"
                data-repo-id="<?php echo e($repoId ?? 'R_kgDONhMV5Q'); ?>"
                data-category="<?php echo e($category ?? 'General'); ?>"
                data-category-id="<?php echo e($categoryId ?? 'DIC_kwDONhMV5c4Cl1YG'); ?>"
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

    
    <details class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
        <summary class="cursor-pointer text-sm font-semibold text-blue-900 dark:text-blue-300">
            ℹ️ How to configure Giscus for your repository
        </summary>
        <div class="mt-3 text-sm text-gray-700 dark:text-gray-300 space-y-2">
            <p><strong>Steps to enable comments:</strong></p>
            <ol class="list-decimal list-inside space-y-1 ml-2">
                <li>Go to your GitHub repository settings</li>
                <li>Enable <strong>Discussions</strong> tab</li>
                <li>Visit <a href="https://giscus.app" target="_blank" class="text-blue-600 hover:underline">giscus.app</a></li>
                <li>Enter your repository name: <code class="bg-gray-200 dark:bg-gray-700 px-1 rounded">RozanRamadani/Blogger</code></li>
                <li>Copy the generated script configuration values</li>
                <li>Update this component with your <code class="bg-gray-200 dark:bg-gray-700 px-1 rounded">data-repo-id</code> and <code class="bg-gray-200 dark:bg-gray-700 px-1 rounded">data-category-id</code></li>
            </ol>
            <p class="mt-3 text-xs text-gray-600 dark:text-gray-400">
                💡 Tip: Comments will sync with your theme automatically (light/dark mode)
            </p>
        </div>
    </details>
</div>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\project1\resources\views/components/giscus-comments.blade.php ENDPATH**/ ?>