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