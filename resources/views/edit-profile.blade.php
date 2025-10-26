{{-- filepath: c:\laragon\www\project1\resources\views\edit-profile.blade.php --}}
<x-layout>
    <x-slot:title>Edit Profile</x-slot:title>

    <section class="py-16 bg-cream-50 dark:bg-charcoal-950 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="font-display text-4xl font-bold text-charcoal-900 dark:text-cream-50 mb-2">Edit Profile</h1>
                <p class="text-charcoal-600 dark:text-cream-300">Update your personal information</p>
            </div>

            <div class="bg-white dark:bg-charcoal-800 rounded-3xl shadow-2xl border-2 border-charcoal-100 dark:border-charcoal-700 p-8">
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
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-terracotta-50 dark:bg-terracotta-900/30 border-2 border-terracotta-200 dark:border-terracotta-800 flex items-start">
                        <svg class="w-6 h-6 text-terracotta-600 dark:text-terracotta-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <p class="text-sm font-medium text-terracotta-800 dark:text-terracotta-200">{{ session('success') }}</p>
                    </div>
                @endif
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-semibold text-charcoal-700 dark:text-cream-200 mb-2">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                            required>
                        @error('name')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-semibold text-charcoal-700 dark:text-cream-200 mb-2">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                            class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                            required>
                        @error('username')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-charcoal-700 dark:text-cream-200 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                            required>
                        @error('email')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="border-t-2 border-charcoal-100 dark:border-charcoal-700 pt-6 mt-6">
                        <h3 class="font-display text-lg font-bold text-charcoal-900 dark:text-cream-50 mb-4">Change Password</h3>
                        <p class="text-sm text-charcoal-600 dark:text-cream-400 mb-4">Leave blank if you don't want to change your password</p>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="password" class="block text-sm font-semibold text-charcoal-700 dark:text-cream-200 mb-2">New Password</label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                                    placeholder="Leave blank if not changing" autocomplete="new-password">
                                @error('password')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-charcoal-700 dark:text-cream-200 mb-2">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-4 py-3 border-2 border-charcoal-200 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-cream-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-terracotta-500 transition-all"
                                    placeholder="Confirm new password" autocomplete="new-password">
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit"
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-terracotta-600 hover:bg-terracotta-700 text-cream-50 font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Changes
                        </button>
                        <a href="{{ url('/about') }}"
                            class="inline-flex items-center px-6 py-3 bg-charcoal-200 dark:bg-charcoal-700 text-charcoal-700 dark:text-cream-200 hover:bg-charcoal-300 dark:hover:bg-charcoal-600 font-medium rounded-xl transition-colors">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layout>
