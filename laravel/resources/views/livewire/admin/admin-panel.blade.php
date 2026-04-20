<div class="flex items-center justify-center min-h-screen bg-black font-sans tracking-tight p-4">
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <div class="glass-panel flex flex-col md:flex-row w-full max-w-[900px] min-h-[520px] rounded-xl border border-white/10 shadow-2xl overflow-hidden bg-[#0a0a0a]">
        
        <aside class="hidden md:flex w-[180px] bg-[#0a0a0a] p-8 flex-col gap-2 border-r border-white/5">
            <span class="text-[10px] text-gray-600 font-black uppercase tracking-[0.2em] mb-4 px-2">Registros</span>
            <button wire:click="setTab('usuario')" class="w-full text-left py-2 px-5 rounded-full text-sm font-bold transition-all block {{ $tab === 'usuario' ? 'bg-[#00ff00] text-black shadow-[0_0_20px_rgba(0,255,0,0.15)]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">Usuario</button>
            <button wire:click="setTab('curso')" class="w-full text-left py-2 px-5 rounded-full text-sm font-bold transition-all block {{ $tab === 'curso' ? 'bg-[#00ff00] text-black shadow-[0_0_20px_rgba(0,255,0,0.15)]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">Curso</button>
            <button wire:click="setTab('short')" class="w-full text-left py-2 px-5 rounded-full text-sm font-bold transition-all block {{ $tab === 'short' ? 'bg-[#00ff00] text-black shadow-[0_0_20px_rgba(0,255,0,0.15)]' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">Short</button>
        </aside>

        <main class="flex-grow p-10 flex flex-col w-full max-w-[720px]">
            
            @if ($statusMsg)
                <div class="mb-6 p-4 rounded-xl text-xs font-bold uppercase tracking-widest border {{ str_contains($statusMsg, 'Error') ? 'bg-red-500/10 border-red-500/20 text-red-500' : 'bg-[#00ff00]/10 border-[#00ff00]/20 text-[#00ff00]' }}">
                    {{ $statusMsg }}
                </div>
            @endif

            @if ($tab === 'usuario')
                <div class="mb-8 flex items-center justify-between">
                    <div>
                        <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight text-white uppercase">
                            Registrar <span class="text-[#00ff00]"> Usuario</span>
                        </h1>
                        <p class="mt-2 text-sm text-gray-400">Personaliza la información y el acceso para el nuevo integrante.</p>
                    </div>
                </div>

                <div x-data="{ open: {{ str_contains($statusMsg ?? '', 'Falta') ? 'true' : 'false' }} }">
                    
                    <div class="mb-10">
                        <button @click="open = !open" class="flex items-center gap-2 bg-[#00ff00]/10 hover:bg-[#00ff00]/20 text-[#00ff00] px-4 py-2 rounded-lg text-[10px] font-bold uppercase tracking-widest transition-all border border-[#00ff00]/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span x-text="open ? 'Volver al registro manual' : 'Registrar varios usuarios desde documento'"></span>
                        </button>

                        <div x-show="open" x-transition class="mt-6 p-6 rounded-2xl border border-white/10 bg-white/[0.02]">
                            <h2 class="text-[11px] font-black text-white uppercase tracking-[0.2em] mb-4">Guía de formato obligatorio</h2>
                            
                            <div class="overflow-hidden border border-white/10 rounded-lg mb-6">
                                <table class="w-full text-[10px] font-mono border-collapse">
                                    <thead>
                                        <tr class="bg-white/5 text-gray-400 border-b border-white/10 text-center">
                                            <th class="p-2 border-r border-white/10 w-8 bg-white/10"></th>
                                            <th class="p-2 border-r border-white/10">A</th>
                                            <th class="p-2 border-r border-white/10">B</th>
                                            <th class="p-2 border-r border-white/10">C</th>
                                            <th class="p-2">D</th>
                                        </tr>
                                        <tr class="text-white border-b border-white/10 bg-black/40">
                                            <td class="p-2 border-r border-white/10 bg-white/5 text-center text-gray-500">1</td>
                                            <td class="p-2 border-r border-white/10 {{ str_contains($statusMsg ?? '', 'Nombre') ? 'text-red-500 font-black underline bg-red-500/10' : '' }}">Nombre</td>
                                            <td class="p-2 border-r border-white/10 {{ str_contains($statusMsg ?? '', 'Apellidos') ? 'text-red-500 font-black underline bg-red-500/10' : '' }}">Apellidos</td>
                                            <td class="p-2 border-r border-white/10 {{ str_contains($statusMsg ?? '', 'Correo Electrónico') ? 'text-red-500 font-black underline bg-red-500/10' : '' }}">Correo Electrónico</td>
                                            <td class="p-2 {{ str_contains($statusMsg ?? '', 'Descripción') ? 'text-red-500 font-black underline bg-red-500/10' : '' }}">Descripción</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-gray-600">
                                            <td class="p-2 border-r border-white/10 bg-white/5 text-center">2</td>
                                            <td class="p-2 border-r border-white/10">Juan</td>
                                            <td class="p-2 border-r border-white/10">Pérez</td>
                                            <td class="p-2 border-r border-white/10">juan@email.com</td>
                                            <td class="p-2 italic">Dato obligatorio</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="flex flex-col gap-4">
                                <label class="relative flex flex-col items-center justify-center border-2 border-dashed border-white/10 hover:border-[#00ff00]/40 rounded-xl p-8 transition-all bg-black group cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-600 mb-2 group-hover:text-[#00ff00]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <span id="file_name_display" class="text-xs text-gray-500 group-hover:text-white">Seleccionar archivo .xlsx, .xls o .csv</span>
                                    <input type="file" id="excel_input" accept=".xlsx, .xls, .csv" class="absolute inset-0 opacity-0 cursor-pointer">
                                </label>
                                <p id="loading_msg" class="hidden text-center text-[10px] text-[#00ff00] font-bold uppercase tracking-widest">Analizando documento...</p>
                            </div>
                        </div>
                    </div>

                    <div x-show="!open" x-transition>
                        <div class="relative flex items-center mb-8">
                            <div class="flex-grow border-t border-white/5"></div>
                            <span class="px-4 text-[9px] font-bold text-gray-700 uppercase tracking-[0.3em]">Registro manual</span>
                            <div class="flex-grow border-t border-white/5"></div>
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
                    </div>
                </div>

                <script>
                    document.getElementById('excel_input')?.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (!file) return;
                        document.getElementById('file_name_display').innerText = file.name;
                        document.getElementById('loading_msg').classList.remove('hidden');

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const data = new Uint8Array(e.target.result);
                            const workbook = XLSX.read(data, { type: 'array' });
                            const worksheet = workbook.Sheets[workbook.SheetNames[0]];
                            const jsonData = XLSX.utils.sheet_to_json(worksheet);
                            
                            @this.cargarUsuariosJson(jsonData).then(() => {
                                document.getElementById('loading_msg').classList.add('hidden');
                                document.getElementById('excel_input').value = '';
                            });
                        };
                        reader.readAsArrayBuffer(file);
                    });
                </script>
            @endif

            @if ($tab === 'curso')
                <div class="mb-8">
                    <h1 class="font-headline text-3xl md:text-4xl font-extrabold tracking-tight text-white uppercase">
                        Registrar <span class="text-[#00ff00]"> Curso</span>
                    </h1>
                    <p class="mt-2 text-sm text-gray-400">Añade un nuevo curso al catálogo completando la siguiente información.</p>
                </div>

                <form wire:submit="saveCurso" class="flex flex-col flex-grow w-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2 flex flex-col gap-1.5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">Título del Curso</label>
                            <input wire:model="titulo" type="text" class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700">
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
                    <p class="mt-2 text-sm text-gray-400">Añade un nuevo short completando la siguiente información.</p>
                </div>

                <form wire:submit="saveShort" class="flex flex-col flex-grow w-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2 flex flex-col gap-1.5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">Título del Short</label>
                            <input wire:model="titulo_short" type="text" class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700">
                            @error('titulo_short') <span class="text-red-500 text-[10px] uppercase font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="md:col-span-2 flex flex-col gap-1.5">
                            <label class="text-[10px] font-bold text-gray-500 uppercase tracking-[0.2em] ml-1">URL</label>
                            <input wire:model="url_short" type="url" placeholder="https://www.youtube.com/shorts/..." class="w-full bg-white/5 border border-white/10 text-white p-3 rounded-xl focus:border-[#00ff00]/40 focus:ring-0 transition-all outline-none text-sm placeholder:text-gray-700">
                            @error('url_short') <span class="text-red-500 text-[10px] uppercase font-bold mt-1 ml-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="bg-[#00ff00] text-black font-black px-12 py-3 rounded-full uppercase text-xs tracking-widest hover:bg-[#00d900] hover:scale-105 transition-all active:scale-95 shadow-[0_0_20px_rgba(0,255,0,0.3)]">
                            Registrar Short
                        </button>
                    </div>

                    <div class="mt-8 border-t border-white/10 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold text-white uppercase tracking-[0.12em]">Shorts registrados</h2>
                            <span class="text-xs text-[#00ff00] font-semibold">{{ $shorts->count() }} total</span>
                        </div>

                        @if ($shorts->isEmpty())
                            <p class="text-sm text-gray-400">Todavia no hay shorts registrados.</p>
                        @else
                            <div class="space-y-3 max-h-[220px] overflow-y-auto pr-1">
                                @foreach ($shorts as $short)
                                    <div class="rounded-xl border border-white/10 bg-white/5 p-3 flex items-center justify-between gap-3">
                                        <div class="min-w-0">
                                            <p class="text-sm text-white font-semibold truncate">{{ $short->titulo }}</p>
                                            <a href="{{ $short->url }}" target="_blank" rel="noopener noreferrer" class="text-xs text-gray-400 hover:text-[#00ff00] truncate block">
                                                {{ $short->url }}
                                            </a>
                                        </div>

                                        <button type="button" wire:click="deleteShort({{ $short->id }})" wire:confirm="Deseas eliminar este short?" class="shrink-0 rounded-full border border-red-500/30 bg-red-500/10 px-4 py-2 text-xs font-bold uppercase tracking-wider text-red-300 hover:bg-red-500/20 transition">
                                            Eliminar
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </form>
            @endif
        </main>
    </div>
</div>