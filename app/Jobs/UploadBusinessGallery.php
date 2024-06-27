<?php

namespace App\Jobs;

use App\Models\Business;
use App\Services\Media\ImageUploadService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class UploadBusinessGallery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $business;
    protected $imagePaths;

    /**
     * Create a new job instance.
     *
     * @param Business $business
     * @param array $imagePaths
     */
    public function __construct(Business $business, array $imagePaths)
    {
        $this->business = $business;
        $this->imagePaths = $imagePaths;
    }

    /**
     * Execute the job.
     *
     * @param ImageUploadService $imageUploadService
     * @return void
     */
    public function handle(ImageUploadService $imageUploadService)
    {
        $timestamp = now()->format('YmdHis');
        $path = 'public/business/' . $this->business->slug . '/business-gallery';

        foreach ($this->imagePaths as $imagePath) {
            $image = Storage::get($imagePath);
            $prefix = $this->business->slug . '-' . $timestamp;
            $sizes = [
                'large' => [1200, null],
                'medium' => [600, null],
                'thumbnail' => [150, null],
            ];

            $uploadedImages = $imageUploadService->processAndStoreImage($image, $path, $sizes, $prefix);

            // Store the image URLs in the database
            foreach ($uploadedImages as $size => $url) {
                $this->business->media()->create([
                    'url' => $url,
                    'mediable_type' => Business::class, // Ensure this is a string
                ]);
            }

            // Delete the temporary file
            Storage::delete($imagePath);
        }
    }
}
