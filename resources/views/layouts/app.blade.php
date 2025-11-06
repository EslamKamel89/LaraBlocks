<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles



</head>

<body class="antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen lg:flex">

        <aside class="hidden lg:flex lg:w-72 lg:flex-col lg:border-r lg:bg-white">

            <div class="flex h-16 items-center gap-2 border-b px-4">
                <div class="grid place-items-center h-9 w-9 rounded-xl bg-indigo-600 text-white">
                    <i class="bi bi-grid-1x2"></i>
                </div>
                <span class="text-base font-semibold tracking-tight">{{ config('app.name', 'App') }}</span>
            </div>


            <nav class="flex-1 space-y-1 p-3">
                @php
                $nav = [
                ['label' => 'Tasks', 'icon' => 'check2-square', 'route' => 'tasks.index'],
                ];
                @endphp

                @foreach ($nav as $item)
                @php
                $active = $item['route'] ? request()->routeIs($item['route'].'*') : false;
                @endphp
                <a
                    @if($item['route']) href="{{ route($item['route']) }}" @else href="#" @endif
                    class="group flex items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium
                               {{ $active
                                   ? 'bg-indigo-50 text-indigo-700 ring-1 ring-inset ring-indigo-100'
                                   : 'hover:bg-gray-50 text-gray-700'
                               }}">
                    <i class="bi bi-{{ $item['icon'] }} text-lg opacity-80 group-hover:opacity-100"></i>
                    <span>{{ $item['label'] }}</span>
                    @if($active)
                    <span class="ml-auto h-2 w-2 rounded-full bg-indigo-500"></span>
                    @endif
                </a>
                @endforeach
            </nav>


            <div class="mt-auto border-t p-3">
                <a href="#" class="flex items-center gap-2 rounded-md px-3 py-2 text-sm text-red-600 border border-red-200 hover:bg-red-50">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </aside>


        <header class="sticky top-0 z-40 flex h-16 items-center justify-between border-b bg-white/80 px-4 backdrop-blur lg:hidden">
            <div class="flex items-center gap-2">
                <button
                    class="inline-flex items-center gap-2 rounded-md border px-3 py-2 text-sm hover:bg-gray-50"
                    @click="sidebarOpen = true"
                    aria-label="Open sidebar">
                    <i class="bi bi-list text-xl"></i>
                </button>
                <span class="font-semibold">{{ $title ?? config('app.name') }}</span>
            </div>
            <div class="flex items-center gap-2">
                <button class="rounded-md border p-2 hover:bg-gray-50">
                    <i class="bi bi-bell"></i>
                </button>
            </div>
        </header>


        <div
            class="fixed inset-0 z-50 lg:hidden"
            x-show="sidebarOpen"
            x-transition.opacity
            style="display:none">
            <div class="absolute inset-0 bg-black/40" @click="sidebarOpen = false"></div>
            <aside
                class="relative h-full w-80 max-w-[85%] bg-white shadow-xl ring-1 ring-black/5"
                x-show="sidebarOpen"
                x-transition:enter="transform transition ease-in-out duration-200"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transform transition ease-in-out duration-200"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full">
                <div class="flex items-center justify-between px-4 py-4 border-b">
                    <span class="text-base font-semibold">{{ config('app.name') }}</span>
                    <button class="rounded-md p-2 hover:bg-gray-100" @click="sidebarOpen = false" aria-label="Close sidebar">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <nav class="px-3 py-4 space-y-1">

                    <a href="{{ route('tasks.index') }}" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium hover:bg-gray-50">
                        <i class="bi bi-check2-square"></i> Tasks
                    </a>

                </nav>

                <div class="mt-auto border-t p-3">
                    <a href="#" class="flex items-center gap-2 rounded-md px-3 py-2 text-sm text-red-600 hover:bg-red-50">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </aside>
        </div>


        <div class="flex-1 ">

            <div class="sticky top-0 z-30 hidden h-16 items-center justify-between border-b bg-white/80 px-6 backdrop-blur lg:flex">
                <div class="flex items-center gap-3">
                    <h1 class="text-xl font-semibold tracking-tight">{{ $title ?? '' }}</h1>
                    <span class="hidden md:inline text-sm text-gray-500">Welcome back, <span class="font-medium">admin</span></span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="relative">
                        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input
                            type="search"
                            placeholder="Search…"
                            class="w-64 rounded-lg border bg-white pl-9 pr-3 py-2 text-sm shadow-sm placeholder:text-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <button class="rounded-full border p-2 hover:bg-gray-50">
                        <i class="bi bi-bell"></i>
                    </button>
                    <div class="h-8 w-8 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500"></div>
                </div>
            </div>


            <main class="px-4 py-6 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    {{ $slot ?? '' }}
                </div>
            </main>


            <footer class="border-t bg-white/70 backdrop-blur">
                <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 px-4 py-4 text-sm text-gray-600 sm:flex-row sm:px-6 lg:px-8">
                    <p>&copy; {{ now()->year }} {{ config('app.name') }}. All rights reserved.</p>
                    <div class="flex items-center gap-4">
                        <a href="#" class="hover:text-gray-900">Privacy</a>
                        <a href="#" class="hover:text-gray-900">Terms</a>
                        <a href="#" class="hover:text-gray-900">Support</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @livewireScripts
</body>

</html>
