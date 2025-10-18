<?php

namespace App\Http\Controllers\Api\Domain;

use App\Http\Controllers\Controller;
use App\Http\Requests\Domain\CreateTaskRequest;
use App\Http\Requests\Domain\UpdateTaskRequest;
use App\Http\Resources\Domain\TaskResource;
use App\Models\Domain\Task;
use Illuminate\Http\Request;

class TaskController extends Controller {
    public function index() {
        return TaskResource::collection(
            Task::latest('id')->paginate(20),
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
