<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-black font-['Inter',_sans-serif] text-[#f0f0f5]">
    <div class="relative z-10 w-full max-w-[420px] p-[40px] bg-[#14141c]/45 backdrop-blur-[30px] border border-white/10 rounded-[24px] shadow-[0_30px_60px_rgba(0,0,0,0.6),inset_0_0_20px_rgba(255,255,255,0.02)] flex flex-col items-center mx-4 max-sm:p-[30px_24px]">
        
        <div class="font-['Montserrat',_sans-serif] text-[28px] font-extrabold tracking-[-0.5px] uppercase mb-[10px]">
            TALENT<span class="text-transparent bg-clip-text bg-gradient-to-br from-[#00ff00] to-[#00ff00] drop-shadow-[0_0_8px_rgba(0,255,0,0.4)]">CAMP</span>
        </div>
        
        <p class="text-[#8b8b99] text-[14px] mb-[40px] text-center font-medium">
            Bienvenido de nuevo. Inicia sesión para continuar.
        </p>

        <x-auth-session-status class="mb-4 w-full" :status="session('status')" />

        <form wire:submit="login" class="w-full">
            <div class="w-full mb-[24px]">
                <label for="email" class="block text-[13px] text-[#f0f0f5] mb-[8px] font-medium ml-1">Email</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="text-[#8b8b99] group-focus-within:text-[#00ff00] transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </div>
                    <input 
                        wire:model="form.email" 
                        id="email" 
                        type="email" 
                        required 
                        autofocus 
                        autocomplete="username" 
                        class="w-full bg-[#25252a]/60 border border-white/10 rounded-[16px] py-3 pl-12 pr-4 text-[#f0f0f5] font-['Inter',_sans-serif] text-[15px] outline-none transition-all duration-300 placeholder:text-[#8b8b99] focus:ring-1 focus:ring-[#00ff00]/40 focus:border-[#00ff00] [&:-webkit-autofill]:shadow-[inset_0_0_0px_1000px_#25252a] [&:-webkit-autofill]:[-webkit-text-fill-color:#f0f0f5] [&:-webkit-autofill]:![font-family:'Inter',_sans-serif] [&:-webkit-autofill]:focus:!shadow-[inset_0_0_0px_1000px_#25252a,0_0_0_2px_rgba(0,255,0,0.4)]" 
                        placeholder="ejemplo@correo.com" 
                    />
                </div>
                <x-input-error :messages="$errors->get('form.email')" class="mt-2 text-red-400 text-sm" />
            </div>

            <div class="w-full mb-[24px]">
                <label for="password" class="block text-[13px] text-[#f0f0f5] mb-[8px] font-medium ml-1">Contraseña</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="text-[#8b8b99] group-focus-within:text-[#00ff00] transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </div>
                    <input 
                        wire:model="form.password" 
                        id="password" 
                        type="password" 
                        required 
                        autocomplete="current-password" 
                        class="w-full bg-[#25252a]/60 border border-white/10 rounded-[16px] py-3 pl-12 pr-4 text-[#f0f0f5] font-['Inter',_sans-serif] text-[15px] outline-none transition-all duration-300 placeholder:text-[#8b8b99] focus:ring-1 focus:ring-[#00ff00]/40 focus:border-[#00ff00] [&:-webkit-autofill]:shadow-[inset_0_0_0px_1000px_#0a0a0f] [&:-webkit-autofill]:[-webkit-text-fill-color:#f0f0f5] [&:-webkit-autofill]:![font-family:'Inter',_sans-serif]" 
                        placeholder="••••••••" 
                    />
                </div>
                <x-input-error :messages="$errors->get('form.password')" class="mt-2 text-red-400 text-sm" />
            </div>

            <div class="w-full flex justify-between items-center mb-[32px] text-[13px]">
                <label for="remember" class="flex items-center text-[#8b8b99] cursor-pointer group">
                    <div class="relative flex items-center justify-center mr-[8px]">
                        <input wire:model="form.remember" id="remember" type="checkbox" class="peer appearance-none w-[18px] h-[18px] border border-white/20 rounded-[4px] bg-white/5 checked:bg-[#00ff00] checked:border-[#00ff00] checked:shadow-[0_0_10px_rgba(0,255,0,0.4)] transition-all cursor-pointer">
                        <span class="absolute text-[#050507] text-[12px] font-bold opacity-0 peer-checked:opacity-100 pointer-events-none">✓</span>
                    </div>
                    <span class="transition-colors duration-300 group-hover:text-[#f0f0f5]">Recordarme</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" wire:navigate class="text-[#8b8b99] no-underline transition-all duration-300 hover:text-[#00ff00] hover:drop-shadow-[0_0_8px_rgba(0,255,0,0.4)]">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full py-[14px] bg-[#00ff00] text-[#050507] border-none rounded-[16px] cursor-pointer font-['Montserrat',_sans-serif] font-bold text-[16px] uppercase tracking-[0.5px] transition-all duration-300 shadow-[0_4px_20px_rgba(0,255,0,0.4)] hover:bg-[#00e600] hover:shadow-[0_6px_25px_rgba(0,255,0,0.6)] hover:-translate-y-[2px]">
                Iniciar Sesión
            </button>
        </form>
        
    </div>
</div>