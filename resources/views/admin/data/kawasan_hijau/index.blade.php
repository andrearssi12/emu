@extends('layout.admin.app')

@push('styles')
    @vite('resources/js/datatables/datatables.css')
@endpush

@section('content')
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="#"
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Data</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Kawasan Hijau</span>
                </div>
            </li>
        </ol>
    </nav>

    <div
        class="w-full p-4 my-6 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:border-gray-700 dark:bg-gray-800 xl:mb-0">
        <div class="flex justify-between mb-5">
            <h1 class="text-gray-900 dark:text-white font-bold">Tabel Data Kawasan Hijau</h1>
            <a href="{{ route('kawasan-hijau.create') }}"
                class="py-2 px-3 text-xs text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                    class="fa-solid fa-plus"></i>
                Tambah</a>
        </div>

        <div class="w-full">
            <table id="pagination-table" class="text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col">
                            Kampus
                        </th>
                        <th scope="col">
                            Geometry
                        </th>
                        <th scope="col">
                            Luas
                        </th>
                        <th scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/datatables/datatables.js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var table = new DataTable('#pagination-table', {
                serverSide: true,
                processing: true,
                responsive: true,
                dom: '<"flex flex-col md:flex-row md:justify-between items-center py-2 space-y-2 md:space-y-0"lf>t<"flex flex-col md:flex-row md:justify-between items-center py-2 space-y-2 md:space-y-0 text-sm"ip>',
                language: {
                    'search': '',
                    'searchPlaceholder': 'Cari data...',
                    "emptyTable": "Data tidak tersedia.",
                    "lengthMenu": "_MENU_ Data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "zeroRecords": "Tidak ada data yang cocok dengan pencarian"
                },
                ajax: {
                    url: "{{ route('kawasan-hijau.datatables') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                },
                columns: [{
                        data: 'kampus.nama_kampus',
                        name: 'kampus.nama_kampus',
                        defaultContent: '-',
                        className: 'text-gray-900 dark:text-white font-medium'
                    },
                    {
                        data: 'geom',
                        name: 'geom',
                        defaultContent: '-',
                        className: 'text-wrap'
                    },
                    {
                        data: 'luas',
                        name: 'luas',
                        defaultContent: '-'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass(
                        'bg-white border-b dark:bg-gray-800 dark:border-gray-700'
                    );
                },
            });
        });
    </script>
@endpush
