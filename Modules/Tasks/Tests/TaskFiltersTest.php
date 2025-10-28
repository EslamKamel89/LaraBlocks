<?php

namespace Modules\Tasks\Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Tasks\Models\Task;
use Tests\TestCase;

class TaskFiltersTest extends TestCase {
    use RefreshDatabase;
    public function test_search_and_done_filters() {
        Task::factory()->create([
            "title" =>  'title one',
            'is_done' => true,
        ]);
        Task::factory()->create([
            'title' => 'title two',
            'is_done' => false,
        ]);
        $this->getJson(route('api.v1.tasks.index', ['q' => 'one']))
            ->assertOk()
            ->assertJsonFragment(['title' => 'title one'])
            ->assertJsonPath('data.0.title', 'title one');
    }
    public function test_mine_filter_wont_work_if_not_authenticated() {
        $me  = User::factory()->create();
        $other = User::factory()->create();
        Task::factory()->for($me)->count(2)->create();
        Task::factory()->for($other)->count(3)->create();
        $this->getJson(route('api.v1.tasks.index', ['mine' => 1]))
            ->assertOk()
            ->assertJsonCount(5, 'data');
    }
    public function test_mine_filter_will_work_if_not_authenticated() {
        $me  = User::factory()->create();
        $myToken = $me->createToken($me->email)->plainTextToken;
        $other = User::factory()->create();
        Task::factory()->for($me)->count(2)->create();
        Task::factory()->for($other)->count(3)->create();
        $headers = ["Accept" => "application/json",  "Authorization" => "Bearer {$myToken}"];
        $this->getJson(uri: route('api.v1.tasks.index', ['mine' => 1]), headers: $headers)
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }
    public function test_due_range_and_sorting() {
        Task::factory()->create(['title' => 'A', 'due_at' => now()->addDays(5)]);
        Task::factory()->create(['title' => 'B', 'due_at' => now()->addDays(1)]);
        Task::factory()->create(['title' => 'C', 'due_at' => now()->addDays(10)]);

        $this->getJson('/api/v1/tasks?due_from=' . now()->addDays(2)->toDateString() . '&due_to=' . now()->addDays(7)->toDateString() . '&sort=due_at&order=asc')
            ->assertOk()
            ->assertJsonMissing(['title' => 'C']);
    }
}
