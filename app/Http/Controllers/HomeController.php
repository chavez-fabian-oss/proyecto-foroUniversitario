<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Subreddit;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->take(10)->get();
        $subreddits = Subreddit::all();
        return view('welcome', compact('posts', 'subreddits'));
    }
    public function dashboard()
    {
        $posts = Post::latest()->get(); // Obtener todos los posts
        $subreddits = Subreddit::all(); // Obtener todos los subreddits

        return view('dashboard', compact('posts', 'subreddits'));
    }
}
