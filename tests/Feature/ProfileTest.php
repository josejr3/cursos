<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Volt\Volt;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/profile');

        $response
            ->assertOk()
            ->assertSeeVolt('profile.update-profile-information-form')
            ->assertSeeVolt('profile.update-password-form')
            ->assertSeeVolt('profile.delete-user-form');
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $component = Volt::test('profile.update-profile-information-form')
            ->set('name', 'Test User')
            ->set('email', 'test@example.com')
            ->call('updateProfileInformation');

        $component
            ->assertHasNoErrors()
            ->assertNoRedirect();

        $user->refresh();

        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_profile_fields_can_be_updated_with_nombre_apellidos_y_descripcion(): void
    {
        $user = User::factory()->create([
            'nombre' => 'Ana',
            'apellidos' => 'Pérez López',
            'descripcion' => 'Descripción inicial',
        ]);

        $this->actingAs($user);

        $component = Volt::test('profile.update-profile-information-form')
            ->set('nombre', 'María')
            ->set('apellidos', 'García Soto')
            ->set('descripcion', 'Desarrolladora backend con experiencia en Laravel y Livewire.')
            ->set('email', 'maria@example.com')
            ->call('updateProfileInformation');

        $component
            ->assertHasNoErrors()
            ->assertNoRedirect();

        $user->refresh();

        $this->assertSame('María', $user->nombre);
        $this->assertSame('García Soto', $user->apellidos);
        $this->assertSame('Desarrolladora backend con experiencia en Laravel y Livewire.', $user->descripcion);
        $this->assertSame('maria@example.com', $user->email);
        $this->assertSame('María García Soto', $user->name);
        $this->assertNull($user->email_verified_at);
    }

    public function test_profile_photo_can_be_uploaded(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $this->actingAs($user);

        $component = Volt::test('profile.update-profile-information-form')
            ->set('nombre', $user->nombre)
            ->set('apellidos', $user->apellidos)
            ->set('descripcion', $user->descripcion ?? '')
            ->set('email', $user->email)
            ->set('photo', UploadedFile::fake()->create('avatar.png', 120, 'image/png'))
            ->call('updateProfileInformation');

        $component
            ->assertHasNoErrors()
            ->assertNoRedirect();

        $user->refresh();

        $this->assertNotNull($user->profile_photo_path);
        Storage::disk('public')->assertExists($user->profile_photo_path);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $component = Volt::test('profile.update-profile-information-form')
            ->set('name', 'Test User')
            ->set('email', $user->email)
            ->call('updateProfileInformation');

        $component
            ->assertHasNoErrors()
            ->assertNoRedirect();

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $component = Volt::test('profile.delete-user-form')
            ->set('password', 'password')
            ->call('deleteUser');

        $component
            ->assertHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $component = Volt::test('profile.delete-user-form')
            ->set('password', 'wrong-password')
            ->call('deleteUser');

        $component
            ->assertHasErrors('password')
            ->assertNoRedirect();

        $this->assertNotNull($user->fresh());
    }
}
