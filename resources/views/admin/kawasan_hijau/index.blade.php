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
                <a href="#"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Home
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
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Templates</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Flowbite</span>
                </div>
            </li>
        </ol>
    </nav>

    <div
        class="p-4 my-6 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:border-gray-700 dark:bg-gray-800 xl:mb-0">
        <div class="flex justify-between mb-5">
            <h1 class="text-gray-900 dark:text-white font-bold">Tabel Data Kawasan Hijau</h1>
            <a href="{{ route('kawasan-hijau.create') }}" class="py-2 px-3 bg-blue-700 rounded-md text-white"><i
                    class="fa-solid fa-edit"></i>
                Tambah</a>
        </div>
        <table id="pagination-table" class="text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col">
                        Nama Kawasan
                    </th>
                    <th scope="col">
                        Nama Kampus
                    </th>
                    <th scope="col">
                        Geometry
                    </th>
                    <th scope="col">
                        Luas
                    </th>
                    <th scope="col">
                        Jenis Vegetasi
                    </th>
                    <th scope="col">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/datatables/datatables.js')
    <script type="module">
        var table = new DataTable('#pagination-table', {
            serverSide: true,
            responsive: true,
            dom: '<"flex flex-col md:flex-row md:justify-between items-center py-2 space-y-2 md:space-y-0"lf>t<"flex flex-col md:flex-row md:justify-between items-center py-2 space-y-2 md:space-y-0"ip>',
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
                url: "{{ route('kawasan.datatables') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            },
            columns: [{
                    data: 'nama_kawasan',
                    name: 'nama_kawasan',
                    defaultContent: '-',
                    className: 'text-gray-900 dark:text-white font-medium'
                },
                {
                    data: 'kampus.nama_kampus',
                    name: 'kampus.nama_kampus',
                    defaultContent: '-'
                },
                {
                    data: 'geom',
                    name: 'geom',
                    orderable: false,
                    searchable: false,
                    defaultContent: '-'
                },
                {
                    data: 'luas',
                    name: 'luas',
                    defaultContent: '-'
                },
                {
                    data: 'jenis_vegetasi',
                    name: 'jenis_vegetasi',
                    defaultContent: '-'
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    </script>
@endpush
