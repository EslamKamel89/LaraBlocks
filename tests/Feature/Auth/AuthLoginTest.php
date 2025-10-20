<?php

namespace Tests\Feature\Auth;

use App\Enums\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthLoginTest extends TestCase {
    use RefreshDatabase;
    public function test_login_requires_email_and_password(): void {
        $this->post(route('api.v1.auth.login'))
            ->assertStatus(Status::HTTP_422_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['email', 'password']);
    }
    public function test_login_fails_with_wrong_credentials(): void {
        $user = User::factory()->create([
            'email' => 'e2e@example.com',
            'password' => 'password'
        ]);
        $this->post(route('api.v1.auth.login'), [
            'email' => 'e2e@example.com',
            'password' => 'wrong-password'
        ])->assertStatus(Status::HTTP_401_UNAUTHORIZED);
    }
    public function test_login_succeeds_and_me_returns_user(): void {
        $user = User::factory()->create([
            'email' => 'e2e@example.com',
            'password' => 'password'
        ]);
        $res =  $this->post(route('api.v1.auth.login'), [
            'email' => 'e2e@example.com',
            'password' => 'password'
        ])
            ->assertOk()
            ->assertJsonStructure(['token', 'user' => ['id', 'name', 'email']])
            ->json();
        $token = $res['token'];
        $this->get(route('api.v1.me'), headers: [
            'Authorization' => "Bearer {$token}"
        ])->assertOk()->assertJsonFragment([
            'email' => $user->email,
        ]);
    }
}
