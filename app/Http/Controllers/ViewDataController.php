<?php
namespace App\Http\Controllers;

use App\Models\View;
use App\Models\Business;
use Illuminate\Http\Request;

class ViewDataController extends Controller
{
    public function index($slug)
    {
        $business = Business::where('slug', $slug)->first();
        $views = View::where('business_id', $business->id)
            ->selectRaw('DATE(created_at) as date, count(*) as views, count(distinct ip_address) as uniqueViews')
            ->groupBy('date')
            ->get();
        return response()->json($views);
    }
}
