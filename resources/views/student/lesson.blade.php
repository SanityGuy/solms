@extends('layouts.student')

@section('title', $lesson->title)

@section('content')
    <a href="{{ route('learn.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">← All lessons</a>

    <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-7 sm:p-10">
        <p class="text-sm font-semibold text-blue-600">COURSE OVERVIEW</p>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ $lesson->title }}</h1>
        <p class="mt-4 max-w-3xl leading-7 text-slate-500">{{ $lesson->description }}</p>
        <div class="mt-6 text-sm text-slate-400">{{ $lesson->chapters->count() }} chapters ·
            {{ $lesson->chapters->sum(fn($chapter) => $chapter->pages->count()) }} learning pages</div>
    </div>

    <div class="mt-10">
        <h2 class="mb-5 text-xl font-bold text-slate-900">Course content</h2>
        <div class="space-y-4">
            @forelse($lesson->chapters as $chapter)
                <a href="{{ route('learn.chapter', [$lesson, $chapter]) }}"
                    class="flex items-center justify-between gap-4 rounded-xl border border-slate-200 bg-white p-5 transition hover:border-blue-200 hover:shadow-md">
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 font-bold text-blue-600">
                            {{ $chapter->order }}</div>
                        <div>
                            <h3 class="font-semibold text-slate-900">{{ $chapter->title }}</h3>
                            <p class="mt-1 text-xs text-slate-500">{{ $chapter->pages->count() }} learning pages</p>
                        </div>
                    </div>
                    <span class="text-blue-600">→</span>
                </a>
            @empty
                <p class="rounded-xl border border-dashed border-slate-300 bg-white p-8 text-center text-sm text-slate-500">No
                    chapters have been added yet.</p>
            @endforelse
        </div>
    </div>
@endsection