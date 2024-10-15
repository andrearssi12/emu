@extends('layout/app')

@section('content')
    <div>
        <section
            class="h-screen flex bg-center bg-no-repeat bg-cover bg-[url('{{ asset('img/kampus-uad.jpg') }}')] bg-gray-600 dark:bg-gray-700 bg-blend-multiply">
            <div class="w-full flex justify-center items-center flex-col">
                <h1
                    class="text-center mb-4 text-4xl font-extrabold tracking-tight leading-none text-white dark:text-white md:text-5xl lg:text-6xl">
                    Eco Map Universitas Ahmad Dahlan
                </h1>
                <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
                    How Green Is Your Campus?
                </p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <a href="#"
                        class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
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
    </div>
@endsection

@push('scripts')
    <script>
        // Memilih elemen HTML yang ingin Anda pantau perubahan kelasnya
        var elemen = document.getElementById('navbar');

        // Menambahkan event listener untuk mendeteksi scroll
        window.addEventListener('scroll', function() {
            // Mendapatkan posisi scroll vertikal
            var scrollPosition = window.scrollY;

            // Menentukan kondisi untuk mengubah kelas
            if (scrollPosition > 100) { // Misalnya, mengubah kelas saat scroll melebihi 100 piksel
                elemen.classList.add('backdrop-blur-xl');
                elemen.classList.add('bg-black/60');
                elemen.classList.remove('bg-inherit');
            } else {
                elemen.classList.remove('backdrop-blur-xl');
                elemen.classList.remove('bg-black/60');
                elemen.classList.add('bg-inherit');
            }
        });
    </script>
@endpush
