<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Page;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'users' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'students' => User::where('role', 'student')->count(),
            'lessons' => Lesson::count(),
            'chapters' => Chapter::count(),
            'pages' => Page::count(),
        ];

        $recentUsers = User::latest()->take(6)->get();

        $recentLessons = Lesson::with('creator')
            ->withCount('chapters')
            ->latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentLessons'));
    }
}
