<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect('/tasks')
        : redirect('/login');
});

Route::get('/report-preview', function () {
    return response()->file(base_path('docs/gallery.html'));
});

Route::get('/report-assets/{path}', function (string $path) {
    $safe = str_replace(['..', '\\'], '', $path);
    $file = base_path('docs/'.$safe);

    if (! is_file($file)) {
        abort(404);
    }

    return response()->file($file);
})->where('path', '.*');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');

    Route::patch('/projects/{project}/toggle', [ProjectController::class, 'toggleStatus'])->name('projects.toggle');
    Route::post('/projects/{project}/members', [ProjectController::class, 'addMember'])->name('projects.members.add');
    Route::delete('/projects/{project}/members/{member}', [ProjectController::class, 'removeMember'])->name('projects.members.remove');
    Route::resource('projects', ProjectController::class)->except(['show']);

    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleStatus'])->name('tasks.toggle');

    Route::get('/attachments/{attachment}/download', [AttachmentController::class, 'download'])
        ->name('attachments.download');

    Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy'])
        ->name('attachments.destroy');

    Route::resource('tasks', TaskController::class)->except(['show']);
});
