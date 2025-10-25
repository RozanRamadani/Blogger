<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@{{ $title ?? 'Home' }} | Laravel Blog</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 
                         (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    
    @stack('styles')
</head>
<body class="h-full bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <div class="min-h-full flex flex-col">
        <x-modern-navbar />

        <main class="flex-grow">
            @isset($title)
                <x-header>@{{ $title }}</x-header>
            @endisset
            
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200">
                        <p>@{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200">
                        <p>@{{ session('error') }}</p>
                    </div>
                @endif
                
                @{{ $slot }}
            </div>
        </main>

        <x-modern-footer />
    </div>

    @stack('scripts')
</body>
</html>
