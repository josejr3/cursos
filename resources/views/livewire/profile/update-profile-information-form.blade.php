<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $nombre = '';
    public string $apellidos = '';
    public string $descripcion = '';
    public string $email = '';
    public ?string $currentPhotoUrl = null;
    public $photo = null;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $user = Auth::user();

        $this->nombre = $user->nombre ?? '';
        $this->apellidos = $user->apellidos ?? '';
        $this->descripcion = $user->descripcion ?? '';
        $this->email = $user->email;
        $this->currentPhotoUrl = $user->profile_photo_url;

        $this->syncFullName();
    }

    public function updatedName(string $value): void
    {
        $fullName = trim($value);

        if ($fullName === '') {
            $this->nombre = '';
            $this->apellidos = '';

            return;
        }

        $parts = preg_split('/\s+/', $fullName, 2);

        $this->nombre = $parts[0] ?? '';
        $this->apellidos = $parts[1] ?? '';
    }

    public function updatedNombre(): void
    {
        $this->syncFullName();
    }

    public function updatedApellidos(): void
    {
        $this->syncFullName();
    }

    protected function syncFullName(): void
    {
        $this->name = trim(implode(' ', array_filter([$this->nombre, $this->apellidos])));
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        if (trim($this->name) !== '' && trim($this->name) !== trim($this->nombre.' '.$this->apellidos)) {
            $this->updatedName($this->name);
        }

        $validated = $this->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string', 'max:1000'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->email, 'email')],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $validated['descripcion'] = filled($validated['descripcion'] ?? null)
            ? trim($validated['descripcion'])
            : null;

        unset($validated['photo']);

        if ($this->photo) {
            if (filled($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $validated['profile_photo_path'] = $this->photo->store('profile-photos', 'public');
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->syncFullName();
        $this->currentPhotoUrl = $user->fresh()->profile_photo_url;
        $this->reset('photo');

        $this->dispatch('profile-updated', name: $user->nombre);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="text-white">
    <header>
        <h2 class="font-headline text-2xl font-bold text-white">
            Información del perfil
        </h2>

        <p class="mt-2 text-sm text-gray-400">
            Actualiza tus datos personales, tu correo, tu foto y una breve descripción para que tu perfil esté siempre listo.
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6" enctype="multipart/form-data">
        <div class="rounded-2xl border border-white/10 bg-black/20 p-4 sm:p-5">
            <x-input-label for="photo" value="Foto de perfil" class="text-gray-200" />

            <div class="mt-3 flex flex-col gap-4 sm:flex-row sm:items-center">
                <img
                    src="{{ $photo ? $photo->temporaryUrl() : $currentPhotoUrl }}"
                    alt="Foto de perfil"
                    class="h-24 w-24 rounded-full object-cover border border-[#00FF00]/30 bg-black/30 shadow-[0_0_25px_rgba(0,255,0,0.12)]"
                >

                <div class="flex-1">
                    <input wire:model="photo" id="photo" name="photo" type="file" accept=".jpg,.jpeg,.png,.webp" class="block w-full text-sm text-gray-300 file:mr-4 file:rounded-full file:border-0 file:bg-[#00FF00] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-black hover:file:bg-[#00e600]" />
                    <p class="mt-2 text-xs text-gray-500">Si no subes una imagen, se mostrará el avatar por defecto.</p>
                    <x-input-error class="mt-2 text-red-400" :messages="$errors->get('photo')" />
                </div>
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <x-input-label for="nombre" value="Nombre" class="text-gray-200" />
                <x-text-input wire:model="nombre" id="nombre" name="nombre" type="text" class="mt-1 block w-full border-white/10 bg-white/5 text-white placeholder:text-gray-500 focus:border-[#00FF00] focus:ring-[#00FF00]" required autofocus autocomplete="given-name" />
                <x-input-error class="mt-2 text-red-400" :messages="$errors->get('nombre')" />
            </div>

            <div>
                <x-input-label for="apellidos" value="Apellidos" class="text-gray-200" />
                <x-text-input wire:model="apellidos" id="apellidos" name="apellidos" type="text" class="mt-1 block w-full border-white/10 bg-white/5 text-white placeholder:text-gray-500 focus:border-[#00FF00] focus:ring-[#00FF00]" required autocomplete="family-name" />
                <x-input-error class="mt-2 text-red-400" :messages="$errors->get('apellidos')" />
            </div>
        </div>

        <div>
            <x-input-label for="email" value="Correo electrónico" class="text-gray-200" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full border-white/10 bg-white/5 text-white placeholder:text-gray-500 focus:border-[#00FF00] focus:ring-[#00FF00]" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div class="mt-3 rounded-xl border border-amber-400/20 bg-amber-400/10 px-4 py-3">
                    <p class="text-sm text-amber-100">
                        Tu correo electrónico aún no está verificado.

                        <button wire:click.prevent="sendVerification" class="ms-1 underline font-semibold text-amber-200 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-amber-300">
                            Reenviar verificación
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-[#00FF00]">
                            Te hemos enviado un nuevo enlace de verificación.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="descripcion" value="Descripción" class="text-gray-200" />
            <textarea
                wire:model="descripcion"
                id="descripcion"
                name="descripcion"
                rows="5"
                class="mt-1 block w-full rounded-xl border border-white/10 bg-white/5 text-white placeholder:text-gray-500 shadow-sm focus:border-[#00FF00] focus:ring-[#00FF00]"
                placeholder="Cuéntanos brevemente quién eres, qué haces o en qué te especializas"
            ></textarea>
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('descripcion')" />
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <x-primary-button class="rounded-full border-0 bg-[#00FF00] px-5 py-2 text-sm font-bold normal-case tracking-normal text-black hover:bg-[#00e600] focus:bg-[#00e600] active:bg-[#00cc00] focus:ring-[#00FF00]">
                Guardar cambios
            </x-primary-button>

            <x-action-message class="me-3 text-sm text-[#00FF00]" on="profile-updated">
                Cambios guardados.
            </x-action-message>

            <span wire:loading wire:target="photo,updateProfileInformation" class="text-sm text-gray-400">
                Actualizando perfil...
            </span>
        </div>
    </form>
</section>
