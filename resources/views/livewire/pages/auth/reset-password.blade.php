<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email')->toString();
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
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
                        Nueva contrasena
                    </h1>
                    <p class="text-on-surface-variant text-center font-medium">
                        Introduce tu nueva contrasena para recuperar el acceso.
                    </p>
                </div>

                <x-auth-session-status class="mb-4 mt-6 text-secondary-fixed-dim" :status="session('status')" />

                <form wire:submit="resetPassword" class="space-y-6 mt-6">
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
                                autocomplete="username"
                                placeholder="ejemplo@correo.com"
                                class="w-full bg-surface-container-highest border-transparent rounded-xl py-4 pl-12 pr-4 text-on-surface focus:ring-1 focus:ring-secondary/40 focus:border-secondary/40 transition-all placeholder:text-outline"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="block font-label text-sm font-semibold tracking-wider text-on-surface-variant uppercase ml-1">
                            Nueva contrasena
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-on-surface-variant group-focus-within:text-secondary transition-colors">lock</span>
                            </div>
                            <input
                                wire:model.defer="password"
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="********"
                                class="w-full bg-surface-container-highest border-transparent rounded-xl py-4 pl-12 pr-4 text-on-surface focus:ring-1 focus:ring-secondary/40 focus:border-secondary/40 transition-all placeholder:text-outline"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                    </div>

                    <div class="space-y-2">
                        <label for="password_confirmation" class="block font-label text-sm font-semibold tracking-wider text-on-surface-variant uppercase ml-1">
                            Confirmar contrasena
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-on-surface-variant group-focus-within:text-secondary transition-colors">password</span>
                            </div>
                            <input
                                wire:model.defer="password_confirmation"
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="********"
                                class="w-full bg-surface-container-highest border-transparent rounded-xl py-4 pl-12 pr-4 text-on-surface focus:ring-1 focus:ring-secondary/40 focus:border-secondary/40 transition-all placeholder:text-outline"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
                    </div>

                    <button type="submit" class="w-full bg-primary-dim hover:bg-primary py-5 rounded-full text-on-primary font-label font-bold tracking-[0.1em] text-sm transition-all transform active:scale-[0.98] shadow-lg shadow-primary-dim/20 uppercase">
                        Restablecer contrasena
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
