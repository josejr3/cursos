<x-app-layout>
    <section class="relative z-10 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="glass-panel rounded-xl p-6 md:p-8 border border-white/10 shadow-2xl">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight text-white">
                            Shorts de <span class="text-[#00FF00]">YouTube</span>
                        </h1>
                        <p class="text-gray-400 mt-2 max-w-2xl">
                            Microcontenido para aprender tips practicos de programacion en menos de 60 segundos.
                        </p>
                    </div>

                    <span class="inline-flex items-center rounded-full bg-[#00FF00]/10 text-[#00FF00] border border-[#00FF00]/20 px-4 py-2 text-sm font-semibold">
                        {{ $shorts->count() }} disponibles
                    </span>
                </div>
            </div>

            @if ($shorts->isEmpty())
                <div class="mt-8 glass-panel rounded-xl p-8 border border-white/10 shadow-xl text-center">
                    <h2 class="font-headline text-2xl font-bold text-white">Todavia no hay shorts disponibles</h2>
                    <p class="text-gray-400 mt-2">
                        Puedes agregar nuevos shorts desde el panel de administracion.
                    </p>
                </div>
            @else
                <div class="mt-8 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($shorts as $short)
                        <article class="glass-panel rounded-xl p-5 border border-white/10 shadow-xl hover:border-[#00FF00]/30 transition-all duration-200">
                            <div class="overflow-hidden rounded-xl border border-white/10 bg-black/40 aspect-[9/16]">
                                @if ($short->embed_url)
                                    <iframe
                                        id="short-player-{{ $short->id }}"
                                        data-youtube-player="true"
                                        class="h-full w-full"
                                        src="{{ $short->embed_url }}?enablejsapi=1&playsinline=1&rel=0"
                                        title="{{ $short->titulo }}"
                                        loading="lazy"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen
                                    ></iframe>
                                @else
                                    <div class="h-full w-full flex items-center justify-center px-4 text-center text-sm text-gray-400">
                                        El enlace no es valido para embeber.
                                    </div>
                                @endif
                            </div>

                            <h2 class="font-headline mt-4 text-xl font-bold text-white leading-tight">
                                {{ $short->titulo }}
                            </h2>

                            <div class="mt-5 flex items-center justify-between gap-3">
                                <a
                                    href="{{ $short->url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center rounded-full bg-[#00FF00] hover:bg-[#00e600] px-5 py-2 text-sm font-bold text-black transition-all shadow-[0_0_15px_rgba(0,255,0,0.2)]"
                                >
                                    Ver en YouTube
                                </a>
                                <livewire:delete-short :short="$short" />
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const iframeElements = Array.from(document.querySelectorAll('iframe[data-youtube-player="true"]'));

            if (!iframeElements.length) {
                return;
            }

            const playerIds = iframeElements
                .map((iframe) => iframe.id)
                .filter((id) => Boolean(id));

            if (!playerIds.length) {
                return;
            }

            const initializePlayers = function () {
                playerIds.forEach(function (id) {
                    new window.YT.Player(id, {
                        events: {
                            onReady: function (event) {
                                event.target.setVolume(50);
                            },
                        },
                    });
                });
            };

            if (window.YT && window.YT.Player) {
                initializePlayers();
                return;
            }

            window.onYouTubeIframeAPIReady = initializePlayers;

            const script = document.createElement('script');
            script.src = 'https://www.youtube.com/iframe_api';
            script.async = true;
            document.head.appendChild(script);
        });
    </script>
</x-app-layout>
