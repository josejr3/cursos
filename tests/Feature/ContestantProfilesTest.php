<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContestantProfilesTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_other_contestants_with_gmail_links(): void
    {
        $currentUser = User::factory()->create([
            'nombre' => 'Raul',
            'apellidos' => 'Lopez',
            'email' => 'raul@example.com',
        ]);

        $firstContestant = User::factory()->create([
            'nombre' => 'Ana',
            'apellidos' => 'Perez',
            'email' => 'ana@example.com',
            'descripcion' => 'Frontend y diseño.',
        ]);

        $secondContestant = User::factory()->create([
            'nombre' => 'Luis',
            'apellidos' => 'Gomez',
            'email' => 'luis@example.com',
            'descripcion' => 'Backend y APIs.',
        ]);

        User::factory()->create([
            'nombre' => 'Admin',
            'apellidos' => 'Master',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        $response = $this->actingAs($currentUser)->get('/concursantes');

        $response
            ->assertOk()
            ->assertSee('Ana Perez')
            ->assertSee('ana@example.com')
            ->assertSee('Luis Gomez')
            ->assertSee('luis@example.com')
            ->assertDontSee('Raul Lopez')
            ->assertDontSee('admin@example.com')
            ->assertSee('https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=ana%40example.com', false)
            ->assertSee('https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=luis%40example.com', false);
    }
}
