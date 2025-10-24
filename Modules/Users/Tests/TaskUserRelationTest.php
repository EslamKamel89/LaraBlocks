<?php


namespace Modules\Users\Tests;

use App\Models\User;
use Modules\Tasks\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskUserRelationTest extends TestCase {
    use RefreshDatabase;
    public function test_task_has_user_relation() {
        $task = Task::factory()->create();
        $this->assertNotNull($task->user);
    }
    public function test_store_attaches_auth_user_when_user_id_missing() {
        $user = User::factory()->create();
        $token = $user->createToken($user->email)->plainTextToken;
        $res =     $this->post(
            route(
                'api.v1.tasks.store'
            ),
            ['title' => 'test'],
            ['Authorization' => "Bearer {$token}"]
        )
            ->assertCreated()
            ->json();
        $task = Task::find($res['id']);
        $this->assertEquals('test', $task->title,);
        $this->assertEquals($user->id, $task->user_id);
    }
}
