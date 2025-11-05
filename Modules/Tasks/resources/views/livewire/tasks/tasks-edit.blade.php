<div class="max-w-2xl mx-auto p-6 space-y-6 bg-white/70 backdrop-blur rounded-2xl border border-gray-200 shadow-sm">
    <h1 class="text-2xl font-semibold tracking-tight text-gray-900">{{ $title }}</h1>

    @if (session("status"))
    <div class="flex items-start gap-2 rounded-lg border border-green-200 bg-green-50 p-3 text-sm text-green-800">
        <span class="font-medium">Success:</span>
        <span>{{ session('status') }}</span>
    </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-5">
        <div class="space-y-1.5">
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input
                type="text"
                wire:model="title"
                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder:text-gray-400 shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('title')
            <div class="text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <div class="space-y-1.5">
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <input
                type="text"
                wire:model="description"
                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-gray-900 placeholder:text-gray-400 shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @error('description')
            <div class="text-sm text-red-600">{{ $message }}</div>
            @enderror
        </div>

        <label class="inline-flex items-center gap-2 select-none">
            <input
                type="checkbox"
                wire:model="is_done"
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
            <span class="text-sm text-gray-800">Completed</span>
        </label>
        @error('is_done')
        <div class="text-sm text-red-600">{{ $message }}</div>
        @enderror

        <div class="flex flex-wrap gap-2 pt-2">
            <a
                wire:navigate
                href="{{ route('tasks.index') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700
                       hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                Back
            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm
                       hover:bg-indigo-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2">
                Update
            </button>


        </div>
    </form>
</div>