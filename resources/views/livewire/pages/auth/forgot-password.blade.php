<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="min-h-screen bg-background text-on-background font-body relative overflow-x-hidden flex flex-col">
    <div class="glow-orb absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary-dim opacity-10"></div>
    <div class="glow-orb absolute top-1/2 -right-48 w-[500px] h-[500px] rounded-full bg-secondary-container opacity-5"></div>
    <div class="glow-orb absolute -bottom-32 left-1/2 -translate-x-1/2 w-[600px] h-[600px] rounded-full bg-primary-container opacity-10"></div>

    <main class="flex-grow flex items-center justify-center px-4 py-12 z-10">
        <div class="w-full max-w-md">
            <div class="glass-panel bg-surface-container-high/60 rounded-xl p-8 md:p-10 border border-outline-variant/10 shadow-2xl">
                <div class="space-y-2">
                    <div class="flex justify-center mb-6">
                        <div class="font-headline text-3xl font-black tracking-tighter text-on-surface">
                            TALENT<span class="text-secondary">CAMP</span>
                        </div>
                    </div>
                    <h1 class="font-headline text-3xl font-extrabold tracking-tight text-on-surface text-center">
                        Restablecer contrasena
                    </h1>
                    <p class="text-on-surface-variant text-center font-medium">
                        Introduce tu correo para recibir el enlace de recuperacion.
                    </p>
                </div>

                <x-auth-session-status class="mb-4 mt-6 text-secondary-fixed-dim" :status="session('status')" />

                <form wire:submit="sendPasswordResetLink" class="space-y-6 mt-6">
                    <div class="space-y-2">
                        <label for="email" class="block font-label text-sm font-semibold tracking-wider text-on-surface-variant uppercase ml-1">
                            Email
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-on-surface-variant group-focus-within:text-secondary transition-colors">mail</span>
                            </div>
                            <input
                                wire:model="email"
                                id="email"
                                type="email"
                                name="email"
                                required
                                autofocus
                                placeholder="ejemplo@correo.com"
                                class="w-full bg-surface-container-highest border-transparent rounded-xl py-4 pl-12 pr-4 text-on-surface focus:ring-1 focus:ring-secondary/40 focus:border-secondary/40 transition-all placeholder:text-outline"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                    </div>

                    <button type="submit" class="w-full bg-primary-dim hover:bg-primary py-5 rounded-full text-on-primary font-label font-bold tracking-[0.1em] text-sm transition-all transform active:scale-[0.98] shadow-lg shadow-primary-dim/20 uppercase">
                        Enviar enlace
                    </button>
                </form>

                <div class="mt-10 text-center">
                    <a href="{{ route('login') }}" wire:navigate class="text-secondary-fixed-dim font-bold ml-1 hover:underline underline-offset-4 decoration-2 inline-flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">keyboard_backspace</span>
                        Volver al inicio de sesion
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
