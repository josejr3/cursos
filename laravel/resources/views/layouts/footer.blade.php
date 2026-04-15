<footer class="relative z-10 mt-12 border-t border-white/10">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 sm:w-1/3 h-px bg-gradient-to-r from-transparent via-[#00FF00]/40 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3 md:items-start">
            <div class="flex flex-col items-center md:items-start gap-2 text-center md:text-left">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="TalentCamp"
                        class="h-10 w-10 object-contain rounded-lg"
                    >
                    <span class="font-headline text-xl font-extrabold text-white tracking-tight group-hover:text-[#00FF00] transition-colors">
                        Talent<span class="text-[#00FF00]">Camp</span>
                    </span>
                </a>
                <p class="text-gray-500 text-xs sm:text-sm">Aprende. Compite. Crece.</p>
            </div>

            <nav class="flex flex-wrap items-center justify-center gap-x-6 gap-y-3 text-sm">
                <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-[#00FF00] transition-colors">Cursos</a>
                <a href="{{ route('contestants.index') }}" class="text-gray-400 hover:text-[#00FF00] transition-colors">Concursantes</a>
                <a href="{{ route('shorts.index') }}" class="text-gray-400 hover:text-[#00FF00] transition-colors">Shorts</a>
                @auth
                    <a href="{{ route('profile') }}" class="text-gray-400 hover:text-[#00FF00] transition-colors">Perfil</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-400 hover:text-[#00FF00] transition-colors">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-gray-400 hover:text-[#00FF00] transition-colors">Registro</a>
                    @endif
                @endauth
            </nav>

            <div class="flex flex-col items-center md:items-end gap-4">
                <div class="flex items-center gap-2">
                    <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-white/5 text-gray-300 hover:text-[#00FF00] hover:border-[#00FF00]/40 transition-colors" aria-label="YouTube">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8zM9.7 15.5v-7l6 3.5-6 3.5z"/>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-white/5 text-gray-300 hover:text-[#00FF00] hover:border-[#00FF00]/40 transition-colors" aria-label="Instagram">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7zm10 2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h10zm-5 3.5A5.5 5.5 0 1 0 17.5 13 5.5 5.5 0 0 0 12 7.5zm0 2A3.5 3.5 0 1 1 8.5 13 3.5 3.5 0 0 1 12 9.5zm5.8-2.9a1.3 1.3 0 1 0 1.3 1.3 1.3 1.3 0 0 0-1.3-1.3z"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-white/5 text-gray-300 hover:text-[#00FF00] hover:border-[#00FF00]/40 transition-colors" aria-label="Facebook">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M13.5 9H16V6h-2.5C10.9 6 9 7.9 9 10.5V13H7v3h2v6h3v-6h2.6l.4-3H12v-2.5c0-.8.7-1.5 1.5-1.5z"/>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer" class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-white/5 text-gray-300 hover:text-[#00FF00] hover:border-[#00FF00]/40 transition-colors" aria-label="LinkedIn">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M6.9 8.6A1.8 1.8 0 1 1 6.9 5a1.8 1.8 0 0 1 0 3.6zM5.3 9.8h3.2V19H5.3V9.8zm5.1 0h3v1.3h.1c.4-.8 1.4-1.6 2.9-1.6 3.1 0 3.7 2 3.7 4.7V19h-3.2v-4.2c0-1 0-2.3-1.4-2.3s-1.6 1.1-1.6 2.2V19h-3.2V9.8z"/>
                        </svg>
                    </a>
                </div>

                <p class="text-gray-600 text-xs text-center md:text-right">
                    &copy; {{ date('Y') }} TalentCamp. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </div>
</footer>
