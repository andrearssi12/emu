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
    {{-- DataTables --}}
    @stack('stylesheet')
</head>

<body>
    <header>
        <x-navbar />
        @if (request()->is('admin/*'))
            <x-sidebar />
        @endif
    </header>
    <main>
        @yield('content')
        @stack('modal')
    </main>
    @if (\Route::is('beranda'))
        @include('layout/partials/footer')
    @endif

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://kit.fontawesome.com/8ed166d714.js" crossorigin="anonymous"></script>
    @stack('scripts')
</body>

</html>
