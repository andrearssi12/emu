@extends('layout.admin.app')

@push('styles')
    @vite('resources/js/datatables/datatables.css')
@endpush

@section('content')
    <!-- Breadcrumb -->
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

    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mt-4 p-4">
        <div class="w-full">
            <table id="pagination-table" class="text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="all" scope="col">
                            Nama
                        </th>
                        <th class="desktop" scope="col">
                            Jumlah Kawasan Hijau
                        </th>
                        <th class="desktop" scope="col">
                            Luas Kawasan Hijau
                        </th>
                        <th class="desktop" scope="col">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kampus as $item)
                        <tr>
                            <td>{{ $item->nama_kampus }}</td>
                            <td>{{ $item->total_kawasan_hijau }}</td>
                            <td>{{ $item->total_luas_kawasan_hijau }}</td>
                            <td class="p-4">
                                <a href="{{ route('kawasan-hijau.create', $item->hashed_id) }}"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Pilih</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/datatables/datatables.js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var table = new DataTable('#pagination-table', {
                processing: true,
                responsive: true,
                autoWidth: false,
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
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass(
                        'bg-white border-b dark:bg-gray-800 dark:border-gray-700'
                    );
                },
            });
        });
    </script>
@endpush