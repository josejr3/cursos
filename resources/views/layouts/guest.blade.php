<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&family=Manrope:wght@400;500;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <script>
            tailwind.config = {
                darkMode: "class",
                theme: {
                    extend: {
                        colors: {
                            "inverse-primary": "#ba0063",
                            "on-background": "#f0edf1",
                            "on-tertiary-container": "#100065",
                            "on-primary-container": "#4c0025",
                            "on-error": "#490013",
                            "background": "#0e0e11",
                            "primary-fixed": "#ff6fa4",
                            "tertiary-dim": "#9691fe",
                            "secondary-dim": "#00d4ec",
                            "on-tertiary-fixed-variant": "#302792",
                            "tertiary": "#9f9bff",
                            "on-secondary-fixed": "#003a42",
                            "on-surface": "#f0edf1",
                            "surface-container-highest": "#25252a",
                            "error": "#ff6e84",
                            "error-container": "#a70138",
                            "on-error-container": "#ffb2b9",
                            "secondary": "#00e3fd",
                            "on-primary": "#610031",
                            "inverse-surface": "#fcf8fd",
                            "outline-variant": "#48474b",
                            "secondary-fixed": "#26e6ff",
                            "surface-dim": "#0e0e11",
                            "secondary-fixed-dim": "#00d7f0",
                            "on-primary-fixed-variant": "#5d002e",
                            "primary": "#ff89b1",
                            "tertiary-container": "#918cf9",
                            "on-tertiary": "#1c0b81",
                            "on-tertiary-fixed": "#0e005e",
                            "surface-variant": "#25252a",
                            "surface-bright": "#2c2c30",
                            "on-secondary-fixed-variant": "#005964",
                            "on-secondary-container": "#e8fbff",
                            "outline": "#767579",
                            "tertiary-fixed": "#aba7ff",
                            "surface-container-low": "#131316",
                            "on-secondary": "#004d57",
                            "primary-container": "#ff6fa4",
                            "tertiary-fixed-dim": "#9c98ff",
                            "error-dim": "#d73357",
                            "surface-container": "#19191d",
                            "surface-tint": "#ff89b1",
                            "surface-container-high": "#1f1f23",
                            "primary-fixed-dim": "#ff5098",
                            "on-surface-variant": "#acaaae",
                            "on-primary-fixed": "#000000",
                            "surface-container-lowest": "#000000",
                            "primary-dim": "#e2007a",
                            "surface": "#0e0e11",
                            "secondary-container": "#006875",
                            "inverse-on-surface": "#555458"
                        },
                        fontFamily: {
                            "headline": ["Plus Jakarta Sans"],
                            "body": ["Manrope"],
                            "label": ["Manrope"]
                        },
                        borderRadius: {
                            "DEFAULT": "0.25rem",
                            "lg": "0.5rem",
                            "xl": "0.75rem",
                            "full": "9999px"
                        },
                    },
                },
            }
        </script>
        
        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
            .glow-orb {
                filter: blur(120px);
                pointer-events: none;
            }
            .glass-panel {
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
            }
        </style>
    </head>
    <body class="bg-background text-on-background font-body min-h-screen relative overflow-x-hidden flex flex-col">
        {{ $slot }}
    </body>
</html>
