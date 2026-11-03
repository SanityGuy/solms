<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(Chapter $chapter): View
    {
        $pages = $chapter->pages()->paginate(10);

        return view('admin.pages.index', compact('chapter', 'pages'));
    }

    public function create(Chapter $chapter): View
    {
        return view('admin.pages.create', compact('chapter'));
    }

    public function store(Request $request, Chapter $chapter): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'order' => ['required', 'integer', 'min:0'],
        ]);

        $chapter->pages()->create($validated);

        return redirect()
            ->route('admin.chapters.pages.index', $chapter)
            ->with('success', 'Page created successfully.');
    }

    public function show(Chapter $chapter, Page $page): View
    {
        abort_unless($page->chapter_id === $chapter->id, 404);

        return view('admin.pages.show', compact('chapter', 'page'));
    }

    public function edit(Chapter $chapter, Page $page): View
    {
        abort_unless($page->chapter_id === $chapter->id, 404);

        return view('admin.pages.edit', compact('chapter', 'page'));
    }

    public function update(Request $request, Chapter $chapter, Page $page): RedirectResponse
    {
        abort_unless($page->chapter_id === $chapter->id, 404);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'order' => ['required', 'integer', 'min:0'],
        ]);

        $page->update($validated);

        return redirect()
            ->route('admin.chapters.pages.index', $chapter)
            ->with('success', 'Page updated successfully.');
    }

    public function destroy(Chapter $chapter, Page $page): RedirectResponse
    {
        abort_unless($page->chapter_id === $chapter->id, 404);

        $page->delete();

        return redirect()
            ->route('admin.chapters.pages.index', $chapter)
            ->with('success', 'Page deleted successfully.');
    }
}
