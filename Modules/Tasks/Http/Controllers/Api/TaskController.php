<?php

namespace Modules\Tasks\Http\Controllers\Api;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\UnauthorizedException;
use Modules\Tasks\Http\Requests\CreateTaskRequest;
use Modules\Tasks\Http\Requests\UpdateTaskRequest;
use Modules\Tasks\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\Tasks\Http\Resources\TaskResource;

class TaskController extends Controller {
    use AuthorizesRequests;
    public function __construct() {
        // $this->authorizeResource(Task::class, 'task');
    }
    public function index(Request $request) {
        $perPage = (int) request('per_page', 20);
        $perPage = min($perPage, 100);
        $q = request('q');
        $mine = request()->boolean('mine', false);
        $done = request('done', null);
        $from = request('due_from');
        $to = request('due_to');
        $sort = in_array(request('sort'), ['id', 'due_at', 'created_at', 'updated_at']) ? request('sort') : 'id';
        $order = request('order') === 'asc' ? 'asc' : 'desc';
        $builder = Task::with('user')
            ->search($q)
            ->done($done)
            ->dueFrom($from)
            ->dueTo($to);
        if ($mine) {
            $builder->mine($request->user()?->id);
        }
        return TaskResource::collection(
            $builder->orderBy($sort, $order)
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
        Gate::authorize('update', $task);
        if ($task->user_id !=  auth()->id()) {
            throw new UnauthorizedException('UnauthorizedException');
        }
        $request->validated();
        $task->update($request->validated());
        // dump($task);
        return TaskResource::make($task);
    }

    public function destroy(Task $task) {
        Gate::authorize('delete', $task);
        $task->delete();
        return response()->json(['deleted' => true]);
    }
}
