<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $isLoggedIn = Auth::check();
        $user = Auth::user() ?? null;
        $business = $user ? $user->business()->with(['salons', 'foodMenus', 'views'])->first() : null;

        $viewData = [];
        if ($business) {
            $views = $business->views()->get()->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d');
            });

            foreach ($views as $date => $viewGroup) {
                $viewData[] = [
                    'date' => $date,
                    'views' => $viewGroup->count(),
                    'unique_views' => $viewGroup->unique('ip_address')->count(),
                ];
            }
        }

        return Inertia::render('Frontend/UserDashboard', [
            'isLoggedIn' => $isLoggedIn,
            'business' => $business,
            'salons' => $business ? $business->salons : [],
            'foodMenus' => $business ? $business->foodMenus : [],
            'views' => $viewData,
        ]);
    }
}
