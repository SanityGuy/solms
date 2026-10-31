@extends('layouts.admin')

@section('title', $lesson->title)
@section('heading', 'Lesson Details')

@section('content')
    <div class="mb-8">
        <a href="{{ route('admin.lessons.index') }}" class="text-sm text-slate-400 transition hover:text-blue-400">
            ← Back to lessons
        </a>

        <div class="mt-5 flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
            <div>
                <p class="text-sm font-medium text-blue-400">LESSON DETAILS</p>
                <h1 class="mt-2 text-2xl font-bold text-white">{{ $lesson->title }}</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-400">
                    {{ $lesson->description ?: 'No description provided.' }}
                </p>
            </div>

            <a href="{{ route('admin.lessons.edit', $lesson) }}"
                class="rounded-lg bg-blue-600 px-5 py-3 text-center text-sm font-semibold text-white transition hover:bg-blue-500">
                Edit lesson
            </a>
        </div>
    </div>

    <div class="mb-6 grid gap-4 sm:grid-cols-3">
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">Total chapters</p>
            <p class="mt-2 text-3xl font-bold text-white">{{ $lesson->chapters->count() }}</p>
        </div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">Total pages</p>
            <p class="mt-2 text-3xl font-bold text-white">
                {{ $lesson->chapters->sum(fn($chapter) => $chapter->pages->count()) }}</p>
        </div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-5">
            <p class="text-sm text-slate-400">Created by</p>
            <p class="mt-2 truncate text-lg font-semibold text-white">{{ $lesson->creator?->display_name ?? 'Unknown' }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-800 bg-slate-900">
        <div class="flex items-center justify-between border-b border-slate-800 p-5">
            <div>
                <h2 class="font-semibold text-white">Chapters</h2>
                <p class="mt-1 text-xs text-slate-500">The learning structure of this lesson.</p>
            </div>
            <span class="rounded-md bg-blue-500/10 px-3 py-1.5 text-xs font-semibold text-blue-400">
                {{ $lesson->chapters->count() }} chapters
            </span>
        </div>

        @forelse($lesson->chapters as $chapter)
            <div class="border-b border-slate-800 p-5 last:border-b-0">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex min-w-0 items-start gap-4">
                        <div
                            class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-500/10 text-sm font-bold text-blue-400">
                            {{ $chapter->order }}
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-semibold text-white">{{ $chapter->title }}</h3>
                            <p class="mt-1 text-xs text-slate-500">{{ $chapter->pages->count() }} learning pages</p>
                        </div>
                    </div>
                </div>

                @if($chapter->pages->count())
                    <div class="mt-4 space-y-2 pl-13">
                        @foreach($chapter->pages as $page)
                            <div class="rounded-lg bg-slate-950 px-4 py-3 text-sm text-slate-400">
                                {{ $page->title }}
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div class="px-6 py-12 text-center">
                <h3 class="font-semibold text-white">No chapters yet</h3>
                <p class="mt-1 text-sm text-slate-500">Chapter management is our next development milestone.</p>
            </div>
        @endforelse
    </div>
@endsection