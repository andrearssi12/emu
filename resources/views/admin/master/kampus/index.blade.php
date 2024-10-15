@extends('layout.admin.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.min.css">
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
            <h1 class="text-gray-900 dark:text-white font-bold">Tabel Data Kampus</h1>
            <a href="{{ route('kampus.create') }}" class="py-2 px-3 bg-blue-700 rounded-md text-white"><i
                    class="fa-solid fa-edit"></i>
                Tambah</a>
        </div>
        <table id="pagination-table">
            <thead>
                <tr>
                    <th>
                        <span class="flex items-center">
                            Nama
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Alamat
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Geom
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Luas
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Aksi
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kampus as $item)
                    <tr>
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $item->nama }}</td>
                        <td>
                            <div class="max-h-24 overflow-y-auto">
                                <div class="whitespace-pre-wrap">{{ $item->alamat }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="max-h-24 overflow-y-auto">
                                <div class="whitespace-pre-wrap">{{ $item->geom }}</div>
                            </div>
                        </td>
                        <td>{{ $item->luas }}</td>
                        <td><a href="{{ route('kampus.edit', $item->id) }}"
                                class="py-2 px-3 bg-blue-700 rounded-md text-white"><i class="fa-solid fa-edit"></i>
                                Edit</a>
                            <form action="{{ route('kampus.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="py-2 px-3 bg-red-700 rounded-md text-white"><i
                                        class="fa-solid fa-trash"></i>
                                    Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    {{-- <script type="module">
        const table = document.getElementById("pagination-table");

        // Initialize Simple-DataTables
        new DataTable(table, {
            search: true,
            paging: true,
            perPage: 5,
            perPageSelect: [5, 10, 15, 20, 25],
            sortable: true
        });
    </script> --}}
@endpush
