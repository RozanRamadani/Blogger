{{-- filepath: c:\laragon\www\project1\resources\views\edit-profile.blade.php --}}
<x-layout>
    <x-slot:title>Edit Profil</x-slot:title>

    <section class="py-12 bg-cream-50 dark:bg-charcoal-950 min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-charcoal-900 dark:text-white mb-2">Edit Profil</h1>
                <p class="text-charcoal-600 dark:text-charcoal-300">Perbarui informasi pribadi Anda</p>
            </div>

            <div class="bg-white dark:bg-charcoal-800 rounded-2xl shadow-lg border border-charcoal-200 dark:border-charcoal-700 p-8">
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
                    <div class="mb-6 p-4 rounded-lg bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 flex items-start">
                            <svg class="w-6 h-6 text-primary-600 dark:text-primary-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                            <p class="text-sm font-medium text-primary-800 dark:text-primary-200">{{ session('success') }}</p>
                    </div>
                @endif
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    {{-- Profile Photo --}}
                    <div class="flex flex-col items-center mb-6">
                        <div class="relative group">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="w-32 h-32 rounded-full object-cover border-4 border-primary-200 dark:border-primary-800 shadow-lg">
                            @else
                                <div class="w-32 h-32 rounded-full bg-primary-100 dark:bg-primary-900 border-4 border-primary-200 dark:border-primary-800 flex items-center justify-center shadow-lg">
                                    <svg class="w-16 h-16 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                            <label for="profile_photo" class="absolute bottom-0 right-0 bg-primary-600 hover:bg-primary-700 text-white rounded-full p-2 cursor-pointer shadow-lg transition-all duration-200 transform hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </label>
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="hidden" onchange="previewImage(event)">
                        </div>
                        <p class="text-sm text-charcoal-600 dark:text-charcoal-400 mt-3">JPG, PNG, atau GIF (Max 2MB)</p>
                        @error('profile_photo')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">Nama</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                            required>
                        @error('name')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="username" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                            class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                            required>
                        @error('username')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                            required>
                        @error('email')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bio --}}
                    <div class="md:col-span-2">
                        <label for="bio" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">
                            Bio / Tentang Saya
                        </label>
                        <textarea name="bio" id="bio" rows="4"
                            class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all resize-none"
                            placeholder="Ceritakan sedikit tentang diri Anda...">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Social Links Section --}}
                    <div class="md:col-span-2 border-t border-charcoal-200 dark:border-charcoal-700 pt-6 mt-2">
                        <h3 class="text-lg font-bold text-charcoal-900 dark:text-white mb-4">Social Media Links</h3>
                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label for="website_url" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">
                                    🌐 Website
                                </label>
                                <input type="url" name="website_url" id="website_url" value="{{ old('website_url', $user->website_url) }}"
                                    class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                    placeholder="https://yourwebsite.com">
                                @error('website_url')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="twitter_url" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">
                                    𝕏 Twitter / X
                                </label>
                                <input type="url" name="twitter_url" id="twitter_url" value="{{ old('twitter_url', $user->twitter_url) }}"
                                    class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                    placeholder="https://twitter.com/username">
                                @error('twitter_url')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="github_url" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">
                                    🐙 GitHub
                                </label>
                                <input type="url" name="github_url" id="github_url" value="{{ old('github_url', $user->github_url) }}"
                                    class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                    placeholder="https://github.com/username">
                                @error('github_url')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="linkedin_url" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">
                                    💼 LinkedIn
                                </label>
                                <input type="url" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}"
                                    class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                    placeholder="https://linkedin.com/in/username">
                                @error('linkedin_url')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2 border-t border-charcoal-200 dark:border-charcoal-700 pt-6 mt-6">
                        <h3 class="text-lg font-bold text-charcoal-900 dark:text-white mb-3">Ubah Password</h3>
                        <p class="text-sm text-charcoal-600 dark:text-charcoal-400 mb-4">Kosongkan jika tidak ingin mengubah password</p>

                        <div class="space-y-6">
                            <div>
                                <label for="password" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">Password Baru</label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                    placeholder="Kosongkan jika tidak mengubah" autocomplete="new-password">
                                @error('password')
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                    placeholder="Konfirmasi password baru" autocomplete="new-password">
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit"
                            class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ url('/about') }}"
                            class="inline-flex items-center px-6 py-3 bg-charcoal-200 dark:bg-charcoal-700 text-charcoal-700 dark:text-charcoal-200 hover:bg-charcoal-300 dark:hover:bg-charcoal-600 font-medium rounded-lg transition-colors">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = input.parentElement.querySelector('img, div');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    if (preview.tagName === 'IMG') {
                        preview.src = e.target.result;
                    } else {
                        // Replace placeholder div with img
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = 'Profile Photo';
                        img.className = 'w-32 h-32 rounded-full object-cover border-4 border-primary-200 dark:border-primary-800 shadow-lg';
                        preview.replaceWith(img);
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-layout>
