<?php

namespace Modules\Tasks\Http\Controllers\Api;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use Modules\Tasks\Http\Requests\CreateTaskRequest;
use Modules\Tasks\Http\Requests\UpdateTaskRequest;
use Modules\Tasks\Models\Task;
use Illuminate\Http\Request;
use Modules\Tasks\Http\Resources\TaskResource;

class TaskController extends Controller {
    public function index() {
        $perPage = (int) request('per_page', 20);
        $perPage = min($perPage, 100);
        return TaskResource::collection(
            Task::latest('id')
                ->paginate($perPage),
        );
    }

    public function store(CreateTaskRequest $request) {
        $validated = $request->validated();
        $validated["user_id"]  ??= auth()->id();
        $task = Task::create($validated);
        return response()->json(TaskResource::make($task), Status::HTTP_201_CREATED);
    }

    public function show(Task $task) {
        $task->load(['user']);
        return TaskResource::make($task);
    }

    public function update(UpdateTaskRequest $request, Task $task) {
        $task->update($request->validated());
        return TaskResource::make($task);
    }

    public function destroy(Task $task) {
        $task->delete();
        return response()->json(['deleted' => true]);
    }
}
