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

    
    <section class="relative bg-white dark:bg-charcoal-900 border-b border-charcoal-200 dark:border-charcoal-700 py-12 md:py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h1 class="text-4xl md:text-5xl font-bold text-charcoal-900 dark:text-white mb-4">
                    Semua <span class="text-primary-600 dark:text-primary-400">Artikel</span>
                </h1>
                <p class="text-lg text-charcoal-600 dark:text-charcoal-300 max-w-2xl mx-auto">
                    Jelajahi berbagai artikel menarik dan temukan yang sesuai minat Anda
                </p>
            </div>

            
            <form class="max-w-2xl mx-auto">
                <?php if(request('category')): ?>
                    <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
                <?php endif; ?>
                <?php if(request('author')): ?>
                    <input type="hidden" name="author" value="<?php echo e(request('author')); ?>">
                <?php endif; ?>
                <div class="flex gap-3">
                    <div class="relative flex-1">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-charcoal-400 dark:text-charcoal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                        </svg>
                        <input
                            type="search"
                            id="search"
                            name="search"
                            value="<?php echo e(request('search')); ?>"
                            placeholder="Cari artikel..."
                            class="w-full pl-12 pr-4 py-3 rounded-lg border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-800 text-charcoal-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all">
                    </div>
                    <button type="submit"
                        class="px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg whitespace-nowrap">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </section>

    
    <section class="py-12 md:py-16 bg-cream-50 dark:bg-charcoal-950">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            
            <?php if($posts->count() > 0 && !request('search') && !request('category') && !request('author')): ?>
                <?php
                    $featured = $posts->first();
                    $featuredImage = null;
                    $featuredGalleryCount = 0;
                    if ($featured->images && is_array($featured->images) && count($featured->images) > 0) {
                        $featuredImage = $featured->images[0];
                        $featuredGalleryCount = count($featured->images);
                    } elseif ($featured->image) {
                        $featuredImage = $featured->image;
                    }
                ?>
                <article class="mb-12 pb-12 border-b border-charcoal-200 dark:border-charcoal-800">
                    <div class="grid lg:grid-cols-2 gap-8 items-center">
                        <?php if($featuredImage): ?>
                            <div class="relative overflow-hidden rounded-lg group">
                                <img
                                    src="<?php echo e(asset('storage/' . $featuredImage)); ?>"
                                    alt="<?php echo e($featured->title); ?>"
                                    class="w-full h-[350px] object-cover transform group-hover:scale-105 transition-transform duration-500">
                                <?php if($featuredGalleryCount > 0): ?>
                                    <div class="absolute top-3 right-3 bg-black/70 text-white text-sm px-3 py-1.5 rounded-full flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <?php echo e($featuredGalleryCount); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300">
                                    <?php echo e($featured->category->name); ?>

                                </span>
                                <span class="text-sm text-charcoal-500 dark:text-charcoal-400">
                                    Artikel Unggulan
                                </span>
                            </div>

                            <a href="/posts/<?php echo e($featured->slug); ?>">
                                <h2 class="text-3xl md:text-4xl font-bold text-charcoal-900 dark:text-white leading-tight hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                    <?php echo e($featured->title); ?>

                                </h2>
                            </a>

                            <p class="text-lg text-charcoal-600 dark:text-charcoal-300 leading-relaxed">
                                <?php echo e(Str::limit($featured->body, 200)); ?>

                            </p>

                            <div class="flex items-center justify-between pt-4">
                                <a href="/posts?author=<?php echo e($featured->author->username); ?>" class="flex items-center space-x-3 group/author">
                                    <div class="w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold shadow-md">
                                        <?php echo e(strtoupper(substr($featured->author->name, 0, 1))); ?>

                                    </div>
                                    <div>
                                        <div class="font-semibold text-charcoal-900 dark:text-white group-hover/author:text-primary-600 dark:group-hover/author:text-primary-400 transition-colors">
                                            <?php echo e($featured->author->name); ?>

                                        </div>
                                        <div class="text-sm text-charcoal-500 dark:text-charcoal-400">
                                            <?php echo e($featured->created_at->format('d M Y')); ?> • <?php echo e(ceil(str_word_count($featured->body) / 200)); ?> menit baca
                                        </div>
                                    </div>
                                </a>

                                <div class="flex items-center gap-3">
                                    <a href="/posts/<?php echo e($featured->slug); ?>"
                                       class="inline-flex items-center px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                                        Baca
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $featured)): ?>
                                        <a href="<?php echo e(route('articles.edit', $featured->slug)); ?>"
                                           class="inline-flex items-center px-4 py-2 bg-white dark:bg-charcoal-700 text-charcoal-700 dark:text-charcoal-200 hover:bg-cream-50 dark:hover:bg-charcoal-600 rounded-lg transition-colors border border-charcoal-200 dark:border-charcoal-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endif; ?>

            
            <?php if($posts->count() > 0): ?>
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-charcoal-900 dark:text-white">
                        <?php if(request('search')): ?>
                            Hasil pencarian "<?php echo e(request('search')); ?>"
                        <?php elseif(request('category')): ?>
                            Kategori: <?php echo e(ucfirst(request('category'))); ?>

                        <?php elseif(request('author')): ?>
                            Oleh <?php echo e(ucfirst(request('author'))); ?>

                        <?php else: ?>
                            Artikel Terbaru
                        <?php endif; ?>
                    </h3>
                </div>
            <?php endif; ?>

            
            <div id="posts-container" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <?php
                    $displayPosts = ($posts->count() > 0 && !request('search') && !request('category') && !request('author'))
                        ? $posts->skip(1)
                        : $posts;
                ?>

                <?php $__empty_1 = true; $__currentLoopData = $displayPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if (isset($component)) { $__componentOriginal14b498b52c33a1421ff8895e4557790f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal14b498b52c33a1421ff8895e4557790f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.post-card','data' => ['post' => $post]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('post-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['post' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal14b498b52c33a1421ff8895e4557790f)): ?>
<?php $attributes = $__attributesOriginal14b498b52c33a1421ff8895e4557790f; ?>
<?php unset($__attributesOriginal14b498b52c33a1421ff8895e4557790f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal14b498b52c33a1421ff8895e4557790f)): ?>
<?php $component = $__componentOriginal14b498b52c33a1421ff8895e4557790f; ?>
<?php unset($__componentOriginal14b498b52c33a1421ff8895e4557790f); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-3 text-center py-24">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 mx-auto mb-8 rounded-full bg-cream-100 dark:bg-charcoal-800 flex items-center justify-center">
                                <svg class="w-12 h-12 text-charcoal-300 dark:text-charcoal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"></path>
                                </svg>
                            </div>
                            <h3 class="font-display text-3xl font-bold text-charcoal-900 dark:text-white mb-4">
                                Tidak ada artikel ditemukan
                            </h3>
                            <p class="text-lg text-charcoal-600 dark:text-charcoal-300 mb-8">
                                Coba ubah pencarian atau lihat semua artikel.
                            </p>
                            <a href="/posts"
                               class="inline-flex items-center px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Lihat semua artikel
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            
            <?php if($posts->hasPages()): ?>
                <div class="mt-16 flex justify-center">
                    <?php echo e($posts->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </section>
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
<?php /**PATH C:\laragon\www\project1\resources\views/posts.blade.php ENDPATH**/ ?>