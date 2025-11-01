<?php

namespace Modules\Tasks\Http\Controllers\Api;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\UnauthorizedException;
use Modules\Tasks\Http\Requests\CreateTaskRequest;
use Modules\Tasks\Http\Requests\TasksIndexRequest;
use Modules\Tasks\Http\Requests\UpdateTaskRequest;
use Modules\Tasks\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\Tasks\Http\Resources\TaskResource;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TaskController extends Controller {
    use AuthorizesRequests;
    public function __construct() {
        // $this->authorizeResource(Task::class, 'task');
    }
    public function index(TasksIndexRequest $request) {
        $validated =  $request->validated();
        [$perPage, $pageMode, $q, $mine, $done, $from, $to, $sort, $order] = $this->getFilters($validated);
        /** @var \Illuminate\Database\Eloquent\Builder<\Modules\Tasks\Models\Task> $builder */
        $builder = Task::with('user')
            ->search($q)
            ->done($done)
            ->dueFrom($from)
            ->dueTo($to);
        if ($mine) {
            $builder->mine($request->user()?->id);
        }
        $builder->orderBy($sort, $order);
        if ($pageMode == 'cursor' && $sort != 'id') {
            $builder->getQuery()->orders = [];
            $builder->orderBy('id', $order);
        }
        $paginator = $pageMode == 'cursor'
            ? $builder->cursorPaginate($perPage)->withQueryString()
            : $builder->paginate($perPage)->withQueryString();

        return TaskResource::collection($paginator);
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
    public function exportCSV(TasksIndexRequest $request): StreamedResponse {
        $validated = $request->validated();
        [$perPage, $pageMode, $q, $mine, $done, $from, $to, $sort, $order] = $this->getFilters($validated);
        /** @var \Illuminate\Database\Eloquent\Builder<\Modules\Tasks\Models\Task> $builder  */
        $builder = Task::with('user')
            ->search($q)
            ->done($done)
            ->dueFrom($from)
            ->dueTo($to)
            ->orderBy($sort, $order);
        if ($mine) {
            $builder->mine($request->user()?->id);
        }
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="tasks.csv"'
        ];
        return response()->stream(
            function () use ($builder) {
                $out = fopen('php://output', 'w');
                fputcsv($out, ['id', 'title', 'description', 'is_done', 'due_at', 'user_id', 'user_email']);
                $builder->chunk(500, function ($rows) use ($out) {
                    foreach ($rows as $t) {
                        fputcsv($out, [$t->id, $t->title, $t->description, $t->is_done, $t->due_at, $t->user_id, $t->user?->email]);
                    }
                });
                fclose($out);
            },
            200,
            $headers,
        );
    }
    protected function getFilters(array $validated): array {
        $perPage = (int) ($validated['per_page'] ?? 20);
        $perPage = min($perPage, 100);
        $pageMode = $validated['page_mode'] ?? 'page';
        $q = $validated['q'] ?? null;
        $mine =  (bool)($validated['mine'] ?? false);
        $done = $validated['done'] ?? null;
        $from = $validated['due_from'] ?? null;
        $to = $validated['due_to'] ?? null;
        $sort = $validated['sort'] ?? 'id';
        $order = $validated['order'] ?? 'desc';
        return [$perPage, $pageMode, $q, $mine, $done, $from, $to, $sort, $order];
    }
}
