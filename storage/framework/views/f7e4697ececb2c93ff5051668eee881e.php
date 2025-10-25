
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

    <div class="max-w-2xl mx-auto p-4">
        <!-- Profile Card -->
        <div class="bg-gradient-to-r from-blue-100 via-purple-100 to-pink-100 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 rounded-xl shadow-lg p-6 mb-8 flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-blue-500 flex items-center justify-center text-white text-2xl font-bold shadow-lg border-4 border-white dark:border-gray-700">
                <?php echo e(strtoupper(substr(Auth::user()->name, 0, 2))); ?>

            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-1"><?php echo e(Auth::user()->name); ?></h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm">Username: <span class="font-semibold"><?php echo e(Auth::user()->username); ?></span></p>
                <p class="text-gray-600 dark:text-gray-300 text-sm">Email: <span class="font-semibold"><?php echo e(Auth::user()->email); ?></span></p>
            </div>
        </div>

        <!-- Welcome Message -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold mb-2">Welcome to My App</h1>
            <p class="text-gray-600">A simple social platform. Share your thoughts and connect!</p>
        </div>

        <!-- Quick Stats -->
        <div class="flex justify-between gap-4 mb-8">
            <div class="flex-1 bg-white dark:bg-gray-800 rounded-lg shadow p-4 text-center">
                <div class="text-lg font-bold text-blue-600 dark:text-blue-400"><?php echo e(Auth::user()->posts()->count()); ?></div>
                <div class="text-sm text-gray-500 dark:text-gray-300">Your Posts</div>
            </div>
            <div class="flex-1 bg-white dark:bg-gray-800 rounded-lg shadow p-4 text-center">
                <div class="text-lg font-bold text-purple-600 dark:text-purple-400"><?php echo e($categories->count()); ?></div>
                <div class="text-sm text-gray-500 dark:text-gray-300">Categories</div>
            </div>
        </div>

        <!-- Category List -->
        <div class="mb-8">
            <h2 class="text-lg font-bold mb-3 text-gray-800 dark:text-white">Explore Categories</h2>
            <div class="flex flex-wrap gap-2">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/categories/<?php echo e($category->slug); ?>"
                        class="px-4 py-2 rounded-lg bg-<?php echo e($category->color); ?>-200 dark:bg-<?php echo e($category->color); ?>-900 text-<?php echo e($category->color); ?>-800 dark:text-<?php echo e($category->color); ?>-200 font-semibold shadow hover:scale-105 transition">
                        <?php echo e($category->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Simple Post Form -->
    <form action="<?php echo e(route('articles.store')); ?>" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 mb-6">
            <?php echo csrf_field(); ?>
            <?php if($errors->any()): ?>
                <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
                    <ul class="list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                <input type="text" name="title" id="title" value="<?php echo e(old('title')); ?>"
                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500"
                    placeholder="Article title" required>
                <?php $__errorArgs = ['title'];
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
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                <select name="category_id" id="category_id" value="<?php echo e(old('category_id')); ?>"
                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500"
                    required>
                    <option value="">-- Select Category --</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['category_id'];
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
            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Content</label>
                <textarea name="body" id="body" rows="5"
                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500"
                    placeholder="Write your article here..." required><?php echo e(old('body')); ?></textarea>
                <?php $__errorArgs = ['body'];
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
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Image (optional)</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500">
                <?php $__errorArgs = ['image'];
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
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Submit Article
            </button>
        </form>
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
<?php endif; ?><?php /**PATH C:\laragon\www\project1\resources\views/home.blade.php ENDPATH**/ ?>