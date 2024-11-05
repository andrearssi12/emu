<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EMU - {{ $pageTitle }}</title>
    <link rel="shortcut icon" type="image/png/jpg" href="{{ asset('img/logo-warna.png') }}">

    @vite(['resources/css/app.css', 'resources/js/template/index.js', 'resources/js/app.js'])
    @stack('stylesheet')
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    <header>
        @if (request()->is('admin/*'))
            @include('layout.admin.partials.navbar')
        @else
            @include('layout.partials.navbar')
        @endif
    </header>
    @if (request()->is('admin/*'))
        <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

            @include('layout.admin.partials.sidebar')

            <div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>

            <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
                <main>
                    <div class="px-4 pt-6">
                        @yield('content')
                    </div>
                </main>

                @include('layout.admin.partials.footer')
            </div>
        </div>
    @else
        <main>
            @yield('content')
        </main>
    @endif

    @stack('modal')

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    @stack('scripts')

</body>

</html>
