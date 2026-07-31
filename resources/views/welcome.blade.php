<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema Metaluna</title>

    <link rel="icon" href="{{ asset('assets/imagenes/logo_metaluna_original.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-800 dark:text-white">

    <!-- BACKGROUND -->
    <div
        class="relative min-h-screen bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('images/foto.jpg') }}');"
    >

        <!-- OVERLAY -->
        <div class="absolute inset-0 bg-black/60"></div>

        <!-- CONTENT -->
        <div class="relative z-10 min-h-screen flex flex-col">

            <div class="w-full max-w-7xl mx-auto px-6 flex-1 flex flex-col">

                <!-- HEADER -->
                <header class="grid grid-cols-2 items-center py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2">
                        <a href="/">
                            <x-application-logo-blanco class="w-30 h-30 fill-current text-white" />
                        </a>
                    </div>

                    @if (Route::has('login'))
                        <nav class="flex justify-end">
                            @auth
                                <a
                                    href="{{ url('/inicio') }}"
                                    class="rounded-md px-4 py-2 text-sm font-semibold text-white transition hover:text-red-400"
                                >
                                    Inicio
                                </a>
                            @endauth
                        </nav>
                    @endif
                </header>

                <!-- MAIN -->
                <main class="flex-1 flex items-center">
                    <div class="w-full text-center lg:text-left">

                        <h1 class="text-4xl md:text-5xl font-extrabold text-white">
                            Sistema Metaluna
                        </h1>

                        <p class="mt-6 max-w-xl text-lg text-gray-200 leading-relaxed">
                            Plataforma empresarial para la gestión eficiente de procesos,
                            ventas y control administrativo.
                        </p>

                        <div class="mt-8">
                            @guest
                                <a
                                    href="{{ route('login') }}"
                                    class="inline-block rounded-lg bg-orange-500 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-orange-600"
                                >
                                    Iniciar Sesion
                                </a>
                            @endguest
                        </div>

                    </div>
                </main>

                <!-- FOOTER -->
                <footer class="py-10 text-center text-sm text-gray-300">
                    Sistema Metaluna 1.5 · Versión 30/01/2026
                </footer>

            </div>
        </div>
    </div>

</body>
</html>
