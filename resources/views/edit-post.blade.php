@php
    // filepath: resources/views/edit-post.blade.php
@endphp
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="py-16 bg-cream-50 dark:bg-charcoal-950">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="font-display text-4xl font-bold text-charcoal-900 dark:text-cream-50 mb-2">Edit Post</h1>
                <p class="text-charcoal-600 dark:text-cream-300">Update your article content</p>
            </div>

            <form action="{{ route('articles.update', $post->slug) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-charcoal-800 rounded-2xl shadow-xl border-2 border-charcoal-100 dark:border-charcoal-700 p-8 mb-6">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/30 border-2 border-red-200 dark:border-red-800">
                        <ul class="space-y-1 text-sm text-red-800 dark:text-red-200">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-semibold text-charcoal-700 dark:text-cream-200 mb-2">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                            class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-700 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                            placeholder="Article title" required>
                        @error('title')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-charcoal-700 dark:text-cream-200 mb-2">Category</label>
                        <select name="category_id" id="category_id"
                            class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-700 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                            required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="body" class="block text-sm font-semibold text-charcoal-700 dark:text-cream-200 mb-2">Content</label>
                        <textarea name="body" id="body" rows="10"
                            class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-700 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all resize-none"
                            placeholder="Write your article here..." required>{{ old('body', $post->body) }}</textarea>
                        @error('body')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-semibold text-charcoal-700 dark:text-cream-200 mb-2">Featured Image (optional)</label>
                        @if ($post->image)
                            <div class="mb-4 rounded-xl overflow-hidden shadow-md">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="post image" class="w-full h-auto">
                            </div>
                        @endif
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-700 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-terracotta-50 file:text-terracotta-700 hover:file:bg-terracotta-100 dark:file:bg-charcoal-700 dark:file:text-cream-200 focus:outline-none focus:ring-2 focus:ring-terracotta-500 transition-all">
                        @error('image')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-terracotta-600 hover:bg-terracotta-700 text-cream-50 font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Update Post
                        </button>
                        <a href="/posts/{{ $post->slug }}" class="inline-flex items-center px-6 py-3 bg-charcoal-200 dark:bg-charcoal-700 text-charcoal-700 dark:text-cream-200 hover:bg-charcoal-300 dark:hover:bg-charcoal-600 font-medium rounded-xl transition-colors">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

            <form action="{{ route('articles.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.');" class="bg-white dark:bg-charcoal-800 rounded-2xl shadow-xl border-2 border-red-200 dark:border-red-900/50 p-8">
                @csrf
                @method('DELETE')
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="font-display text-xl font-bold text-charcoal-900 dark:text-cream-50 mb-2">Danger Zone</h3>
                        <p class="text-charcoal-600 dark:text-cream-300">Once you delete this post, there is no going back. Please be certain.</p>
                    </div>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Post
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layout>
