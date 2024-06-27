<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Inertia\Inertia;
use App\Models\EventCategory;
use App\Http\Requests\SearchRequest;
use App\Services\Search\SearchService;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function index()
    {
        $locations = $this->searchService->search([]);
        $tags = Tag::all();
        $eventTypes = EventCategory::all();

        return inertia('Frontend/SearchPage', [
            'initialLocations' => $locations,
            'tags' => $tags,
            'eventTypes' => $eventTypes,
            'filters' => request()->all('search'),
        ]);
    }

    public function search(SearchRequest $request)
    {
        try {

            $filters = $request->validated();
            
            $locations = $this->searchService->search($filters);

            return inertia('Frontend/SearchPage', [
                'initialLocations' => $locations,
                'tags' => Tag::all(),
                'eventTypes' => EventCategory::all(),
                'filters' => $filters,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Flash an error message to the session
            Session::flash('error', 'Validation error: ' . implode(', ', $e->errors()));

            // Redirect back with input and errors
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Flash an error message to the session
            Session::flash('error', $e->getMessage());

            // Optionally, log the error or handle it as necessary
            throw new HttpResponseException(response()->json(['error' => $e->getMessage()], 422));
        }
    }
}
