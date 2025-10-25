@php
    // filepath: resources/views/edit-post.blade.php
@endphp
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

        <form action="{{ route('articles.update', $post->slug) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-4">
            @csrf
            @method('PUT')

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
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                    placeholder="Article title" required>
                @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category_id" id="category_id"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                    required>
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea name="body" id="body" rows="6"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                    placeholder="Write your article here..." required>{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image (optional)</label>
                @if ($post->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="post image" class="w-48 h-auto rounded">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Post</button>
            </div>
        </form>

        <form action="{{ route('articles.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Delete this post?');" class="mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
        </form>
    </div>
</x-layout>
