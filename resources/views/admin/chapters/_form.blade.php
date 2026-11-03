<div class="space-y-6">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-300">Chapter title</label>
        <input type="text" name="title" value="{{ old('title', $chapter->title ?? '') }}" required maxlength="255"
            class="w-full rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none focus:border-blue-500">
        @error('title')
        <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-300">Display order</label>
        <input type="number" name="order" min="0"
            value="{{ old('order', $chapter->order ?? (($lesson->chapters()->max('order') ?? 0) + 1)) }}" required
            class="w-full rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none focus:border-blue-500">
        <p class="mt-2 text-xs text-slate-500">Lower numbers appear first.</p>
        @error('order')
        <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
    </div>
</div>