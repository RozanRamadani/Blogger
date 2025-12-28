
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
     <?php $__env->slot('title', null, []); ?> Tentang Saya <?php $__env->endSlot(); ?>

    
    <section class="relative bg-gradient-to-br from-cream-50 to-white dark:from-charcoal-950 dark:to-charcoal-900 border-b border-charcoal-200 dark:border-charcoal-700 py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-charcoal-900 dark:text-white mb-4 leading-tight">
                    Tentang <span class="text-primary-600 dark:text-primary-400">Saya</span>
                </h1>
                <p class="text-xl text-charcoal-600 dark:text-charcoal-300 max-w-2xl mx-auto">
                    Penulis, kreator konten, dan storyteller digital
                </p>
            </div>
        </div>
    </section>

    
    <section class="py-16 bg-white dark:bg-charcoal-900">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <div class="flex flex-col items-center lg:items-start text-center lg:text-left">
                    <div class="relative mb-6">
                        <?php if(Auth::user()->profile_photo): ?>
                            <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo)); ?>" alt="<?php echo e(Auth::user()->name); ?>" class="w-40 h-40 rounded-2xl object-cover shadow-xl border-4 border-primary-200 dark:border-primary-800">
                        <?php else: ?>
                            <div class="w-40 h-40 rounded-2xl bg-primary-600 flex items-center justify-center text-white text-5xl font-bold shadow-xl">
                                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 2))); ?>

                            </div>
                        <?php endif; ?>
                        <div class="absolute -bottom-3 -right-3 w-12 h-12 rounded-full bg-green-500 flex items-center justify-center shadow-lg border-4 border-white dark:border-charcoal-900">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>

                    <h2 class="text-3xl md:text-4xl font-bold text-charcoal-900 dark:text-white mb-4">
                        <?php echo e(Auth::user()->name); ?>

                    </h2>

                    <div class="space-y-2 mb-6">
                        <div class="flex items-center justify-center lg:justify-start gap-2 text-charcoal-600 dark:text-charcoal-300">
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="font-medium"><?php echo e(Auth::user()->username); ?></span>
                        </div>
                        <div class="flex items-center justify-center lg:justify-start gap-2 text-charcoal-600 dark:text-charcoal-300">
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span><?php echo e(Auth::user()->email); ?></span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3 justify-center lg:justify-start">
                        <a href="<?php echo e(route('profile.edit')); ?>"
                            class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Profil
                        </a>
                        <span class="inline-flex items-center px-5 py-3 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 font-medium border border-green-200 dark:border-green-800">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Aktif
                        </span>
                    </div>
                </div>

                
                <div class="space-y-6">
                    <div>
                        <h3 class="text-2xl font-bold text-charcoal-900 dark:text-white mb-4">
                            Selamat Datang di Profil Saya
                        </h3>
                        <div class="space-y-3 text-base text-charcoal-600 dark:text-charcoal-300 leading-relaxed">
                            <p>
                                Ini adalah halaman profil pribadi Anda dimana Anda dapat menampilkan kepribadian, minat, dan karya kreatif Anda.
                                Bagikan cerita Anda, terhubung dengan pembaca, dan bangun kehadiran online Anda.
                            </p>
                            <p>
                                Sebagai kreator konten, Anda memiliki kekuatan untuk menginspirasi, mendidik, dan menghibur melalui tulisan Anda.
                                Setiap artikel yang Anda publikasikan berkontribusi pada portofolio pemikiran dan keahlian Anda.
                            </p>
                        </div>
                    </div>

                    
                    <div>
                        <h4 class="font-semibold text-sm uppercase tracking-wider text-charcoal-500 dark:text-charcoal-400 mb-3">
                            Minat & Keahlian
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 hover:bg-primary-100 dark:hover:bg-primary-900/45 transition-colors">
                                Teknologi
                            </span>
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 hover:bg-primary-100 dark:hover:bg-primary-900/45 transition-colors">
                                Tailwind CSS
                            </span>
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 hover:bg-primary-100 dark:hover:bg-primary-900/45 transition-colors">
                                Web Developer
                            </span>
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide border border-primary-200 dark:border-primary-800 bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 hover:bg-primary-100 dark:hover:bg-primary-900/45 transition-colors">
                                Content Creator
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-16 bg-cream-50 dark:bg-charcoal-950 border-y border-charcoal-100 dark:border-charcoal-800">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-5xl font-display font-bold text-primary-600 dark:text-primary-400 mb-2">
                        <?php echo e(Auth::user()->posts()->count()); ?>

                    </div>
                    <div class="text-lg font-semibold text-charcoal-600 dark:text-charcoal-300">
                        Artikel Terbit
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-display font-bold text-primary-500 dark:text-primary-300 mb-2">
                        <?php echo e(Auth::user()->created_at->diffInDays(now())); ?>

                    </div>
                    <div class="text-lg font-semibold text-charcoal-600 dark:text-charcoal-300">
                        Hari Aktif
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-5xl font-display font-bold text-charcoal-700 dark:text-white mb-2">
                        <?php echo e(number_format(Auth::user()->posts()->sum('id') * 137)); ?>

                    </div>
                    <div class="text-lg font-semibold text-charcoal-600 dark:text-charcoal-300">
                        Perkiraan Tampilan
                    </div>
                </div>
            </div>
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
<?php /**PATH C:\laragon\www\project1\resources\views/about.blade.php ENDPATH**/ ?>