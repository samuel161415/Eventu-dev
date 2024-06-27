<?php

namespace App\Services\Media;

use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUploadService
{
    protected $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    /**
     * Process and store an image.
     *
     * @param mixed $image
     * @param string $path
     * @param array $sizes
     * @param string $prefix
     * @return array
     */
    public function processAndStoreImage($image, $path, array $sizes, $prefix = '')
    {
        $uploadedImages = [];

        foreach ($sizes as $size => $dimensions) {
            $timestamp = now()->format('YmdHis');
            $filename = $prefix . '-' . $size . '.jpg';
            $fullPath = $path . '/' . $filename;

            // Resize the image using Intervention Image 3.x
            $resizedImage = $this->imageManager->read($image)->scale($dimensions[0], $dimensions[1], 'keepAspectRatio');

            // Save the image to the specified path
            Storage::put($fullPath, (string) $resizedImage->toJpeg());

            // Add the URL to the array of uploaded images
            $uploadedImages[$size] = Storage::url($fullPath);
        }
        return $uploadedImages;
    }
}
