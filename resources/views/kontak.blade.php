{{-- filepath: c:\laragon\www\project1\resources\views\kontak.blade.php --}}
<x-layout>
    <x-slot:title>Contact Us</x-slot:title>

    <div class="max-w-2xl mx-auto mt-10 bg-gradient-to-br from-green-100 via-blue-100 to-purple-100 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-extrabold text-center text-gray-800 dark:text-white mb-6">Contact Us</h1>
        <p class="text-center text-gray-600 dark:text-gray-300 mb-8">
            Have questions, feedback, or want to collaborate? Fill out the form below and we'll get back to you soon!
        </p>
        <form method="POST" action="#" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Your Name</label>
                <input type="text" name="name" id="name"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Enter your name" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Email Address</label>
                <input type="email" name="email" id="email"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Enter your email" required>
            </div>
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Message</label>
                <textarea name="message" id="message" rows="5"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Type your message..." required></textarea>
            </div>
            <button type="submit"
                class="w-full py-3 px-6 bg-gradient-to-r from-green-400 via-blue-400 to-purple-400 hover:from-green-500 hover:via-blue-500 hover:to-purple-500 text-white font-bold rounded-lg shadow-lg transition duration-150">
                Send Message
            </button>
        </form>
        <div class="mt-8 text-center text-gray-500 dark:text-gray-400">
            <span class="inline-block px-4 py-2 rounded-full bg-gradient-to-r from-green-200 via-blue-200 to-purple-200 dark:from-gray-700 dark:via-gray-800 dark:to-gray-700 text-sm font-semibold shadow">
                We'll respond as soon as possible!
            </span>
        </div>
    </div>
</x-layout>