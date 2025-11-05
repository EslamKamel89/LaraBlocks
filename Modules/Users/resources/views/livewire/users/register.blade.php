<div class="max-w-sm mx-auto p-6 space-y-6 bg-white border border-gray-200 rounded-lg shadow-sm">
    <h1 class="text-2xl font-semibold text-gray-900">{{ $title ?? 'Register' }}</h1>

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

    {{-- Registration Form --}}
    <form wire:submit.prevent="submit" class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input
                type="text"
                wire:model.live="name"
                placeholder="John Doe"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

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

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
            <input
                type="password"
                wire:model.live="password_confirmation"
                placeholder="••••••••"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        <button
            type="submit"
            class="w-full inline-flex justify-center items-center px-4 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition">
            <i class="bi bi-person-plus-fill mr-2"></i> Create Account
        </button>
    </form>

    <p class="text-center text-sm text-gray-600">
        Already have an account?
        <a wire:navigate href="{{ route('users.login') }}" class="text-blue-600 hover:underline">Login here</a>
    </p>
</div>