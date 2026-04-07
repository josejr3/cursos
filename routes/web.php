<?php

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\RegisterUser;

Route::get('/admin/usuarios', RegisterUser::class)
    ->middleware(['auth'])
    ->name('admin.users');

Route::redirect('/', '/login');

Route::get('dashboard', function () {
    $courses = Course::query()
        ->where('estado', 'activo')
        ->latest()
        ->get();

    return view('dashboard', [
        'courses' => $courses,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('concursantes', function () {
    $contestants = User::query()
        ->where('is_admin', false)
        ->where('email', '!=', auth()->user()->email)
        ->orderBy('nombre')
        ->orderBy('apellidos')
        ->get();

    return view('contestants.index', [
        'contestants' => $contestants,
    ]);
})->middleware(['auth', 'verified'])->name('contestants.index');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::redirect('courses', 'dashboard')
    ->middleware(['auth'])
    ->name('courses.index');

require __DIR__.'/auth.php';
