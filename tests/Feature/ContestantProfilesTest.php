<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ContestantProfilesTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_other_contestants_with_gmail_links(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('profile-photos/luis.png', 'fake-image');

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
            'profile_photo_path' => 'profile-photos/luis.png',
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
            ->assertSee('/images/default-avatar.svg', false)
            ->assertSee('/storage/profile-photos/luis.png', false)
            ->assertSee('https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=ana%40example.com', false)
            ->assertSee('https://mail.google.com/mail/?view=cm&amp;fs=1&amp;to=luis%40example.com', false);
    }
}
