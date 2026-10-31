@extends('layouts.admin')

@section('title', 'Lessons')
@section('heading', 'Lessons')

@section('content')
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="text-sm font-medium text-blue-400">CONTENT MANAGEMENT</p>
            <h1 class="mt-2 text-2xl font-bold tracking-tight text-white">Lessons</h1>
            <p class="mt-1 text-sm text-slate-400">Manage your learning materials and subjects.</p>
        </div>

        <a href="{{ route('admin.lessons.create') }}"
            class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-500">
            + Create lesson
        </a>
    </div>

    <div class="mb-5 grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">Total lessons</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ $lessons->total() }}</p>
        </div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">Current page</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ $lessons->currentPage() }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-800 bg-slate-900">
        <div class="border-b border-slate-800 p-5">
            <form method="GET" action="{{ route('admin.lessons.index') }}" class="flex flex-col gap-3 sm:flex-row">
                <input type="search" name="search" value="{{ $search }}" placeholder="Search lessons..."
                    class="w-full rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none placeholder:text-slate-500 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                <button
                    class="rounded-lg bg-slate-800 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                    Search
                </button>
                @if($search)
                    <a href="{{ route('admin.lessons.index') }}"
                        class="rounded-lg border border-slate-700 px-5 py-3 text-center text-sm text-slate-400 hover:bg-slate-800">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        @if($lessons->count())
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-slate-800 bg-slate-950/50 text-xs uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Lesson</th>
                            <th class="px-6 py-4 font-semibold">Creator</th>
                            <th class="px-6 py-4 font-semibold">Chapters</th>
                            <th class="px-6 py-4 font-semibold">Created</th>
                            <th class="px-6 py-4 text-right font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @foreach($lessons as $lesson)
                            <tr class="transition hover:bg-slate-800/40">
                                <td class="px-6 py-5">
                                    <a href="{{ route('admin.lessons.show', $lesson) }}"
                                        class="font-semibold text-white hover:text-blue-400">
                                        {{ $lesson->title }}
                                    </a>
                                    <p class="mt-1 max-w-xs truncate text-xs text-slate-500">
                                        {{ $lesson->description ?: 'No description provided.' }}
                                    </p>
                                </td>
                                <td class="px-6 py-5 text-slate-400">
                                    {{ $lesson->creator?->display_name ?? 'Unknown' }}
                                </td>
                                <td class="px-6 py-5">
                                    <span class="rounded-md bg-blue-500/10 px-2.5 py-1 text-xs font-semibold text-blue-400">
                                        {{ $lesson->chapters_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-slate-400">
                                    {{ $lesson->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.lessons.edit', $lesson) }}"
                                            class="text-sm font-medium text-blue-400 hover:text-blue-300">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.lessons.destroy', $lesson) }}"
                                            onsubmit="return confirm('Delete this lesson and all its chapters and pages?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-sm font-medium text-red-400 hover:text-red-300">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-800 p-5">
                {{ $lessons->links() }}
            </div>
        @else
            <div class="px-6 py-16 text-center">
                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-800 text-2xl text-slate-400">
                    +
                </div>
                <h3 class="mt-4 font-semibold text-white">No lessons found</h3>
                <p class="mt-1 text-sm text-slate-500">
                    {{ $search ? 'Try another search term.' : 'Create your first lesson to get started.' }}
                </p>
                @unless($search)
                    <a href="{{ route('admin.lessons.create') }}"
                        class="mt-5 inline-flex rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-500">
                        Create your first lesson
                    </a>
                @endunless
            </div>
        @endif
    </div>
@endsection