<x-app-layout>
    <section class="relative z-10 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <div class="glass-panel rounded-xl p-6 md:p-8 border border-white/10 shadow-2xl">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-center gap-4">
                        <img
                            src="{{ auth()->user()->profile_photo_url }}"
                            alt="Foto de {{ auth()->user()->nombre }}"
                            class="h-20 w-20 rounded-full object-cover border border-[#00FF00]/30 shadow-[0_0_25px_rgba(0,255,0,0.12)]"
                        >

                        <div>
                            <span class="inline-flex items-center rounded-full bg-[#00FF00]/10 text-[#00FF00] border border-[#00FF00]/20 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em]">
                                Mi cuenta
                            </span>
                            <h1 class="mt-3 font-headline text-3xl md:text-4xl font-extrabold tracking-tight text-white">
                                Editar perfil
                            </h1>
                            <p class="mt-2 max-w-2xl text-sm text-gray-400">
                                Personaliza tu información, tu foto y la seguridad de tu cuenta desde un solo lugar.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 text-sm">
                        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-4 py-2 font-medium text-gray-200">
                            {{ auth()->user()->email }}
                        </span>
                        <span class="inline-flex items-center rounded-full border border-[#00FF00]/20 bg-[#00FF00]/10 px-4 py-2 font-medium text-[#00FF00]">
                            Perfil visible para concursantes
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 xl:grid-cols-3">
                <div class="xl:col-span-2 glass-panel rounded-xl p-5 md:p-7 border border-white/10 shadow-xl">
                    <livewire:profile.update-profile-information-form />
                </div>

                <div class="space-y-6">
                    <div class="glass-panel rounded-xl p-5 md:p-6 border border-white/10 shadow-xl">
                        <livewire:profile.update-password-form />
                    </div>

                    <div class="glass-panel rounded-xl p-5 md:p-6 border border-red-500/20 shadow-xl">
                        <livewire:profile.delete-user-form />
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
