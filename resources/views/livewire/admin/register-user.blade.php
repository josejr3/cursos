<div class="py-12 bg-black min-h-screen">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-[#0a0a0a] border border-gray-800 overflow-hidden shadow-2xl sm:rounded-lg">
            <div class="p-8">
                
                <div class="mb-10 border-l-4 border-[#00FF00] pl-4">
                    <h2 class="text-2xl font-black uppercase tracking-widest text-white">
                        Registrar <span class="text-[#00FF00]">Nuevo Usuario</span>
                    </h2>
                </div>

                @if (session('status'))
                    <div class="mb-6 p-4 bg-[#00FF00]/10 border border-[#00FF00] text-[#00FF00] rounded text-sm font-bold uppercase tracking-widest">
                        {{ session('status') }}
                    </div>
                @endif

                <form wire:submit="save" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold text-[#00FF00] uppercase mb-1">Nombre</label>
                            <input wire:model="nombre" type="text" class="w-full bg-black border border-gray-800 text-white p-3 rounded focus:border-[#00FF00] focus:ring-0 transition">
                            @error('nombre') <span class="text-red-500 text-[10px] uppercase">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-[#00FF00] uppercase mb-1">Apellidos</label>
                            <input wire:model="apellidos" type="text" class="w-full bg-black border border-gray-800 text-white p-3 rounded focus:border-[#00FF00] focus:ring-0 transition">
                            @error('apellidos') <span class="text-red-500 text-[10px] uppercase">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-[#00FF00] uppercase mb-1">Correo Electrónico</label>
                        <input wire:model="email" type="email" class="w-full bg-black border border-gray-800 text-white p-3 rounded focus:border-[#00FF00] focus:ring-0 transition">
                        @error('email') <span class="text-red-500 text-[10px] uppercase">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-baseline mb-1">
                            <label class="block text-[10px] font-bold text-[#00FF00] uppercase">Descripción</label>
                            <span class="text-[9px] text-gray-600 font-bold uppercase">(Opcional)</span>
                        </div>
                        <textarea wire:model="descripcion" rows="4" class="w-full bg-black border border-gray-800 text-white p-3 rounded resize-none focus:border-[#00FF00] focus:ring-0 transition"></textarea>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-[#00FF00] text-black font-black px-10 py-4 rounded uppercase text-xs tracking-widest hover:scale-105 transition-transform active:scale-95">
                            Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>