@extends('layout/app')

@section('content')
    <section
        class="h-screen flex justify-center items-center bg-center bg-no-repeat bg-cover bg-gray-600 dark:bg-gray-800 bg-blend-multiply"
        style="background-image: url('{{ Vite::asset('resources/img/kampus-uad.jpg') }}');">
        <div class="container flex flex-col justify-center items-center gap-6 px-4 lg:gap-8">
            <h1
                class="text-center text-3xl font-extrabold tracking-tight leading-none text-white sm:text-4xl md:text-5xl lg:text-6xl">
                Eco Map Universitas Ahmad Dahlan
            </h1>
            <p class="mb-6 text-lg font-normal tracking-tight text-gray-300 sm:text-xl sm:px-16 lg:px-48 text-center">
                How Green Is Your Campus?
            </p>
            <div class="flex flex-col space-y-4">
                <a id="get-started-button" href="#first-content"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 shadow-lg shadow-gray-800">
                    Get started
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
    <section id="first-content" class="bg-gray-100 dark:bg-gray-800">
        <div class="container py-12 px-4">
            <div class="grid grid-cols-1 gap-6 rounded-xl lg:grid-cols-2">
                <div class="flex flex-col justify-center items-start space-y-4">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 lg:text-3xl">Peta Kampus</h2>
                    <p class="text-base font-normal text-gray-600 dark:text-gray-300 lg:text-lg">
                        Dengan peta kampus ini, Anda dapat mengetahui luasan tiap-tiap kampus Universitas Ahmad Dahlan di
                        berbagai wilayah Yogyakarta, membantu dalam visualisasi area kampus.
                    </p>
                </div>
                <div class="group relative rounded-xl overflow-hidden bg-gray-200 dark:bg-gray-400">
                    <div class="w-full h-full flex absolute justify-center items-center">
                        <a href="{{ route('peta.kampus') }}"
                            class="z-10 px-3 py-2 text-sm sm:px-6 sm:py-3.5 sm:text-base sm:font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-500 shadow-md shadow-gray-800">View
                            Details</a>
                    </div>
                    <img src="{{ Vite::asset('resources/img/peta-kampus.png') }}" alt="Eco Map UAD"
                        class="w-full h-auto group-hover:scale-105 group-hover:mix-blend-multiply transition-all ease-in-out duration-500">
                </div>
            </div>
        </div>
    </section>
    <section class="bg-gray-100 dark:bg-gray-800">
        <div class="container sm:py-12 px-4">
            <div class="grid grid-cols-1 gap-6 rounded-xl lg:grid-cols-2">
                <div class="group relative rounded-xl overflow-hidden bg-gray-200 dark:bg-gray-400 order-2 lg:order-1">
                    <div class="w-full h-full flex absolute justify-center items-center">
                        <a href="{{ route('peta.kawasan.hijau') }}"
                            class="z-10 px-3 py-2 text-sm sm:px-6 sm:py-3.5 sm:text-base sm:font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 opacity-0 group-hover:opacity-100 transition-all ease-in-out duration-500 shadow-md shadow-gray-800">View
                            Details</a>
                    </div>
                    <img src="{{ Vite::asset('resources/img/peta-kawasan.png') }}" alt="Eco Map UAD"
                        class="w-full h-auto group-hover:scale-105 group-hover:mix-blend-multiply transition-all ease-in-out duration-500">
                </div>
                <div class="flex flex-col justify-center items-start space-y-4 order-1 lg:order-2">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 lg:text-3xl">Peta Kawasan Hijau</h2>
                    <p class="text-base font-normal text-gray-600 dark:text-gray-300 lg:text-lg">
                        Pada tiap lokasi kampus Universitas Ahmad Dahlan terdapat kawasan hijau yang asri dan nyaman untuk
                        dijadikan tempat beristirahat. Peta ini menampilkan lokasi-lokasi yang berhubungan dengan lingkungan
                        hidup, fasilitas-fasilitas yang ada, informasi mengenai lokasi-lokasi, luas kawasan hijau di tiap
                        lokasi kampus, serta jumlah pepohonan yang ditanam di tiap kawasan hijau.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.getElementById('get-started-button').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('first-content').scrollIntoView({
                behavior: 'smooth'
            });
        });
    </script>
@endpush
