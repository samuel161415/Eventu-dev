<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Business;
use App\Models\Location;
use App\Models\EventCategory;
use Inertia\Inertia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $companies = Business::latest()->with('location')->take(4)->get();

        $posts = Post::with('user')->latest()->paginate(5);

        $locations = Location::all();
        $eventCategories = EventCategory::all();

        return Inertia::render('Frontend/Homepage', [
            'companies' => $companies,
            'posts' => $posts,
            'data' => [
                'locations' => $locations,
                'eventCategories' => $eventCategories
            ]
        ]);
    }
}
