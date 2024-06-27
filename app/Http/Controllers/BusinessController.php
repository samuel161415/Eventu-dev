<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\View;
use Inertia\Inertia;
use App\Models\Salon;
use App\Models\Business;
use App\Models\Category;
use App\Models\FoodMenu;
use Illuminate\Http\Request;
use App\Models\LocationCategory;
use App\Jobs\UploadBusinessGallery;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Repositories\BusinessRepository;
use App\Services\Business\BusinessService;
use App\Http\Requests\UpdateOfferSectionRequest;
use App\Http\Requests\UpdateEssentialsSectionRequest;

class BusinessController extends Controller
{
    protected $businessService;

    public function __construct(BusinessService $businessService)
    {
        $this->businessService = $businessService;
    }

    public function profile(string $slug)
    {
        $business = Business::where('slug', $slug)->with('tags', 'media')->first();
        $images = $business->media->groupBy(function ($item) {
            preg_match('/-(thumbnail|medium|large)\.jpg$/', $item->url, $matches);
            return $matches[1] ?? 'original';
        })->map(function ($group) {
            return $group->unique('url');
        });
        if (Auth::check()) {
            $user = Auth::user();
            $isOwner = $business->user_id === $user->id;

            View::create([
                'business_id' => $business->id,
                'user_id' => $user->id,
                'ip_address' => request()->ip(),
            ]);
        } else {
            View::create([
                'business_id' => $business->id,
                'ip_address' => request()->ip(),
            ]);
        }

        $salons = Salon::where('business_id', $business->id)->with('tags')->get();
        $foodMenus = FoodMenu::where('business_id', $business->id)->get();
        $tags = $business->tags;
        return Inertia::render('Frontend/BusinessProfile', [
            'business' => $business,
            'categories' => $business->categories,
            'tags' => $tags,
            'salons' => $salons,
            'foodMenus' => $foodMenus,
            'isOwner' => $isOwner ?? false,
            'images' => $images
        ]);
    }


    public function updateOfferSection(UpdateOfferSectionRequest $request, $slug)
    {
        $business = Business::where('slug', $slug)->first();
        $data = $request->validated();

        try {
            $this->businessService->updateOfferSection($data, $business);

            Session::flash('success', 'Secțiunea a fost actualizată cu succes!');

            return response()->json(['message' => 'Secțiunea a fost actualizată cu succes!']);
        } catch (\Exception $e) {
            Session::flash('error', 'Nu s-a putut face actualizarea: ' . $e->getMessage());

            return response()->json(['error' => 'Nu s-a putut face actualizarea!'], 500);
        }
    }

    public function updateEssentialsSection(UpdateEssentialsSectionRequest $request, $slug)
    {
        try {
            $business = Business::where('slug', $slug)->first();

            $data = $request->validated();
            $this->businessService->updateEssentials($data, $business);

            Session::flash('success', 'Secțiunea Esențiale a fost actualizată cu succes.');
            return response()->json(['message' => 'Secțiunea Esențiale a fost actualizată cu succes']);
        } catch (\Exception $e) {
            Log::error('Error updating essentials section: ' . $e->getMessage());
            Session::flash('error', 'Nu s-a putut actualiza secțiunea Esențiale: ' . $e->getMessage());

            return response()->json(['error' => 'Nu s-a putut actualiza secțiunea Esențiale'], 500);
        }
    }

    public function deleteImage(string $businessSlug, int|string $imageId)
    {
        try {
            $business = Business::where('slug', $businessSlug)->first();
            // Call the service method to delete the image
            $this->businessService->deleteImage($business, $imageId);

            Session::flash('success', 'Imaginea a fost ștearsă cu succes.');
            return response()->json([
                'message' => 'Imaginea a fost ștearsă cu succes',
                'images' => $business->media
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting image: ' . $e->getMessage());
            Session::flash('error', 'Nu s-a putut șterge imaginea: ' . $e->getMessage());

            return response()->json(['error' => 'Nu s-a putut șterge imaginea'], 500);
        }
    }
    public function uploadImages(Request $request, string $slug)
    {
        $business = Business::where('slug', $slug)->first();
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePaths = [];
        $uploadedImages = [];
        $timestamp = now()->format('YmdHis');
        $path = 'public/business/' . $business->slug . '/business-gallery';
        $sizes = [
            'large' => [1200, null],
            'medium' => [600, null],
            'thumbnail' => [150, null],
        ];

        foreach ($request->file('images') as $image) {
            $prefix = $business->slug . '-' . $timestamp;
            $storedPath = $image->store('temp');
            $imagePaths[] = $storedPath;

            // Generate URLs for immediate response
            foreach ($sizes as $size => $dimensions) {
                $filename = $prefix . '-' . $size . '.jpg';
                $fullPath = $path . '/' . $filename;
                $uploadedImages[$size][] = [
                    'url' => Storage::url($fullPath),
                    'id' => $this->storeImageMetaData($business, Storage::url($fullPath), $size) // Store metadata and return ID
                ];
            }
        }
        // Dispatch job for processing and storing images
        UploadBusinessGallery::dispatch($business, $imagePaths, $uploadedImages);

        return response()->json(['message' => 'Images uploaded successfully', 'images' => $uploadedImages]);
    }

    private function storeImageMetaData($business, $url, $size)
    {
        $image = $business->media()->create([
            'url' => $url,
            'mediable_type' => 'App\Models\Business',
            'size' => $size
        ]);

        return $image->id;
    }





    public function updateDescription(Request $request, $slug)
    {
        $request->validate([
            'description' => 'required|string|max:5000',
        ]);

        try {
            $business = Business::where('slug', $slug)->first();
            $business->short_description = $request->input('description');
            $business->save();

            return response()->json(['message' => 'Description updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating description: ' . $e->getMessage()], 500);
        }
    }

    public function updateTags(Request $request, $slug)
    {
        $business = Business::where('slug', $slug)->first();

        $request->validate([
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,name',
        ]);
        $tagIds = Tag::whereIn('name', $request->tags)->pluck('id');
        try {
            $business->tags()->sync($tagIds);
            return response()->json(['message' => 'Tags updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating description: ' . $e->getMessage()], 500);
        }
    }

    public function updateSalonTags(Request $request, $id)
    {
        $request->validate([
            'tags' => 'array',
            'tags.*' => 'string'
        ]);

        $salon = Salon::where('id', $id)->firstOrFail();
        $tagIds = Tag::whereIn('name', $request->tags)->pluck('id');

        try {
            $salon->tags()->sync($tagIds);
            return response()->json(['message' => 'Tags updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating description: ' . $e->getMessage()], 500);
        }
        return response()->json(['message' => 'Tags updated successfully']);
    }
}
