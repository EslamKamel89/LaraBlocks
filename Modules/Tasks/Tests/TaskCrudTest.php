<?php


namespace Modules\Tasks\Tests;

use Modules\Tasks\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskCrudTest extends TestCase {
    use RefreshDatabase;
    public function test_tasks_endpoint_lists_data(): void {
        $this->seed();
        $response = $this->get(route('api.v1.tasks.index'));
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
        $this->getJson(route('api.v1.tasks.index'))->assertOk();
        $this->getJson(route('api.v1.tasks.show', ['task' => 1]))->assertOk();
    }
    public function test_store_require_auth_and_creates(): void {
        $this->postJson(route('api.v1.tasks.store'))->assertStatus(401);
        $payload = ['title' => 'new task', 'description' => 'd', 'is_done' => false];
        $this->postJson(route('api.v1.tasks.store'), $payload, $this->authHeaders())
            ->assertCreated()
            ->assertJsonFragment(['title' => 'new task']);
        $this->assertDatabaseHas('tasks', ['title' => 'new task']);
    }
    public function test_update_requires_auth_and_validates(): void {
        $url = route('api.v1.tasks.update', ['task' => 1]);
        $task = Task::factory()->create();
        $this->putJson($url, ['title' => 'x'])
            ->assertStatus(401);
        $this->putJson($url, ['title' => str_repeat('a', 300)], $this->authHeaders())
            ->assertStatus(422);
        $this->putJson($url, ['title' => 'updated'], $this->authHeaders())
            ->assertOk()
            ->assertJsonFragment(['title' => 'updated']);
        $this->assertDatabaseHas('tasks', ['title' => 'updated']);
    }
    public function test_destroy_requires_auth() {
        $task = Task::factory()->create();
        $url = route('api.v1.tasks.destroy', ['task' => 1]);
        $this->deleteJson($url)->assertUnauthorized();
        $this->deleteJson($url, headers: $this->authHeaders())->assertOk()->assertJson(['deleted' => true]);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
