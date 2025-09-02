<x-layout>
    <x-slot:title>About Me</x-slot:title>

    <div class="max-w-2xl mx-auto mt-10 bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 rounded-xl shadow-lg p-8">
        <div class="flex flex-col md:flex-row items-center gap-6">
            <div class="w-24 h-24 rounded-full bg-blue-500 flex items-center justify-center text-white text-3xl font-bold shadow-lg border-4 border-white dark:border-gray-700">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-3xl font-extrabold text-gray-800 dark:text-white mb-2">{{ Auth::user()->name }}</h1>
                <p class="text-lg text-gray-500 dark:text-gray-300 mb-1">Username: <span class="font-semibold">{{ Auth::user()->username }}</span></p>
                <p class="text-lg text-gray-500 dark:text-gray-300 mb-1">Email: <span class="font-semibold">{{ Auth::user()->email }}</span></p>
                <span class="inline-block mt-2 px-3 py-1 rounded-full bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 text-white text-xs font-bold shadow">Active User</span>
            </div>
        </div>
        <div class="mt-8 text-gray-700 dark:text-gray-200 text-center md:text-left">
            <h2 class="text-xl font-bold mb-2">Welcome to your profile!</h2>
            <p class="mb-2">This is your personal about page. You can see your profile information and update your details soon.</p>
            <div class="flex flex-wrap gap-2 mt-4 justify-center md:justify-start">
                <span class="px-4 py-2 rounded-lg bg-blue-200 dark:bg-blue-900 text-blue-800 dark:text-blue-200 font-semibold shadow">Laravel Enthusiast</span>
                <span class="px-4 py-2 rounded-lg bg-purple-200 dark:bg-purple-900 text-purple-800 dark:text-purple-200 font-semibold shadow">Tailwind CSS Lover</span>
                <span class="px-4 py-2 rounded-lg bg-pink-200 dark:bg-pink-900 text-pink-800 dark:text-pink-200 font-semibold shadow">Web Developer</span>
            </div>
        </div>
    </div>
</x-layout>