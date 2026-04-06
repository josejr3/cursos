<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --bg-dark: #000000;
                --text-main: #f0f0f5;
            }

            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }

            /* Fondo Premium Global Corregido: Más negro, menos brillo */
            body {
                background-color: var(--bg-dark) !important;
                background-image: 
                    radial-gradient(circle at 15% 15%, rgba(0, 229, 255, 0.07) 0%, transparent 25%),
                    radial-gradient(circle at 85% 85%, rgba(0, 255, 0, 0.07) 0%, transparent 25%),
                    linear-gradient(to bottom, rgba(0,0,0,0.9), rgba(0,0,0,1)),
                    repeating-linear-gradient(45deg, rgba(255,255,255,0.01) 0px, rgba(255,255,255,0.01) 1px, transparent 1px, transparent 10px);
                background-blend-mode: screen, screen, normal, normal;
                background-attachment: fixed;
                color: var(--text-main);
            }

            .glow-orb {
                filter: blur(120px);
                pointer-events: none;
            }

            .glass-panel {
                backdrop-filter: blur(30px);
                -webkit-backdrop-filter: blur(30px);
                background-color: rgba(20, 20, 28, 0.45);
                border: 1px solid rgba(255, 255, 255, 0.08);
            }
        </style>
    </head>
    <body class="font-body min-h-screen relative overflow-x-hidden antialiased">
        <div class="min-h-screen flex flex-col">
            <livewire:layout.navigation />

            @if (isset($header))
                <header class="bg-transparent border-b border-white/5 shadow-lg relative z-20">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="flex-grow relative z-10">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>