<?php

namespace App\Http\Controllers;

use App\Models\Subreddit;
use Illuminate\Http\Request;

class SubredditController extends Controller
{
    public function index()
    {
        $subreddits = Subreddit::all();
        return view('subreddits.index', compact('subreddits'));
    }

    public function create()
    {
        return view('subreddits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:subreddits',
            'description' => 'required',
        ]);

        Subreddit::create($request->all());

        return redirect()->route('subreddits.index');
    }

    public function show(Subreddit $subreddit)
    {
        $posts = $subreddit->posts()->latest()->get();
        return view('subreddits.show', compact('subreddit', 'posts'));
    }

    public function edit(Subreddit $subreddit)
    {
        return view('subreddits.edit', compact('subreddit'));
    }

    public function update(Request $request, Subreddit $subreddit)
    {
        $request->validate([
            'name' => 'required|unique:subreddits,name,' . $subreddit->id,
            'description' => 'required',
        ]);

        $subreddit->update($request->all());

        return redirect()->route('subreddits.index');
    }

    public function destroy(Subreddit $subreddit)
    {
        $subreddit->delete();
        return redirect()->route('subreddits.index');
    }

    public function join(Subreddit $subreddit)
    {
        $subreddit->users()->attach(auth()->user());
        return redirect()->back()->with('success', 'Te has unido al subreddit.');
    }

    public function leave(Subreddit $subreddit)
    {
        $subreddit->users()->detach(auth()->user());
        return redirect()->back()->with('success', 'Has salido del subreddit.');
    }
}
