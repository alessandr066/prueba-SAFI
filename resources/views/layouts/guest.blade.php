<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SAFI') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-ues-light text-gray-900 dark:bg-gray-900">

    <!-- CONTENEDOR DE PÁGINA -->
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10">

        <!-- LOGO UES (Opcional - Descomenta si quieres mostrarlo) -->
        {{--
        <div class="mb-6">
            <a href="{{ url('/') }}">
                <img src="https://www.ues.edu.sv/wp-content/uploads/sites/20/2024/08/dark-header-v2-500x176.png"
                    alt="Logo UES" class="h-16">
            </a>
        </div>
        --}}

        <!-- CONTENEDOR DEL FORMULARIO -->
        <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-xl rounded-xl px-8 py-6">
            {{ $slot }}
        </div>

    </div>

    <!-- FOOTER (Opcional) -->
    <footer class="text-center mt-4 text-sm text-gray-600 dark:text-gray-300">
        © {{ date('Y') }} SAFI — Universidad de El Salvador. Todos los derechos reservados.
    </footer>

</body>

</html>
