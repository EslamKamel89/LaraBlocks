<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
    <!-- Page header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-gray-200 pb-4">
        <div class="space-y-2">
            <div class="flex flex-col sm:items-baseline sm:justify-between">
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">
                    {{ $title }}
                </h1>
                @auth
                <h2 class="text-lg text-gray-600 mt-1 sm:mt-0">
                    👋 Welcome back,
                    <span class="font-semibold text-gray-800">{{ $username }}</span>
                </h2>
                @endauth
            </div>

            <p class="text-sm text-gray-500">
                Manage, filter, and review your tasks — all in one place.
            </p>
        </div>

        <!-- Actions -->
        <div class="flex flex-wrap items-center gap-2">
            @auth
            <button
                class="inline-flex items-center gap-2 rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <i class="bi bi-download"></i>
                <span>Export</span>
            </button>

            <a
                wire:navigate
                href="{{ route('tasks.create') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 text-white px-3 py-2 text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <i class="bi bi-plus-lg"></i>
                <span>New Task</span>
            </a>

            <button
                wire:click="logout"
                class="inline-flex items-center gap-2 rounded-lg border border-red-300 text-red-600 px-3 py-2 text-sm font-medium hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
            </button>
            @endauth

            @guest
            <a
                wire:navigate
                href="{{ route('users.login') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 text-white px-3 py-2 text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>

            <a
                wire:navigate
                href="{{ route('users.register') }}"
                class="inline-flex items-center gap-2 rounded-lg border border-gray-300 text-gray-700 px-3 py-2 text-sm font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                <i class="bi bi-person-plus"></i>
                <span>Register</span>
            </a>
            @endguest
        </div>
    </div>

    <!-- Filters -->
    <section>
        <livewire:tasks.components.filters :search="$search" :is-done="$isDone" />
    </section>

    <!-- Table -->
    <section>
        <livewire:tasks.components.table :search="$search" :is-done="$isDone" />
    </section>
</div>