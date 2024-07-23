<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'subreddit_id', 'title', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subreddit()
    {
        return $this->belongsTo(Subreddit::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
