<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="space-y-6 text-white">
    <header>
        <h2 class="font-headline text-xl font-bold text-red-300">
            Zona sensible
        </h2>

        <p class="mt-2 text-sm text-gray-400">
            Si eliminas tu cuenta, se borrarán permanentemente tus datos y no podrás recuperarlos después.
        </p>
    </header>

    <div class="rounded-xl border border-red-500/20 bg-red-500/10 p-4 text-sm text-red-100">
        Recomendación: solo elimina tu cuenta si estás completamente seguro.
    </div>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-full border-0 bg-[#EF4444] px-5 py-2 text-sm font-bold normal-case tracking-normal text-white hover:bg-[#DC2626] focus:bg-[#DC2626] active:bg-[#B91C1C] focus:ring-[#EF4444]"
    >Eliminar cuenta</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="deleteUser" class="rounded-2xl bg-[#0B1220] p-6 text-white border border-white/10 shadow-2xl">
            <h2 class="font-headline text-xl font-bold text-white">
                ¿Seguro que quieres eliminar tu cuenta?
            </h2>

            <p class="mt-2 text-sm text-gray-400">
                Esta acción es definitiva. Introduce tu contraseña para confirmar la eliminación de tu cuenta.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Contraseña" class="text-gray-200" />

                <x-text-input
                    wire:model="password"
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full border-white/10 bg-white/5 text-white focus:border-red-400 focus:ring-red-400"
                    placeholder="Escribe tu contraseña"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="border-slate-400/20 bg-slate-500/10 text-slate-200 hover:bg-slate-500/20 focus:ring-slate-300">
                    Cancelar
                </x-secondary-button>

                <x-danger-button class="rounded-full border-0 bg-[#EF4444] px-5 py-2 text-sm font-bold normal-case tracking-normal text-white hover:bg-[#DC2626] focus:bg-[#DC2626] active:bg-[#B91C1C] focus:ring-[#EF4444]">
                    Sí, eliminar cuenta
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
