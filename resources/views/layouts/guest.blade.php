<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Acceso</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            
            body {
                background-color: #f5f8fa !important;
            }
        </style>
    </head>
    <body class="font-sans text-[#14171a] antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            
            <div class="mb-6 transition-transform hover:scale-110 duration-300">
                <a href="/" class="flex flex-col items-center">
                    <i class="fa-solid fa-bug text-[#1da1f2] text-5xl mb-2"></i>
                    <span class="font-black text-2xl tracking-tighter text-[#1da1f2]">IT-TALK</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-2 overflow-hidden">
                
                {{ $slot }}
            </div>

            <div class="mt-8 flex gap-4 text-[11px] font-bold text-[#657786] uppercase tracking-widest">
                <a href="#" class="hover:text-[#1da1f2]">Sobre nosotros</a>
                <span>·</span>
                <a href="#" class="hover:text-[#1da1f2]">Ayuda</a>
                <span>·</span>
                <a href="#" class="hover:text-[#1da1f2]">Condiciones</a>
            </div>
        </div>
    </body>
</html>