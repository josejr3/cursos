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

<div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-black font-['Inter',_sans-serif] text-[#f0f0f5]">
    <div class="relative z-10 w-full max-w-[420px] p-[40px] bg-[#14141c]/45 backdrop-blur-[30px] border border-white/10 rounded-[24px] shadow-[0_30px_60px_rgba(0,0,0,0.6),inset_0_0_20px_rgba(255,255,255,0.02)] flex flex-col items-center mx-4 max-sm:p-[30px_24px]">
        
        <img src="{{ asset('images/LOGO AVATAR TSCH TRANSPARENTE (1).PNG') }}" alt="TalentCamp" class="h-16 w-16 object-contain mb-2">
        
        <p class="text-[#f0f0f5] text-[18px] font-bold mt-[10px] mb-[5px] text-center">
            Nueva contraseña
        </p>
        <p class="text-[#8b8b99] text-[13px] mb-[30px] text-center font-medium">
            Introduce tu nueva contraseña para recuperar el acceso.
        </p>

        <x-auth-session-status class="mb-4 w-full" :status="session('status')" />

        <form wire:submit="resetPassword" class="w-full">
            
            <div class="w-full mb-[24px]">
                <label for="email" class="block text-[13px] text-[#f0f0f5] mb-[8px] font-medium ml-1">Email</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="text-[#8b8b99] group-focus-within:text-[#00ff00] transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </div>
                    <input 
                        wire:model="email" 
                        id="email" 
                        type="email" 
                        name="email"
                        required 
                        autofocus 
                        autocomplete="username"
                        class="w-full bg-[#25252a]/60 border border-white/10 rounded-[16px] py-3 pl-12 pr-4 text-[#f0f0f5] font-['Inter',_sans-serif] text-[15px] outline-none transition-all duration-300 placeholder:text-[#8b8b99] focus:border-[#00ff00] focus:ring-1 focus:ring-[#00ff00]/40 [&:-webkit-autofill]:[-webkit-text-fill-color:#f0f0f5] [&:-webkit-autofill]:![font-family:'Inter',_sans-serif] [&:-webkit-autofill]:shadow-[inset_0_0_0px_1000px_#25252a] [&:-webkit-autofill]:focus:!shadow-[inset_0_0_0px_1000px_#25252a,0_0_0_2px_rgba(0,255,0,0.4)]" 
                        placeholder="ejemplo@correo.com" 
                    />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
            </div>

            <div class="w-full mb-[24px]">
                <label for="password" class="block text-[13px] text-[#f0f0f5] mb-[8px] font-medium ml-1">Nueva contraseña</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="text-[#8b8b99] group-focus-within:text-[#00ff00] transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </div>
                    <input 
                        wire:model.defer="password" 
                        id="password" 
                        type="password" 
                        name="password"
                        required 
                        autocomplete="new-password"
                        class="w-full bg-[#25252a]/60 border border-white/10 rounded-[16px] py-3 pl-12 pr-4 text-[#f0f0f5] font-['Inter',_sans-serif] text-[15px] outline-none transition-all duration-300 placeholder:text-[#8b8b99] focus:border-[#00ff00] focus:ring-1 focus:ring-[#00ff00]/40 [&:-webkit-autofill]:[-webkit-text-fill-color:#f0f0f5] [&:-webkit-autofill]:![font-family:'Inter',_sans-serif] [&:-webkit-autofill]:shadow-[inset_0_0_0px_1000px_#25252a] [&:-webkit-autofill]:focus:!shadow-[inset_0_0_0px_1000px_#25252a,0_0_0_2px_rgba(0,255,0,0.4)]" 
                        placeholder="********" 
                    />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-sm" />
            </div>

            <div class="w-full mb-[32px]">
                <label for="password_confirmation" class="block text-[13px] text-[#f0f0f5] mb-[8px] font-medium ml-1">Confirmar contraseña</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="text-[#8b8b99] group-focus-within:text-[#00ff00] transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </div>
                    <input 
                        wire:model.defer="password_confirmation" 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation"
                        required 
                        autocomplete="new-password"
                        class="w-full bg-[#25252a]/60 border border-white/10 rounded-[16px] py-3 pl-12 pr-4 text-[#f0f0f5] font-['Inter',_sans-serif] text-[15px] outline-none transition-all duration-300 placeholder:text-[#8b8b99] focus:border-[#00ff00] focus:ring-1 focus:ring-[#00ff00]/40 [&:-webkit-autofill]:[-webkit-text-fill-color:#f0f0f5] [&:-webkit-autofill]:![font-family:'Inter',_sans-serif] [&:-webkit-autofill]:shadow-[inset_0_0_0px_1000px_#25252a] [&:-webkit-autofill]:focus:!shadow-[inset_0_0_0px_1000px_#25252a,0_0_0_2px_rgba(0,255,0,0.4)]" 
                        placeholder="********" 
                    />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400 text-sm" />
            </div>

            <button type="submit" class="w-full py-[14px] bg-[#00ff00] text-[#050507] border-none rounded-[16px] cursor-pointer font-['Montserrat',_sans-serif] font-bold text-[16px] uppercase tracking-[0.5px] transition-all duration-300 shadow-[0_4px_20px_rgba(0,255,0,0.4)] hover:bg-[#00e600] hover:shadow-[0_6px_25px_rgba(0,255,0,0.6)] hover:-translate-y-[2px]">
                Restablecer contraseña
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