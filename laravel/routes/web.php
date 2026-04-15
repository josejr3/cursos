<?php

use App\Models\Course;
use App\Models\Short;
use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Livewire\Admin\AdminPanel;


Route::get('/limpiar-todo', function () {
    // Limpia la configuración y caché
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    
    // Ejecuta los Seeders
    // El '--force' es vital para que IONOS no bloquee el comando
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
    
    return "hola";
});

Route::get('/admin', AdminPanel::class)
    ->middleware(['auth'])
    ->name('admin.panel');

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

Route::get('shorts', function () {
    $shorts = Short::query()
        ->latest()
        ->get();

    return view('shorts.index', [
        'shorts' => $shorts,
    ]);
})->middleware(['auth', 'verified'])->name('shorts.index');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::redirect('courses', 'dashboard')
    ->middleware(['auth'])
    ->name('courses.index');

require __DIR__.'/auth.php';
