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
                        <article class="group glass-panel overflow-hidden rounded-2xl border border-white/10 shadow-2xl hover:border-[#00FF00]/40 hover:shadow-[0_0_30px_rgba(0,255,0,0.08)] transition-all duration-300">

                            {{-- Thumbnail --}}
                            <div class="relative overflow-hidden">
                                <img
                                    src="{{ $course->thumbnail_url }}"
                                    alt="Miniatura de {{ $course->titulo }}"
                                    class="h-48 w-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>

                                {{-- Play overlay --}}
                                <a
                                    href="{{ $course->url_video }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                                >
                                    <div class="w-14 h-14 rounded-full bg-[#00FF00]/20 border border-[#00FF00]/50 flex items-center justify-center backdrop-blur-sm shadow-[0_0_20px_rgba(0,255,0,0.3)]">
                                        <svg class="w-6 h-6 text-[#00FF00] ml-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </a>

                                {{-- Badge --}}
                                <div class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-full bg-black/70 backdrop-blur-sm px-3 py-1 text-xs font-semibold text-[#00FF00] border border-[#00FF00]/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#00FF00] animate-pulse"></span>
                                    Video disponible
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-5 flex flex-col gap-3">
                                <h2 class="font-headline text-lg font-bold text-white leading-snug group-hover:text-[#00FF00] transition-colors duration-200">
                                    {{ $course->titulo }}
                                </h2>

                                <p class="text-gray-400 text-sm leading-relaxed line-clamp-2">
                                    {{ $course->descripcion }}
                                </p>

                                <div class="mt-auto pt-3 border-t border-white/5 flex items-center justify-between gap-3">
                                    <span class="inline-flex items-center gap-1.5 text-xs text-gray-500">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z"/>
                                        </svg>
                                        {{ $course->updated_at->diffForHumans() }}
                                    </span>
                                    <a
                                        href="{{ $course->url_video }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center gap-2 rounded-full bg-[#00FF00] hover:bg-[#00e600] px-5 py-2 text-sm font-bold text-black transition-all shadow-[0_0_15px_rgba(0,255,0,0.25)] hover:shadow-[0_0_25px_rgba(0,255,0,0.45)]"
                                    >
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                        Ver curso
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <footer class="relative z-10 mt-16 border-t border-white/10">
        {{-- Glow line --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/3 h-px bg-gradient-to-r from-transparent via-[#00FF00]/40 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row items-center md:items-start justify-between gap-8">

                {{-- Brand --}}
                <div class="flex flex-col items-center md:items-start gap-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <img
                            src="{{ asset('images/LOGO AVATAR TSCH TRANSPARENTE (1).PNG') }}"
                            alt="TalentCamp"
                            class="h-10 w-10 object-contain rounded-lg"
                        >
                        <span class="font-headline text-xl font-extrabold text-white tracking-tight group-hover:text-[#00FF00] transition-colors">
                            Talent<span class="text-[#00FF00]">Camp</span>
                        </span>
                    </a>
                    <p class="text-gray-500 text-xs">Aprende. Compite. Crece.</p>
                </div>

                {{-- Nav --}}
                <div class="flex items-center gap-8 text-sm">
                    <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-[#00FF00] transition-colors duration-200 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.723v6.554a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/>
                        </svg>
                        Cursos
                    </a>
                    <a href="{{ route('contestants.index') }}" class="text-gray-400 hover:text-[#00FF00] transition-colors duration-200 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                        </svg>
                        Concursantes
                    </a>
                    <a href="{{ route('profile') }}" class="text-gray-400 hover:text-[#00FF00] transition-colors duration-200 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1118.88 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Perfil
                    </a>
                </div>

                {{-- Copyright --}}
                <p class="text-gray-600 text-xs text-center md:text-right">
                    &copy; {{ date('Y') }} TalentCamp.<br class="hidden md:block">
                    Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>

</x-app-layout>