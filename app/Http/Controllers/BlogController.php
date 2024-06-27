<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_published', true)->get()->toArray();
        return Inertia::render('Frontend/Blog', [
            'posts' => $posts,
        ]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return Inertia::render('Frontend/SinglePost', [
            'post' => $post
        ]);
    }
}
