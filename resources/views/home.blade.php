<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-cream-100 via-cream-50 to-olive-50 dark:from-charcoal-900 dark:via-charcoal-950 dark:to-charcoal-950 overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMwMDAiIGZpbGwtb3BhY2l0eT0iMC4wMiI+PHBhdGggZD0iTTM2IDEzNGg3djFoLTd6bTAtMWg3di0xaC03em0wIDNoN3YtMWgtN3ptMCAzaDd2LTFoLTd6Ii8+PC9nPjwvZz48L3N2Zz4=')] opacity-30"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="max-w-3xl">
                <h1 class="font-display text-5xl md:text-7xl font-bold text-charcoal-900 dark:text-cream-50 leading-tight mb-6">
                    Stories that
                    <span class="text-terracotta-600 dark:text-terracotta-500">inspire</span>
                </h1>
                <p class="text-xl md:text-2xl text-charcoal-600 dark:text-cream-200 leading-relaxed mb-8 max-w-2xl">
                    A minimalist space for thoughtful writing, curated content, and meaningful conversations.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="/posts" 
                       class="inline-flex items-center px-8 py-4 bg-terracotta-600 hover:bg-terracotta-700 text-cream-50 font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Explore Articles
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="#newsletter" 
                       class="inline-flex items-center px-8 py-4 bg-transparent border-2 border-charcoal-300 dark:border-cream-700 text-charcoal-700 dark:text-cream-200 hover:bg-charcoal-100 dark:hover:bg-charcoal-900 font-medium rounded-lg transition-all duration-200">
                        Subscribe
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Categories --}}
    <section class="py-20 bg-white dark:bg-charcoal-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-display text-4xl md:text-5xl font-bold text-charcoal-900 dark:text-cream-50 mb-4">
                    Explore Topics
                </h2>
                <p class="text-xl text-charcoal-600 dark:text-cream-300 max-w-2xl mx-auto">
                    Dive into diverse categories and discover content that speaks to you
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($categories as $category)
                    <a href="/categories/{{ $category->slug }}" 
                       class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-cream-100 to-cream-200 dark:from-charcoal-800 dark:to-charcoal-700 p-8 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-charcoal-100 dark:border-charcoal-600">
                        <div class="relative z-10">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-terracotta-500 to-olive-600 flex items-center justify-center text-cream-50 font-bold text-xl mb-4 shadow-lg group-hover:scale-110 transition-transform">
                                {{ strtoupper(substr($category->name, 0, 1)) }}
                            </div>
                            <h3 class="font-display text-2xl font-bold text-charcoal-900 dark:text-cream-50 mb-2 group-hover:text-terracotta-600 dark:group-hover:text-terracotta-400 transition-colors">
                                {{ $category->name }}
                            </h3>
                            <p class="text-sm text-charcoal-600 dark:text-cream-300 font-medium">
                                {{ $category->posts->count() }} articles
                            </p>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-br from-terracotta-500/10 to-olive-600/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Quick Stats Dashboard (for logged-in user) --}}
    @auth
    <section class="py-12 bg-white dark:bg-charcoal-900 border-y border-charcoal-100 dark:border-charcoal-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-4 mb-8">
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-terracotta-500 to-olive-600 flex items-center justify-center text-cream-50 font-display font-bold text-2xl shadow-lg">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <h3 class="font-display text-2xl font-bold text-charcoal-900 dark:text-cream-50">
                        Welcome back, {{ Auth::user()->name }}
                    </h3>
                    <p class="text-charcoal-600 dark:text-cream-300">
                        {{ Auth::user()->username }}
                    </p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-cream-50 dark:bg-charcoal-800 rounded-xl p-6 border border-charcoal-100 dark:border-charcoal-700">
                    <div class="text-3xl font-display font-bold text-terracotta-600 dark:text-terracotta-400 mb-1">
                        {{ Auth::user()->posts()->count() }}
                    </div>
                    <div class="text-sm text-charcoal-600 dark:text-cream-300">Your Posts</div>
                </div>
                <div class="bg-cream-50 dark:bg-charcoal-800 rounded-xl p-6 border border-charcoal-100 dark:border-charcoal-700">
                    <div class="text-3xl font-display font-bold text-olive-600 dark:text-olive-400 mb-1">
                        {{ $categories->count() }}
                    </div>
                    <div class="text-sm text-charcoal-600 dark:text-cream-300">Categories</div>
                </div>
                <div class="col-span-2">
                    <a href="/posts" 
                       class="block bg-gradient-to-r from-terracotta-600 to-olive-600 hover:from-terracotta-700 hover:to-olive-700 text-cream-50 rounded-xl p-6 text-center font-medium transition-all duration-200 shadow-md hover:shadow-lg">
                        View All Articles →
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endauth

    {{-- Create Post Form (for logged-in user) --}}
    @auth
    <section class="py-16 bg-cream-50 dark:bg-charcoal-950">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-display text-3xl font-bold text-charcoal-900 dark:text-cream-50 mb-8">
                Share Your Story
            </h2>
            
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-charcoal-900 rounded-2xl shadow-xl border border-charcoal-100 dark:border-charcoal-800 p-8">
                @csrf
                
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
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
                        <label class="block text-sm font-medium text-charcoal-700 dark:text-cream-200 mb-2">
                            Title
                        </label>
                        <input type="text" 
                               name="title" 
                               required 
                               value="{{ old('title') }}"
                               class="w-full px-4 py-3 rounded-lg border border-charcoal-200 dark:border-charcoal-700 bg-white dark:bg-charcoal-800 text-charcoal-900 dark:text-cream-50 placeholder-charcoal-400 dark:placeholder-cream-500 focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-transparent transition-all"
                               placeholder="Enter your article title...">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal-700 dark:text-cream-200 mb-2">
                            Content
                        </label>
                        <textarea name="body" 
                                  rows="8" 
                                  required
                                  class="w-full px-4 py-3 rounded-lg border border-charcoal-200 dark:border-charcoal-700 bg-white dark:bg-charcoal-800 text-charcoal-900 dark:text-cream-50 placeholder-charcoal-400 dark:placeholder-cream-500 focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-transparent transition-all resize-none"
                                  placeholder="Write your story...">{{ old('body') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-charcoal-700 dark:text-cream-200 mb-2">
                                Category
                            </label>
                            <select name="category_id" 
                                    required
                                    class="w-full px-4 py-3 rounded-lg border border-charcoal-200 dark:border-charcoal-700 bg-white dark:bg-charcoal-800 text-charcoal-900 dark:text-cream-50 focus:outline-none focus:ring-2 focus:ring-terracotta-500 focus:border-transparent transition-all">
                                <option value="">Choose a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-charcoal-700 dark:text-cream-200 mb-2">
                                Featured Image
                            </label>
                            <input type="file" 
                                   name="image" 
                                   accept="image/*"
                                   class="w-full px-4 py-3 rounded-lg border border-charcoal-200 dark:border-charcoal-700 bg-white dark:bg-charcoal-800 text-charcoal-900 dark:text-cream-50 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-terracotta-50 file:text-terracotta-700 hover:file:bg-terracotta-100 dark:file:bg-charcoal-700 dark:file:text-cream-200 focus:outline-none focus:ring-2 focus:ring-terracotta-500 transition-all">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="inline-flex items-center px-8 py-3 bg-terracotta-600 hover:bg-terracotta-700 text-cream-50 font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Publish Article
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @endauth
</x-layout>
