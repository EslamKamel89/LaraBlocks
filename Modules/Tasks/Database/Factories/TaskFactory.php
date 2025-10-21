<?php

namespace Modules\Tasks\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Tasks\Models\Task;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Tasks\Models\Task>
 */
class TaskFactory extends Factory {
    protected $model = Task::class;
    public function definition(): array {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'is_done' => $this->faker->boolean(20),
            'due_at' => $this->faker->optional()->dateTimeBetween('now', '+10 days')
        ];
    }
}
