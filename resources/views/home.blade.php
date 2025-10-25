{{-- filepath: c:\laragon\www\project1\resources\views\home.blade.php --}}
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="max-w-2xl mx-auto p-4">
        <!-- Profile Card -->
        <div class="bg-gradient-to-r from-blue-100 via-purple-100 to-pink-100 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 rounded-xl shadow-lg p-6 mb-8 flex items-center gap-4">
            <div class="w-16 h-16 rounded-full bg-blue-500 flex items-center justify-center text-white text-2xl font-bold shadow-lg border-4 border-white dark:border-gray-700">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-1">{{ Auth::user()->name }}</h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm">Username: <span class="font-semibold">{{ Auth::user()->username }}</span></p>
                <p class="text-gray-600 dark:text-gray-300 text-sm">Email: <span class="font-semibold">{{ Auth::user()->email }}</span></p>
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
                <div class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ Auth::user()->posts()->count() }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-300">Your Posts</div>
            </div>
            <div class="flex-1 bg-white dark:bg-gray-800 rounded-lg shadow p-4 text-center">
                <div class="text-lg font-bold text-purple-600 dark:text-purple-400">{{ $categories->count() }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-300">Categories</div>
            </div>
        </div>

        <!-- Category List -->
        <div class="mb-8">
            <h2 class="text-lg font-bold mb-3 text-gray-800 dark:text-white">Explore Categories</h2>
            <div class="flex flex-wrap gap-2">
                @foreach ($categories as $category)
                    <a href="/categories/{{ $category->slug }}"
                        class="px-4 py-2 rounded-lg bg-{{ $category->color }}-200 dark:bg-{{ $category->color }}-900 text-{{ $category->color }}-800 dark:text-{{ $category->color }}-200 font-semibold shadow hover:scale-105 transition">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Simple Post Form -->
    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 mb-6">
            @csrf
            @if ($errors->any())
                <div class="mb-4 p-3 rounded bg-red-100 text-red-800">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500"
                    placeholder="Article title" required>
                @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                <select name="category_id" id="category_id" value="{{ old('category_id') }}"
                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500"
                    required>
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Content</label>
                <textarea name="body" id="body" rows="5"
                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500"
                    placeholder="Write your article here..." required>{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Image (optional)</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500">
                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Submit Article
            </button>
        </form>
    </div>
</x-layout>