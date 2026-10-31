@php
    $editing = isset($lesson);
@endphp

<form method="POST" action="{{ $editing ? route('admin.lessons.update', $lesson) : route('admin.lessons.store') }}"
    class="space-y-6">
    @csrf
    @if($editing)
        @method('PUT')
    @endif

    <div>
        <label for="title" class="mb-2 block text-sm font-medium text-slate-300">Lesson title</label>
        <input id="title" type="text" name="title" value="{{ old('title', $lesson->title ?? '') }}"
            placeholder="e.g. Introduction to Web Development" required maxlength="255"
            class="w-full rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none placeholder:text-slate-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        @error('title')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="mb-2 block text-sm font-medium text-slate-300">Description</label>
        <textarea id="description" name="description" rows="5" maxlength="5000"
            placeholder="Describe what students will learn..."
            class="w-full resize-y rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-sm text-white outline-none placeholder:text-slate-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">{{ old('description', $lesson->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-col-reverse gap-3 border-t border-slate-800 pt-6 sm:flex-row sm:justify-end">
        <a href="{{ route('admin.lessons.index') }}"
            class="rounded-lg border border-slate-700 px-5 py-3 text-center text-sm font-semibold text-slate-300 transition hover:bg-slate-800">
            Cancel
        </a>
        <button type="submit"
            class="rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-500">
            {{ $editing ? 'Save changes' : 'Create lesson' }}
        </button>
    </div>
</form>