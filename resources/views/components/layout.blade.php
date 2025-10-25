<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- SEO Meta Tags --}}
    <meta name="description" content="{{ $metaDescription ?? 'Modern Laravel Blog - Share your thoughts and stories' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'blog, laravel, articles, technology' }}">
    <meta name="author" content="{{ $metaAuthor ?? 'Laravel Blog' }}">
    
    {{-- Open Graph / Social Media --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Laravel Blog' }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'Modern Laravel Blog' }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('img/og-default.jpg') }}">
    
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? 'Laravel Blog' }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? 'Modern Laravel Blog' }}">
    <meta name="twitter:image" content="{{ $ogImage ?? asset('img/og-default.jpg') }}">
    
    <title>{{ $title ?? 'Home' }} | Laravel Blog</title>
    
    {{-- Preload critical fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lora:wght@400;500;600;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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

    {{-- Schema.org Organization Data --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => config('app.name'),
            'url' => url('/'),
            'logo' => asset('img/logo.png'),
            'description' => 'Modern blog platform built with Laravel',
            'sameAs' => [
                'https://twitter.com/yourhandle',
                'https://github.com/RozanRamadani',
                'https://linkedin.com/company/yourcompany'
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    {{-- WebSite Schema --}}
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => config('app.name'),
            'url' => url('/'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/posts?search=') . '{search_term_string}',
                'query-input' => 'required name=search_term_string'
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    
    @stack('styles')
</head>
<body class="h-full bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <div class="min-h-full flex flex-col">
        <x-modern-navbar />

        <main class="flex-grow">
            @isset($title)
                <x-header>{{ $title }}</x-header>
            @endisset
            
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{-- Flash Messages with Alpine.js auto-hide --}}
                @if(session('success'))
                    <div x-data="{ show: true }" 
                         x-show="show" 
                         x-transition
                         x-init="$nextTick(() => setTimeout(() => show = false, 5000))"
                         class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 animate-slide-down">
                        <div class="flex items-center justify-between">
                            <p class="font-medium">{{ session('success') }}</p>
                            <button @click="show = false" class="ml-4 text-green-600 hover:text-green-800 dark:text-green-400 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div x-data="{ show: true }" 
                         x-show="show" 
                         x-transition
                         x-init="$nextTick(() => setTimeout(() => show = false, 5000))"
                         class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 animate-slide-down">
                        <div class="flex items-center justify-between">
                            <p class="font-medium">{{ session('error') }}</p>
                            <button @click="show = false" class="ml-4 text-red-600 hover:text-red-800 dark:text-red-400 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif
                
                {{ $slot }}
            </div>
        </main>

        <x-modern-footer />
        
        @stack('scripts')
    </div>
</body>
</html>
