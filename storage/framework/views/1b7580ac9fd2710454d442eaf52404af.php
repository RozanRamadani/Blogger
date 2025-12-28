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

                
                <div class="hidden md:flex items-center gap-2" x-data="shareButtons">
                    <span class="text-sm font-medium text-charcoal-600 dark:text-charcoal-400 mr-2">Bagikan</span>
                    <button @click="shareTwitter" title="Share on Twitter" class="p-2 rounded-lg border border-primary-200 dark:border-primary-800 bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300 hover:bg-primary-100 dark:hover:bg-primary-900/35 hover:text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-charcoal-900 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </button>
                    <button @click="shareLinkedIn" title="Share on LinkedIn" class="p-2 rounded-lg border border-primary-200 dark:border-primary-800 bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300 hover:bg-primary-100 dark:hover:bg-primary-900/35 hover:text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-charcoal-900 transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </button>
                    <button @click="copyLink" title="Copy link" class="p-2 rounded-lg border border-primary-200 dark:border-primary-800 bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300 hover:bg-primary-100 dark:hover:bg-primary-900/35 hover:text-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-charcoal-900 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </button>
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
                    <span class="text-sm font-semibold text-charcoal-600 dark:text-charcoal-400">Topik:</span>
                    <a href="/posts?category=<?php echo e($post->category->slug); ?>" class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 hover:bg-primary-200 dark:hover:bg-primary-900/50 transition-colors">
                        <?php echo e($post->category->name); ?>

                    </a>
                </div>
            </div>
        </div>

        
        <?php if($relatedPosts->count() > 0): ?>
        <section class="border-t border-charcoal-200 dark:border-charcoal-700 bg-cream-50 dark:bg-charcoal-950 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="font-display text-3xl font-bold text-charcoal-900 dark:text-white mb-8">
                    Baca Selanjutnya
                </h3>
                <div class="grid gap-6 md:grid-cols-3">
                    <?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedPost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="group bg-white dark:bg-charcoal-800 rounded-xl overflow-hidden border border-charcoal-200 dark:border-charcoal-700 shadow-md hover:shadow-xl transition-all duration-300">
                        <?php if($relatedPost->image): ?>
                            <a href="/posts/<?php echo e($relatedPost->slug); ?>" class="block overflow-hidden">
                                <img
                                    src="<?php echo e(asset('storage/' . $relatedPost->image)); ?>"
                                    alt="<?php echo e($relatedPost->title); ?>"
                                    loading="lazy"
                                    class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-500">
                            </a>
                        <?php endif; ?>

                        <div class="p-5">
                            <a href="/posts?category=<?php echo e($relatedPost->category->slug); ?>"
                               class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 mb-3 hover:bg-primary-200 dark:hover:bg-primary-900/50 transition-colors">
                                <?php echo e($relatedPost->category->name); ?>

                            </a>

                            <a href="/posts/<?php echo e($relatedPost->slug); ?>">
                                <h4 class="text-lg font-bold text-charcoal-900 dark:text-white mb-3 leading-tight group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">
                                    <?php echo e($relatedPost->title); ?>

                                </h4>
                            </a>

                            <p class="text-sm text-charcoal-600 dark:text-charcoal-300 mb-4 line-clamp-2 leading-relaxed">
                                <?php echo e(Str::limit($relatedPost->body, 100)); ?>

                            </p>

                            <div class="flex items-center text-xs text-charcoal-500 dark:text-charcoal-400 pt-3 border-t border-charcoal-100 dark:border-charcoal-700">
                                <span class="font-medium"><?php echo e($relatedPost->author->name); ?></span>
                                <span class="mx-2">•</span>
                                <span><?php echo e($relatedPost->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
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