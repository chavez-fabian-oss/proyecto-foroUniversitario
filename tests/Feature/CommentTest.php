<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create();

        $response = $this->post('/comments', [
            'post_id' => $post->id,
            'body' => 'This is a comment.',
        ]);

        $response->assertStatus(302); // O el código de estado que tu aplicación devuelve
        $this->assertCount(1, Comment::all());
    }

    public function test_a_user_can_delete_a_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $comment = Comment::factory()->create(['user_id' => $user->id]);

        $response = $this->delete("/comments/{$comment->id}");

        $response->assertStatus(302); // O el código de estado que tu aplicación devuelve
        $this->assertCount(0, Comment::all());
    }
}
