<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-white/10 bg-black/40 backdrop-blur-xl text-on-surface">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4">
            <div class="flex items-center gap-3 sm:gap-6">
                <a href="{{ route('dashboard') }}" wire:navigate class="group flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-white/5 shadow-lg shadow-black/20 transition group-hover:border-[#00FF00]/30 group-hover:bg-[#00FF00]/10">
                        <x-application-logo class="block h-7 w-auto fill-current text-white" />
                    </span>

                    <div class="hidden md:block">
                        <p class="font-headline text-sm font-bold tracking-wide text-white">TalentCamp</p>
                        <p class="text-xs text-gray-400">Panel principal</p>
                    </div>
                </a>

                <div class="hidden sm:flex items-center gap-2 rounded-full border border-white/10 bg-white/5 p-1">
                    <a
                        href="{{ route('dashboard') }}"
                        wire:navigate
                        class="rounded-full px-4 py-2 text-sm font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-[#00FF00] text-black shadow-[0_0_20px_rgba(0,255,0,0.18)]' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}"
                    >
                        Cursos
                    </a>

                    <a
                        href="{{ route('contestants.index') }}"
                        wire:navigate
                        class="rounded-full px-4 py-2 text-sm font-semibold transition {{ request()->routeIs('contestants.index') ? 'bg-[#00FF00] text-black shadow-[0_0_20px_rgba(0,255,0,0.18)]' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}"
                    >
                        Concursantes
                    </a>

                    @if (auth()->user()->is_admin)
                        <a
                            href="{{ route('admin.panel') }}"
                            wire:navigate
                            class="rounded-full px-4 py-2 text-sm font-semibold transition {{ request()->routeIs('admin.panel') ? 'bg-[#00FF00] text-black shadow-[0_0_20px_rgba(0,255,0,0.18)]' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}"
                        >
                            Admin
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex items-center gap-3">
               

                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-3 rounded-full border border-white/10 bg-white/5 px-2 py-2 text-sm font-medium text-white hover:border-[#00FF00]/30 hover:bg-white/10 focus:outline-none transition duration-150">
                            <img
                                src="{{ auth()->user()->profile_photo_url }}"
                                alt="Foto de {{ auth()->user()->nombre }}"
                                class="h-9 w-9 rounded-full object-cover border border-[#00FF00]/20"
                            >

                            <div class="hidden md:block text-left leading-tight">
                                <div class="text-sm font-semibold" x-data="{{ json_encode(['name' => auth()->user()->nombre]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                                <div class="text-xs text-gray-400">Mi cuenta</div>
                            </div>

                            <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 011.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-white/10">
                            <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->nombre }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            Perfil
                        </x-dropdown-link>

                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                Cerrar sesión
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 p-2 text-white hover:border-[#00FF00]/30 hover:bg-white/10 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-white/10 bg-black/60 backdrop-blur-xl">
        <div class="px-4 py-4 space-y-4">
            <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 p-3">
                <img
                    src="{{ auth()->user()->profile_photo_url }}"
                    alt="Foto de {{ auth()->user()->nombre }}"
                    class="h-11 w-11 rounded-full object-cover border border-[#00FF00]/20"
                >

                <div>
                    <div class="font-semibold text-white" x-data="{{ json_encode(['name' => auth()->user()->nombre]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="text-sm text-gray-400">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <div class="space-y-2">
                <a
                    href="{{ route('dashboard') }}"
                    wire:navigate
                    class="block rounded-xl px-4 py-3 text-sm font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-[#00FF00] text-black' : 'bg-white/5 text-gray-200 hover:bg-white/10' }}"
                >
                    Cursos
                </a>

                <a
                    href="{{ route('contestants.index') }}"
                    wire:navigate
                    class="block rounded-xl px-4 py-3 text-sm font-semibold transition {{ request()->routeIs('contestants.index') ? 'bg-[#00FF00] text-black' : 'bg-white/5 text-gray-200 hover:bg-white/10' }}"
                >
                    Concursantes
                </a>

                @if (auth()->user()->is_admin)
                    <a
                        href="{{ route('admin.panel') }}"
                        wire:navigate
                        class="block rounded-xl px-4 py-3 text-sm font-semibold transition {{ request()->routeIs('admin.panel') ? 'bg-[#00FF00] text-black' : 'bg-white/5 text-gray-200 hover:bg-white/10' }}"
                    >
                        Admin
                    </a>
                @endif

                <a
                    href="{{ route('profile') }}"
                    wire:navigate
                    class="block rounded-xl bg-white/5 px-4 py-3 text-sm font-semibold text-gray-200 hover:bg-white/10 transition"
                >
                    Perfil
                </a>

                <button wire:click="logout" class="block w-full rounded-xl bg-red-500/10 px-4 py-3 text-left text-sm font-semibold text-red-200 hover:bg-red-500/20 transition">
                    Cerrar sesión
                </button>
            </div>
        </div>
    </div>
</nav>
