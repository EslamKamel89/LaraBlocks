<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HealthEndpointTest extends TestCase {
    /**
     * A basic feature test example.
     */
    public function test_example(): void {
        $response =  $this->get(route('api.v1.health'));
        $response
            ->assertOk()
            ->assertJsonStructure(['app', 'time', 'status'])
            ->assertJson(['status' => 'ok']);
    }
}
