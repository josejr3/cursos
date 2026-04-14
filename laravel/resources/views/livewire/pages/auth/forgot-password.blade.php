<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

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

<div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-black font-['Inter',_sans-serif] text-[#f0f0f5]">
    <div class="relative z-10 w-full max-w-[420px] p-[40px] bg-[#14141c]/45 backdrop-blur-[30px] border border-white/10 rounded-[24px] shadow-[0_30px_60px_rgba(0,0,0,0.6),inset_0_0_20px_rgba(255,255,255,0.02)] flex flex-col items-center mx-4 max-sm:p-[30px_24px]">
        
        <img src="{{ asset('images/logo.png') }}" alt="TalentCamp" class="h-16 w-16 object-contain mb-2">
        
        <p class="text-[#f0f0f5] text-[18px] font-bold mt-[10px] mb-[5px] text-center">
            Restablecer contraseña
        </p>
        <p class="text-[#8b8b99] text-[13px] mb-[30px] text-center font-medium">
            Introduce tu correo para recibir el enlace de recuperación.
        </p>

        <x-auth-session-status class="mb-4 w-full" :status="session('status')" />

        <form wire:submit="sendPasswordResetLink" class="w-full">
            <div class="w-full mb-[32px]">
                <label for="email" class="block text-[13px] text-[#f0f0f5] mb-[8px] font-medium ml-1">Email</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="text-[#8b8b99] group-focus-within:text-[#00ff00] transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </div>
                    <input 
                        wire:model="email" 
                        id="email" 
                        type="email" 
                        required 
                        autofocus 
                        autocomplete="username" 
                        class="w-full bg-[#25252a]/60 border border-white/10 rounded-[16px] py-3 pl-12 pr-4 text-[#f0f0f5] font-['Inter',_sans-serif] text-[15px] outline-none transition-all duration-300 placeholder:text-[#8b8b99] focus:ring-1 focus:ring-[#00ff00]/40 focus:border-[#00ff00] [&:-webkit-autofill]:shadow-[inset_0_0_0px_1000px_#25252a] [&:-webkit-autofill]:[-webkit-text-fill-color:#f0f0f5] [&:-webkit-autofill]:![font-family:'Inter',_sans-serif] [&:-webkit-autofill]:focus:!shadow-[inset_0_0_0px_1000px_#25252a,0_0_0_2px_rgba(0,255,0,0.4)]" 
                        placeholder="ejemplo@correo.com" 
                    />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
            </div>

            <button type="submit" class="w-full py-[14px] bg-[#00ff00] text-[#050507] border-none rounded-[16px] cursor-pointer font-['Montserrat',_sans-serif] font-bold text-[16px] uppercase tracking-[0.5px] transition-all duration-300 shadow-[0_4px_20px_rgba(0,255,0,0.4)] hover:bg-[#00e600] hover:shadow-[0_6px_25px_rgba(0,255,0,0.6)] hover:-translate-y-[2px]">
                Enviar enlace
            </button>
        </form>

        <div class="mt-[30px] text-center">
            <a href="{{ route('login') }}" wire:navigate class="text-[#8b8b99] no-underline font-medium text-[14px] flex items-center justify-center gap-2 transition-all duration-300 hover:text-[#00ff00] hover:drop-shadow-[0_0_8px_rgba(0,255,0,0.4)]">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Volver al inicio de sesión
            </a>
        </div>
        
    </div>
</div>