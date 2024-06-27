<?php

namespace App\Repositories\Business;

use Exception;
use App\Models\Business;
use Illuminate\Support\Facades\Storage;

class BusinessRepository
{
    protected $model;

    public function __construct(Business $model)
    {
        $this->model = $model;
    }

    public function updateOfferSection(array $data, Business $business)
    {
        foreach($data as $key => $field){
            if($field !== null){
                $business->$key = $field;
            }
        }
        $business->save();
        return $business;
    }

    public function updateEssentials(array $data, Business $business): Business
    {
        foreach ($data as $key => $value) {
            if (!is_null($value)) {
                $business->{$key} = $value;
            }
        }

        $business->save();

        return $business;
    }
    public function deleteImage(Business $business, $imageId)
    {
        try {
            $image = $business->media()->where('id', $imageId)->first();
            if ($image) {
                // Generate paths for all sizes
                $relativePath = str_replace('/storage', 'public', $image->url);
                $mediumPath = str_replace('-thumbnail.jpg', '-medium.jpg', $relativePath);
                $largePath = str_replace('-thumbnail.jpg', '-large.jpg', $relativePath);
    
                // Delete the image files from the storage
                Storage::delete([$relativePath, $mediumPath, $largePath]);
    
                // Delete the image records from the database
                $image->delete(); // Delete the thumbnail record
                $business->media()->where('url', str_replace('/storage', '', Storage::url($mediumPath)))->delete();
                $business->media()->where('url', str_replace('/storage', '', Storage::url($largePath)))->delete();
            }
        } catch (Exception $e) {
            throw new Exception('Error deleting image: ' . $e->getMessage());
        }
    }
    
    
    
}
