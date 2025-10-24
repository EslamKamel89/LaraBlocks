<?php


namespace Modules\Users\Tests;

use App\Models\User;
use Modules\Tasks\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersShowTest extends TestCase {
    use RefreshDatabase;
    public function test_can_fetch_user_public_profile() {
        $user = User::factory()->create(['name' => 'test']);
        $this->getJson(route('api.v1.users.show', ['user' => $user->id]))
            ->assertOk()
            ->assertJsonFragment(['name' => $user->name, 'email' => $user->email]);
    }
}
