<x-app-layout>
    <section class="relative z-10 py-10 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="glass-panel rounded-2xl p-6 md:p-8 border border-white/10 shadow-2xl">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-5">
                    <div>
                        <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight text-white flex items-center gap-3">
                            <img src="/images/PARTICIPANTES.png" alt="Participantes" class="h-10 w-10 object-contain shrink-0">
                            Perfiles de <span class="text-[#00FF00]">concursantes</span>
                        </h1>
                        <p class="text-gray-400 mt-2 max-w-2xl">
                            Conoce a los participantes, revisa su presentación y conéctate con ellos en un clic.
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <a
                            href="{{ route('dashboard') }}"
                            class="inline-flex items-center rounded-full border border-white/15 bg-black/25 px-4 py-2 text-xs font-semibold text-white hover:border-[#00FF00]/40 hover:text-[#00FF00] transition-all"
                        >
                            Volver al dashboard
                        </a>
                        <a
                            href="{{ route('shorts.index') }}"
                            class="inline-flex items-center rounded-full border border-white/15 bg-black/25 px-4 py-2 text-xs font-semibold text-white hover:border-[#00FF00]/40 hover:text-[#00FF00] transition-all"
                        >
                            Ver shorts
                        </a>
                    </div>
                </div>

            </div>

            @if ($contestants->isEmpty())
                <div class="mt-8 glass-panel rounded-2xl p-8 border border-white/10 shadow-xl text-center">
                    <h2 class="font-headline text-2xl font-bold text-white">Todavía no hay concursantes para mostrar</h2>
                    <p class="text-gray-400 mt-2">
                        Cuando se registren nuevos participantes, aparecerán aquí automáticamente.
                    </p>
                    <a
                        href="{{ route('dashboard') }}"
                        class="mt-5 inline-flex items-center rounded-full bg-[#00FF00] hover:bg-[#00e600] px-5 py-2.5 text-sm font-bold text-black transition-all shadow-[0_0_15px_rgba(0,255,0,0.2)]"
                    >
                        Ir al dashboard
                    </a>
                </div>
            @else
                <div class="mt-8 space-y-4">
                    <div class="glass-panel rounded-2xl border border-white/10 p-4 md:p-5">
                        <div class="flex flex-col gap-3">
                            <div class="relative flex-1">
                                <svg class="w-4 h-4 text-gray-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.1-4.4a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z"/>
                                </svg>
                                <input
                                    id="contestant-search"
                                    type="text"
                                    placeholder="Buscar por nombre, apellido o email"
                                    class="w-full rounded-full border border-white/10 bg-black/30 pl-10 pr-4 py-2.5 text-sm text-white placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-[#00FF00]/35 focus:border-[#00FF00]/35"
                                >
                            </div>

                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-[10px] uppercase tracking-widest font-bold text-gray-600">Año:</span>
                                <button
                                    type="button"
                                    data-year=""
                                    class="year-filter active-year inline-flex items-center rounded-full border border-[#00FF00]/40 bg-[#00FF00]/10 px-3 py-1 text-xs font-semibold text-[#00FF00] transition-all hover:bg-[#00FF00]/20"
                                >
                                    Todos
                                </button>
                                @foreach ($years as $year)
                                    <button
                                        type="button"
                                        data-year="{{ $year }}"
                                        class="year-filter inline-flex items-center rounded-full border border-white/15 bg-black/25 px-3 py-1 text-xs font-semibold text-gray-300 transition-all hover:border-[#00FF00]/40 hover:text-[#00FF00]"
                                    >
                                        {{ $year }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div id="contestants-grid" class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($contestants as $contestant)
                        @php
                            $gmailUrl = 'https://mail.google.com/mail/?view=cm&fs=1&to='.rawurlencode($contestant->email).'&su='.rawurlencode('Hola '.$contestant->nombre).'&body='.rawurlencode('Hola '.$contestant->nombre.", vi tu perfil en TalentCamp y me gustaría ponerme en contacto contigo.");
                            $fullName = trim(($contestant->nombre ?? '').' '.($contestant->apellidos ?? ''));
                        @endphp

                        <article
                            class="contestant-card group glass-panel rounded-2xl p-5 border border-white/10 shadow-xl hover:border-[#00FF00]/30 hover:shadow-[0_0_28px_rgba(0,255,0,0.08)] transition-all duration-300"
                            data-search="{{ strtolower($fullName.' '.$contestant->email) }}"
                            data-years='{{ json_encode($contestant->convocatoria ?? []) }}'
                        >
                            <div class="flex items-start gap-3">
                                <div class="flex items-center gap-4">
                                    <img
                                        src="{{ $contestant->profile_photo_url }}"
                                        alt="Foto de {{ $contestant->nombre }} {{ $contestant->apellidos }}"
                                        class="h-16 w-16 rounded-full object-cover border border-[#00FF00]/30 bg-black/30 ring-2 ring-black/20"
                                    >

                                    <div>
                                        <h2 class="font-headline text-xl font-bold text-white leading-tight group-hover:text-[#00FF00] transition-colors">
                                            {{ $contestant->nombre }} {{ $contestant->apellidos }}
                                        </h2>
                                        <div class="mt-1 flex items-center gap-2 flex-wrap">
                                            <p class="text-sm text-[#00FF00] break-all">
                                                {{ $contestant->email }}
                                            </p>
                                            @if (!empty($contestant->convocatoria))
                                                @foreach ($contestant->convocatoria as $convYear)
                                                    <span class="inline-flex items-center rounded-full bg-white/5 border border-white/10 px-2 py-0.5 text-[10px] font-bold text-gray-400">
                                                        {{ $convYear }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p title="{{ $contestant->descripcion ?: 'Este concursante todavía no ha añadido una descripción.' }}" class="contestant-description is-clamped mt-4 text-gray-300 text-sm leading-6 min-h-[88px] whitespace-pre-line break-words rounded-xl border border-white/5 bg-black/20 px-3 py-3">
                                {{ $contestant->descripcion ?: 'Este concursante todavía no ha añadido una descripción.' }}
                            </p>

                            <div class="mt-5 flex items-center justify-between gap-3">
                                <button
                                    type="button"
                                    class="contestant-toggle hidden inline-flex items-center rounded-full border border-white/15 bg-black/25 px-3 py-1.5 text-xs font-semibold text-gray-200 hover:border-[#00FF00]/40 hover:text-[#00FF00] transition-all"
                                >
                                    Ver más
                                </button>

                                <a
                                    href="{{ $gmailUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex h-12 w-12 items-center justify-center transition-transform duration-200 hover:scale-110"
                                    aria-label="Abrir Gmail"
                                    title="Abrir Gmail"
                                >
                                    <img src="/images/mensaje.png" alt="Abrir Gmail" class="h-10 w-10 object-contain">
                                </a>
                            </div>
                        </article>
                    @endforeach
                    </div>

                    <div id="contestants-empty-filter" class="hidden glass-panel rounded-2xl p-8 border border-white/10 shadow-xl text-center">
                        <h2 class="font-headline text-2xl font-bold text-white">No hay resultados para esa búsqueda</h2>
                        <p class="text-gray-400 mt-2">Prueba con otro nombre o email.</p>
                        <button
                            type="button"
                            id="contestants-reset-filter"
                            class="mt-5 inline-flex items-center rounded-full bg-[#00FF00] hover:bg-[#00e600] px-5 py-2.5 text-sm font-bold text-black transition-all"
                        >
                            Limpiar búsqueda
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <style>
        .contestant-description {
            overflow-wrap: anywhere;
        }

        .contestant-description.is-clamped {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 4;
            overflow: hidden;
        }
    </style>

    @if ($contestants->isNotEmpty())
        <script>
            (() => {
                const searchInput = document.getElementById('contestant-search');
                const yearButtons = Array.from(document.querySelectorAll('.year-filter'));
                const cards = Array.from(document.querySelectorAll('.contestant-card'));
                const emptyState = document.getElementById('contestants-empty-filter');
                const resetButton = document.getElementById('contestants-reset-filter');

                if (!searchInput || !cards.length) {
                    return;
                }

                let activeYear = '';

                const normalize = (value) =>
                    value
                        .toLowerCase()
                        .normalize('NFD')
                        .replace(/[\u0300-\u036f]/g, '')
                        .trim();

                const applyFilters = () => {
                    const searchValue = normalize(searchInput.value);
                    let visibleCount = 0;

                    cards.forEach((card) => {
                        const cardSearch = normalize(card.dataset.search || '');
                        const cardYears = JSON.parse(card.dataset.years || '[]');
                        const matchesSearch = !searchValue || cardSearch.includes(searchValue);
                        const matchesYear = !activeYear || cardYears.includes(Number(activeYear));
                        const isVisible = matchesSearch && matchesYear;

                        card.classList.toggle('hidden', !isVisible);
                        if (isVisible) {
                            visibleCount += 1;
                        }
                    });

                    if (emptyState) {
                        emptyState.classList.toggle('hidden', visibleCount > 0);
                    }
                };

                yearButtons.forEach((btn) => {
                    btn.addEventListener('click', () => {
                        activeYear = btn.dataset.year;

                        yearButtons.forEach((b) => {
                            const isActive = b === btn;
                            b.classList.toggle('active-year', isActive);
                            b.classList.toggle('border-[#00FF00]/40', isActive);
                            b.classList.toggle('bg-[#00FF00]/10', isActive);
                            b.classList.toggle('text-[#00FF00]', isActive);
                            b.classList.toggle('border-white/15', !isActive);
                            b.classList.toggle('bg-black/25', !isActive);
                            b.classList.toggle('text-gray-300', !isActive);
                        });

                        applyFilters();
                    });
                });

                if (resetButton) {
                    resetButton.addEventListener('click', () => {
                        searchInput.value = '';
                        activeYear = '';
                        yearButtons.forEach((b, i) => {
                            const isFirst = i === 0;
                            b.classList.toggle('active-year', isFirst);
                            b.classList.toggle('border-[#00FF00]/40', isFirst);
                            b.classList.toggle('bg-[#00FF00]/10', isFirst);
                            b.classList.toggle('text-[#00FF00]', isFirst);
                            b.classList.toggle('border-white/15', !isFirst);
                            b.classList.toggle('bg-black/25', !isFirst);
                            b.classList.toggle('text-gray-300', !isFirst);
                        });
                        applyFilters();
                        searchInput.focus();
                    });
                }

                const setupDescriptionToggle = (card) => {
                    const description = card.querySelector('.contestant-description');
                    const toggleButton = card.querySelector('.contestant-toggle');

                    if (!description || !toggleButton) {
                        return;
                    }

                    if (toggleButton.dataset.bound !== 'true') {
                        toggleButton.addEventListener('click', () => {
                            const isExpanded = !description.classList.contains('is-clamped');

                            description.classList.toggle('is-clamped', isExpanded);
                            toggleButton.textContent = isExpanded ? 'Ver más' : 'Ver menos';
                        });
                        toggleButton.dataset.bound = 'true';
                    }

                    description.classList.add('is-clamped');
                    toggleButton.textContent = 'Ver más';
                    toggleButton.classList.add('hidden');

                    const hasOverflow = description.scrollHeight > description.clientHeight + 1;

                    if (!hasOverflow) {
                        description.classList.remove('is-clamped');
                    } else {
                        toggleButton.classList.remove('hidden');
                    }
                };

                cards.forEach((card) => {
                    setupDescriptionToggle(card);
                });

                window.addEventListener('resize', () => {
                    cards.forEach((card) => {
                        setupDescriptionToggle(card);
                    });
                });

                searchInput.addEventListener('input', applyFilters);
                applyFilters();
            })();
        </script>
    @endif
</x-app-layout>
