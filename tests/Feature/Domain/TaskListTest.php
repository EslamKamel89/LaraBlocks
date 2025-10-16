<?php

namespace Tests\Feature\Domain;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskListTest extends TestCase {
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_tasks_endpoint_lists_data(): void {
        $this->seed();
        $response = $this->get('/api/tasks');
        $response->assertOk()
            ->assertJsonStructure([[
                "title",
                "description",
                "is_done",
                "due_at",
            ]]);
        $this->assertGreaterThan(0, count($response->json()));
    }
}
