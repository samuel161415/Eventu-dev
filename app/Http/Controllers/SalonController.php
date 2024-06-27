<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Salon;
use Illuminate\Http\Request;

class SalonController extends Controller
{
    public function index(Request $request)
    {
        $query = Salon::query();

        // Apply filters
        if ($request->has('capacity') && $request->capacity !== '') {
            $query->where('max_people', '>=', $request->capacity);
        }

        if ($request->has('location') && $request->location !== '') {
            $query->where('city', 'like', '%' . $request->location . '%');
        }

        // Pagination
        $salons = $query->paginate(12);

        return Inertia::render('Frontend/SearchPage', [
            'locations' => $salons,
        ]);
    }
}
