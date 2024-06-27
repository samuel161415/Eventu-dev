<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class GeneralPageController extends Controller
{
    public function b2b()
    {
        return Inertia::render('Frontend/B2B');
    }
}
