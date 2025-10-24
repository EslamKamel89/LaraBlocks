<?php

namespace Database\Seeders;

use Modules\Tasks\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Users\Models\User;

class TaskSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $user = User::where('email', 'admin@gmail.com')->first();
        Task::factory()->count(5)->create([
            'user_id' => $user->id
        ]);
        Task::factory()->count(10)->create();
    }
}
