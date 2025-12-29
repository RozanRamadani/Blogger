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

    
    <section class="relative bg-white dark:bg-charcoal-900 overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
            <div class="text-center space-y-6">
                <h1 class="font-display text-4xl md:text-6xl lg:text-7xl font-bold text-charcoal-900 dark:text-white leading-tight">
                    Selamat Datang di <br>
                    <span class="text-primary-600 dark:text-primary-400">Blogger</span>
                </h1>
                <p class="text-lg md:text-xl text-charcoal-600 dark:text-charcoal-300 max-w-2xl mx-auto leading-relaxed">
                    Tempat berbagi pikiran, pengalaman, dan cerita seputar kehidupan sehari-hari, teknologi, dan hal menarik lainnya.
                </p>
                <div class="pt-4">
                    <a href="/posts"
                       class="inline-flex items-center px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                        Baca Artikel
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    
    <section class="py-16 bg-cream-50 dark:bg-charcoal-950">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-display text-3xl md:text-4xl font-bold text-charcoal-900 dark:text-white mb-3">
                    Kategori
                </h2>
                <p class="text-charcoal-600 dark:text-charcoal-300">
                    Temukan artikel berdasarkan topik yang Anda minati
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="/categories/<?php echo e($category->slug); ?>"
                       class="group bg-white dark:bg-charcoal-800 rounded-lg p-6 hover:shadow-lg transition-all duration-200 border border-charcoal-100 dark:border-charcoal-700 hover:border-primary-300 dark:hover:border-primary-600">
                        <div class="text-center">
                            <div class="w-12 h-12 mx-auto rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400 font-bold text-lg mb-3 group-hover:scale-110 transition-transform">
                                <?php echo e(strtoupper(substr($category->name, 0, 1))); ?>

                            </div>
                            <h3 class="font-semibold text-charcoal-900 dark:text-white mb-1 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                <?php echo e($category->name); ?>

                            </h3>
                            <p class="text-sm text-charcoal-500 dark:text-charcoal-400">
                                <?php echo e($category->posts->count()); ?> artikel
                            </p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    
    <?php if(auth()->guard()->check()): ?>
    <section class="py-12 bg-white dark:bg-charcoal-900">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-4 mb-8">
                <div class="w-14 h-14 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold text-xl">
                    <?php echo e(strtoupper(substr(Auth::user()->name, 0, 1))); ?>

                </div>
                <div>
                    <h3 class="text-xl font-bold text-charcoal-900 dark:text-white">
                        Halo, <?php echo e(Auth::user()->name); ?>!
                    </h3>
                    <p class="text-charcoal-600 dark:text-charcoal-300">
                        <?php echo e(Auth::user()->username); ?>

                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-cream-50 dark:bg-charcoal-800 rounded-lg p-5 border border-charcoal-100 dark:border-charcoal-700">
                    <div class="text-3xl font-bold text-primary-600 dark:text-primary-400 mb-1">
                        <?php echo e(Auth::user()->posts()->count()); ?>

                    </div>
                    <div class="text-sm text-charcoal-600 dark:text-charcoal-300">Artikel Saya</div>
                </div>
                <div class="bg-cream-50 dark:bg-charcoal-800 rounded-lg p-5 border border-charcoal-100 dark:border-charcoal-700">
                    <div class="text-3xl font-bold text-primary-600 dark:text-primary-400 mb-1">
                        <?php echo e($categories->count()); ?>

                    </div>
                    <div class="text-sm text-charcoal-600 dark:text-charcoal-300">Kategori</div>
                </div>
                <div class="col-span-2">
                    <a href="/posts"
                       class="block bg-primary-600 hover:bg-primary-700 text-white rounded-lg p-5 text-center font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                        Lihat Semua Artikel →
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    
    <?php if(auth()->guard()->check()): ?>
    <section class="py-16 bg-cream-50 dark:bg-charcoal-950">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-charcoal-900 dark:text-white mb-8">
                Tulis Artikel Baru
            </h2>

            <form action="<?php echo e(route('articles.store')); ?>" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-charcoal-800 rounded-lg border border-charcoal-200 dark:border-charcoal-700 p-8" x-data="{ files: [] }"
                  @submit="const dt = new DataTransfer(); files.forEach(f => dt.items.add(f)); $el.querySelector('#imgInput').files = dt.files;">
                <?php echo csrf_field(); ?>

                <?php if($errors->any()): ?>
                    <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
                        <ul class="space-y-1 text-sm text-red-800 dark:text-red-200">
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

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-300 mb-2">
                            Judul
                        </label>
                        <input type="text"
                               name="title"
                               required
                               value="<?php echo e(old('title')); ?>"
                               class="w-full px-4 py-3 rounded-lg border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                               placeholder="Masukkan judul artikel...">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-300 mb-2">
                            Konten
                        </label>
                        <textarea name="body"
                                  rows="8"
                                  required
                                  class="w-full px-4 py-3 rounded-lg border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all resize-none"
                                  placeholder="Tulis cerita Anda..."><?php echo e(old('body')); ?></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-300 mb-2">
                                Kategori
                            </label>
                            <select name="category_id"
                                    required
                                    class="w-full px-4 py-3 rounded-lg border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                <option value="">Pilih kategori</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-300 mb-2">
                                Tags
                                <span class="text-xs font-normal text-charcoal-500">- Pilih beberapa tags (optional)</span>
                            </label>
                            <select name="tags[]" multiple
                                    class="w-full px-4 py-3 rounded-lg border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all"
                                    style="height: 120px;">
                                <?php $__currentLoopData = App\Models\Tag::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tag->id); ?>" <?php echo e(in_array($tag->id, old('tags', [])) ? 'selected' : ''); ?>>
                                        <?php echo e($tag->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <p class="text-xs text-charcoal-500 dark:text-charcoal-400 mt-1">Hold Ctrl (Cmd di Mac) untuk pilih multiple tags</p>
                        </div>
                    </div>

                    
                    <div>
                        <input type="file" id="imgInput" name="images[]" accept="image/*" multiple class="hidden"
                               @change="Array.from($event.target.files).forEach(f => files.push(f)); $event.target.value = '';">

                        <label class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-300 mb-2">
                            Gambar Artikel
                            <span class="text-xs font-normal text-charcoal-500">- Klik "Pilih Gambar" untuk menambahkan gambar, max 2MB per gambar</span>
                        </label>

                        <div x-show="files.length" class="mb-4">
                            <p class="text-xs font-medium text-charcoal-600 dark:text-charcoal-300 mb-2">Gambar (<span x-text="files.length"></span>):</p>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <template x-for="(file, i) in files" :key="i">
                                    <div class="relative group rounded-lg overflow-hidden shadow-md bg-charcoal-100 dark:bg-charcoal-700">
                                        <img :src="URL.createObjectURL(file)" class="w-full h-32 object-cover">
                                        <button type="button" @click="files.splice(i, 1)"
                                                class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                        <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-xs p-1 truncate" x-text="file.name"></div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        
                        <div class="flex gap-2">
                            <button type="button" @click="$el.closest('div').parentElement.querySelector('#imgInput').click()"
                                    class="inline-flex items-center px-4 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Pilih Gambar
                                <span x-show="files.length" x-text="' (' + files.length + ')'" class="ml-1"></span>
                            </button>

                            <span x-show="files.length" class="text-sm text-charcoal-500 dark:text-charcoal-400 flex items-center">
                                Total: <span x-text="files.length" class="font-semibold mx-1"></span> gambar
                            </span>
                        </div>
                    </div>
                    </div>

                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-300 mb-2">
                                Status Artikel
                            </label>
                            <select name="status" id="status" required
                                    onchange="document.getElementById('publishDateField').style.display = this.value === 'scheduled' ? 'block' : 'none'"
                                    class="w-full px-4 py-3 rounded-lg border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                <option value="published" <?php echo e(old('status', 'published') === 'published' ? 'selected' : ''); ?>>Publish Now</option>
                                <option value="draft" <?php echo e(old('status') === 'draft' ? 'selected' : ''); ?>>Save as Draft</option>
                                <option value="scheduled" <?php echo e(old('status') === 'scheduled' ? 'selected' : ''); ?>>Schedule for Later</option>
                            </select>
                        </div>

                        <div id="publishDateField" style="display: <?php echo e(old('status') === 'scheduled' ? 'block' : 'none'); ?>">
                            <label class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-300 mb-2">
                                Publish Date & Time
                            </label>
                            <input type="datetime-local" name="published_at" value="<?php echo e(old('published_at')); ?>"
                                   min="<?php echo e(now()->format('Y-m-d\TH:i')); ?>"
                                   class="w-full px-4 py-3 rounded-lg border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="submit"
                                class="inline-flex items-center px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                            <span id="submitText">Publikasikan</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                    </div>

                    <script>
                        // Update submit button text based on status
                        document.getElementById('status').addEventListener('change', function() {
                            const submitText = document.getElementById('submitText');
                            if (this.value === 'draft') {
                                submitText.textContent = 'Simpan Draft';
                            } else if (this.value === 'scheduled') {
                                submitText.textContent = 'Jadwalkan';
                            } else {
                                submitText.textContent = 'Publikasikan';
                            }
                        });
                    </script>
                </div>
            </form>
        </div>
    </section>
    <?php endif; ?>
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
<?php /**PATH C:\laragon\www\project1\resources\views/home.blade.php ENDPATH**/ ?>