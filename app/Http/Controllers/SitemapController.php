<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        // Cache sitemap for 1 day
        return Cache::remember('sitemap', 60 * 24, function () {
            $posts = Post::latest()->get();
            $categories = Category::all();

            $xml = '<?xml version="1.0" encoding="UTF-8"?>';
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

            // Homepage
            $xml .= '<url>';
            $xml .= '<loc>' . url('/') . '</loc>';
            $xml .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>daily</changefreq>';
            $xml .= '<priority>1.0</priority>';
            $xml .= '</url>';

            // Posts page
            $xml .= '<url>';
            $xml .= '<loc>' . url('/posts') . '</loc>';
            $xml .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>daily</changefreq>';
            $xml .= '<priority>0.9</priority>';
            $xml .= '</url>';

            // Individual posts
            foreach ($posts as $post) {
                $xml .= '<url>';
                $xml .= '<loc>' . url("/posts/{$post->slug}") . '</loc>';
                $xml .= '<lastmod>' . $post->updated_at->toAtomString() . '</lastmod>';
                $xml .= '<changefreq>weekly</changefreq>';
                $xml .= '<priority>0.8</priority>';
                $xml .= '</url>';
            }

            // Categories
            foreach ($categories as $category) {
                $xml .= '<url>';
                $xml .= '<loc>' . url("/posts?category={$category->slug}") . '</loc>';
                $xml .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
                $xml .= '<changefreq>weekly</changefreq>';
                $xml .= '<priority>0.7</priority>';
                $xml .= '</url>';
            }

            // About page
            $xml .= '<url>';
            $xml .= '<loc>' . url('/about') . '</loc>';
            $xml .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>monthly</changefreq>';
            $xml .= '<priority>0.6</priority>';
            $xml .= '</url>';

            // Contact page
            $xml .= '<url>';
            $xml .= '<loc>' . url('/kontak') . '</loc>';
            $xml .= '<lastmod>' . now()->toAtomString() . '</lastmod>';
            $xml .= '<changefreq>monthly</changefreq>';
            $xml .= '<priority>0.6</priority>';
            $xml .= '</url>';

            $xml .= '</urlset>';

            return response($xml, 200)
                ->header('Content-Type', 'application/xml');
        });
    }

    public function robots()
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin\n";
        $content .= "Disallow: /login\n";
        $content .= "Disallow: /register\n";
        $content .= "Disallow: /dashboard\n";
        $content .= "\n";
        $content .= "Sitemap: " . url('/sitemap.xml') . "\n";

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }
}
