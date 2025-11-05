<div class="flex flex-col sm:flex-row sm:items-center gap-3 bg-white border border-gray-200 rounded-lg p-3 shadow-sm">
    <div class="flex-1">
        <input
            type="text"
            placeholder="Search tasks..."
            wire:model.live.debounce.500="search"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
    </div>

    <div class="w-full sm:w-48">
        <select
            wire:model.live.debounce.500="isDone"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
            <option value="">🧠 All</option>
            <option value="1">✅ Completed</option>
            <option value="0">⏳ Pending</option>
        </select>
    </div>
</div>