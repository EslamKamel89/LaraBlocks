<div class="bg-white border border-gray-200 rounded-lg shadow-sm">
    <div class="overflow-x-auto rounded-t-lg">
        <table class="min-w-full table-auto text-sm">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr class="text-left text-gray-700 uppercase text-xs tracking-wider">
                    <th class="px-4 py-3 font-semibold">Title</th>
                    <th class="px-4 py-3 font-semibold">Description</th>
                    <th class="px-4 py-3 font-semibold">Owner name</th>
                    <th class="px-4 py-3 font-semibold">Status</th>
                    <th class="px-4 py-3 font-semibold">Updated</th>
                    <th class="px-4 py-3 font-semibold text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse ($tasks as $task)
                <tr class="hover:bg-gray-50" wire:key="{{'task-'. $task->id }}">
                    <td class="px-4 py-3 font-medium text-gray-800 ">{{ $task->title }}</td>
                    <td class="px-4 py-3 text-gray-600 line-clamp-4">{{ $task->description }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $task->user->name }}</td>
                    <td class="px-4 py-3">
                        @if($task->is_done)
                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 text-green-700 px-2 py-0.5 text-xs font-medium">
                            <i class="bi bi-check-circle-fill"></i> Done
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 text-yellow-700 px-2 py-0.5 text-xs font-medium">
                            <i class="bi bi-hourglass-split"></i> Pending
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $task->updated_at->diffForHumans() }}</td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            @if(auth()->id() == $task->user_id)
                            <a wire:navigate href="{{ route('tasks.edit', ['task'=>$task->id]) }}"
                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-300 text-blue-600 hover:bg-blue-50 transition">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <button
                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-gray-300 text-red-600 hover:bg-red-50 transition">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                            @else
                            <div class="text-gray-400 text-xs italic">N/A</div>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <div class="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 010 2h-5v5a1 1 0 01-2 0v-5H4a1 1 0 010-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="font-medium text-gray-700">No tasks found</p>
                            <p class="text-sm text-gray-500 mt-1">Add a new task to see it here.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="border-t border-gray-200 px-4 py-3 flex items-center justify-end text-sm">


        <div class="flex items-center space-x-5">
            {{ $tasks->onEachSide(1)->links() }}
        </div>
    </div>
</div>