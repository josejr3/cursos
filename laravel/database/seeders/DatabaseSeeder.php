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
       // User::factory(5)->create();
        /*
        User::updateOrCreate(
            ['email' => 'comosa21@gmail.com'],
            [
                'nombre' => 'Test',
                'apellidos' => 'User',
                'descripcion' => 'Usuario de prueba',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(60),
            ]
        );
    */
        User::updateOrCreate(
            ['email' => 'admin@ejemplo.com'],
            [
                'nombre' => 'gestion@talentcamp.com',
                'apellidos' => 'Sistema',
                'email_verified_at' => now(),
                'password' => Hash::make('n#jZ{OGxO)7O'),
                'is_admin' => true,
            ]
        );

        Course::updateOrCreate(
            ['titulo' => 'Fundamentos de Laravel 12'],
            [
                'descripcion' => 'Aprende routing, controladores, Blade y autenticacion con un proyecto real paso a paso.',
                'url_video' => 'https://www.youtube.com/watch?v=ImtZ5yENzgE',
                'estado' => 'activo',
            ]
        );

        Course::updateOrCreate(
            ['titulo' => 'Curso Laravel 12 Livewire 3 desde cero'],
            [
                'descripcion' => 'Construye interfaces reactivas sin salir de PHP usando componentes Livewire y pantallas Volt.',
                'url_video' => 'https://www.youtube.com/watch?v=Avv1ZnkfkH0',
                'estado' => 'activo',
            ]
        );
        Course::updateOrCreate(
            ['titulo' => 'Curso de Reactjs desde Cero'],
            [
                'descripcion' => 'En este curso de React aprenderás las bases necesarias de React como componentes (Components), props, estado (useState), hooks, estilos',
                'url_video' => 'https://www.youtube.com/watch?v=rLoWMU4L_qE',
                'estado' => 'activo',
            ]
        );
        Course::updateOrCreate(
            ['titulo' => 'Eloquent el ORM de Laravel 11'],
            [
                'descripcion' => 'Domina relaciones, scopes y buenas practicas de consulta para mejorar rendimiento en producción.',
                'url_video' => 'https://www.youtube.com/watch?v=9-lBWMdEnCA',
                'estado' => 'activo',
            ]
        );
    }
}
