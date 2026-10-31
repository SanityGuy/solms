@extends('layouts.admin')

@section('title', 'Create Lesson')
@section('heading', 'Create Lesson')

@section('content')
    <div class="mb-8">
        <a href="{{ route('admin.lessons.index') }}" class="text-sm text-slate-400 transition hover:text-blue-400">
            ← Back to lessons
        </a>
        <h1 class="mt-4 text-2xl font-bold text-white">Create a lesson</h1>
        <p class="mt-1 text-sm text-slate-400">Add a new subject to your learning platform.</p>
    </div>

    <div class="max-w-3xl rounded-xl border border-slate-800 bg-slate-900 p-6 sm:p-8">
        @include('admin.lessons._form')
    </div>
@endsection