<div class="max-w-4xl mx-auto p-6 space-y-6">
    <h1 class="text-2xl font-semibold">{{ $title }}</h1>
    <livewire:tasks.components.filters :search="$search" :is-done="$isDone" />
    <livewire:tasks.components.table :search="$search" :is-done="$isDone" />
</div>