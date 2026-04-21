<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-black font-['Inter',_sans-serif] text-[#f0f0f5]">
        <div class="relative z-10 w-full max-w-[420px] p-[40px] bg-[#14141c]/45 backdrop-blur-[30px] border border-white/10 rounded-[24px] shadow-[0_30px_60px_rgba(0,0,0,0.6),inset_0_0_20px_rgba(255,255,255,0.02)] flex flex-col items-center mx-4 max-sm:p-[30px_24px]">

            <img src="{{ asset('images/logo.png') }}" alt="TalentCamp" class="h-16 w-16 object-contain mb-2">

            <h2 class="text-[20px] font-bold text-[#f0f0f5] mb-2">Verifica tu correo</h2>

            <p class="text-[#8b8b99] text-[14px] mb-6 text-center leading-relaxed">
                Gracias por registrarte. Antes de continuar, verifica tu dirección de correo haciendo clic en el enlace que te enviamos. Si no lo recibiste, podemos enviarte otro.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="w-full mb-5 px-4 py-3 rounded-[12px] bg-[#00e3fd]/10 border border-[#00e3fd]/30 text-[#00e3fd] text-[13px] text-center">
                    Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                </div>
            @endif

            <button
                wire:click="sendVerification"
                class="w-full py-3 rounded-[16px] bg-[#00ff00] text-[#050507] font-bold text-[15px] shadow-[0_4px_14px_rgba(0,255,0,0.3)] hover:shadow-[0_6px_20px_rgba(0,255,0,0.45)] hover:brightness-110 transition-all duration-200 mb-4"
            >
                Reenviar correo de verificación
            </button>

            <button
                wire:click="logout"
                type="button"
                class="text-[13px] text-[#8b8b99] hover:text-[#f0f0f5] transition-colors duration-200 underline underline-offset-2"
            >
                Cerrar sesión
            </button>
        </div>
    </div>
</div>
