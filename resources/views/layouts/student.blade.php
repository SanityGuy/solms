<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Learning') | SoLMS</title>
    <meta name="description" content="@yield('description', 'SoLMS – Learning made accessible')">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-50 focus:rounded-lg focus:bg-white focus:px-4 focus:py-2 focus:shadow-lg">
        Skip to content
    </a>

    <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-5 sm:px-8">
            <a href="{{ route('learn.index') }}" class="text-xl font-bold tracking-tight"><span
                    class="text-blue-600">So</span>LMS</a>
            <nav class="flex flex-wrap items-center gap-2 sm:gap-3" aria-label="Main navigation">
                <a href="{{ route('learn.index') }}" class="rounded-lg border px-4 py-2 text-sm font-medium transition duration-300 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2
                          {{ request()->routeIs('learn.index')
    ? 'border-blue-500 bg-blue-50 text-blue-700'
    : 'border-slate-200 text-slate-600 hover:text-white hover:bg-blue-500' }}">
                    <x-lucide-book class="mr-1 inline h-4 w-4" />
                    My Learning
                </a>
                <a href="{{ route('profile.edit') }}" class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 transition duration-300 ease-in-out hover:text-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2
                          {{ request()->routeIs('profile.edit')
    ? 'border-blue-500 bg-blue-50 text-blue-700'
    : 'border-slate-200 text-slate-600 hover:text-white hover:bg-blue-500' }}">
                    <x-lucide-user class="mr-1 inline h-4 w-4" />
                    {{ auth()->user()->display_name }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-white bg-red-500 transition duration-300 ease-in-out hover:bg-red-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2">
                        Sign out
                        <x-lucide-log-out class="ml-1 inline h-4 w-4" />
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <main id="main-content" class="mx-auto min-h-[calc(100dvh-4rem)] max-w-7xl px-5 py-8 sm:px-8 sm:py-12">
        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-white px-5 py-6 text-center text-xs text-slate-400">
        SoLMS · Learning made accessible
    </footer>

    @stack('scripts')
</body>

</html>