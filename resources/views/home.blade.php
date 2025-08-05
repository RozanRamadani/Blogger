<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  
  <div class="max-w-2xl mx-auto p-4">
    <!-- Welcome Message -->
    <div class="text-center mb-8">
      <h1 class="text-2xl font-bold mb-2">Welcome to My App</h1>
      <p class="text-gray-600">A simple social platform</p>
    </div>

    <!-- Simple Post Form -->
    <form action="">
      <div class="bg-white rounded-lg shadow p-4 mb-6">
      <textarea 
        class="w-full p-2 border border-gray-300 rounded mb-2 focus:outline-none focus:ring-1 focus:ring-blue-500"
        placeholder="What's on your mind?"
        rows="3"
      ></textarea>
      <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Post
      </button>
    </div>
    </form>
    </div>
</x-layout>