<?php

namespace Modules\Tasks\Http\Controllers\Api;

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
            Task::latest('id')->paginate($perPage),
        );
    }

    public function store(CreateTaskRequest $request) {
        $task = Task::create($request->validated());
        return response()->json(TaskResource::make($task), 201);
    }

    public function show(Task $task) {
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
