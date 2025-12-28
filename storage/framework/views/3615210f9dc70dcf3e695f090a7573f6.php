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
     <?php $__env->slot('title', null, []); ?> Kontak <?php $__env->endSlot(); ?>

    
    <section class="relative bg-gradient-to-br from-cream-50 to-white dark:from-charcoal-950 dark:to-charcoal-900 border-b border-charcoal-200 dark:border-charcoal-700 py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-charcoal-900 dark:text-white mb-4 leading-tight">
                Hubungi <span class="text-primary-600 dark:text-primary-400">Kami</span>
            </h1>
            <p class="text-xl text-charcoal-600 dark:text-charcoal-300 max-w-2xl mx-auto leading-relaxed">
                Ada pertanyaan, saran, atau ingin berkolaborasi? Kami siap mendengarkan Anda.
            </p>
        </div>
    </section>

    
    <section class="py-16 bg-white dark:bg-charcoal-900">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12">
                
                <div class="space-y-6">
                    <div>
                        <h2 class="text-3xl font-bold text-charcoal-900 dark:text-white mb-4">
                            Mari Berdiskusi
                        </h2>
                        <p class="text-base text-charcoal-600 dark:text-charcoal-300 leading-relaxed mb-6">
                            Apakah Anda memiliki pertanyaan tentang konten kami, ingin berkontribusi, atau sekadar ingin menyapa,
                            kami siap merespons dalam waktu 24-48 jam.
                        </p>
                    </div>

                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-4 p-5 rounded-lg bg-cream-50 dark:bg-charcoal-800 border border-charcoal-200 dark:border-charcoal-700">
                            <div class="w-12 h-12 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-charcoal-900 dark:text-white mb-1">Email Kami</h3>
                                <p class="text-charcoal-600 dark:text-charcoal-300 text-sm">kontak@blogpribadi.com</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-5 rounded-lg bg-cream-50 dark:bg-charcoal-800 border border-charcoal-200 dark:border-charcoal-700">
                            <div class="w-12 h-12 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-charcoal-900 dark:text-white mb-1">Waktu Respons</h3>
                                <p class="text-charcoal-600 dark:text-charcoal-300 text-sm">Dalam 24-48 jam</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-5 rounded-lg bg-cream-50 dark:bg-charcoal-800 border border-charcoal-200 dark:border-charcoal-700">
                            <div class="w-12 h-12 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-charcoal-900 dark:text-white mb-1">Terhubung</h3>
                                <p class="text-charcoal-600 dark:text-charcoal-300 text-sm">Ikuti kami di media sosial</p>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div>
                    <?php if(session('success')): ?>
                        <div class="mb-6 p-5 rounded-lg bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 flex items-start gap-4">
                            <div class="w-8 h-8 rounded-lg bg-green-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-green-900 dark:text-green-200 mb-1">Berhasil!</h4>
                                <p class="text-green-800 dark:text-green-300"><?php echo e(session('success')); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(route('kontak.send')); ?>" class="bg-cream-50 dark:bg-charcoal-800 rounded-2xl shadow-lg border border-charcoal-200 dark:border-charcoal-700 p-8">
                        <?php echo csrf_field(); ?>

                        <div class="space-y-5">
                            <div>
                                <label for="name" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">
                                    Nama Anda *
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="<?php echo e(old('name')); ?>"
                                       class="w-full px-4 py-3 rounded-lg border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white placeholder-charcoal-400 dark:placeholder-charcoal-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                       placeholder="Nama Lengkap"
                                       required>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <?php echo e($message); ?>

                                    </p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">
                                    Alamat Email *
                                </label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       value="<?php echo e(old('email')); ?>"
                                       class="w-full px-4 py-3 rounded-lg border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white placeholder-charcoal-400 dark:placeholder-charcoal-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                       placeholder="nama@email.com"
                                       required>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <?php echo e($message); ?>

                                    </p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">
                                    Pesan Anda *
                                </label>
                                <textarea name="message"
                                          id="message"
                                          rows="6"
                                          class="w-full px-4 py-3 rounded-lg border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white placeholder-charcoal-400 dark:placeholder-charcoal-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all resize-none"
                                          placeholder="Tulis pesan Anda di sini..."
                                          required><?php echo e(old('message')); ?></textarea>
                                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        <?php echo e($message); ?>

                                    </p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <button type="submit"
                                class="w-full py-3 px-6 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Pesan
                            </button>
                        </div>
                    </form>

                    <p class="text-center text-sm text-charcoal-500 dark:text-charcoal-400 mt-6">
                        Kami menghormati privasi Anda dan tidak akan membagikan informasi Anda kepada pihak ketiga.
                    </p>
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
<?php /**PATH C:\laragon\www\project1\resources\views/kontak.blade.php ENDPATH**/ ?>