@extends('layouts.admin')

@section('title', 'Learning Pages')
@section('heading', 'Page Management')

@section('content')
    <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <a href="{{ route('admin.lessons.chapters.index', $chapter->lesson) }}"
                class="text-sm text-blue-400 hover:text-blue-300">← Back to chapters</a>
            <h1 class="mt-3 text-2xl font-bold text-white">{{ $chapter->title }}</h1>
            <p class="mt-1 text-sm text-slate-400">{{ $chapter->lesson->title }}</p>
        </div>
        <a href="{{ route('admin.chapters.pages.create', $chapter) }}"
            class="rounded-lg bg-blue-600 px-5 py-3 text-center text-sm font-semibold text-white hover:bg-blue-500">Add
            learning page</a>
    </div>

    <div class="overflow-hidden rounded-xl border border-slate-800 bg-slate-900">
        <div class="border-b border-slate-800 px-5 py-4">
            <h2 class="font-semibold text-white">Learning material</h2>
        </div>
        @forelse($pages as $page)
            <div
                class="flex flex-col justify-between gap-4 border-b border-slate-800 p-5 last:border-0 sm:flex-row sm:items-center">
                <div class="flex items-center gap-4">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-500/10 font-bold text-blue-400">
                        {{ $page->order }}</div>
                    <div>
                        <a href="{{ route('admin.chapters.pages.show', [$chapter, $page]) }}"
                            class="font-semibold text-white hover:text-blue-400">{{ $page->title }}</a>
                        <p class="mt-1 text-xs text-slate-500">
                            {{ \Illuminate\Support\Str::limit(strip_tags($page->content ?? ''), 90) }}</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.chapters.pages.show', [$chapter, $page]) }}"
                        class="rounded-lg bg-blue-600/10 px-3 py-2 text-sm text-blue-400 hover:bg-blue-600/20">Preview</a>
                    <a href="{{ route('admin.chapters.pages.edit', [$chapter, $page]) }}"
                        class="rounded-lg bg-slate-800 px-3 py-2 text-sm text-slate-300 hover:bg-slate-700">Edit</a>
                    <form method="POST" action="{{ route('admin.chapters.pages.destroy', [$chapter, $page]) }}"
                        onsubmit="return confirm('Delete this learning page?')">
                        @csrf
                        @method('DELETE')
                        <button
                            class="rounded-lg bg-red-500/10 px-3 py-2 text-sm text-red-400 hover:bg-red-500/20">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="px-5 py-14 text-center">
                <p class="font-semibold text-white">No learning pages yet</p>
                <p class="mt-2 text-sm text-slate-400">Create a page to add educational content to this chapter.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-5">{{ $pages->links() }}</div>
@endsection