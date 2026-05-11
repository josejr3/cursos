<div>
    @auth
        @if (auth()->user()->is_admin)
            @if ($confirmingDelete)
                <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
                    <div class="bg-gray-900 border border-red-500/30 rounded-2xl p-6 max-w-sm mx-4 shadow-2xl">
                        <h3 class="text-lg font-bold text-white mb-2">¿Estás seguro?</h3>
                        <p class="text-gray-300 mb-6">
                            Vas a eliminar el short "<strong>{{ $short->titulo }}</strong>". Esta acción no se puede deshacer.
                        </p>
                        <div class="flex gap-3">
                            <button
                                wire:click="delete"
                                class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                Eliminar
                            </button>
                            <button
                                wire:click="$set('confirmingDelete', false)"
                                class="flex-1 bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <button
                wire:click="confirmDelete"
                class="inline-flex items-center justify-center rounded-lg p-2.5 text-red-500 hover:bg-red-500/15 hover:text-red-400 transition-all duration-200 group"
                title="Eliminar short">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        @endif
    @endauth
</div>
