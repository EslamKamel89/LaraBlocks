<?php

namespace Modules\Tasks\Tests;

use App\Enums\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Modules\Tasks\Models\Task;
use Tests\TestCase;

class TaskIndexRequestTest extends TestCase {
    use RefreshDatabase;
    public function test_index_rejects_invalid_params() {
        $this->get(route('api.v1.tasks.index', ['per_page' => 10000000, 'order' => 'sideways']))
            ->assertStatus(Status::HTTP_422_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['per_page', 'order']);
    }
    public function test_index_accepts_valid_params_and_returns_meta_links() {
        Task::factory()->count(3)->create();
        $res = $this->getJson(route('api.v1.tasks.index', ['per_page' => 2, 'sort' => 'id', 'order' => 'asc']))
            ->assertOk()->json();
        $this->assertArrayHasKey('data', $res);
        $this->assertArrayHasKey('meta', $res);
        $this->assertArrayHasKey('links', $res);
    }
}
