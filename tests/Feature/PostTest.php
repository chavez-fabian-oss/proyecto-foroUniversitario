<?php
namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Models\Subreddit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $subreddit = Subreddit::factory()->create();

        $response = $this->post('/posts', [
            'title' => 'Test Title',
            'body' => 'Test Body',
            'subreddit_id' => $subreddit->id,
        ]);

        $response->assertStatus(302);
        $this->assertCount(1, Post::all());
    }

    public function test_a_user_can_update_a_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->put("/posts/{$post->id}", [
            'title' => 'Updated Title',
            'body' => 'Updated Body',
        ]);

        $response->assertStatus(302);
        $post->refresh();
        $this->assertEquals('Updated Title', $post->title);
        $this->assertEquals('Updated Body', $post->body);
    }

    public function test_a_user_can_delete_a_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->delete("/posts/{$post->id}");

        $response->assertStatus(302);
        $this->assertCount(0, Post::all());
    }
}
