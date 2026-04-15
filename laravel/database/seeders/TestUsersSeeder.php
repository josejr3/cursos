<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestUsersSeeder extends Seeder
{
    /**
     * Seed contestants for local testing.
     */
    public function run(): void
    {
        $users = [
            [
                'nombre' => 'Raul',
                'apellidos' => 'Mendoza',
                'email' => 'raul.mendoza@talentcamp.test',
                'descripcion' => 'Backend developer enfocado en Laravel y APIs REST.',
            ],
            [
                'nombre' => 'Laura',
                'apellidos' => 'Pineda',
                'email' => 'laura.pineda@talentcamp.test',
                'descripcion' => 'Frontend developer con enfoque en UX y componentes reutilizables.',
            ],
            [
                'nombre' => 'Mateo',
                'apellidos' => 'Carrasco',
                'email' => 'mateo.carrasco@talentcamp.test',
                'descripcion' => 'Full stack developer con interes en arquitectura limpia.',
            ],
            [
                'nombre' => 'Valeria',
                'apellidos' => 'Nunez',
                'email' => 'valeria.nunez@talentcamp.test',
                'descripcion' => 'QA engineer apasionada por pruebas automatizadas y calidad.',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'nombre' => $user['nombre'],
                    'apellidos' => $user['apellidos'],
                    'descripcion' => $user['descripcion'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('password123'),
                    'remember_token' => Str::random(10),
                    'is_admin' => false,
                ]
            );
        }
    }
}
