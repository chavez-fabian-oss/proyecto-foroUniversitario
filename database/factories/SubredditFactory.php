<?php
namespace Database\Factories;
use App\Models\Subreddit;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubredditFactory extends Factory
{
    protected $model = Subreddit::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
        ];
    }
}
