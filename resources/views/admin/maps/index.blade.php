@extends('layout/app')

@section('content')
    <div class="p-4 sm:ml-64">
        <x-breadcrumb :paths="[]" :active="'Maps'" />
        <div class="container mt-4">
            <x-data-tables :headers="['kampus', 'luas', 'map', 'action']" />
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#dataTables').DataTable({
                responsive: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('maps.datatables') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'campus.name',
                        name: 'campus.name'
                    },
                    {
                        data: 'area',
                        name: 'area'
                    },
                    {
                        data: 'geom',
                        name: 'geom'
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
