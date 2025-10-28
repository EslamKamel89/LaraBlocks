<?php


namespace Modules\Tasks\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Modules\Tasks\Models\Task;

class TaskPolicy {
    public function viewAny(User $user): bool {
        return true;
    }

    public function view(User $user, Task $task): bool {
        return true;
    }

    public function create(User $user): bool {
        return true;
    }

    public function update(User $user, Task $task): bool {
        return $user->id == $task->user_id;
    }

    public function delete(User $user, Task $task): bool {
        return $user->id == $task->user_id;
    }

    public function restore(User $user, Task $task): bool {
        return true;
    }

    public function forceDelete(User $user, Task $task): bool {
        return true;
    }
}
