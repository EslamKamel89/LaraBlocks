<div class="max-w-sm mx-auto my-6 p-6 space-y-6 bg-white border border-gray-200 rounded-lg shadow-sm">
    <h1 class="text-2xl font-semibold text-gray-900">{{ $title ?? 'Login' }}</h1>

    {{-- Validation Errors --}}
    @if ($errors->any())
    <div class="border border-red-200 bg-red-50 text-red-700 rounded-lg p-3 text-sm">
        <ul class="list-disc ml-5 space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Session Errors --}}
    @if (session('serverErrors'))
    <div class="border border-red-200 bg-red-50 text-red-700 rounded-lg p-3 text-sm">
        <ul class="list-disc ml-5 space-y-1">
            @foreach (session('serverErrors') as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Login Form --}}
    <form wire:submit.prevent="submit" class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input
                type="email"
                wire:model.live="email"
                placeholder="you@example.com"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input
                type="password"
                wire:model.live="password"
                placeholder="••••••••"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                <input type="checkbox" wire:model.live="remember" class="rounded border-gray-300 focus:ring-blue-500">
                <span>Remember me</span>
            </label>

            <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
        </div>

        <button
            type="submit"
            class="w-full inline-flex justify-center items-center px-4 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition">
            <i class="bi bi-box-arrow-in-right mr-2"></i> Login
        </button>
    </form>
</div>