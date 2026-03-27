<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cursos
            </h2>
            <span class="text-sm text-gray-500">
                {{ $courses->count() }} disponibles
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <section class="rounded-xl bg-gradient-to-r from-sky-500 to-indigo-600 p-6 text-white shadow-lg">
                <h3 class="text-2xl font-bold">Impulsa tu carrera hoy</h3>
                <p class="mt-2 text-sky-100 max-w-2xl">
                    Explora contenidos practicos y empieza con lecciones enfocadas en habilidades reales para empleo tech.
                </p>
            </section>

            @if ($courses->isEmpty())
                <section class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-8 text-center">
                        <h3 class="text-lg font-semibold text-gray-900">Aun no hay cursos activos</h3>
                        <p class="mt-2 text-gray-600">
                            Cuando agregues cursos con estado activo, apareceran aqui automaticamente.
                        </p>
                    </div>
                </section>
            @else
                <section class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ($courses as $course)
                        <article class="group rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-200 overflow-hidden">
                            <div class="h-2 bg-gradient-to-r from-sky-400 to-indigo-500"></div>

                            <div class="p-5">
                                <div class="flex items-center justify-between gap-3">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $course->titulo }}</h3>
                                    <span class="shrink-0 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold px-3 py-1">
                                        {{ ucfirst($course->estado) }}
                                    </span>
                                </div>

                                <p class="mt-3 text-sm text-gray-600">
                                    {{ $course->descripcion }}
                                </p>

                                <div class="mt-5 flex items-center justify-between">
                                    <span class="text-xs text-gray-400">Actualizado {{ $course->updated_at->diffForHumans() }}</span>
                                    <a
                                        href="{{ $course->url_video }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition-colors"
                                    >
                                        Ver clase
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </section>
            @endif
        </div>
    </div>
</x-app-layout>