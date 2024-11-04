<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EMU - {{ $pageTitle }}</title>
    <link rel="shortcut icon" type="image/png/jpg" href="{{ asset('img/logo-warna.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('stylesheet')
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    <header>
        @include('layout.partials.navbar')
    </header>
    <main>
        @yield('content')
        @stack('modal')
    </main>

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
