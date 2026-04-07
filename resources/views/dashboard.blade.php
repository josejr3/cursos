<x-app-layout>
    <section class="relative z-10 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <div class="glass-panel rounded-xl p-6 md:p-8 border border-white/10 shadow-2xl">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight text-white">
                            Cursos <span class="text-[#00FF00]">TalentCamp</span>
                        </h1>
                        <p class="text-gray-400 mt-2 max-w-2xl">
                            Empieza por una clase y construye progreso constante.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                        <a
                            href="{{ route('contestants.index') }}"
                            class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-5 py-2 text-sm font-semibold text-white hover:border-[#00FF00]/40 hover:text-[#00FF00] transition-all"
                        >
                            Ver concursantes
                        </a>

                        <span class="inline-flex items-center rounded-full bg-[#00FF00]/10 text-[#00FF00] border border-[#00FF00]/20 px-4 py-2 text-sm font-semibold">
                            {{ $courses->count() }} disponibles
                        </span>
                    </div>
                </div>
            </div>

            @if ($courses->isEmpty())
                <div class="mt-8 glass-panel rounded-xl p-8 border border-white/10 shadow-xl text-center">
                    <h2 class="font-headline text-2xl font-bold text-white">Aun no hay cursos disponibles</h2>
                    <p class="text-gray-400 mt-2">
                        En cuanto se publiquen nuevos cursos, aparecerán aquí automáticamente.
                    </p>
                </div>
            @else
                <div class="mt-8 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($courses as $course)
                        <article class="glass-panel rounded-xl p-5 border border-white/10 shadow-xl hover:border-[#00FF00]/30 transition-all duration-200">
                            <div class="flex items-start justify-between gap-3">
                                <h2 class="font-headline text-xl font-bold text-white leading-tight">
                                    {{ $course->titulo }}
                                </h2>
                            </div>

                            <p class="mt-3 text-gray-400 text-sm leading-6">
                                {{ $course->descripcion }}
                            </p>

                            <div class="mt-5 flex items-center justify-between gap-3">
                                <span class="text-xs text-gray-500">
                                    {{ $course->updated_at->diffForHumans() }}
                                </span>
                                <a
                                    href="{{ $course->url_video }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center rounded-full bg-[#00FF00] hover:bg-[#00e600] px-5 py-2 text-sm font-bold text-black transition-all shadow-[0_0_15px_rgba(0,255,0,0.2)]"
                                >
                                    Ver curso
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <livewire:gemini-chat />
</x-app-layout>