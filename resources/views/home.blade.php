<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="max-w-2xl mx-auto p-4">
        <!-- Welcome Message -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold mb-2">Welcome to My App</h1>
            <p class="text-gray-600">A simple social platform</p>
        </div>

        <!-- Simple Post Form -->
        <form action="{{ route('articles.store') }}" method="POST" class="bg-white rounded-lg shadow p-4 mb-6">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" id="title"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                    placeholder="Article title" required>
            </div>
            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category_id" id="category_id"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                    required>
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea name="body" id="body" rows="5"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                    placeholder="Write your article here..." required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Submit Article
            </button>
        </form>
    </div>
</x-layout>
