<?php

namespace Tests\Feature\Domain;

use App\Models\Domain\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskCrudTest extends TestCase {
    use RefreshDatabase;
    public function test_tasks_endpoint_lists_data(): void {
        $this->seed();
        $response = $this->get('/api/tasks');
        $response->assertOk()
            ->assertJsonStructure(["data" => [
                ["title", "description", "is_done", "due_at",]
            ]]);
        $this->assertGreaterThan(0, count($response->json()));
    }
    protected function authHeaders(): array {
        $user = User::factory()->create();
        $token =   $user->createToken('test')->plainTextToken;
        return ['Authorization' => "Bearer {$token}"];
    }
    public function test_public_index_and_show_are_accessible(): void {
        Task::factory()->create();
        $this->getJson('/api/tasks')->assertOk();
        $this->getJson('/api/tasks/1')->assertOk();
    }
    public function test_store_require_auth_and_creates(): void {
        $this->postJson('/api/tasks')->assertStatus(401);
        $payload = ['title' => 'new task', 'description' => 'd', 'is_done' => false];
        $this->postJson('/api/tasks', $payload, $this->authHeaders())
            ->assertCreated()
            ->assertJsonFragment(['title' => 'new task']);
        $this->assertDatabaseHas('tasks', ['title' => 'new task']);
    }
    public function test_update_requires_auth_and_validates(): void {
        $task = Task::factory()->create();
        $this->putJson('/api/tasks/1', ['title' => 'x'])
            ->assertStatus(401);
        $this->putJson('/api/tasks/1', ['title' => str_repeat('a', 300)], $this->authHeaders())
            ->assertStatus(422);
        $this->putJson('/api/tasks/1', ['title' => 'updated'], $this->authHeaders())
            ->assertOk()
            ->assertJsonFragment(['title' => 'updated']);
        $this->assertDatabaseHas('tasks', ['title' => 'updated']);
    }
    public function test_destroy_requires_auth() {
        $task = Task::factory()->create();
        $this->deleteJson('/api/tasks/1')->assertUnauthorized();
        $this->deleteJson('/api/tasks/1', headers: $this->authHeaders())->assertOk()->assertJson(['deleted' => true]);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
