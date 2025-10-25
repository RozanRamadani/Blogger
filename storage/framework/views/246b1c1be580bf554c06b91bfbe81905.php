<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    
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
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lora:wght@400;500;600;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
<body class="h-full bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <div class="min-h-full flex flex-col">
        <?php if (isset($component)) { $__componentOriginal9373b5e3fdef3dfbe272cd492a9731c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9373b5e3fdef3dfbe272cd492a9731c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modern-navbar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modern-navbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9373b5e3fdef3dfbe272cd492a9731c7)): ?>
<?php $attributes = $__attributesOriginal9373b5e3fdef3dfbe272cd492a9731c7; ?>
<?php unset($__attributesOriginal9373b5e3fdef3dfbe272cd492a9731c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9373b5e3fdef3dfbe272cd492a9731c7)): ?>
<?php $component = $__componentOriginal9373b5e3fdef3dfbe272cd492a9731c7; ?>
<?php unset($__componentOriginal9373b5e3fdef3dfbe272cd492a9731c7); ?>
<?php endif; ?>

        <main class="flex-grow">
            <?php if(isset($title)): ?>
                <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php echo e($title); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
            <?php endif; ?>
            
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                
                <?php if(session('success')): ?>
                    <div x-data="{ show: true }" 
                         x-show="show" 
                         x-transition
                         x-init="$nextTick(() => setTimeout(() => show = false, 5000))"
                         class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 animate-slide-down">
                        <div class="flex items-center justify-between">
                            <p class="font-medium"><?php echo e(session('success')); ?></p>
                            <button @click="show = false" class="ml-4 text-green-600 hover:text-green-800 dark:text-green-400 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div x-data="{ show: true }" 
                         x-show="show" 
                         x-transition
                         x-init="$nextTick(() => setTimeout(() => show = false, 5000))"
                         class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 animate-slide-down">
                        <div class="flex items-center justify-between">
                            <p class="font-medium"><?php echo e(session('error')); ?></p>
                            <button @click="show = false" class="ml-4 text-red-600 hover:text-red-800 dark:text-red-400 transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php echo e($slot); ?>

            </div>
        </main>

        <?php if (isset($component)) { $__componentOriginal7dcb606ffe9561696142de1eeb99a0e8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7dcb606ffe9561696142de1eeb99a0e8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modern-footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modern-footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7dcb606ffe9561696142de1eeb99a0e8)): ?>
<?php $attributes = $__attributesOriginal7dcb606ffe9561696142de1eeb99a0e8; ?>
<?php unset($__attributesOriginal7dcb606ffe9561696142de1eeb99a0e8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7dcb606ffe9561696142de1eeb99a0e8)): ?>
<?php $component = $__componentOriginal7dcb606ffe9561696142de1eeb99a0e8; ?>
<?php unset($__componentOriginal7dcb606ffe9561696142de1eeb99a0e8); ?>
<?php endif; ?>
        
        <?php echo $__env->yieldPushContent('scripts'); ?>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\project1\resources\views/components/layout.blade.php ENDPATH**/ ?>