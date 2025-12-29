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

    <section class="py-16 bg-cream-50 dark:bg-charcoal-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="font-display text-4xl font-bold text-charcoal-900 dark:text-white mb-2">
                    📚 My Favorites
                </h1>
                <p class="text-charcoal-600 dark:text-charcoal-300">
                    Artikel yang Anda simpan (<?php echo e($posts->total()); ?> artikel)
                </p>
            </div>

            <?php if($posts->count() > 0): ?>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <?php if($posts->hasPages()): ?>
                    <div class="mt-12">
                        <?php echo e($posts->links()); ?>

                    </div>
                <?php endif; ?>
            <?php else: ?>
                
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-charcoal-300 dark:text-charcoal-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                    <h3 class="font-display text-2xl font-bold text-charcoal-900 dark:text-white mb-2">
                        Belum Ada Favorit
                    </h3>
                    <p class="text-charcoal-600 dark:text-charcoal-400 mb-6 max-w-md mx-auto">
                        Anda belum menyimpan artikel apapun. Click icon bookmark (📑) pada artikel untuk menyimpannya.
                    </p>
                    <a href="/posts" class="inline-flex items-center px-6 py-3 rounded-lg bg-primary-600 hover:bg-primary-700 text-white font-semibold shadow-md hover:shadow-lg transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Jelajahi Artikel
                    </a>
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
<?php /**PATH C:\laragon\www\project1\resources\views/my-favorites.blade.php ENDPATH**/ ?>