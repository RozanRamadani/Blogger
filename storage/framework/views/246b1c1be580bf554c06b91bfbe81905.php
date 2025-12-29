<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <meta name="description" content="<?php echo e($metaDescription ?? 'Modern Laravel Blog - Share your thoughts and stories'); ?>">
    <meta name="keywords" content="<?php echo e($metaKeywords ?? 'blog, laravel, articles, technology'); ?>">
    <meta name="author" content="<?php echo e($metaAuthor ?? 'Laravel Blog'); ?>">

    
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:title" content="<?php echo e($title ?? 'Laravel Blog'); ?>">
    <meta property="og:description" content="<?php echo e($metaDescription ?? 'Modern Laravel Blog'); ?>">
    <meta property="og:image" content="<?php echo e($ogImage ?? asset('img/og-default.jpg')); ?>">

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($title ?? 'Laravel Blog'); ?>">
    <meta name="twitter:description" content="<?php echo e($metaDescription ?? 'Modern Laravel Blog'); ?>">
    <meta name="twitter:image" content="<?php echo e($ogImage ?? asset('img/og-default.jpg')); ?>">

    <title><?php echo e($title ?? 'Home'); ?> | Laravel Blog</title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lora:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700;800&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lora:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <script>
        (function() {
            const theme = localStorage.getItem('theme') ||
                         (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    
    <script type="application/ld+json">
        <?php echo json_encode([
            '<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>' => 'https://schema.org',
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
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>

    </script>

    
    <script type="application/ld+json">
        <?php echo json_encode([
            '<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => config('app.name'),
            'url' => url('/'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/posts?search=') . '{search_term_string}',
                'query-input' => 'required name=search_term_string'
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>

    </script>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="h-full bg-cream-50 dark:bg-charcoal-950 text-charcoal-900 dark:text-cream-50 font-sans antialiased transition-colors duration-300">
    <div class="min-h-full flex flex-col">
        <?php if (isset($component)) { $__componentOriginal9da8031f0a59b0ce921043f9e0c05a16 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9da8031f0a59b0ce921043f9e0c05a16 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.minimal-navbar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('minimal-navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9da8031f0a59b0ce921043f9e0c05a16)): ?>
<?php $attributes = $__attributesOriginal9da8031f0a59b0ce921043f9e0c05a16; ?>
<?php unset($__attributesOriginal9da8031f0a59b0ce921043f9e0c05a16); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9da8031f0a59b0ce921043f9e0c05a16)): ?>
<?php $component = $__componentOriginal9da8031f0a59b0ce921043f9e0c05a16; ?>
<?php unset($__componentOriginal9da8031f0a59b0ce921043f9e0c05a16); ?>
<?php endif; ?>

        <main class="flex-grow">
            
            <?php if(session('success')): ?>
                <div x-data="{ show: true }"
                     x-show="show"
                     x-transition
                     x-init="$nextTick(() => setTimeout(() => show = false, 5000))"
                     class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                    <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 animate-slide-down">
                        <div class="flex items-center justify-between">
                            <p class="font-medium"><?php echo e(session('success')); ?></p>
                            <button @click="show = false" class="ml-4 text-green-600 hover:text-green-800 dark:text-green-400 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div x-data="{ show: true }"
                     x-show="show"
                     x-transition
                     x-init="$nextTick(() => setTimeout(() => show = false, 5000))"
                     class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                    <div class="p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 animate-slide-down">
                        <div class="flex items-center justify-between">
                            <p class="font-medium"><?php echo e(session('error')); ?></p>
                            <button @click="show = false" class="ml-4 text-red-600 hover:text-red-800 dark:text-red-400 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php echo e($slot); ?>

        </main>

        <?php if (isset($component)) { $__componentOriginal38c35f6bb1809ef0fccd4f46eb2f0e9c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal38c35f6bb1809ef0fccd4f46eb2f0e9c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.minimal-footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('minimal-footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal38c35f6bb1809ef0fccd4f46eb2f0e9c)): ?>
<?php $attributes = $__attributesOriginal38c35f6bb1809ef0fccd4f46eb2f0e9c; ?>
<?php unset($__attributesOriginal38c35f6bb1809ef0fccd4f46eb2f0e9c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal38c35f6bb1809ef0fccd4f46eb2f0e9c)): ?>
<?php $component = $__componentOriginal38c35f6bb1809ef0fccd4f46eb2f0e9c; ?>
<?php unset($__componentOriginal38c35f6bb1809ef0fccd4f46eb2f0e9c); ?>
<?php endif; ?>

        
        <script src="<?php echo e(asset('js/like-bookmark.js')); ?>"></script>

        <?php echo $__env->yieldPushContent('scripts'); ?>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\project1\resources\views/components/layout.blade.php ENDPATH**/ ?>