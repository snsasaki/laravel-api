<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TodoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_todo_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/todos', [
            'category_id' => 1,
            'title' => 'テストTodo',
            'body' => 'テスト本文',
            'user_id' => $user->id,
        ]);

        $response->assertRedirect('/todos');

        $this->assertDatabaseHas('todos', [
            'title' => 'テストTodo',
        ]);
    }
    public function test_api_can_return_todos()
    {

        $user = User::factory()->create([
            'api_token' => 'test-token',
        ]);

        $response = $this->withHeaders([
            'X-API-TOKEN' => $user->api_token,
        ])->getJson('/api/todos');

        $response->assertStatus(200);
    }
}
