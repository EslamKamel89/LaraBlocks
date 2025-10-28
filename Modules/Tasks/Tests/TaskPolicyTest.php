<?php

namespace Modules\Tasks\Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Tasks\Models\Task;
use Tests\TestCase;

class TaskPolicyTest extends TestCase {
    use RefreshDatabase;
    protected function token(User $u): array {
        $token = $u->createToken($u->email)->plainTextToken;
        return ['Authorization' => "Bearer {$token}"];
    }
    public function  test_not_owner_cant_delete_or_update() {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $owner->id,
            'title' => 'test',
        ]);
        $res =   $this->putJson(
            uri: route('api.v1.tasks.update', $task),
            data: ['title' => 'hack'],
            headers: $this->token($other),
        )->assertForbidden();
        $this->deleteJson(
            uri: route('api.v1.tasks.destroy', $task),
            headers: $this->token($other)
        )->assertForbidden();
    }
    public function  test_owner_can_delete_or_update() {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $task = Task::factory()->create([
            'user_id' => $owner->id,
            'title' => 'test',
        ]);


        $res =   $this->putJson(
            uri: route('api.v1.tasks.update', ['task' => $task->id]),
            data: ['title' => 'ok'],
            headers: $this->token($owner)
        )
            ->assertOk()
            ->assertJsonFragment(['title' => 'ok']);
        $this->deleteJson(
            uri: route('api.v1.tasks.destroy', $task),
            headers: $this->token($owner)
        )->assertOk()
            ->assertJsonFragment(['deleted' => true]);
    }
}
