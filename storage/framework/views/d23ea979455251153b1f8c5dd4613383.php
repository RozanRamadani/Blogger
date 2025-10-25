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

    
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:px-6 animate-fade-in">
        <div class="mx-auto max-w-screen-md sm:text-center mb-8">
            <form>
                <?php if(request('category')): ?>
                    <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
                <?php endif; ?>
                <?php if(request('author')): ?>
                    <input type="hidden" name="author" value="<?php echo e(request('author')); ?>">
                <?php endif; ?>
                <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                    <div class="relative w-full">
                        <label for="search" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Search</label>
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input
                            class="block p-3 pl-10 w-full text-sm text-gray-900 bg-white dark:bg-gray-800 rounded-lg border border-gray-300 dark:border-gray-700 sm:rounded-none sm:rounded-l-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 dark:text-white dark:placeholder-gray-400 transition-all duration-300"
                            placeholder="Search for articles..." type="search" id="search" name="search" value="<?php echo e(request('search')); ?>">
                    </div>
                    <div>
                        <button type="submit"
                            class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 sm:rounded-none sm:rounded-r-lg hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 focus:ring-4 focus:ring-primary-300 transition-all duration-300 transform hover:scale-105">
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    <div class="mb-6 pagination-controls">
        <?php echo e($posts->links()); ?>

    </div>

    
    <div class="py-4 px-4 mx-auto max-w-screen-xl lg:py-4 lg:px-0">
        <div id="posts-container" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article
                    data-aos="fade-up"
                    data-aos-delay="<?php echo e($index * 50); ?>"
                    class="group relative p-6 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden">
                    
                    
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 via-purple-500/5 to-pink-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    
                    
                    <?php if($post->image): ?>
                        <div class="relative mb-4 -mx-6 -mt-6 overflow-hidden rounded-t-2xl">
                            <img 
                                src="<?php echo e(asset('storage/' . $post->image)); ?>" 
                                alt="<?php echo e($post->title); ?>"
                                loading="lazy"
                                class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-700"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </div>
                    <?php endif; ?>

                    
                    <div class="flex justify-between items-center mb-4 text-gray-500 relative z-10">
                        <a href="/posts?category=<?php echo e($post->category->slug); ?>" class="group/cat">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold bg-<?php echo e($post->category->color); ?>-100 dark:bg-<?php echo e($post->category->color); ?>-900 text-<?php echo e($post->category->color); ?>-800 dark:text-<?php echo e($post->category->color); ?>-200 shadow-sm hover:shadow-md transition-all duration-300 transform group-hover/cat:scale-110">
                                <?php echo e($post->category->name); ?>

                            </span>
                        </a>
                        <span class="text-sm text-gray-500 dark:text-gray-400"><?php echo e($post->created_at->diffForHumans()); ?></span>
                    </div>

                    
                    <a href="/posts/<?php echo e($post['slug']); ?>" class="relative z-10">
                        <h2
                            class="mb-3 text-2xl font-bold tracking-tight text-gray-900 dark:text-white group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:via-purple-600 group-hover:to-pink-600 transition-all duration-300">
                            <?php echo e($post->title); ?>

                        </h2>
                    </a>

                    
                    <p class="mb-5 font-light text-gray-600 dark:text-gray-400 line-clamp-3 relative z-10">
                        <?php echo e(Str::limit($post->body, 120)); ?>

                    </p>

                    
                    <div class="flex justify-between items-center relative z-10">
                        <a href="/posts?author=<?php echo e($post->author->username); ?>" class="group/author">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white font-semibold text-sm transform group-hover/author:scale-110 transition-transform duration-300 shadow-md">
                                    <?php echo e(strtoupper(substr($post->author->name, 0, 2))); ?>

                                </div>
                                <span class="font-medium text-sm dark:text-white group-hover/author:text-primary-600 dark:group-hover/author:text-primary-400 transition-colors">
                                    <?php echo e($post->author->name); ?>

                                </span>
                            </div>
                        </a>

                        <div class="flex items-center gap-2">
                            <a href="/posts/<?php echo e($post['slug']); ?>"
                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                                Read
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $post)): ?>
                                <a href="<?php echo e(route('articles.edit', $post->slug)); ?>"
                                    class="inline-flex items-center text-sm px-3 py-1.5 rounded-lg bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 hover:bg-yellow-200 dark:hover:bg-yellow-800 transition-colors duration-300">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-3 text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"></path>
                    </svg>
                    <p class="text-center font-semibold text-xl mb-2 text-gray-600 dark:text-gray-400">No posts found.</p>
                    <a href="/posts" class="inline-block text-primary-600 dark:text-primary-400 hover:underline my-2">&laquo; Back to all posts</a>
                </div>
            <?php endif; ?>
        </div>

        
        <div id="loading-indicator" class="hidden">
            <div class="flex justify-center items-center py-8">
                <div class="flex items-center gap-3">
                    <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400 font-medium">Loading more posts...</span>
                </div>
            </div>
        </div>

        
        <div id="end-message" class="hidden text-center py-8">
            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-gray-600 dark:text-gray-400 font-medium">🎉 You've reached the end!</p>
            <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">No more posts to load</p>
        </div>
    </div>

    
    <div class="mt-8 pagination-controls">
        <?php echo e($posts->links()); ?>

    </div>

    <?php $__env->startPush('scripts'); ?>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50,
        });

        // Hide pagination controls when infinite scroll is active
        document.addEventListener('DOMContentLoaded', function() {
            const paginationControls = document.querySelectorAll('.pagination-controls');
            if (document.getElementById('posts-container')) {
                paginationControls.forEach(el => el.style.display = 'none');
            }
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
<?php /**PATH C:\laragon\www\project1\resources\views/posts.blade.php ENDPATH**/ ?>