<footer class="relative z-10 mt-12 border-t border-white/10">
	<div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 sm:w-1/3 h-px bg-gradient-to-r from-transparent via-[#00FF00]/40 to-transparent"></div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
		<div class="grid grid-cols-1 gap-8 md:grid-cols-3 md:items-start">
			<div class="flex flex-col items-center md:items-start gap-2 text-center md:text-left">
				<a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
					<img
						src="/images/logo.png"
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
				<a href="{{ route('profile') }}" class="text-gray-400 hover:text-[#00FF00] transition-colors">Perfil</a>
			</nav>

			<div class="flex flex-col items-center md:items-end gap-4">
				<div class="flex items-center gap-2">
					<a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" class="inline-flex h-12 w-12 items-center justify-center transition-transform duration-200 hover:scale-110" aria-label="Instagram">
						<img src="/images/ig.png" alt="Instagram" class="block h-10 w-10 object-contain object-center" aria-hidden="true">
					</a>
					<a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="inline-flex h-12 w-12 items-center justify-center transition-transform duration-200 hover:scale-110" aria-label="Facebook">
						<img src="/images/facebook.png" alt="Facebook" class="block h-10 w-10 object-contain object-center" aria-hidden="true">
					</a>
					<a href="https://www.linkedin.com" target="_blank" rel="noopener noreferrer" class="inline-flex h-12 w-12 items-center justify-center transition-transform duration-200 hover:scale-110" aria-label="LinkedIn">
						<img src="/images/linkedin.png" alt="LinkedIn" class="block h-10 w-10 object-contain object-center" aria-hidden="true">
					</a>
					<a href="https://www.tiktok.com" target="_blank" rel="noopener noreferrer" class="inline-flex h-12 w-12 items-center justify-center transition-transform duration-200 hover:scale-110" aria-label="TikTok">
						<img src="/images/tiktok.png" alt="TikTok" class="block h-10 w-10 object-contain object-center" aria-hidden="true">
					</a>
					<a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer" class="inline-flex h-12 w-12 items-center justify-center transition-transform duration-200 hover:scale-110" aria-label="YouTube">
						<img src="/images/youtube.png" alt="YouTube" class="block h-10 w-10 object-contain object-center" aria-hidden="true">
					</a>
				</div>

				<p class="text-gray-600 text-xs text-center md:text-right">
					&copy; {{ date('Y') }} TalentCamp. Todos los derechos reservados.
				</p>
			</div>
		</div>

		<div class="mt-8 pt-6 border-t border-white/10">
			<p class="text-center text-xs sm:text-sm uppercase tracking-[0.18em] text-gray-400 mb-5">
				En colaboracion con
			</p>
			<div class="flex flex-wrap items-center justify-center gap-8">
				<img src="/images/LOGO CABILDO VERDE.png" alt="Cabildo" class="h-32 object-contain opacity-80 hover:opacity-100 transition-opacity">
				<img src="/images/LOGO SODEPAL VERDE.png" alt="Sodepal" class="h-32 object-contain opacity-80 hover:opacity-100 transition-opacity">
				<img src="/images/LOGO AYUNTAMIENTO DE GARAFÍA. NEGRO.png" alt="Ayuntamiento de Garafía" class="h-40 object-contain opacity-80 hover:opacity-100 transition-opacity" style="filter: brightness(0) saturate(100%) invert(42%) sepia(93%) saturate(1352%) hue-rotate(87deg) brightness(119%) contrast(119%)">
			</div>
		</div>
	</div>
</footer>
