@extends('layouts.admin')

@section('title', 'Edit User')
@section('heading', 'Edit User')

@section('content')
    <div class="mb-8">
        <a href="{{ route('admin.users.index') }}" class="text-sm text-slate-400 hover:text-white">← Back to users</a>
        <h1 class="mt-4 text-2xl font-bold text-white">Edit account</h1>
        <p class="mt-2 text-sm text-slate-400">Update {{ $user->display_name }}'s account information.</p>
    </div>

    <div class="max-w-2xl rounded-2xl border border-slate-800 bg-slate-900 p-6 sm:p-8">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            @include('admin.users._form', ['user' => $user])

            <div class="mt-8 flex flex-col-reverse justify-end gap-3 sm:flex-row">
                <a href="{{ route('admin.users.index') }}"
                    class="rounded-xl border border-slate-700 px-5 py-3 text-center text-sm font-medium text-slate-300 hover:bg-slate-800">
                    Cancel
                </a>
                <button type="submit"
                    class="rounded-xl bg-blue-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-500">
                    Save changes
                </button>
            </div>
        </form>
    </div>
@endsection