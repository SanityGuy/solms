<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') | SoLMS</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 font-sans text-slate-100 antialiased">
    <div class="min-h-screen lg:flex">
        <aside class="w-full border-b border-slate-800 bg-slate-900 lg:min-h-screen lg:w-64 lg:border-b-0 lg:border-r">
            <div class="flex h-16 items-center justify-between border-b border-slate-800 px-6">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold tracking-tight">
                    <span class="text-blue-500">So</span>LMS
                </a>
                <span class="rounded-md bg-blue-500/10 px-2 py-1 text-xs font-semibold text-blue-400">ADMIN</span>
            </div>

            <nav class="flex gap-2 overflow-x-auto p-4 lg:flex-col">
                <a href="{{ route('dashboard') }}"
                    class="rounded-lg px-4 py-3 text-sm font-medium text-slate-400 transition hover:bg-slate-800 hover:text-white">
                    Dashboard
                </a>
                <a href="{{ route('admin.lessons.index') }}"
                    class="rounded-lg px-4 py-3 text-sm font-medium transition {{ request()->routeIs('admin.lessons.*') ? 'bg-blue-600/15 text-blue-400' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    Lessons
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="rounded-lg px-4 py-3 text-sm font-medium transition {{ request()->routeIs('admin.users.*') ? 'bg-blue-600/15 text-blue-400' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    Manage Users
                </a>
            </nav>

            <div class="hidden border-t border-slate-800 p-4 lg:mt-auto lg:block">
                <div class="mb-3 px-3">
                    <p class="truncate text-sm font-semibold text-white">{{ auth()->user()->display_name }}</p>
                    <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                </div>
                <a href="{{ route('profile.edit') }}"
                    class="block rounded-lg px-3 py-2 text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                    Account settings
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full rounded-lg px-3 py-2 text-left text-sm text-slate-400 hover:bg-slate-800 hover:text-white">
                        Sign out
                    </button>
                </form>
            </div>
        </aside>

        <main class="min-w-0 flex-1">
            <header
                class="flex h-16 items-center justify-between border-b border-slate-800 bg-slate-900/60 px-5 sm:px-8">
                <div>
                    <p class="text-sm font-semibold text-white">@yield('heading', 'Administration')</p>
                    <p class="text-xs text-slate-500">SoLMS Management</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="hidden text-sm text-slate-400 sm:block">{{ auth()->user()->display_name }}</span>
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-600/20 text-sm font-bold text-blue-400">
                        {{ strtoupper(substr(auth()->user()->display_name, 0, 1)) }}
                    </div>
                </div>
            </header>

            <div class="mx-auto max-w-7xl p-5 sm:p-8">
                @if(session('success'))
                    <div
                        class="mb-6 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-400">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 rounded-xl border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-400">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>