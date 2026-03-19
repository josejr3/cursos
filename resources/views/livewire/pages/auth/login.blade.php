<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen bg-background text-on-background font-body relative overflow-x-hidden flex flex-col">
    <!-- Decorative Glow Orbs -->
    <div class="glow-orb absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary-dim opacity-10"></div>
    <div class="glow-orb absolute top-1/2 -right-48 w-[500px] h-[500px] rounded-full bg-secondary-container opacity-5"></div>
    <div class="glow-orb absolute -bottom-32 left-1/2 -translate-x-1/2 w-[600px] h-[600px] rounded-full bg-primary-container opacity-10"></div>
    
    <!-- Top Navigation -->

    
    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center px-4 py-12 z-10">
        <!-- Login Card -->
        <div class="w-full max-w-md">
            <div class="glass-panel bg-surface-container-high/60 rounded-xl p-8 md:p-10 border border-outline-variant/10 shadow-2xl">
                <!-- Card Header -->
                <div class="space-y-2">
                    <div class="flex justify-center mb-6">
                        <div class="font-headline text-3xl font-black tracking-tighter text-on-surface">
                            TALENT<span class="text-secondary">CAMP</span>
                        </div>
                    </div>
                    <h1 class="font-headline text-3xl font-extrabold tracking-tight text-on-surface text-center">
                        Bienvenido de nuevo
                    </h1>
                    <p class="text-on-surface-variant text-center font-medium">
                        Inicia sesión para continuar.
                    </p>
                </div>
                
                <!-- Session Status -->
                <x-auth-session-status class="mb-4 mt-6" :status="session('status')" />
                
                <!-- Form -->
                <form wire:submit="login" class="space-y-6 mt-6">
                    <!-- Email Input -->
                    <div class="space-y-2">
                        <label for="email" class="block font-label text-sm font-semibold tracking-wider text-on-surface-variant uppercase ml-1">
                            Email
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-on-surface-variant group-focus-within:text-secondary transition-colors">mail</span>
                            </div>
                            <input 
                                wire:model="form.email" 
                                id="email" 
                                class="w-full bg-surface-container-highest border-transparent rounded-xl py-4 pl-12 pr-4 text-on-surface focus:ring-1 focus:ring-secondary/40 focus:border-secondary/40 transition-all placeholder:text-outline" 
                                placeholder="ejemplo@correo.com" 
                                type="email"
                                required 
                                autofocus 
                                autocomplete="username"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-red-400" />
                    </div>
                    
                    <!-- Password Input -->
                    <div class="space-y-2">
                        <label for="password" class="block font-label text-sm font-semibold tracking-wider text-on-surface-variant uppercase ml-1">
                            Contraseña
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="material-symbols-outlined text-on-surface-variant group-focus-within:text-secondary transition-colors">lock</span>
                            </div>
                            <input 
                                wire:model="form.password" 
                                id="password" 
                                class="w-full bg-surface-container-highest border-transparent rounded-xl py-4 pl-12 pr-4 text-on-surface focus:ring-1 focus:ring-secondary/40 focus:border-secondary/40 transition-all placeholder:text-outline" 
                                placeholder="********" 
                                type="password"
                                required 
                                autocomplete="current-password"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-red-400" />
                    </div>
                    
                    <!-- Actions Row -->
                    <div class="flex items-center justify-between text-sm py-2">
                        <label for="remember" class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input 
                                    wire:model="form.remember" 
                                    id="remember" 
                                    class="peer appearance-none w-5 h-5 rounded border-2 border-outline-variant bg-transparent checked:bg-secondary checked:border-secondary transition-all cursor-pointer" 
                                    type="checkbox"
                                />
                                <span class="material-symbols-outlined absolute text-on-secondary text-base opacity-0 peer-checked:opacity-100 transition-opacity pointer-events-none" style="font-variation-settings: 'wght' 700;">check</span>
                            </div>
                            <span class="text-on-surface-variant font-medium group-hover:text-on-surface transition-colors">Recordarme</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-secondary-fixed-dim font-semibold hover:text-secondary transition-colors" href="{{ route('password.request') }}" wire:navigate>¿Olvidaste tu contraseña?</a>
                        @endif
                    </div>
                    
                    <!-- Submit Button -->
                    <button 
                        class="w-full bg-primary-dim hover:bg-primary py-5 rounded-full text-on-primary font-label font-bold tracking-[0.1em] text-sm transition-all transform active:scale-[0.98] shadow-lg shadow-primary-dim/20" 
                        type="submit"
                    >
                        INICIAR SESIÓN
                    </button>
                </form>
                
              
            </div>
        </div>
    </main>
</div>
