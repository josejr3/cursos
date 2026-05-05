<x-app-layout>
    <section class="relative z-10 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <div class="glass-panel rounded-xl p-6 md:p-8 border border-white/10 shadow-2xl">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-4">
                            <img src="/images/CURSO.png" alt="Cursos"
                                class="h-16 w-16 object-contain shrink-0 drop-shadow-lg">
                            <div>
                                <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight text-white">
                                    Cursos <span class="text-[#00FF00]">TalentCamp</span>
                                </h1>
                                <p class="text-gray-400 mt-2 max-w-2xl">
                                    Empieza por una clase y construye progreso constante.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-auto flex flex-col items-stretch gap-3">
                        <div
                            class="rounded-2xl border border-[#00FF00]/25 bg-gradient-to-br from-[#00FF00]/14 via-[#00FF00]/5 to-transparent px-4 py-3 shadow-[0_0_28px_rgba(0,255,0,0.08)]">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                <div>
                                    <p class="text-[11px] uppercase tracking-[0.2em] text-[#00FF00]/80 font-semibold">
                                        Zona de concursantes</p>
                                    <p class="text-sm text-gray-200 mt-1">Explora perfiles, avances y shorts en un solo
                                        lugar.</p>
                                </div>

                                <a href="{{ route('contestants.index') }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-full bg-[#00FF00] hover:bg-[#00e600] px-5 py-2.5 text-sm font-bold text-black transition-all shadow-[0_0_15px_rgba(0,255,0,0.25)] hover:shadow-[0_0_24px_rgba(0,255,0,0.45)]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 20h5V4H2v16h5m10 0v-8a2 2 0 00-2-2H9a2 2 0 00-2 2v8m10 0H7" />
                                    </svg>
                                    Entrar a concursantes
                                </a>
                            </div>

                            <div class="mt-3 flex flex-wrap items-center gap-2">
                                <a href="{{ route('shorts.index') }}"
                                    class="inline-flex items-center rounded-full border border-white/15 bg-black/25 px-4 py-2 text-xs font-semibold text-white hover:border-[#00FF00]/40 hover:text-[#00FF00] transition-all">
                                    Ver shorts
                                </a>

                                <span
                                    class="inline-flex items-center rounded-full bg-[#00FF00]/10 text-[#00FF00] border border-[#00FF00]/20 px-4 py-2 text-xs font-semibold">
                                    {{ $courses->count() }} cursos activos
                                </span>
                            </div>
                        </div>
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
                    <article
                        class="group glass-panel overflow-hidden rounded-2xl border border-white/10 shadow-2xl hover:border-[#00FF00]/40 hover:shadow-[0_0_30px_rgba(0,255,0,0.08)] transition-all duration-300">
                        <div class="relative overflow-hidden w-full aspect-video bg-black">
                            <iframe class="absolute top-0 left-0 w-full h-full"
                                src="https://www.youtube.com/embed/Wm8KWFtvyvc?si=5hn8FhcOSVO4urWH&rel=0&modestbranding=1"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                            </iframe>
                        </div>

                        <div class="p-5 flex flex-col gap-3">
                            <h2
                                class="font-headline text-lg font-bold text-white leading-snug group-hover:text-[#00FF00] transition-colors duration-200">
                                TALENT SCHOOL LA PALMA
                            </h2>

                            <p class="text-gray-400 text-sm leading-relaxed line-clamp-2">
                                Descubre TALENT SCHOOL LA PALMA: "Donde tus ideas se hacen realidad"
                            </p>

                            <div class="mt-auto pt-3 border-t border-white/5 flex items-center justify-end gap-3">
                                <a href="https://www.youtube.com/watch?v=Wm8KWFtvyvc" target="_blank"
                                    rel="noopener noreferrer">

                                </a>
                            </div>
                        </div>
                    </article>
                    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />

                    <style>
                        :root {
                            --plyr-color-main: #00FF00;
                            --plyr-video-background: #000000;
                            --plyr-control-icon-size: 18px;
                            --plyr-control-spacing: 10px;
                        }
                    </style>

                    <article x-data="youtubePlayer()"
                        class="group glass-panel overflow-hidden rounded-2xl border border-white/10 shadow-2xl hover:border-[#00FF00]/40 hover:shadow-[0_0_30px_rgba(0,255,0,0.08)] transition-all duration-300">
                        <div class="relative overflow-hidden w-full aspect-video bg-black">
                            <div x-ref="player" data-plyr-provider="youtube" data-plyr-embed-id="Wm8KWFtvyvc"></div>
                        </div>

                        <div class="p-5 flex flex-col gap-3">
                            <h2
                                class="font-headline text-lg font-bold text-white leading-snug group-hover:text-[#00FF00] transition-colors duration-200">
                                TALENT SCHOOL LA PALMA
                            </h2>

                            <p class="text-gray-400 text-sm leading-relaxed line-clamp-2">
                                Descubre TALENT SCHOOL LA PALMA: "Donde tus ideas se hacen realidad"
                            </p>

                            <div class="mt-auto pt-3 border-t border-white/5 flex items-center justify-end gap-3">
                                <span class="text-xs text-[#00FF00] font-bold">Video Interactivo</span>
                            </div>
                        </div>
                    </article>

                    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>

                    <script>
                        document.addEventListener('alpine:init', () => {
                            Alpine.data('youtubePlayer', () => ({
                                playerInstance: null,

                                init() {
                                    this.playerInstance = new Plyr(this.$refs.player, {
                                        controls: [
                                            'play-large',
                                            'play',
                                            'progress',
                                            'current-time',
                                            'duration',
                                            'mute',
                                            'volume',
                                            'fullscreen'
                                        ],
                                        youtube: {
                                            noCookie: true,
                                            rel: 0,
                                            showinfo: 0,
                                            iv_load_policy: 3,
                                            modestbranding: 1,
                                            disablekb: 1
                                        }
                                    });
                                }
                            }));
                        });
                    </script>
                    @foreach ($courses as $course)
                        <article
                            class="group glass-panel overflow-hidden rounded-2xl border border-white/10 shadow-2xl hover:border-[#00FF00]/40 hover:shadow-[0_0_30px_rgba(0,255,0,0.08)] transition-all duration-300">

                            {{-- Thumbnail --}}
                            <div class="relative overflow-hidden">
                                <img src="{{ $course->thumbnail_url }}" alt="Miniatura de {{ $course->titulo }}"
                                    class="h-48 w-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent"></div>

                                {{-- Play overlay --}}
                                <a href="{{ $course->url_video }}" target="_blank" rel="noopener noreferrer"
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div
                                        class="w-14 h-14 rounded-full bg-[#00FF00]/20 border border-[#00FF00]/50 flex items-center justify-center backdrop-blur-sm shadow-[0_0_20px_rgba(0,255,0,0.3)]">
                                        <svg class="w-6 h-6 text-[#00FF00] ml-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                    </div>
                                </a>

                                {{-- Badge --}}
                                <div
                                    class="absolute bottom-3 left-3 inline-flex items-center gap-1.5 rounded-full bg-black/70 backdrop-blur-sm px-3 py-1 text-xs font-semibold text-[#00FF00] border border-[#00FF00]/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#00FF00] animate-pulse"></span>
                                    Video disponible
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-5 flex flex-col gap-3">
                                <h2
                                    class="font-headline text-lg font-bold text-white leading-snug group-hover:text-[#00FF00] transition-colors duration-200">
                                    {{ $course->titulo }}
                                </h2>

                                <p class="text-gray-400 text-sm leading-relaxed line-clamp-2">
                                    {{ $course->descripcion }}
                                </p>

                                <div class="mt-auto pt-3 border-t border-white/5 flex items-center justify-between gap-3">
                                    <span class="inline-flex items-center gap-1.5 text-xs text-gray-500">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                                        </svg>
                                        {{ $course->updated_at->diffForHumans() }}
                                    </span>
                                    <a href="{{ $course->url_video }}" target="_blank" rel="noopener noreferrer"
                                        class="inline-flex items-center gap-2 rounded-full bg-[#00FF00] hover:bg-[#00e600] px-5 py-2 text-sm font-bold text-black transition-all shadow-[0_0_15px_rgba(0,255,0,0.25)] hover:shadow-[0_0_25px_rgba(0,255,0,0.45)]">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z" />
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

</x-app-layout>