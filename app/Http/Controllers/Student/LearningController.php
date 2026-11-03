<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Chapter;
use App\Models\Page;
use Illuminate\View\View;

class LearningController extends Controller
{
    public function index(): View
    {
        $lessons = Lesson::withCount('chapters')
            ->with('chapters')
            ->latest()
            ->paginate(12);

        return view('student.index', compact('lessons'));
    }

    public function lesson(Lesson $lesson): View
    {
        $lesson->load('chapters.pages');

        return view('student.lesson', compact('lesson'));
    }

    public function chapter(Lesson $lesson, Chapter $chapter): View
    {
        abort_unless($chapter->lesson_id === $lesson->id, 404);

        $chapter->load(['pages', 'lesson.chapters']);

        return view('student.chapter', compact('lesson', 'chapter'));
    }

    public function page(Lesson $lesson, Chapter $chapter, Page $page): View
    {
        abort_unless($chapter->lesson_id === $lesson->id, 404);
        abort_unless($page->chapter_id === $chapter->id, 404);

        $chapter->load(['pages', 'lesson.chapters']);

        return view('student.page', compact('lesson', 'chapter', 'page'));
    }
}
