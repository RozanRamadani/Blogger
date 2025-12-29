@php
    // filepath: resources/views/edit-post.blade.php
@endphp
<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <section class="py-16 bg-cream-50 dark:bg-charcoal-950">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="font-display text-4xl font-bold text-charcoal-900 dark:text-white mb-2">Edit Artikel</h1>
                <p class="text-charcoal-600 dark:text-charcoal-300">Perbarui konten artikel Anda</p>
            </div>

            <form action="{{ route('articles.update', $post->slug) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-charcoal-800 rounded-2xl shadow-xl border border-charcoal-200 dark:border-charcoal-700 p-8 mb-6" x-data="{ files: [] }"
                  @submit="const dt = new DataTransfer(); files.forEach(f => dt.items.add(f)); $el.querySelector('#imgInput').files = dt.files;">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
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
                        <label for="title" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">Judul</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                            class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                            placeholder="Judul artikel" required>
                        @error('title')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">Kategori</label>
                        <select name="category_id" id="category_id"
                            class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                            required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tags" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">
                            Tags
                            <span class="text-xs font-normal text-charcoal-500 dark:text-charcoal-400">- Pilih beberapa tags (optional)</span>
                        </label>
                        <select name="tags[]" id="tags" multiple
                            class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                            style="height: 120px;">
                            @foreach (App\Models\Tag::orderBy('name')->get() as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-charcoal-500 dark:text-charcoal-400 mt-1">Hold Ctrl (Cmd di Mac) untuk pilih multiple tags</p>
                        @error('tags')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="body" class="block text-sm font-medium text-charcoal-700 dark:text-charcoal-200 mb-2">Konten</label>
                        <textarea name="body" id="body" rows="10"
                            class="w-full px-4 py-3 border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all resize-none"
                            placeholder="Tulis artikel Anda di sini..." required>{{ old('body', $post->body) }}</textarea>
                        @error('body')
                            <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Images Section --}}
                    <div>
                        <input type="file" id="imgInput" name="images[]" accept="image/*" multiple class="hidden"
                               @change="Array.from($event.target.files).forEach(f => files.push(f)); $event.target.value = '';">

                        <label class="block text-sm font-semibold text-charcoal-700 dark:text-cream-200 mb-2">
                            Gambar Artikel
                            <span class="text-xs font-normal text-charcoal-500 dark:text-cream-400">- Klik "Pilih Gambar" untuk menambahkan gambar, max 2MB per gambar</span>
                        </label>

                        {{-- Existing Images --}}
                        @php
                            $allImages = [];
                            if ($post->image) {
                                $allImages[] = $post->image;
                            }
                            if ($post->images && is_array($post->images)) {
                                $allImages = array_merge($allImages, $post->images);
                            }
                        @endphp

                        @if(count($allImages) > 0)
                            <div class="mb-4">
                                <p class="text-xs font-medium text-charcoal-600 dark:text-cream-300 mb-2">Gambar yang sudah ada ({{ count($allImages) }}):</p>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    @foreach($allImages as $index => $img)
                                        <div class="relative group rounded-lg overflow-hidden shadow-md" id="existing-img-{{ $index }}">
                                            <img src="{{ asset('storage/' . $img) }}" alt="Image {{ $index + 1 }}" class="w-full h-32 object-cover">
                                            <button type="button"
                                                    onclick="document.getElementById('existing-img-{{ $index }}').remove(); document.getElementById('remove_image_{{ $index }}').disabled = false;"
                                                    class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition-all shadow-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                            <input type="hidden" id="remove_image_{{ $index }}" name="remove_images[]" value="{{ $img }}" disabled>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div x-show="files.length" class="mb-4">
                            <p class="text-xs font-medium text-charcoal-600 dark:text-cream-300 mb-2">Gambar baru (<span x-text="files.length"></span>):</p>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <template x-for="(file, i) in files" :key="i">
                                    <div class="relative group rounded-lg overflow-hidden shadow-md bg-charcoal-100 dark:bg-charcoal-700">
                                        <img :src="URL.createObjectURL(file)" class="w-full h-32 object-cover">
                                        <button type="button" @click="files.splice(i, 1)"
                                                class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                        <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-xs p-1 truncate" x-text="file.name"></div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        {{-- Upload Button --}}
                        <div class="flex gap-2">
                            <button type="button" @click="$el.parentElement.parentElement.querySelector('#imgInput').click()"
                                    class="inline-flex items-center px-4 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Pilih Gambar
                                <span x-show="files.length" x-text="' (' + files.length + ')'" class="ml-1"></span>
                            </button>

                            <span x-show="files.length" class="text-sm text-charcoal-500 dark:text-cream-400 flex items-center">
                                Total: <span x-text=\"files.length\" class=\"font-semibold mx-1\"></span> gambar baru
                            </span>
                        </div>

                        @error('images.*')
                            <p class=\"text-sm text-red-600 dark:text-red-400 mt-2\">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status & Publish Date --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-charcoal-700 dark:text-cream-300 mb-2">
                                Status Artikel
                            </label>
                            <select name="status" id="status" required
                                    onchange="document.getElementById('publishDateField').style.display = this.value === 'scheduled' ? 'block' : 'none'"
                                    class="w-full px-4 py-3 rounded-lg border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                                <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="scheduled" {{ old('status', $post->status) === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            </select>
                        </div>

                        <div id="publishDateField" style="display: {{ old('status', $post->status) === 'scheduled' ? 'block' : 'none' }}">
                            <label class="block text-sm font-medium text-charcoal-700 dark:text-cream-300 mb-2">
                                Publish Date & Time
                            </label>
                            <input type="datetime-local" name="published_at"
                                   value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                                   class="w-full px-4 py-3 rounded-lg border border-charcoal-300 dark:border-charcoal-600 bg-white dark:bg-charcoal-900 text-charcoal-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="submit" id="submitBtn" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span id="submitText">Perbarui Artikel</span>
                        </button>
                        <a href="/posts/{{ $post->slug }}" class="inline-flex items-center px-6 py-3 bg-charcoal-200 dark:bg-charcoal-700 text-charcoal-700 dark:text-cream-200 hover:bg-charcoal-300 dark:hover:bg-charcoal-600 font-medium rounded-xl transition-colors">
                            Cancel
                        </a>
                    </div>

                    <script>
                        // Update submit button text based on status
                        document.getElementById('status').addEventListener('change', function() {
                            const submitText = document.getElementById('submitText');
                            if (this.value === 'draft') {
                                submitText.textContent = 'Simpan Draft';
                            } else if (this.value === 'scheduled') {
                                submitText.textContent = 'Jadwalkan';
                            } else {
                                submitText.textContent = 'Publikasikan';
                            }
                        });

                        // Set initial button text
                        const initialStatus = document.getElementById('status').value;
                        const submitText = document.getElementById('submitText');
                        if (initialStatus === 'draft') {
                            submitText.textContent = 'Simpan Draft';
                        } else if (initialStatus === 'scheduled') {
                            submitText.textContent = 'Jadwalkan';
                        }
                    </script>
                </div>
            </form>

            <form action="{{ route('articles.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.');" class="bg-white dark:bg-charcoal-800 rounded-2xl shadow-xl border border-red-200 dark:border-red-900/50 p-8">
                @csrf
                @method('DELETE')
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="font-display text-xl font-bold text-charcoal-900 dark:text-white mb-2">Zona Bahaya</h3>
                        <p class="text-charcoal-600 dark:text-charcoal-300">Setelah Anda menghapus artikel ini, tidak ada jalan untuk kembali. Pastikan Anda yakin.</p>
                    </div>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Artikel
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layout>
