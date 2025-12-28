<?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css', 'resources/js/app.js'); ?>
<section class="min-h-screen bg-gradient-to-br from-cream-50 to-white dark:from-charcoal-950 dark:to-charcoal-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen">
        <div class="w-full bg-white dark:bg-charcoal-800 rounded-2xl shadow-xl border border-charcoal-200 dark:border-charcoal-700 md:mt-0 sm:max-w-md xl:p-0">
            <div class="p-8 space-y-6">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-primary-600 rounded-xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-charcoal-900 dark:text-white mb-2">
                        Selamat Datang Kembali
                    </h1>
                    <p class="text-charcoal-600 dark:text-charcoal-300">
                        Masuk untuk melanjutkan
                    </p>
                </div>

                <form method="POST" class="space-y-5" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php if($errors->any()): ?>
                        <div class="bg-red-50 dark:bg-red-900/30 border-2 border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-xl" role="alert">
                            <ul class="space-y-1 text-sm">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                        <?php echo e($error); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if(session('status')): ?>
                        <div class="bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 text-primary-800 dark:text-primary-200 px-4 py-3 rounded-lg" role="alert">
                            <p class="text-sm"><?php echo e(session('status')); ?></p>
                        </div>
                    <?php endif; ?>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-charcoal-700 dark:text-charcoal-200">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>"
                            class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                            placeholder="nama@email.com" required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-charcoal-700 dark:text-charcoal-200">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                            required>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" name="remember" type="checkbox"
                                    class="w-4 h-4 border-2 border-charcoal-300 dark:border-charcoal-600 rounded bg-white dark:bg-charcoal-800 focus:ring-2 focus:ring-primary-500 text-primary-600">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember" class="text-charcoal-600 dark:text-charcoal-300">Ingat saya</label>
                            </div>
                        </div>
                        <a href="/forgot-password" class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                            Lupa password?
                        </a>
                    </div>

                    <button type="submit"
                        class="w-full py-3 px-5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                        Masuk
                    </button>

                    <p class="text-sm text-center text-charcoal-600 dark:text-charcoal-400">
                        Belum punya akun?
                        <a href="/register" class="font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                            Daftar sekarang
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
<?php /**PATH C:\laragon\www\project1\resources\views/login.blade.php ENDPATH**/ ?>