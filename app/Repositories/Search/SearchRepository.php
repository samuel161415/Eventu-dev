<?php

namespace App\Repositories\Search;

use App\Models\Business;
use App\Models\Location;

class SearchRepository
{
    public function search($filters)
    {
        $query = Business::with(['salons', 'eventCategories']);

        if (isset($filters['capacity'])) {
            $query->where('max_people', '>=', $filters['capacity']); // Adjusted to handle capacity properly
        }

        if (isset($filters['tags']) && !empty($filters['tags'])) {
            $tags = $filters['tags'];
            $query->whereHas('tags', function ($q) use ($tags) {
                $q->whereIn('name', $tags);
            });
        }

        if (isset($filters['eventType']) && !empty($filters['eventType'])) {
            $eventTypes = $filters['eventType'];
            $query->whereHas('eventCategories', function ($q) use ($eventTypes) {
                $q->whereIn('name', $eventTypes);
            });
        }

        if (isset($filters['location'])) {
            $locationId = Location::where('name', $filters['location'])->select('id')->first()->pluck('id')[0];
           
            $query->where('location_id', $locationId);
        }

        return $query->paginate(6);
    }
}
