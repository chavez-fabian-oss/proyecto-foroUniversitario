<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subreddit;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create($subreddit)
    {
        $subreddit = Subreddit::findOrFail($subreddit);
        $subreddits = Subreddit::all();
        return view('posts.create', compact('subreddits', 'subreddit'));
    }
    

    public function store(Request $request, $subreddit)
    {
        $subreddit = Subreddit::findOrFail($subreddit);

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'subreddit_id' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $post = new Post();
        $post->user_id = auth()->id();
        $post->subreddit_id = $subreddit->id;
        $post->title = $request->title;
        $post->body = $request->body;

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images', 'public');
        }

        $post->save();

        return redirect()->route('subreddits.show', ['subreddit' => $subreddit->id])
            ->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $subreddits = Subreddit::all();
        return view('posts.edit', compact('post', 'subreddits'));
    }
    

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $post->title = $request->title;
        $post->body = $request->body;

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $post->image = $request->file('image')->store('images', 'public');
        }

        $post->save();

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
