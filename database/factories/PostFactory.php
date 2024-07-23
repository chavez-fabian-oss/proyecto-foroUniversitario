<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Subreddit;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'subreddit_id' => Subreddit::factory(),
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ];
    }
}
