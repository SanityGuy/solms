<div class="space-y-6">
    <div>
        <label class="mb-2 block text-sm font-medium text-slate-300">Page title</label>
        <input type="text" name="title" value="{{ old('title', $page->title ?? '') }}" required maxlength="255"
            class="w-full rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none focus:border-blue-500">
        @error('title')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-300">Learning content</label>
        <textarea name="content" rows="18"
            class="w-full rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 leading-7 text-white outline-none focus:border-blue-500"
            placeholder="Write your learning material here...">{{ old('content', $page->content ?? '') }}</textarea>
        <p class="mt-2 text-xs text-slate-500">Plain text is supported. Line breaks will be preserved for students.</p>
        @error('content')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-slate-300">Display order</label>
        <input type="number" name="order" min="0"
            value="{{ old('order', $page->order ?? (($chapter->pages()->max('order') ?? 0) + 1)) }}" required
            class="w-full rounded-lg border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none focus:border-blue-500">
        <p class="mt-2 text-xs text-slate-500">Lower numbers appear first.</p>
        @error('order')
            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>
</div>