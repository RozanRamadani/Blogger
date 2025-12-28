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
     <?php $__env->slot('title', null, []); ?> Daftar Pengguna <?php $__env->endSlot(); ?>

    
    <div class="bg-gradient-to-br from-primary-50 via-cream-50 to-secondary-50 dark:from-charcoal-900 dark:via-charcoal-800 dark:to-charcoal-900 py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-charcoal-900 dark:text-cream-50 mb-4">
                    Daftar Pengguna
                </h1>
                <p class="text-lg md:text-xl text-charcoal-600 dark:text-cream-200 mb-8">
                    Temukan penulis dan kontributor di platform kami
                </p>

            
            <form action="/users" method="GET" class="max-w-2xl mx-auto">
                <div class="relative flex gap-2">
                    <div class="flex-1 relative">
                        <input
                            type="search"
                            id="search"
                            name="search"
                            value="<?php echo e(request('search')); ?>"
                            placeholder="Cari berdasarkan nama, username, atau email..."
                            class="w-full pl-12 pr-4 py-4 text-charcoal-900 dark:text-cream-50 bg-white dark:bg-charcoal-800 border-2 border-charcoal-200 dark:border-charcoal-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all shadow-sm">
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-charcoal-400 dark:text-cream-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <button type="submit"
                            class="px-6 py-4 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all shadow-sm hover:shadow-md">
                        Cari
                    </button>
                    <?php if(request('search')): ?>
                        <a href="/users"
                           class="px-4 py-4 bg-charcoal-200 dark:bg-charcoal-700 hover:bg-charcoal-300 dark:hover:bg-charcoal-600 text-charcoal-700 dark:text-cream-100 rounded-xl transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
            </div>
        </div>
    </div>

    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <?php if(request('search')): ?>
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-charcoal-900 dark:text-cream-50">
                    Hasil pencarian "<?php echo e(request('search')); ?>"
                </h2>
                <p class="text-charcoal-600 dark:text-cream-200 mt-1">
                    Ditemukan <?php echo e($users->total()); ?> pengguna
                </p>
            </div>
        <?php endif; ?>

        <?php if($users->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/posts?author=<?php echo e($user->username); ?>"
                       class="group bg-white dark:bg-charcoal-800 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-charcoal-100 dark:border-charcoal-700 hover:border-primary-300 dark:hover:border-primary-600">
                        <div class="p-6">
                            
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-charcoal-900 dark:text-cream-50 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors truncate">
                                        <?php echo e($user->name); ?>

                                    </h3>
                                    <p class="text-sm text-charcoal-600 dark:text-cream-300 truncate">
                                        <?php echo e($user->username); ?>

                                    </p>
                                </div>
                            </div>

                            
                            <div class="flex items-center gap-4 pt-4 border-t border-charcoal-100 dark:border-charcoal-700">
                                <div class="flex items-center gap-2 text-charcoal-600 dark:text-cream-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="text-sm">
                                        <span class="font-semibold text-charcoal-900 dark:text-cream-50"><?php echo e($user->posts->count()); ?></span> artikel
                                    </span>
                                </div>
                                <?php if($user->email): ?>
                                    <div class="flex items-center gap-2 text-charcoal-600 dark:text-cream-300 truncate">
                                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm truncate"><?php echo e(Str::limit($user->email, 20)); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            
                            <div class="mt-4">
                                <div class="inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 group-hover:gap-3 transition-all">
                                    <span class="text-sm font-semibold">Lihat Artikel</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <?php if($users->hasPages()): ?>
                <div class="mt-12">
                    <?php echo e($users->links()); ?>

                </div>
            <?php endif; ?>
        <?php else: ?>
            
            <div class="text-center py-16">
                <div class="inline-block p-6 bg-charcoal-100 dark:bg-charcoal-800 rounded-full mb-4">
                    <svg class="w-16 h-16 text-charcoal-400 dark:text-cream-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-charcoal-900 dark:text-cream-50 mb-2">
                    Tidak ada pengguna yang ditemukan
                </h3>
                <p class="text-charcoal-600 dark:text-cream-200">
                    <?php if(request('search')): ?>
                        Coba gunakan kata kunci yang berbeda
                    <?php else: ?>
                        Belum ada pengguna terdaftar
                    <?php endif; ?>
                </p>
                <?php if(request('search')): ?>
                    <a href="/users" class="inline-block mt-4 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-xl transition-all">
                        Lihat Semua Pengguna
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
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
<?php /**PATH C:\laragon\www\project1\resources\views/users.blade.php ENDPATH**/ ?>