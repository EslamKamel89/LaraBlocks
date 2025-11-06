<?php

namespace Modules\Tasks\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\Tasks\Models\Task;

class ExportTasksController extends Controller {

    public function __invoke(Request $request) {
        Gate::authorize('viewAny', Task::class);
        $search = $request->get('search', '');
        $isDone = $request->get('isDone');
        $query = Task::query()->with(['user']);
        if ($search) {
            $query->search($search);
        }
        if ($isDone === '1' || $isDone === '0') {
            $query->done($isDone);
        }
        $fileName = 'tasks-expert-' . now()->format('Ymd-His') . '.csv';
        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['id', 'title', 'description', 'is_done', 'owner_name', 'updated_at']);
            $query->latest()->chunk(500, function ($chunk) use ($out) {
                foreach ($chunk as $task) {
                    fputcsv($out, [
                        $task->id,
                        $task->title,
                        $task->description,
                        $task->is_done ? 1 : 0,
                        optional($task->user)->name,
                        $task->updated_at?->toDateTimeString(),
                    ]);
                }
            });
            fclose($out);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
