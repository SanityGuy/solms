<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Learning') | SoLMS</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">
    <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-5 sm:px-8">
            <a href="{{ route('learn.index') }}" class="text-xl font-bold tracking-tight"><span
                    class="text-blue-600">So</span>LMS</a>
            <nav class="flex items-center gap-4">
                <a href="{{ route('learn.index') }}" class="text-sm font-medium text-slate-600 hover:text-blue-600">My
                    learning</a>
                <span class="hidden text-sm text-slate-500 sm:block">{{ auth()->user()->display_name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">Sign
                        out</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="mx-auto min-h-[calc(100vh-4rem)] max-w-7xl px-5 py-8 sm:px-8 sm:py-12">
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-white px-5 py-6 text-center text-xs text-slate-400">
        SoLMS · Learning made accessible
    </footer>
</body>

</html>