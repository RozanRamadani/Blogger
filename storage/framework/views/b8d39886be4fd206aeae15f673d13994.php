<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['post']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['post']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $displayImage = null;
    $galleryCount = 0;
    if ($post->images && is_array($post->images) && count($post->images) > 0) {
        $displayImage = $post->images[0];
        $galleryCount = count($post->images);
    } elseif ($post->image) {
        $displayImage = $post->image;
    }
?>

<article <?php echo e($attributes->merge(['class' => 'group bg-white dark:bg-charcoal-800 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-charcoal-200 dark:border-charcoal-700'])); ?>>
    <?php if($displayImage): ?>
        <a href="/posts/<?php echo e($post->slug); ?>" class="block overflow-hidden relative">
            <img
                src="<?php echo e(asset('storage/' . $displayImage)); ?>"
                alt="<?php echo e($post->title); ?>"
                loading="lazy"
                class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-500">
            <?php if($galleryCount > 0): ?>
                <div class="absolute top-2 right-2 bg-black/70 text-white text-xs px-2 py-1 rounded-full flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <?php echo e($galleryCount); ?>

                </div>
            <?php endif; ?>
        </a>
    <?php endif; ?>

    <div class="p-6">
        <div class="flex items-center justify-between mb-3">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300">
                <?php echo e($post->category->name); ?>

            </span>
            <span class="text-sm text-charcoal-500 dark:text-charcoal-400">
                <?php echo e($post->created_at->diffForHumans()); ?>

            </span>
        </div>

        <a href="/posts/<?php echo e($post->slug); ?>">
            <h3 class="text-xl font-bold text-charcoal-900 dark:text-white mb-3 leading-tight group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">
                <?php echo e($post->title); ?>

            </h3>
        </a>

        <p class="text-charcoal-600 dark:text-charcoal-300 mb-4 leading-relaxed line-clamp-3 text-sm">
            <?php echo e(Str::limit($post->body, 120)); ?>

        </p>

        <?php if($post->tags && $post->tags->count() > 0): ?>
            <div class="flex flex-wrap gap-1.5 mb-4">
                <?php $__currentLoopData = $post->tags->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/posts?tag=<?php echo e($tag->slug); ?>"
                       class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium transition-colors"
                       style="background-color: <?php echo e($tag->color); ?>15; color: <?php echo e($tag->color); ?>; border: 1px solid <?php echo e($tag->color); ?>30;"
                       title="<?php echo e($tag->name); ?>">
                        #<?php echo e($tag->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($post->tags->count() > 3): ?>
                    <span class="inline-flex items-center px-2 py-0.5 text-xs text-charcoal-500 dark:text-charcoal-400">
                        +<?php echo e($post->tags->count() - 3); ?>

                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="flex items-center justify-between pt-4 border-t border-charcoal-200 dark:border-charcoal-700">
            <a href="/posts?author=<?php echo e($post->author->username); ?>" class="flex items-center space-x-2 group/author">
                <div class="w-8 h-8 rounded-full bg-primary-600 flex items-center justify-center text-white text-xs font-semibold">
                    <?php echo e(strtoupper(substr($post->author->name, 0, 1))); ?>

                </div>
                <span class="text-sm font-medium text-charcoal-700 dark:text-charcoal-200 group-hover/author:text-primary-600 dark:group-hover/author:text-primary-400 transition-colors">
                    <?php echo e($post->author->name); ?>

                </span>
            </a>

            <div class="flex items-center gap-3">
                <span class="inline-flex items-center text-xs text-charcoal-500 dark:text-charcoal-400" title="<?php echo e(number_format($post->views_count)); ?> views">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <?php echo e($post->views_count >= 1000 ? number_format($post->views_count / 1000, 1) . 'k' : $post->views_count); ?>

                </span>

                <?php if(auth()->guard()->check()): ?>
                    
                    <button
                        onclick="toggleLike(<?php echo e($post->id); ?>, '<?php echo e($post->slug); ?>')"
                        id="like-btn-<?php echo e($post->id); ?>"
                        class="inline-flex items-center text-xs transition-colors <?php echo e($post->isLikedBy(auth()->user()) ? 'text-red-500' : 'text-charcoal-500 dark:text-charcoal-400 hover:text-red-500'); ?>"
                        title="<?php echo e($post->isLikedBy(auth()->user()) ? 'Unlike' : 'Like'); ?>">
                        <svg class="w-4 h-4 mr-1 <?php echo e($post->isLikedBy(auth()->user()) ? 'fill-current' : ''); ?>" fill="<?php echo e($post->isLikedBy(auth()->user()) ? 'currentColor' : 'none'); ?>" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span id="likes-count-<?php echo e($post->id); ?>"><?php echo e($post->likes()->count()); ?></span>
                    </button>

                    
                    <button
                        onclick="toggleBookmark(<?php echo e($post->id); ?>, '<?php echo e($post->slug); ?>')"
                        id="bookmark-btn-<?php echo e($post->id); ?>"
                        class="inline-flex items-center text-xs transition-colors <?php echo e($post->isBookmarkedBy(auth()->user()) ? 'text-yellow-500' : 'text-charcoal-500 dark:text-charcoal-400 hover:text-yellow-500'); ?>"
                        title="<?php echo e($post->isBookmarkedBy(auth()->user()) ? 'Remove bookmark' : 'Bookmark'); ?>">
                        <svg class="w-4 h-4 <?php echo e($post->isBookmarkedBy(auth()->user()) ? 'fill-current' : ''); ?>" fill="<?php echo e($post->isBookmarkedBy(auth()->user()) ? 'currentColor' : 'none'); ?>" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </button>
                <?php endif; ?>

                <a href="/posts/<?php echo e($post->slug); ?>"
                   class="inline-flex items-center text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                    Baca
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $post)): ?>
                    <a href="<?php echo e(route('articles.edit', $post->slug)); ?>"
                       class="p-2 text-charcoal-500 dark:text-charcoal-400 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-cream-50 dark:hover:bg-charcoal-700 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>
<?php /**PATH C:\laragon\www\project1\resources\views/components/post-card.blade.php ENDPATH**/ ?>