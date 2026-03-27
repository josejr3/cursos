<x-app-layout>
    <div class="min-h-screen bg-background text-on-background font-body relative overflow-x-hidden">
        <div class="glow-orb absolute -top-24 -left-24 w-96 h-96 rounded-full bg-primary-dim opacity-10"></div>
        <div class="glow-orb absolute top-1/2 -right-48 w-[500px] h-[500px] rounded-full bg-secondary-container opacity-5"></div>
        <div class="glow-orb absolute -bottom-32 left-1/2 -translate-x-1/2 w-[600px] h-[600px] rounded-full bg-primary-container opacity-10"></div>

        <section class="relative z-10 py-10 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="glass-panel bg-surface-container-high/60 rounded-xl p-6 md:p-8 border border-outline-variant/10 shadow-2xl">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight text-on-surface">
                                Cursos TalentCamp
                            </h1>
                            <p class="text-on-surface-variant mt-2 max-w-2xl">
                                 Empieza por una clase y construye progreso constante.
                            </p>
                        </div>
                        <span class="inline-flex items-center rounded-full bg-secondary-container/80 text-on-secondary-container px-4 py-2 text-sm font-semibold">
                            {{ $courses->count() }} disponibles
                        </span>
                    </div>
                </div>

                @if ($courses->isEmpty())
                    <div class="mt-8 glass-panel bg-surface-container-high/60 rounded-xl p-8 border border-outline-variant/10 shadow-xl text-center">
                        <h2 class="font-headline text-2xl font-bold text-on-surface">Aun no hay cursos activos</h2>
                        <p class="text-on-surface-variant mt-2">
                            En cuanto publiques cursos en estado activo, apareceran aqui automaticamente.
                        </p>
                    </div>
                @else
                    <div class="mt-8 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($courses as $course)
                            <article class="glass-panel bg-surface-container-high/60 rounded-xl p-5 border border-outline-variant/10 shadow-xl hover:scale-[1.01] transition-transform duration-200">
                                <div class="flex items-start justify-between gap-3">
                                    <h2 class="font-headline text-xl font-bold text-on-surface leading-tight">
                                        {{ $course->titulo }}
                                    </h2>
                                    <span class="shrink-0 rounded-full bg-primary-container text-on-primary-container text-xs font-semibold px-3 py-1">
                                        {{ ucfirst($course->estado) }}
                                    </span>
                                </div>

                                <p class="mt-3 text-on-surface-variant text-sm leading-6">
                                    {{ $course->descripcion }}
                                </p>

                                <div class="mt-5 flex items-center justify-between gap-3">
                                    <span class="text-xs text-outline">
                                        {{ $course->updated_at->diffForHumans() }}
                                    </span>
                                    <a
                                        href="{{ $course->url_video }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center rounded-full bg-primary-dim hover:bg-primary px-4 py-2 text-sm font-bold text-on-primary transition-colors"
                                    >
                                        Ver clase
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    </div>

    <livewire:gemini-chat />
</x-app-layout>
