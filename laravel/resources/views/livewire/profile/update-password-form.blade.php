<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section class="text-white">
    <header>
        <h2 class="font-headline text-xl font-bold text-white">
            Seguridad
        </h2>

        <p class="mt-2 text-sm text-gray-400">
            Cambia tu contraseña periódicamente para mantener protegida tu cuenta.
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-5">
        <div>
            <x-input-label for="update_password_current_password" value="Contraseña actual" class="text-gray-200" />
            <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full border-white/10 bg-white/5 text-white focus:border-[#00FF00] focus:ring-[#00FF00]" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Nueva contraseña" class="text-gray-200" />
            <x-text-input wire:model="password" id="update_password_password" name="password" type="password" class="mt-1 block w-full border-white/10 bg-white/5 text-white focus:border-[#00FF00] focus:ring-[#00FF00]" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Confirmar contraseña" class="text-gray-200" />
            <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border-white/10 bg-white/5 text-white focus:border-[#00FF00] focus:ring-[#00FF00]" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="rounded-xl border border-white/10 bg-black/20 px-4 py-3 text-xs text-gray-400">
            Consejo: usa una contraseña larga con letras, números y símbolos.
        </div>

        <div class="flex flex-wrap items-center gap-4">
            <x-primary-button class="rounded-full !border-0 !bg-[#00FF00] px-5 py-2 text-sm font-bold normal-case tracking-normal !text-black hover:!bg-[#00e600] focus:!bg-[#00e600] active:!bg-[#00cc00] !focus:ring-[#00FF00]">
                Actualizar contraseña
            </x-primary-button>

            <x-action-message class="me-3 text-sm text-[#00FF00]" on="password-updated">
                Contraseña actualizada.
            </x-action-message>
        </div>
    </form>
</section>
