@extends('layout.app')

@section('content')
    <div class="p-4 sm:ml-64">
        <x-breadcrumb :paths="[]" :active="'Campus'" />
        <div class="container mb-4 mt-4">
            <a href="{{ route('campus.create') }}" class="py-2 px-3 bg-green-700 rounded-md text-white"><i
                    class="fa-solid fa-plus"></i> Tambah</a>
        </div>
        <div class="container mt-4">
            <x-data-tables :headers="['kampus', 'alamat', 'lat', 'lng', 'action']" />
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dataTables').DataTable({
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('campus.datatables') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'lat',
                        name: 'lat'
                    },
                    {
                        data: 'long',
                        name: 'long'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
