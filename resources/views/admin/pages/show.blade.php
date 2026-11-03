@extends('layouts.admin')

@section('title', $page->title)
@section('heading', 'Page Preview')

@section('content')
    <div class="mx-auto max-w-4xl">
        <a href="{{ route('admin.chapters.pages.index', $chapter) }}" class="text-sm text-blue-400 hover:text-blue-300">←
            Back to pages</a>
        <div class="mt-5 rounded-xl border border-slate-800 bg-slate-900 p-6 sm:p-10">
            <p class="text-sm text-blue-400">{{ $chapter->lesson->title }} / {{ $chapter->title }}</p>
            <h1 class="mt-3 text-3xl font-bold text-white">{{ $page->title }}</h1>
            <div class="mt-8 whitespace-pre-wrap break-words leading-8 text-slate-300">{{ $page->content }}</div>
            <div class="mt-10 border-t border-slate-800 pt-5">
                <a href="{{ route('admin.chapters.pages.edit', [$chapter, $page]) }}"
                    class="rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-500">Edit
                    page</a>
            </div>
        </div>
    </div>
@endsection