<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required_without:comment_id',
            'comment_id' => 'required_without:post_id',
            'vote' => 'required|boolean',
        ]);

        Vote::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'post_id' => $request->post_id,
                'comment_id' => $request->comment_id,
            ],
            ['vote' => $request->vote]
        );

        return back();
    }
}
