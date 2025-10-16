<?php

namespace Database\Factories\Domain;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Domain\Task>
 */
class TaskFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'is_done' => $this->faker->boolean(20),
            'due_at' => $this->faker->optional()->dateTimeBetween('now', '+10 days')
        ];
    }
}
