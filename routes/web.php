<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ViewDataController;
use App\Http\Controllers\VisitDataController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\GeneralPageController;


// Route::get('/', function () {
//     // return Inertia::render('Welcome', [
//     //     'canLogin' => Route::has('login'),
//     //     'canRegister' => Route::has('register'),
//     //     'laravelVersion' => Application::VERSION,
//     //     'phpVersion' => PHP_VERSION,
//     // ]);
//     return Inertia::render('frontend/pages/Homepage');
// });

// Frontend routes
// Route::get('/', function () {
//     return Inertia::render('Frontend/Homepage');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
// routes/web.php

// In your routes/api.php

Route::get('/business/{slug}/views', [ViewDataController::class, 'index']);


Route::get('/b2b', [GeneralPageController::class, 'b2b'])->name('b2b');



Route::get('/descopera', [SearchController::class, 'index']);
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/resurse', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/business/{slug}', [BusinessController::class, 'profile'])->name('business.profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Admin/Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::put('/salon/{id}/schimba-taguri', [BusinessController::class, 'updateSalonTags']);
    Route::put('/business/{slug}/schimba-preturi', [BusinessController::class, 'updateOfferSection']);
    Route::put('/business/{slug}/schimba-descriere', [BusinessController::class, 'updateDescription']);
    Route::put('/business/{slug}/schimba-taguri', [BusinessController::class, 'updateTags']);
    Route::post('/business/{slug}/incarca-imagini', [BusinessController::class, 'uploadImages']);
    Route::put('/business/{slug}/schimba-esentiale', [BusinessController::class, 'updateEssentialsSection']);
    Route::delete('/business/{slug}/sterge-imagine/{imageId}', [BusinessController::class, 'deleteImage']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
