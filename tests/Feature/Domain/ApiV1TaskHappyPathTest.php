<?php

namespace Tests\Feature\Domain;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiV1TaskHappyPathTest extends TestCase {
    use RefreshDatabase;
    protected function loginHeaders(): array {
        $user = User::factory()->create([
            'email' => 'e2e@example.com',
            'password' => 'password'
        ]);
        $token = $this->post(route('api.v1.auth.login'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertOk()->json('token');
        return ['Authorization' => "Bearer {$token}"];
    }
    public function test_happy_path_crud() {
        $this->getJson(route('api.v1.tasks.index'))->assertOk();
        $headers = $this->loginHeaders();
        $createdRes = $this->post(route('api.v1.tasks.store'), [
            'title' => 'title test',
            'description' => 'title description',
            'is_done' => false,
        ], $headers)->assertCreated()->json();
        $id = $createdRes['id'] ?? null;
        $this->assertNotNull($id);
        $this->getJson(route('api.v1.tasks.index'))
            ->assertOk()
            ->assertJsonFragment(['title' => 'title test']);
        $this->getJson(route('api.v1.tasks.show', ['task' => $id]))
            ->assertOk()->assertJsonFragment(['title' => 'title test']);
        $this->putJson(route('api.v1.tasks.update', ['task' => $id]), [
            'title' => 'updated',
            'is_done' => true,
        ], $headers)
            ->assertOk()
            ->assertJsonFragment([
                'title' => 'updated',
                'is_done' => true,
            ]);
        $this->deleteJson(route('api.v1.tasks.destroy', ['task' => $id]))
            ->assertOk()
            ->assertJsonFragment(['deleted' => true]);
    }
}
