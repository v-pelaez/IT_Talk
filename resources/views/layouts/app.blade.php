<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>IT-TALK</title>

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
    <div class="min-h-screen">

        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white border-b border-[#e1e8ed]">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-xl font-black tracking-tight">{{ $header }}</h1>
                </div>
            </header>
        @endisset

        <main class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        <footer class="py-8 text-center">
            <p class="text-xs text-[#657786] font-medium">
                &copy; {{ date('Y') }} IT-TALK. Encuentra el bug.
            </p>
        </footer>
    </div>
</body>
