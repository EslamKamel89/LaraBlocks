<?php

namespace Modules\Tasks\Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Tasks\Models\Task;
use Tests\TestCase;

class TaskCursorAndCsvTest extends TestCase {

    use RefreshDatabase;

    public function test_cursor_mode_include_links() {
        Task::factory()->count(5)->create();
        $res = $this->getJson(route('api.v1.tasks.index', ['per_page' => 2, 'page_mode' => 'cursor']))
            ->assertOk();
        $this->assertArrayHasKey('links', $res);
    }
    // public function test_csv_export_downloads_with_headers() {
    //     $user = User::factory()->create();
    //     $task = Task::factory()->for($user)->count(3)->create();
    //     $token = $user->createToken($user->email)->plainTextToken;
    //     $headers = ['Authorization' => "Bearer {$token}"];
    //     $res = $this->get('/api/v1/tasks/export.csv', headers: $headers)
    //         ->assertOk()
    //         ->assertHeader('content-type', 'text/csv; charset=UTF-8')
    //         ->assertHeader('content-disposition', 'attachment; filename="tasks.csv"');;
    // }
}
