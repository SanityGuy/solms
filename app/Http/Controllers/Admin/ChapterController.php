<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChapterController extends Controller
{
    public function index(Lesson $lesson): View
    {
        $chapters = $lesson->chapters()->withCount('pages')->paginate(10);

        return view('admin.chapters.index', compact('lesson', 'chapters'));
    }

    public function create(Lesson $lesson): View
    {
        return view('admin.chapters.create', compact('lesson'));
    }

    public function store(Request $request, Lesson $lesson): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
        ]);

        $lesson->chapters()->create($validated);

        return redirect()
            ->route('admin.lessons.chapters.index', $lesson)
            ->with('success', 'Chapter created successfully.');
    }

    public function show(Lesson $lesson, Chapter $chapter): RedirectResponse
    {
        abort_unless($chapter->lesson_id === $lesson->id, 404);

        return redirect()->route('admin.chapters.pages.index', $chapter);
    }

    public function edit(Lesson $lesson, Chapter $chapter): View
    {
        abort_unless($chapter->lesson_id === $lesson->id, 404);

        return view('admin.chapters.edit', compact('lesson', 'chapter'));
    }

    public function update(Request $request, Lesson $lesson, Chapter $chapter): RedirectResponse
    {
        abort_unless($chapter->lesson_id === $lesson->id, 404);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
        ]);

        $chapter->update($validated);

        return redirect()
            ->route('admin.lessons.chapters.index', $lesson)
            ->with('success', 'Chapter updated successfully.');
    }

    public function destroy(Lesson $lesson, Chapter $chapter): RedirectResponse
    {
        abort_unless($chapter->lesson_id === $lesson->id, 404);

        $chapter->delete();

        return redirect()
            ->route('admin.lessons.chapters.index', $lesson)
            ->with('success', 'Chapter deleted successfully.');
    }
}
