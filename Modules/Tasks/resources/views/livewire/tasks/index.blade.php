<div class="max-w-4xl mx-auto p-6 space-y-6">
    <h1 class="text-2xl font-semibold">Tasks</h1>
    <div class="flex gap-2">
        <input type="text"
            placeholder="Search..."
            wire:model.live.debounce.500="search"
            class="border rounded-lg px-3 py-2 w-full ">
        <select wire:model.live.debounce.500="isDone" class="border rounded-lg px-3 py-2 w-full ">
            <option value="">🧠 All</option>
            <option value="1">✅ Completed</option>
            <option value="0">⏳ Pending</option>
        </select>
    </div>
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
                <tr class="border-t">
                    <td class="p-3">{{ $task->title }}</td>
                    <td class="p-3">{{ $task->description }}</td>
                    <td class="p-3">
                        <div class="text-center text-sm">{{ $task->is_done ? '✅ completed' : '⏳ pending' }}</div>
                    </td>
                    <td class="p-3">{{ $task->updated_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td class="p-3" colspan="4">No tasks found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>