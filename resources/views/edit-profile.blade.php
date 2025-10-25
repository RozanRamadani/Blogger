{{-- filepath: c:\laragon\www\project1\resources\views\edit-profile.blade.php --}}
<x-layout>
    <x-slot:title>Edit Profile</x-slot:title>

    <div class="max-w-xl mx-auto mt-10 bg-white dark:bg-gray-800 rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Edit Profile</h1>
        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800 text-center font-semibold shadow">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800 text-center font-semibold shadow">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required>
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="username"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required>
                @error('username')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="email"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required>
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">New
                    Password</label>
                <input type="password" name="password" id="password"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Leave blank if not changing" autocomplete="new-password">
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Confirm new password" autocomplete="new-password">
            </div>
            <button type="submit"
                class="w-full py-3 px-6 bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 text-white font-bold rounded-lg shadow-lg transition duration-150">
                Save Changes
            </button>
        </form>
        <a href="{{ url('/about') }}"
            class="block mt-6 text-center py-2 px-4 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg font-semibold shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
            &laquo; Back to About
        </a>
    </div>
</x-layout>
