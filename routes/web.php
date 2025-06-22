<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'dashboard')
  ->middleware(['auth', 'verified'])
  ->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('products', ProductController::class)
  ->middleware(['auth', 'verified']);

Route::get('preferences/theme/{theme}', function (string $theme): void {
  $_SESSION['theme'] = $theme;
});

require __DIR__ . '/auth.php';
