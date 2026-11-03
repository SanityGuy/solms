<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Student\LearningController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.lessons.index');
    }

    return redirect()->route('learn.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/learn', [LearningController::class, 'index'])->name('learn.index');
    Route::get('/learn/{lesson}', [LearningController::class, 'lesson'])->name('learn.lesson');
    Route::get('/learn/{lesson}/chapters/{chapter}', [LearningController::class, 'chapter'])->name('learn.chapter');
    Route::get('/learn/{lesson}/chapters/{chapter}/pages/{page}', [LearningController::class, 'page'])->name('learn.page');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('lessons', LessonController::class);
    Route::resource('lessons.chapters', ChapterController::class);
    Route::resource('chapters.pages', PageController::class);
});

require __DIR__.'/auth.php';
