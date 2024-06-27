<?php

namespace App\Services\Business;

use App\Models\Business;
use App\Jobs\UploadBusinessGallery;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Business\BusinessRepository;


class BusinessService
{
    protected $businessRepository;

    public function __construct(BusinessRepository $businessRepository)
    {
        $this->businessRepository = $businessRepository;
    }

    public function updateOfferSection(array $data, Business $business)
    {
        return $this->businessRepository->updateOfferSection($data, $business);
    }

    public function updateEssentials(array $data, Business $business): Business
    {
        return $this->businessRepository->updateEssentials($data, $business);
    }
    public function deleteImage(Business $business, $imageId)
    {
        return $this->businessRepository->deleteImage($business, $imageId);
    }

    public function uploadImages(Business $business, array $imagePaths)
    {
        UploadBusinessGallery::dispatch($business, $imagePaths);
    }
    
    
}
