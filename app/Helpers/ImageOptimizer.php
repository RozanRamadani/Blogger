<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageOptimizer
{
    /**
     * Optimize and convert image to WebP format
     * 
     * @param string $imagePath Path to the original image
     * @param int $quality Quality of the WebP image (0-100)
     * @return string|null Path to the optimized WebP image
     */
    public static function optimizeToWebP($imagePath, $quality = 80)
    {
        try {
            // Check if image exists
            if (!Storage::disk('public')->exists($imagePath)) {
                return null;
            }

            // Get the full path
            $fullPath = Storage::disk('public')->path($imagePath);
            
            // Generate WebP filename
            $pathInfo = pathinfo($imagePath);
            $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
            $webpFullPath = Storage::disk('public')->path($webpPath);

            // Check if WebP version already exists
            if (Storage::disk('public')->exists($webpPath)) {
                return $webpPath;
            }

            // Create ImageManager with GD driver
            $manager = new ImageManager(new Driver());
            
            // Read and optimize image
            $image = $manager->read($fullPath);
            
            // Resize if too large (max width 1920px)
            if ($image->width() > 1920) {
                $image->scale(width: 1920);
            }
            
            // Save as WebP
            $image->toWebp($quality)->save($webpFullPath);

            return $webpPath;
        } catch (\Exception $e) {
            \Log::error('Image optimization failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Generate responsive image sizes
     * 
     * @param string $imagePath Path to the original image
     * @param array $sizes Array of widths to generate
     * @return array Array of generated image paths
     */
    public static function generateResponsiveSizes($imagePath, $sizes = [640, 768, 1024, 1280, 1920])
    {
        $responsiveImages = [];

        try {
            if (!Storage::disk('public')->exists($imagePath)) {
                return [];
            }

            $fullPath = Storage::disk('public')->path($imagePath);
            $pathInfo = pathinfo($imagePath);
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($fullPath);

            foreach ($sizes as $width) {
                // Skip if original is smaller than target width
                if ($image->width() <= $width) {
                    continue;
                }

                $resizedPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . "-{$width}w.webp";
                $resizedFullPath = Storage::disk('public')->path($resizedPath);

                // Skip if already exists
                if (Storage::disk('public')->exists($resizedPath)) {
                    $responsiveImages[$width] = $resizedPath;
                    continue;
                }

                // Clone and resize
                $resized = clone $image;
                $resized->scale(width: $width);
                $resized->toWebp(80)->save($resizedFullPath);

                $responsiveImages[$width] = $resizedPath;
            }

            return $responsiveImages;
        } catch (\Exception $e) {
            \Log::error('Responsive image generation failed: ' . $e->getMessage());
            return [];
        }
    }
}
