@extends('layouts.student')

@section('title', 'My Learning')

@section('content')
    <div class="mb-10">
        <p class="text-sm font-semibold text-blue-600">YOUR LEARNING SPACE</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Welcome back,
            {{ auth()->user()->display_name }}.</h1>
        <p class="mt-3 text-slate-500">Explore your lessons and continue learning at your own pace.</p>
    </div>

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-900">Available lessons</h2>
            <p class="mt-1 text-sm text-slate-500">{{ $lessons->total() }} lessons available</p>
        </div>
    </div>

    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @forelse($lessons as $lesson)
            <a href="{{ route('learn.lesson', $lesson) }}"
                class="group rounded-2xl border border-slate-200 bg-white p-6 transition duration-200 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-900/5">
                <div
                    class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-lg font-bold text-blue-600">
                    S</div>
                <h3 class="text-lg font-bold text-slate-900 transition group-hover:text-blue-600">{{ $lesson->title }}</h3>
                <p class="mt-2 min-h-12 text-sm leading-6 text-slate-500">
                    {{ $lesson->description ?: 'Explore this lesson and start learning.' }}</p>
                <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-4">
                    <span class="text-xs font-medium text-slate-400">{{ $lesson->chapters_count }} chapters</span>
                    <span class="text-sm font-semibold text-blue-600">Start learning →</span>
                </div>
            </a>
        @empty
            <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                <h3 class="font-semibold text-slate-900">No lessons available yet</h3>
                <p class="mt-2 text-sm text-slate-500">Your administrator has not published any learning material.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">{{ $lessons->links() }}</div>
@endsection