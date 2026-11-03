@extends('layouts.student')

@section('title', $page->title)

@section('content')
    <div class="mb-6">
        <a href="{{ route('learn.lesson', $lesson) }}"
            class="text-sm font-medium text-blue-600 hover:text-blue-700">{{ $lesson->title }}</a>
        <span class="mx-2 text-slate-300">/</span>
        <a href="{{ route('learn.chapter', [$lesson, $chapter]) }}"
            class="text-sm font-medium text-blue-600 hover:text-blue-700">{{ $chapter->title }}</a>
    </div>

    <div class="grid gap-6 lg:grid-cols-[260px_1fr]">
        <aside class="h-fit rounded-xl border border-slate-200 bg-white p-5">
            <h2 class="mb-4 text-sm font-bold text-slate-900">Chapter content</h2>
            <div class="space-y-2">
                @foreach($chapter->pages as $item)
                    <a href="{{ route('learn.page', [$lesson, $chapter, $item]) }}"
                        class="block rounded-lg px-3 py-3 text-sm transition {{ $item->id === $page->id ? 'bg-blue-50 font-semibold text-blue-700' : 'text-slate-600 hover:bg-slate-50' }}">{{ $item->order }}.
                        {{ $item->title }}</a>
                @endforeach
            </div>
        </aside>

        <article class="min-w-0 rounded-xl border border-slate-200 bg-white p-6 sm:p-10">
            <p class="text-sm font-semibold text-blue-600">{{ $chapter->title }}</p>
            <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ $page->title }}</h1>
            <div class="mt-8 whitespace-pre-wrap break-words text-base leading-8 text-slate-700">{{ $page->content }}</div>

            <div class="mt-12 flex flex-wrap justify-between gap-3 border-t border-slate-100 pt-6">
                @php
                    $previous = $chapter->pages->where('order', '<', $page->order)->sortByDesc('order')->first();
                    $next = $chapter->pages->where('order', '>', $page->order)->sortBy('order')->first();
                @endphp

                @if($previous)
                    <a href="{{ route('learn.page', [$lesson, $chapter, $previous]) }}"
                        class="rounded-lg border border-slate-200 px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50">←
                        Previous page</a>
                @else
                    <a href="{{ route('learn.chapter', [$lesson, $chapter]) }}"
                        class="rounded-lg border border-slate-200 px-4 py-3 text-sm font-medium text-slate-600 hover:bg-slate-50">←
                        Chapter overview</a>
                @endif

                @if($next)
                    <a href="{{ route('learn.page', [$lesson, $chapter, $next]) }}"
                        class="rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white hover:bg-blue-700">Next page
                        →</a>
                @else
                    <a href="{{ route('learn.lesson', $lesson) }}"
                        class="rounded-lg bg-blue-600 px-4 py-3 text-sm font-semibold text-white hover:bg-blue-700">Finish
                        chapter →</a>
                @endif
            </div>
        </article>
    </div>
@endsection