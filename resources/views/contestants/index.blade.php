<x-app-layout>
    <section class="relative z-10 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="glass-panel rounded-xl p-6 md:p-8 border border-white/10 shadow-2xl">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight text-white">
                            Perfiles de <span class="text-[#00FF00]">concursantes</span>
                        </h1>
                        <p class="text-gray-400 mt-2 max-w-2xl">
                            Conoce a los demás participantes y contáctalos directamente desde Gmail.
                        </p>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-[#00FF00]/10 text-[#00FF00] border border-[#00FF00]/20 px-4 py-2 text-sm font-semibold">
                        {{ $contestants->count() }} perfiles
                    </span>
                </div>
            </div>

            @if ($contestants->isEmpty())
                <div class="mt-8 glass-panel rounded-xl p-8 border border-white/10 shadow-xl text-center">
                    <h2 class="font-headline text-2xl font-bold text-white">Todavía no hay más concursantes</h2>
                    <p class="text-gray-400 mt-2">
                        Cuando se registren nuevos participantes, aparecerán aquí automáticamente.
                    </p>
                </div>
            @else
                <div class="mt-8 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($contestants as $contestant)
                        @php
                            $gmailUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to='.rawurlencode($contestant->email).'&su='.rawurlencode('Hola '.$contestant->nombre).'&body='.rawurlencode('Hola '.$contestant->nombre.", vi tu perfil en TalentCamp y me gustaría ponerme en contacto contigo.");
                        @endphp

                        <article class="glass-panel rounded-xl p-5 border border-white/10 shadow-xl hover:border-[#00FF00]/30 transition-all duration-200">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h2 class="font-headline text-xl font-bold text-white leading-tight">
                                        {{ $contestant->nombre }} {{ $contestant->apellidos }}
                                    </h2>
                                    <p class="mt-1 text-sm text-[#00FF00]">
                                        {{ $contestant->email }}
                                    </p>
                                </div>
                            </div>

                            <p class="mt-4 text-gray-400 text-sm leading-6 min-h-[72px]">
                                {{ $contestant->descripcion ?: 'Este concursante todavía no ha añadido una descripción.' }}
                            </p>

                            <div class="mt-5 flex items-center justify-end gap-3">
                                <a
                                    href="{{ $gmailUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center rounded-full bg-[#00FF00] hover:bg-[#00e600] px-5 py-2 text-sm font-bold text-black transition-all shadow-[0_0_15px_rgba(0,255,0,0.2)]"
                                >
                                    Abrir Gmail
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
