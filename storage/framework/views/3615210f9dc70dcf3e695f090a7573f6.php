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
     <?php $__env->slot('title', null, []); ?> Contact Us <?php $__env->endSlot(); ?>

    <div
        class="max-w-2xl mx-auto mt-10 bg-gradient-to-br from-green-100 via-blue-100 to-purple-100 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-extrabold text-center text-gray-800 dark:text-white mb-6">Contact Us</h1>
        <p class="text-center text-gray-600 dark:text-gray-300 mb-8">
            Have questions, feedback, or want to collaborate? Fill out the form below and we'll get back to you soon!
        </p>
        <?php if(session('success')): ?>
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-center font-semibold shadow">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <form method="POST" action="<?php echo e(route('kontak.send')); ?>" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Your
                    Name</label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Enter your name" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Email
                    Address</label>
                <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Enter your email" required>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label for="message"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Message</label>
                <textarea name="message" id="message" rows="5"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Type your message..." required><?php echo e(old('message')); ?></textarea>
                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <button type="submit"
                class="w-full py-3 px-6 bg-gradient-to-r from-green-400 via-blue-400 to-purple-400 hover:from-green-500 hover:via-blue-500 hover:to-purple-500 text-white font-bold rounded-lg shadow-lg transition duration-150">
                Send Message
            </button>
        </form>
        <div class="mt-8 text-center text-gray-500 dark:text-gray-400">
            <span
                class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-green-200 via-blue-200 to-purple-200 dark:from-gray-700 dark:via-gray-800 dark:to-gray-700 text-sm font-semibold shadow">
                We'll respond as soon as possible!
            </span>
        </div>
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
<?php /**PATH C:\laragon\www\project1\resources\views/kontak.blade.php ENDPATH**/ ?>