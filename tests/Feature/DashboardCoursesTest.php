<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardCoursesTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_shows_youtube_thumbnail_for_courses(): void
    {
        $user = User::factory()->create();

        Course::create([
            'titulo' => 'Curso con miniatura',
            'descripcion' => 'Descripción del curso.',
            'url_video' => 'https://www.youtube.com/watch?v=ImtZ5yENzgE',
            'estado' => 'activo',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response
            ->assertOk()
            ->assertSee('https://img.youtube.com/vi/ImtZ5yENzgE/hqdefault.jpg', false);
    }
}
