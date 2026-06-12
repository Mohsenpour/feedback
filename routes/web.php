<?php

use App\Http\Controllers\Admin\AdminFeedbackController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedbacks', [FeedbackController::class, 'store'])->name('feedbacks.store');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/feedbacks', [AdminFeedbackController::class, 'index'])->name('feedbacks.index');
    Route::patch('/feedbacks/{feedback}/status', [AdminFeedbackController::class, 'updateStatus'])
        ->name('feedbacks.status.update');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.feedbacks.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
