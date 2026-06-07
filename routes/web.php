<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect('/tasks')
        : redirect('/login');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleStatus']);

    Route::get('/attachments/{attachment}/download', [AttachmentController::class, 'download'])
        ->name('attachments.download');

    Route::delete('/attachments/{attachment}', [AttachmentController::class, 'destroy'])
        ->name('attachments.destroy');

    Route::resource('tasks', TaskController::class)->except(['show']);
});
