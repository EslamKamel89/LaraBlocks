<div class="border rounded">
    <table class="w-full">
        <thead>
            <tr class="text-left">
                <th class="p-3">Title</th>
                <th class="p-3">Description</th>
                <th class="p-3">Status</th>
                <th class="p-3">Updated</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task )
            <livewire:tasks.components.row
                :task-id="$task->id"
                :title="$task->title"
                :description="$task->description"
                :is-done="$task->is_done"
                :updated-human="$task->updated_at->diffForHumans()"
                :key="'task-'.$task->id" />
            @empty
            <tr>
                <td class="p-3" colspan="4">No tasks found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">
        {{ $tasks->onEachSide(1)->links() }}
    </div>
</div>