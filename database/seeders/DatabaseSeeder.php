<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();

        User::updateOrCreate(
            ['email' => 'comosa21@gmail.com'],
            [
                'nombre' => 'Test',
                'apellidos' => 'User',
                'descripcion' => 'Usuario de prueba',
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(60),
            ]
        );
        User::factory()->create([
        'nombre' => 'Admin',
        'apellidos' => 'Sistema',
        'email' => 'admin@ejemplo.com',
        'password' => Hash::make('test'),
        'is_admin' => true,
        ]);

        Course::updateOrCreate(
            ['titulo' => 'Fundamentos de Laravel 12'],
            [
                'descripcion' => 'Aprende routing, controladores, Blade y autenticacion con un proyecto real paso a paso.',
                'url_video' => 'https://www.youtube.com/watch?v=ImtZ5yENzgE',
                'estado' => 'activo',
            ]
        );

        Course::updateOrCreate(
            ['titulo' => 'Livewire y Volt desde cero'],
            [
                'descripcion' => 'Construye interfaces reactivas sin salir de PHP usando componentes Livewire y pantallas Volt.',
                'url_video' => 'https://www.youtube.com/watch?v=U6YfFj2J9Ao',
                'estado' => 'activo',
            ]
        );

        Course::updateOrCreate(
            ['titulo' => 'Eloquent para aplicaciones escalables'],
            [
                'descripcion' => 'Domina relaciones, scopes y buenas practicas de consulta para mejorar rendimiento en producción.',
                'url_video' => 'https://www.youtube.com/watch?v=T7PRf5G2nZ8',
                'estado' => 'activo',
            ]
        );
    }
}
