@extends('layouts.student')

@section('title', $chapter->title)

@section('content')
    <a href="{{ route('learn.lesson', $lesson) }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">←
        {{ $lesson->title }}</a>

    <div class="mt-6">
        <p class="text-sm font-semibold text-blue-600">CHAPTER {{ $chapter->order }}</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $chapter->title }}</h1>
        <p class="mt-2 text-slate-500">{{ $chapter->pages->count() }} learning pages in this chapter.</p>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-[260px_1fr]">
        <aside class="h-fit rounded-xl border border-slate-200 bg-white p-5">
            <h2 class="mb-4 text-sm font-bold text-slate-900">Chapter pages</h2>
            <div class="space-y-2">
                @forelse($chapter->pages as $item)
                    <a href="{{ route('learn.page', [$lesson, $chapter, $item]) }}"
                        class="block rounded-lg px-3 py-3 text-sm text-slate-600 transition hover:bg-blue-50 hover:text-blue-700">{{ $item->order }}.
                        {{ $item->title }}</a>
                @empty
                    <p class="text-sm text-slate-400">No pages available.</p>
                @endforelse
            </div>
        </aside>

        <section class="rounded-xl border border-slate-200 bg-white p-7 sm:p-10">
            <h2 class="text-xl font-bold text-slate-900">Ready to begin?</h2>
            <p class="mt-2 leading-7 text-slate-500">Choose a page from the chapter menu to start reading the learning
                material.</p>
            @if($chapter->pages->isNotEmpty())
                <a href="{{ route('learn.page', [$lesson, $chapter, $chapter->pages->first()]) }}"
                    class="mt-6 inline-block rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-700">Start
                    chapter →</a>
            @endif
        </section>
    </div>
@endsection