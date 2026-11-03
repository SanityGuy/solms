@extends('layouts.admin')

@section('title', 'Chapters')
@section('heading', 'Chapter Management')

@section('content')
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <a href="{{ route('admin.lessons.index') }}" class="text-sm text-blue-400 hover:text-blue-300">← Back to
                lessons</a>
            <h1 class="mt-3 text-2xl font-bold text-white">{{ $lesson->title }}</h1>
            <p class="mt-1 text-sm text-slate-400">Manage chapters and their learning pages.</p>
        </div>
        <a href="{{ route('admin.lessons.chapters.create', $lesson) }}"
            class="rounded-lg bg-blue-600 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-blue-500">Add
            chapter</a>
    </div>

    <div class="mb-5 grid gap-4 sm:grid-cols-2">
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">Total chapters</p>
            <p class="mt-2 text-2xl font-bold text-white">{{ $lesson->chapters()->count() }}</p>
        </div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">Learning pages</p>
            <p class="mt-2 text-2xl font-bold text-white">
                {{ $lesson->chapters()->withCount('pages')->get()->sum('pages_count') }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-800 bg-slate-900">
        <div class="border-b border-slate-800 px-5 py-4">
            <h2 class="font-semibold text-white">All chapters</h2>
        </div>
        @forelse($chapters as $chapter)
            <div
                class="flex flex-col justify-between gap-4 border-b border-slate-800 p-5 last:border-0 sm:flex-row sm:items-center">
                <div class="flex items-center gap-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-500/10 font-bold text-blue-400">
                        {{ $chapter->order }}</div>
                    <div>
                        <a href="{{ route('admin.chapters.pages.index', $chapter) }}"
                            class="font-semibold text-white hover:text-blue-400">{{ $chapter->title }}</a>
                        <p class="mt-1 text-xs text-slate-500">{{ $chapter->pages_count }} learning pages</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.chapters.pages.index', $chapter) }}"
                        class="rounded-lg bg-blue-600/10 px-3 py-2 text-sm text-blue-400 hover:bg-blue-600/20">Pages</a>
                    <a href="{{ route('admin.lessons.chapters.edit', [$lesson, $chapter]) }}"
                        class="rounded-lg bg-slate-800 px-3 py-2 text-sm text-slate-300 hover:bg-slate-700">Edit</a>
                    <form method="POST" action="{{ route('admin.lessons.chapters.destroy', [$lesson, $chapter]) }}"
                        onsubmit="return confirm('Delete this chapter and all its pages?')">
                        @csrf
                        @method('DELETE')
                        <button
                            class="rounded-lg bg-red-500/10 px-3 py-2 text-sm text-red-400 hover:bg-red-500/20">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="px-5 py-14 text-center">
                <p class="font-semibold text-white">No chapters yet</p>
                <p class="mt-2 text-sm text-slate-400">Create your first chapter to start building this lesson.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-5">{{ $chapters->links() }}</div>
@endsection