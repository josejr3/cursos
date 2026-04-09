<?php

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Livewire\Admin\AdminPanel;

Route::get('/arreglar-vite', function () {
    $target = '/usr/home/sodepalpracticas.com/web/build';
    $shortcut = '/usr/home/sodepalpracticas.com/laravel/public/build';
    
    // Crear la carpeta public si no existe
    if (!file_exists('/usr/home/sodepalpracticas.com/laravel/public')) {
        mkdir('/usr/home/sodepalpracticas.com/laravel/public', 0755, true);
    }

    if (symlink($target, $shortcut)) {
        return "¡Enlace de Vite creado con éxito!";
    } else {
        return "Error al crear el enlace. Verifica si la carpeta 'public/build' ya existe y bórrala primero.";
    }
});

Route::get('/limpiar-todo', function () {
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return "Caché de configuración limpiada. Intenta entrar a la web ahora.";
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

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::redirect('courses', 'dashboard')
    ->middleware(['auth'])
    ->name('courses.index');

require __DIR__.'/auth.php';
