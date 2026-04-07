<div class="flex items-center justify-center min-h-screen bg-black font-sans tracking-tight">
    <div class="glass-panel flex w-full max-w-[900px] min-h-[520px] rounded-xl border border-white/10 shadow-2xl overflow-hidden bg-[#0a0a0a]">
        
        <aside class="hidden md:flex w-[180px] bg-[#0a0a0a] p-8 flex-col gap-2 border-r border-white/5">
            <span class="text-[10px] text-gray-600 font-black uppercase tracking-[0.2em] mb-4 px-2">Registros</span>
            
            <button wire:click="setTab('usuario')" class="w-full text-left py-2 px-5 rounded-full text-sm font-bold transition-all block {{ $tab === 'usuario' ? 'bg-[#00ff00] text-black shadow-[0_0_20px_rgba(0,255,0,0.15)]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                Usuario
            </button>
            
            <button wire:click="setTab('curso')" class="w-full text-left py-2 px-5 rounded-full text-sm font-bold transition-all block {{ $tab === 'curso' ? 'bg-[#00ff00] text-black shadow-[0_0_20px_rgba(0,255,0,0.15)]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                Curso
            </button>
            
            <button wire:click="setTab('short')" class="w-full text-left py-2 px-5 rounded-full text-sm font-bold transition-all block {{ $tab === 'short' ? 'bg-[#00ff00] text-black shadow-[0_0_20px_rgba(0,255,0,0.15)]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                Short
            </button>
        </aside>

        <main class="flex-grow p-10 flex flex-col w-full max-w-[720px]">
            @if (session('status'))
                <div class="mb-6 p-4 bg-[#00ff00]/10 border border-[#00ff00]/20 text-[#00ff00] rounded-xl text-xs font-bold uppercase tracking-widest">
                    {{ session('status') }}
                </div>
            @endif

            @if ($tab === 'usuario')
                <div class="mb-8">
                   
                    
                    <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight text-white uppercase">
                        Registrar <span class="text-[#00ff00]"> Usuario</span>
                    </h1>
                    
                    <p class="mt-2 text-sm text-gray-400">
                        Personaliza la información y el acceso para el nuevo integrante desde un solo lugar.
                    </p>
                </div>

                <form wire:submit="saveUsuario" class="flex flex-col flex-grow w-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">Nombre</label>
                            <input wire:model="nombre" type="text" placeholder="Ej. Juan" class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700">
                            @error('nombre') <span class="text-red-500 text-[10px] uppercase font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">Apellidos</label>
                            <input wire:model="apellidos" type="text" placeholder="Ej. Pérez" class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700">
                            @error('apellidos') <span class="text-red-500 text-[10px] uppercase font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2 flex flex-col gap-1.5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">Correo Electrónico</label>
                            <input wire:model="email" type="email" placeholder="nombre@ejemplo.com" class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700">
                            @error('email') <span class="text-red-500 text-[10px] uppercase font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2 flex flex-col gap-1.5">
                            <div class="flex justify-between items-center ml-1">
                                <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em]">Descripción</label>
                                <span class="text-[9px] text-gray-700 font-bold uppercase">(Opcional)</span>
                            </div>
                            <textarea wire:model="descripcion_usuario" placeholder="Breve biografía o notas..." class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl h-24 resize-none focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700"></textarea>
                            @error('descripcion_usuario') <span class="text-red-500 text-[10px] uppercase font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-auto pt-8 flex justify-end">
                        <button type="submit" class="bg-[#00ff00] text-black font-black px-12 py-3 rounded-full uppercase text-xs tracking-widest hover:bg-[#00d900] hover:scale-105 transition-all active:scale-95 shadow-[0_0_20px_rgba(0,255,0,0.3)]">
                            Registrar Usuario
                        </button>
                    </div>
                </form>
            @endif

            @if ($tab === 'curso')
                <div class="mb-8">
                    
                    
                    <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight text-white uppercase">
                        Registrar <span class="text-[#00ff00]"> Curso</span>
                    </h1>
                    
                    <p class="mt-2 text-sm text-gray-400">
                        Añade un nuevo curso al catálogo completando la siguiente información.
                    </p>
                </div>

                <form wire:submit="saveCurso" class="flex flex-col flex-grow w-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2 flex flex-col gap-1.5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">Título del Curso</label>
                            <input wire:model="titulo" type="text"  class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700">
                            @error('titulo') <span class="text-red-500 text-[10px] uppercase font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">URL del Video</label>
                            <input wire:model="url_video" type="url" placeholder="https://www.youtube.com/watch?v=..." class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700">
                            @error('url_video') <span class="text-red-500 text-[10px] uppercase font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">Estado</label>
                            <select wire:model="estado" class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700 appearance-none">
                                <option value="" class="bg-[#0a0a0a] text-gray-400">Seleccionar estado</option>
                                <option value="activo" class="bg-[#0a0a0a] text-white">Activo</option>
                                <option value="inactivo" class="bg-[#0a0a0a] text-white">Inactivo</option>
                            </select>
                            @error('estado') <span class="text-red-500 text-[10px] uppercase font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="md:col-span-2 flex flex-col gap-1.5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">Descripción</label>
                            <textarea wire:model="descripcion_curso" placeholder="Aprende routing, controladores, Blade..." class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl h-24 resize-none focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700"></textarea>
                            @error('descripcion_curso') <span class="text-red-500 text-[10px] uppercase font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-auto pt-8 flex justify-end">
                        <button type="submit" class="bg-[#00ff00] text-black font-black px-12 py-3 rounded-full uppercase text-xs tracking-widest hover:bg-[#00d900] hover:scale-105 transition-all active:scale-95 shadow-[0_0_20px_rgba(0,255,0,0.3)]">
                            Registrar Curso
                        </button>
                    </div>
                </form>
            @endif

            @if ($tab === 'short')
                <div class="mb-8">
                  
                    
                    <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight text-white uppercase">
                        Registrar <span class="text-[#00ff00]"> Short</span>
                    </h1>
                    
                    <p class="mt-2 text-sm text-gray-400">
                        Añade un nuevo short completando la siguiente información.
                    </p>
                </div>

                <form wire:submit="saveShort" class="flex flex-col flex-grow w-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2 flex flex-col gap-1.5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">Título del Short</label>
                            <input wire:model="titulo_short" type="text"  class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700">
                            @error('titulo_short') <span class="text-red-500 text-[10px] uppercase font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="md:col-span-2 flex flex-col gap-1.5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">URL</label>
                            <input wire:model="url_short" type="url" placeholder="https://..." class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700">
                            @error('url_short') <span class="text-red-500 text-[10px] uppercase font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-auto pt-8 flex justify-end">
                        <button type="submit" class="bg-[#00ff00] text-black font-black px-12 py-3 rounded-full uppercase text-xs tracking-widest hover:bg-[#00d900] hover:scale-105 transition-all active:scale-95 shadow-[0_0_20px_rgba(0,255,0,0.3)]">
                            Registrar Short
                        </button>
                    </div>
                </form>
            @endif
        </main>
    </div>
</div>