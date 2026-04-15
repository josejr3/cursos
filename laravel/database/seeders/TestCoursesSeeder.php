<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class TestCoursesSeeder extends Seeder
{
    /**
     * Seed sample courses for local testing.
     */
    public function run(): void
    {
        $courses = [
            [
                'titulo' => 'Laravel APIs con Sanctum',
                'descripcion' => 'Construye autenticacion con tokens, middlewares y buenas practicas para APIs seguras.',
                'url_video' => 'https://www.youtube.com/watch?v=KxwQy0qX95k',
                'estado' => 'activo',
            ],
            [
                'titulo' => 'Livewire 3 para Paneles Admin',
                'descripcion' => 'Aprende a crear interfaces reactivas en Laravel sin salir de PHP.',
                'url_video' => 'https://www.youtube.com/watch?v=Avv1ZnkfkH0',
                'estado' => 'activo',
            ],
            [
                'titulo' => 'Testing en Laravel con Pest',
                'descripcion' => 'Configura pruebas unitarias y de integracion para proteger funcionalidades criticas.',
                'url_video' => 'https://www.youtube.com/watch?v=E4k6x3rLx4A',
                'estado' => 'inactivo',
            ],
            [
                'titulo' => 'React desde Cero para Backend Devs',
                'descripcion' => 'Introduccion practica a componentes, estado y consumo de APIs en React.',
                'url_video' => 'https://www.youtube.com/watch?v=rLoWMU4L_qE',
                'estado' => 'activo',
            ],
        ];

        foreach ($courses as $course) {
            Course::updateOrCreate(
                ['titulo' => $course['titulo']],
                [
                    'descripcion' => $course['descripcion'],
                    'url_video' => $course['url_video'],
                    'estado' => $course['estado'],
                ]
            );
        }
    }
}
