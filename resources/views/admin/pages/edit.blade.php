@extends('layouts.admin')

@section('title', 'Edit Learning Page')
@section('heading', 'Edit Learning Page')

@section('content')
    <div class="mx-auto max-w-4xl">
        <a href="{{ route('admin.chapters.pages.index', $chapter) }}" class="text-sm text-blue-400 hover:text-blue-300">←
            Back to pages</a>
        <div class="mt-5 rounded-xl border border-slate-800 bg-slate-900 p-6 sm:p-8">
            <h1 class="text-xl font-bold text-white">Edit learning page</h1>
            <p class="mt-1 mb-7 text-sm text-slate-400">{{ $chapter->title }}</p>
            <form method="POST" action="{{ route('admin.chapters.pages.update', [$chapter, $page]) }}">
                @csrf
                @method('PUT')
                @include('admin.pages._form')
                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('admin.chapters.pages.index', $chapter) }}"
                        class="rounded-lg px-4 py-3 text-sm text-slate-400 hover:bg-slate-800">Cancel</a>
                    <button class="rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-500">Save
                        changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection