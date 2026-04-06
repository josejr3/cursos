<div>
    <div
        x-data="{
            open: false,
            fullscreen: false,
            dragging: false,
            startX: 0,
            startY: 0,
            x: window.innerWidth - 420,
            y: window.innerHeight - 650,
            startDrag(e) {
                if (this.fullscreen) return;
                this.dragging = true;
                this.startX = e.clientX - this.x;
                this.startY = e.clientY - this.y;
            },
            doDrag(e) {
                if (this.dragging && !this.fullscreen) {
                    e.preventDefault();
                    this.x = e.clientX - this.startX;
                    this.y = e.clientY - this.startY;
                }
            },
            stopDrag() {
                this.dragging = false;
            }
        }"
        @mousemove.window="doDrag($event)"
        @mouseup.window="stopDrag()"
        class="relative z-50 font-sans antialiased"
    >
        <button
            type="button"
            x-show="!open"
            @click="open = true"
            class="fixed bottom-6 right-6 w-14 h-14 bg-[#00FF00] text-black rounded-full  flex items-center justify-center hover:scale-105 focus:outline-none transition-transform duration-200"
        >
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
        </button>

        <div
            x-show="open"
            x-bind:class="fullscreen ? 'fixed inset-0 w-full h-full rounded-none' : 'fixed w-[380px] h-[600px] rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)]'"
            x-bind:style="!fullscreen ? 'left: ' + x + 'px; top: ' + y + 'px;' : ''"
            class="bg-[#09090b]/85 backdrop-blur-2xl flex flex-col overflow-hidden transition-all duration-200 ease-out border border-white/10"
        >
            <div
                @mousedown="startDrag($event)"
                class="bg-[#000000]/40 border-b border-white/5 px-5 py-4 flex justify-between items-center cursor-move select-none z-10"
            >
                <div class="flex items-center space-x-2">
                    <span class="text-white font-semibold text-[15px] tracking-wide">
                        TALENT<span class="text-[#00FF00]">CAMP</span>
                    </span>
                </div>

                <div class="flex items-center space-x-1">
                    <button type="button" @click="open = false" class="p-1.5 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all focus:outline-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></path>
                        </svg>
                    </button>
                    <button type="button" @click="fullscreen = !fullscreen" class="p-1.5 text-gray-400 hover:text-white hover:bg-white/10 rounded-lg transition-all focus:outline-none">
                        <svg x-show="!fullscreen" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l-5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                        </svg>
                        <svg x-show="fullscreen" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 14h6m0 0v6m0-6l-7 7m17-11h-6m0 0V4m0 6l7-7M4 10h6m0 0V4m0 6l-7-7m17 10h-6m0 0v6m0-6l7 7"></path>
                        </svg>
                    </button>
                    <button type="button" @click="open = false; fullscreen = false" class="p-1.5 text-gray-400 hover:text-[#00FF00] hover:bg-[#00FF00]/10 rounded-lg transition-all focus:outline-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-5 space-y-5 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                
                <div class="flex flex-col space-y-5" wire:key="messages-container">
                    @foreach($messages as $index => $message)
                        <div wire:key="msg-{{ $index }}" class="flex {{ $message['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[85%] flex flex-col {{ $message['role'] === 'user' ? 'items-end' : 'items-start' }}">
                                <div class="px-6 py-4 text-[14px] leading-relaxed break-words break-all {{ $message['role'] === 'user' ? 'bg-[#00FF00] text-black font-medium rounded-2xl' : 'bg-[#18181b] border border-[#27272a] border-l-[3px] border-l-[#00e5ff] text-gray-200 rounded-2xl' }}">
                                    {{ $message['content'] }}
                                </div>
                                <span class="text-[10px] text-gray-500 mt-1.5 px-1">{{ now()->format('H:i') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div wire:key="loading-indicator" class="w-full {{ $isWaiting ? 'block' : 'hidden' }}">
                    <div class="flex justify-start">
                        <div class="max-w-[80%] flex flex-col items-start">
                            <div class="px-5 py-3.5 bg-white/5 border border-white/10 rounded-2xl rounded-tl-sm flex items-center space-x-1.5 shadow-sm">
                                <div class="w-1.5 h-1.5 bg-[#00e5ff] rounded-full animate-bounce"></div>
                                <div class="w-1.5 h-1.5 bg-[#00e5ff] rounded-full animate-bounce" style="animation-delay: 0.15s"></div>
                                <div class="w-1.5 h-1.5 bg-[#00FF00] rounded-full animate-bounce" style="animation-delay: 0.3s"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-[#000000]/20 p-4 border-t border-white/5 z-10 flex-shrink-0">
                <div class="flex items-center bg-[#09090b]/80 border border-white/10 rounded-full p-1.5 focus-within:border-[#00FF00]/50 focus-within:ring-1 focus-within:ring-[#00FF00]/50 transition-all shadow-inner">
                    <input
                        type="text"
                        wire:model="newMessage"
                        wire:keydown.enter.prevent="sendMessage"
                        {{ $isWaiting ? 'disabled' : '' }}
                        placeholder="Escribe tu mensaje..."
                        class="flex-1 bg-transparent border-none focus:ring-0 text-[14px] text-white placeholder-gray-500 px-4 py-1.5 outline-none disabled:opacity-50"
                    >
                    <button
                        type="button"
                        wire:click="sendMessage"
                        {{ $isWaiting ? 'disabled' : '' }}
                        class="w-9 h-9 bg-gradient-to-r from-[#00FF00] to-[#00d400] rounded-full flex items-center justify-center text-black hover:brightness-110 transition-all shadow-[0_0_12px_rgba(0,255,0,0.4)] flex-shrink-0 focus:outline-none disabled:opacity-50"
                    >
                        <svg class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>