@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-sm text-blue-400">Overview</p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-white sm:text-3xl">
                Welcome back, {{ auth()->user()->display_name }}.
            </h1>
            <p class="mt-2 text-sm text-slate-400">
                Here's what's happening across your learning platform.
            </p>
        </div>

        <a href="{{ route('admin.lessons.create') }}"
            class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-500">
            Create lesson
        </a>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ([
            ['Total users', $stats['users'], 'Registered accounts', 'users'],
            ['Students', $stats['students'], 'Student accounts', 'graduation-cap'],
            ['Administrators', $stats['admins'], 'Management accounts', 'shield-check'],
            ['Lessons', $stats['lessons'], 'Available subjects', 'book-open'],
            ['Chapters', $stats['chapters'], 'Learning chapters', 'layers'],
            ['Pages', $stats['pages'], 'Learning materials', 'file-text'],
        ] as [$label, $value, $description, $icon])
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-5 transition hover:border-blue-500/40">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-400">{{ $label }}</p>
                        <p class="mt-3 text-3xl font-bold tracking-tight text-white">{{ number_format($value) }}</p>
                        <p class="mt-1 text-xs text-slate-500">{{ $description }}</p>
                    </div>
                    <div class="rounded-xl bg-blue-500/10 p-3 text-blue-400">
                        @if ($icon === 'users')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM20 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        @elseif ($icon === 'graduation-cap')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m2 10 10-5 10 5-10 5-10-5ZM6 12v5c3.5 3 8.5 3 12 0v-5M22 10v6"/></svg>
                        @elseif ($icon === 'shield-check')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 22s8-4 8-11V5l-8-3-8 3v6c0 7 8 11 8 11Z"/><path d="m9 12 2 2 4-4"/></svg>
                        @elseif ($icon === 'book-open')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 7v14M3 18V5a2 2 0 0 1 2-2h3a4 4 0 0 1 4 4 4 4 0 0 1 4-4h3a2 2 0 0 1 2 2v13h-5a4 4 0 0 0-4 3 4 4 0 0 0-4-3H3Z"/></svg>
                        @elseif ($icon === 'layers')
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="m12 2 9 5-9 5-9-5 9-5ZM3 12l9 5 9-5M3 17l9 5 9-5"/></svg>
                        @else
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h8"/></svg>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-2">
        <section class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
            <div class="flex items-center justify-between border-b border-slate-800 px-5 py-4">
                <div>
                    <h2 class="font-semibold text-white">Recent users</h2>
                    <p class="mt-1 text-xs text-slate-500">Latest registered accounts</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="text-sm font-medium text-blue-400 hover:text-blue-300">View all</a>
            </div>

            <div class="divide-y divide-slate-800">
                @forelse ($recentUsers as $user)
                    <div class="flex items-center justify-between gap-3 px-5 py-4">
                        <div class="flex min-w-0 items-center gap-3">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-500/10 font-semibold text-blue-400">
                                {{ strtoupper(substr($user->display_name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="truncate text-sm font-medium text-white">{{ $user->display_name }}</p>
                                <p class="truncate text-xs text-slate-500">{{ $user->email }}</p>
                            </div>
                        </div>
                        <span class="shrink-0 rounded-full px-2.5 py-1 text-xs font-medium {{ $user->role === 'admin' ? 'bg-blue-500/10 text-blue-400' : 'bg-slate-800 text-slate-400' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                @empty
                    <p class="px-5 py-8 text-center text-sm text-slate-500">No users registered yet.</p>
                @endforelse
            </div>
        </section>

        <section class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
            <div class="flex items-center justify-between border-b border-slate-800 px-5 py-4">
                <div>
                    <h2 class="font-semibold text-white">Recent lessons</h2>
                    <p class="mt-1 text-xs text-slate-500">Recently created learning content</p>
                </div>
                <a href="{{ route('admin.lessons.index') }}" class="text-sm font-medium text-blue-400 hover:text-blue-300">View all</a>
            </div>

            <div class="divide-y divide-slate-800">
                @forelse ($recentLessons as $lesson)
                    <div class="flex items-center justify-between gap-3 px-5 py-4">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-white">{{ $lesson->title }}</p>
                            <p class="mt-1 truncate text-xs text-slate-500">
                                By {{ $lesson->creator?->display_name ?? 'Unknown' }}
                            </p>
                        </div>
                        <span class="shrink-0 rounded-lg bg-slate-800 px-3 py-1.5 text-xs text-slate-300">
                            {{ $lesson->chapters_count }} chapters
                        </span>
                    </div>
                @empty
                    <p class="px-5 py-8 text-center text-sm text-slate-500">No lessons created yet.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
