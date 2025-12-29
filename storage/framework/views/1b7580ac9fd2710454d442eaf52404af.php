<?php if (isset($component)) { $__componentOriginal1f9e5f64f242295036c059d9dc1c375c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1f9e5f64f242295036c059d9dc1c375c = $attributes; } ?>
<?php $component = App\View\Components\Layout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> <?php echo e($title); ?> <?php $__env->endSlot(); ?>

    
     <?php $__env->slot('metaDescription', null, []); ?> <?php echo e(Str::limit(strip_tags($post->body), 160)); ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('metaKeywords', null, []); ?> <?php echo e($post->category->name); ?>, blog, article, <?php echo e($post->author->name); ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('metaAuthor', null, []); ?> <?php echo e($post->author->name); ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('ogImage', null, []); ?> <?php echo e($post->image ? asset('storage/' . $post->image) : asset('img/og-default.jpg')); ?> <?php $__env->endSlot(); ?>

    
    <?php
        $articleSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => Str::limit(strip_tags($post->body), 160),
            'image' => $post->image ? asset('storage/' . $post->image) : asset('img/default-post.jpg'),
            'author' => [
                '@type' => 'Person',
                'name' => $post->author->name,
                'url' => url('/posts?author=' . $post->author->username),
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => config('app.name'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('img/logo.png'),
                ],
            ],
            'datePublished' => $post->created_at->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => url('/posts/' . $post->slug),
            ],
            'articleSection' => $post->category->name,
            'keywords' => $post->category->name . ', blog, article',
            'wordCount' => str_word_count($post->body),
            'inLanguage' => 'en-US',
        ];

        $breadcrumbSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => url('/'),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'Blog',
                    'item' => url('/posts'),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 3,
                    'name' => $post->category->name,
                    'item' => url('/posts?category=' . $post->category->slug),
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 4,
                    'name' => $post->title,
                    'item' => url('/posts/' . $post->slug),
                ],
            ],
        ];
    ?>

    <script type="application/ld+json"><?php echo json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
    <script type="application/ld+json"><?php echo json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>

    
    <div id="reading-progress-bar" class="fixed top-0 left-0 h-1 bg-gradient-to-r from-primary-500 via-primary-600 to-primary-700 transition-all duration-150 ease-out z-50" style="width: 0%"></div>

    
    <button
        id="scroll-to-top"
        class="fixed bottom-8 right-8 w-12 h-12 bg-primary-600 hover:bg-primary-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center opacity-0 invisible z-40"
        aria-label="Scroll to top">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    
    <article class="bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50">
        
        <div class="border-b border-charcoal-200 dark:border-charcoal-700 bg-white dark:bg-charcoal-900">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <a href="/posts" class="inline-flex items-center text-sm font-semibold px-3 py-2 rounded-lg border border-primary-200 dark:border-primary-800 text-primary-700 dark:text-primary-300 bg-primary-50 dark:bg-primary-900/15 hover:bg-primary-100 dark:hover:bg-primary-900/30 hover:text-primary-800 transition-colors group">
                        <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke artikel
                    </a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $post)): ?>
                        <a href="<?php echo e(route('articles.edit', $post->slug)); ?>" class="inline-flex items-center text-sm px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-semibold shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-charcoal-900">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Artikel
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <header class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8">
            
            <div class="flex items-center gap-4 mb-6">
                <a href="/posts?category=<?php echo e($post->category->slug); ?>" class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 hover:bg-primary-200 dark:hover:bg-primary-900/50 transition-colors">
                    <?php echo e($post->category->name); ?>

                </a>
                <span class="text-sm text-charcoal-500 dark:text-charcoal-400">
                    <?php echo e(ceil(str_word_count($post->body) / 200)); ?> menit baca
                </span>
                <span class="inline-flex items-center text-sm text-charcoal-500 dark:text-charcoal-400" title="<?php echo e(number_format($post->views_count)); ?> views">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <?php echo e(number_format($post->views_count)); ?> views
                </span>
            </div>

            
            <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-charcoal-900 dark:text-white leading-[1.05] mb-8 tracking-tight">
                <?php echo e($post->title); ?>

            </h1>

            
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-8 border-b border-charcoal-200 dark:border-charcoal-700">
                <a href="/posts?author=<?php echo e($post->author->username); ?>" class="flex items-center space-x-4 group/author">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-semibold text-lg shadow-lg">
                        <?php echo e(strtoupper(substr($post->author->name, 0, 2))); ?>

                    </div>
                    <div>
                        <div class="font-semibold text-lg text-charcoal-900 dark:text-white group-hover/author:text-primary-600 dark:group-hover/author:text-primary-400 transition-colors">
                            <?php echo e($post->author->name); ?>

                        </div>
                        <div class="text-sm text-charcoal-500 dark:text-charcoal-400">
                            <?php echo e($post->created_at->format('F d, Y')); ?>

                            <?php if($post->created_at != $post->updated_at): ?>
                                <span class="mx-1">•</span>
                                <span>Diubah <?php echo e($post->updated_at->diffForHumans()); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>

                <div class="flex items-center gap-4">
                    <?php if(auth()->guard()->check()): ?>
                        
                        <button
                            onclick="toggleLike(<?php echo e($post->id); ?>, '<?php echo e($post->slug); ?>')"
                            id="like-btn-<?php echo e($post->id); ?>"
                            class="inline-flex items-center px-3 py-1.5 rounded-lg border text-sm transition-all <?php echo e($post->isLikedBy(auth()->user()) ? 'border-red-500 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400' : 'border-charcoal-300 dark:border-charcoal-600 text-charcoal-600 dark:text-charcoal-300 hover:border-red-500 hover:text-red-600'); ?>"
                            title="<?php echo e($post->isLikedBy(auth()->user()) ? 'Unlike' : 'Like'); ?>">
                            <svg class="w-4 h-4 mr-1.5 <?php echo e($post->isLikedBy(auth()->user()) ? 'fill-current' : ''); ?>" fill="<?php echo e($post->isLikedBy(auth()->user()) ? 'currentColor' : 'none'); ?>" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span id="likes-count-<?php echo e($post->id); ?>" class="font-medium"><?php echo e($post->likes()->count()); ?></span>
                        </button>

                        
                        <button
                            onclick="toggleBookmark(<?php echo e($post->id); ?>, '<?php echo e($post->slug); ?>')"
                            id="bookmark-btn-<?php echo e($post->id); ?>"
                            class="inline-flex items-center px-3 py-1.5 rounded-lg border text-sm transition-all <?php echo e($post->isBookmarkedBy(auth()->user()) ? 'border-yellow-500 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400' : 'border-charcoal-300 dark:border-charcoal-600 text-charcoal-600 dark:text-charcoal-300 hover:border-yellow-500 hover:text-yellow-600'); ?>"
                            title="<?php echo e($post->isBookmarkedBy(auth()->user()) ? 'Remove bookmark' : 'Bookmark'); ?>">
                            <svg class="w-4 h-4 mr-1.5 <?php echo e($post->isBookmarkedBy(auth()->user()) ? 'fill-current' : ''); ?>" fill="<?php echo e($post->isBookmarkedBy(auth()->user()) ? 'currentColor' : 'none'); ?>" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                            <span class="font-medium"><?php echo e($post->isBookmarkedBy(auth()->user()) ? 'Saved' : 'Save'); ?></span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        
        <?php if($post->image): ?>
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
                <div class="relative overflow-hidden rounded-2xl shadow-2xl">
                    <img
                        src="<?php echo e(asset('storage/' . $post->image)); ?>"
                        alt="<?php echo e($post->title); ?>"
                        class="w-full h-auto object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-charcoal-900/30 to-transparent"></div>
                </div>
            </div>
        <?php endif; ?>

        
        <?php if($post->images && count($post->images) > 0): ?>
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 mb-12" x-data="imageGallery()">
                <h3 class="text-xl font-bold text-charcoal-900 dark:text-white mb-4">Gallery</h3>

                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                    <?php $__currentLoopData = $post->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div @click="openImage(<?php echo e($index); ?>)" class="cursor-pointer group relative overflow-hidden rounded-xl shadow-md hover:shadow-xl transition-all">
                            <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="Gallery image <?php echo e($index + 1); ?>" class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity"></div>
                            <div class="absolute top-2 right-2 bg-black/60 text-white text-xs px-2 py-1 rounded-full">
                                <?php echo e($index + 1); ?>/<?php echo e(count($post->images)); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div x-show="isOpen"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="closeImage"
                     class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 backdrop-blur-sm"
                     style="display: none;">

                    
                    <button @click="closeImage" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-10">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    
                    <button @click.stop="previousImage" class="absolute left-4 text-white hover:text-gray-300 transition-colors z-10 bg-black/50 hover:bg-black/70 rounded-full p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>

                    
                    <div class="max-w-6xl max-h-[90vh] mx-4" @click.stop>
                        <img :src="currentImageUrl"
                             alt="Full size gallery image"
                             class="max-w-full max-h-[90vh] w-auto h-auto object-contain rounded-lg shadow-2xl">
                        <div class="text-center text-white mt-4 text-sm">
                            <span x-text="currentIndex + 1"></span> / <span x-text="totalImages"></span>
                        </div>
                    </div>

                    
                    <button @click.stop="nextImage" class="absolute right-4 text-white hover:text-gray-300 transition-colors z-10 bg-black/50 hover:bg-black/70 rounded-full p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>

                <script>
                    function imageGallery() {
                        return {
                            isOpen: false,
                            currentIndex: 0,
                            images: <?php echo json_encode(array_map(fn($img) => asset('storage/' . $img), $post->images), 512) ?>,
                            totalImages: <?php echo e(count($post->images)); ?>,

                            get currentImageUrl() {
                                return this.images[this.currentIndex];
                            },

                            openImage(index) {
                                this.currentIndex = index;
                                this.isOpen = true;
                                document.body.style.overflow = 'hidden';
                            },

                            closeImage() {
                                this.isOpen = false;
                                document.body.style.overflow = 'auto';
                            },

                            nextImage() {
                                this.currentIndex = (this.currentIndex + 1) % this.totalImages;
                            },

                            previousImage() {
                                this.currentIndex = (this.currentIndex - 1 + this.totalImages) % this.totalImages;
                            },

                            init() {
                                // Keyboard navigation
                                this.$watch('isOpen', (value) => {
                                    if (value) {
                                        document.addEventListener('keydown', this.handleKeyboard.bind(this));
                                    } else {
                                        document.removeEventListener('keydown', this.handleKeyboard.bind(this));
                                    }
                                });
                            },

                            handleKeyboard(e) {
                                if (e.key === 'Escape') this.closeImage();
                                if (e.key === 'ArrowLeft') this.previousImage();
                                if (e.key === 'ArrowRight') this.nextImage();
                            }
                        }
                    }
                </script>
            </div>
        <?php endif; ?>

        
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="prose prose-lg prose-charcoal dark:prose-invert max-w-none">
                <div class="text-charcoal-800 dark:text-cream-100 leading-relaxed text-lg font-normal tracking-normal">
                    <?php echo nl2br(e($post->body)); ?>

                </div>
            </div>

            
            <div class="mt-12 pt-8 border-t border-charcoal-200 dark:border-charcoal-700">
                <div class="flex flex-wrap gap-2 items-center">
                    <span class="text-sm font-semibold text-charcoal-600 dark:text-charcoal-400">Kategori:</span>
                    <a href="/posts?category=<?php echo e($post->category->slug); ?>" class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 hover:bg-primary-200 dark:hover:bg-primary-900/50 transition-colors">
                        <?php echo e($post->category->name); ?>

                    </a>
                </div>

                <?php if($post->tags && $post->tags->count() > 0): ?>
                    <div class="flex flex-wrap gap-2 items-center mt-4">
                        <span class="text-sm font-semibold text-charcoal-600 dark:text-charcoal-400">Tags:</span>
                        <?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="/posts?tag=<?php echo e($tag->slug); ?>"
                               class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-semibold transition-all hover:shadow-md"
                               style="background-color: <?php echo e($tag->color); ?>15; color: <?php echo e($tag->color); ?>; border: 1.5px solid <?php echo e($tag->color); ?>40;">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                                <?php echo e($tag->name); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="mt-12 pt-8 border-t border-charcoal-200 dark:border-charcoal-700">
                <div class="flex items-center justify-center sm:justify-end">
                    
                    <?php if (isset($component)) { $__componentOriginal17b2004f99a8943478e07573999cea74 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal17b2004f99a8943478e07573999cea74 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.social-share','data' => ['url' => url('/posts/' . $post->slug),'title' => $post->title,'description' => Str::limit(strip_tags($post->body), 160)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('social-share'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(url('/posts/' . $post->slug)),'title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post->title),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Str::limit(strip_tags($post->body), 160))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal17b2004f99a8943478e07573999cea74)): ?>
<?php $attributes = $__attributesOriginal17b2004f99a8943478e07573999cea74; ?>
<?php unset($__attributesOriginal17b2004f99a8943478e07573999cea74); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal17b2004f99a8943478e07573999cea74)): ?>
<?php $component = $__componentOriginal17b2004f99a8943478e07573999cea74; ?>
<?php unset($__componentOriginal17b2004f99a8943478e07573999cea74); ?>
<?php endif; ?>
                </div>
            </div>
        </div>

        
        <?php if($relatedPosts->count() > 0): ?>
        <section class="border-t border-charcoal-200 dark:border-charcoal-700 bg-cream-50 dark:bg-charcoal-950 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="font-display text-3xl font-bold text-charcoal-900 dark:text-white">
                            Artikel Terkait
                        </h3>
                        <p class="text-charcoal-600 dark:text-charcoal-400 mt-2">
                            Artikel lain dalam kategori <span class="font-semibold text-primary-600 dark:text-primary-400"><?php echo e($post->category->name); ?></span>
                        </p>
                    </div>
                    <a href="/posts?category=<?php echo e($post->category->slug); ?>" class="hidden md:inline-flex items-center text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                        Lihat semua
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                    <?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="group bg-white dark:bg-charcoal-800 rounded-xl overflow-hidden border border-charcoal-200 dark:border-charcoal-700 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <?php if($relatedPost->image): ?>
                            <a href="/posts/<?php echo e($relatedPost->slug); ?>" class="block overflow-hidden relative">
                                <img
                                    src="<?php echo e(asset('storage/' . $relatedPost->image)); ?>"
                                    alt="<?php echo e($relatedPost->title); ?>"
                                    loading="lazy"
                                    class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </a>
                        <?php endif; ?>

                        <div class="p-5">
                            <div class="flex items-center justify-between mb-3">
                                <a href="/posts?category=<?php echo e($relatedPost->category->slug); ?>"
                                   class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 hover:bg-primary-200 dark:hover:bg-primary-900/50 transition-colors">
                                    <?php echo e($relatedPost->category->name); ?>

                                </a>
                                <span class="inline-flex items-center text-xs text-charcoal-500 dark:text-charcoal-400" title="<?php echo e(number_format($relatedPost->views_count)); ?> views">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <?php echo e($relatedPost->views_count >= 1000 ? number_format($relatedPost->views_count / 1000, 1) . 'k' : $relatedPost->views_count); ?>

                                </span>
                            </div>

                            <a href="/posts/<?php echo e($relatedPost->slug); ?>">
                                <h4 class="text-lg font-bold text-charcoal-900 dark:text-white mb-3 leading-tight group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">
                                    <?php echo e($relatedPost->title); ?>

                                </h4>
                            </a>

                            <p class="text-sm text-charcoal-600 dark:text-charcoal-300 mb-4 line-clamp-2 leading-relaxed">
                                <?php echo e(Str::limit($relatedPost->body, 100)); ?>

                            </p>

                            <div class="flex items-center justify-between pt-3 border-t border-charcoal-100 dark:border-charcoal-700">
                                <div class="flex items-center text-xs text-charcoal-500 dark:text-charcoal-400">
                                    <div class="w-6 h-6 rounded-full bg-primary-600 flex items-center justify-center text-white text-xs font-semibold mr-2">
                                        <?php echo e(strtoupper(substr($relatedPost->author->name, 0, 1))); ?>

                                    </div>
                                    <span class="font-medium"><?php echo e($relatedPost->author->name); ?></span>
                                </div>
                                <span class="text-xs text-charcoal-400 dark:text-charcoal-500">
                                    <?php echo e($relatedPost->created_at->diffForHumans()); ?>

                                </span>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <?php else: ?>
        
        <section class="border-t border-charcoal-200 dark:border-charcoal-700 bg-cream-50 dark:bg-charcoal-950 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <svg class="w-16 h-16 mx-auto text-charcoal-300 dark:text-charcoal-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <h3 class="font-display text-2xl font-bold text-charcoal-900 dark:text-white mb-2">
                    Belum Ada Artikel Terkait
                </h3>
                <p class="text-charcoal-600 dark:text-charcoal-400 mb-6">
                    Saat ini belum ada artikel lain dalam kategori ini
                </p>
                <a href="/posts" class="inline-flex items-center px-6 py-3 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                    </svg>
                    Kembali ke Semua Artikel
                </a>
            </div>
        </section>
        <?php endif; ?>

        
        <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <?php if (isset($component)) { $__componentOriginal0921db5bc5e3dc132fa2ade7377815f9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0921db5bc5e3dc132fa2ade7377815f9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.giscus-comments','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('giscus-comments'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0921db5bc5e3dc132fa2ade7377815f9)): ?>
<?php $attributes = $__attributesOriginal0921db5bc5e3dc132fa2ade7377815f9; ?>
<?php unset($__attributesOriginal0921db5bc5e3dc132fa2ade7377815f9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0921db5bc5e3dc132fa2ade7377815f9)): ?>
<?php $component = $__componentOriginal0921db5bc5e3dc132fa2ade7377815f9; ?>
<?php unset($__componentOriginal0921db5bc5e3dc132fa2ade7377815f9); ?>
<?php endif; ?>
        </section>
    </article>

    <?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('shareButtons', () => ({
                pageUrl: window.location.href,
                pageTitle: '<?php echo e(addslashes($post->title)); ?>',

                shareTwitter() {
                    const url = `https://twitter.com/intent/tweet?url=${encodeURIComponent(this.pageUrl)}&text=${encodeURIComponent(this.pageTitle)}`;
                    window.open(url, '_blank', 'width=600,height=400');
                },

                shareLinkedIn() {
                    const url = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(this.pageUrl)}`;
                    window.open(url, '_blank', 'width=600,height=400');
                },

                async copyLink() {
                    try {
                        await navigator.clipboard.writeText(this.pageUrl);
                        // Toast notification
                        const toast = document.createElement('div');
                        toast.className = 'fixed bottom-4 right-4 px-6 py-3 bg-primary-600 text-white rounded-lg shadow-xl z-50 font-medium';
                        toast.textContent = '✓ Link copied!';
                        document.body.appendChild(toast);
                        setTimeout(() => {
                            toast.style.opacity = '0';
                            toast.style.transform = 'translateY(10px)';
                            toast.style.transition = 'all 0.3s ease';
                            setTimeout(() => toast.remove(), 300);
                        }, 2000);
                    } catch (err) {
                        alert('Failed to copy link');
                    }
                }
            }));
        });
    </script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const progressBar = document.getElementById('reading-progress-bar');
            const scrollToTopBtn = document.getElementById('scroll-to-top');
            const article = document.querySelector('article');

            // Update reading progress on scroll
            function updateReadingProgress() {
                const windowHeight = window.innerHeight;
                const documentHeight = document.documentElement.scrollHeight;
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const scrollPercentage = (scrollTop / (documentHeight - windowHeight)) * 100;

                // Cap at 100%
                const progress = Math.min(scrollPercentage, 100);
                progressBar.style.width = progress + '%';
            }

            // Show/hide scroll to top button
            function toggleScrollButton() {
                if (window.pageYOffset > 500) {
                    scrollToTopBtn.classList.remove('opacity-0', 'invisible');
                    scrollToTopBtn.classList.add('opacity-100', 'visible');
                } else {
                    scrollToTopBtn.classList.add('opacity-0', 'invisible');
                    scrollToTopBtn.classList.remove('opacity-100', 'visible');
                }
            }

            // Scroll to top with smooth animation
            scrollToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Listen to scroll events
            let ticking = false;
            window.addEventListener('scroll', function() {
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        updateReadingProgress();
                        toggleScrollButton();
                        ticking = false;
                    });
                    ticking = true;
                }
            });

            // Initial update
            updateReadingProgress();
            toggleScrollButton();
        });
    </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1f9e5f64f242295036c059d9dc1c375c)): ?>
<?php $attributes = $__attributesOriginal1f9e5f64f242295036c059d9dc1c375c; ?>
<?php unset($__attributesOriginal1f9e5f64f242295036c059d9dc1c375c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1f9e5f64f242295036c059d9dc1c375c)): ?>
<?php $component = $__componentOriginal1f9e5f64f242295036c059d9dc1c375c; ?>
<?php unset($__componentOriginal1f9e5f64f242295036c059d9dc1c375c); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\project1\resources\views/post.blade.php ENDPATH**/ ?>