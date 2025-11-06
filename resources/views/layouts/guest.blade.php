<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{  'Nexus' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex bg-[#FFFFFF]">
            
            <div class="w-1/2 hidden sm:flex items-center justify-center bg-[#C974E3]">
                <x-application-logo class="w-32 h-32 fill-current text-gray-500" />
                <h1 class="text-white text-4xl font-bold ms-4">Nexus System</h1>
            </div>

            <div class="w-full sm:w-1/2 flex items-center justify-center">
                {{ $slot }}
            </div>
        </div>
    </body>

</html>
