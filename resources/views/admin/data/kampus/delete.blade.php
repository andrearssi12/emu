@extends('layout.admin.app')

@push('styles')
    @vite('resources/css/map/mapbox-gl.css')
@endpush

@section('content')
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
        class="w-full p-4 my-6 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:border-gray-700 dark:bg-gray-800 xl:mb-0">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-2">
            <h1 class="text-gray-900 dark:text-white font-bold">Data {{ $kampus->nama_kampus }}</h1>

            <div class="flex justify-end gap-2">
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="text-white text-xs bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg py-2 px-3 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button"><i class="fa-solid fa-gear"></i><span class="ms-1">Menu</span><svg
                        class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdown"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="{{ route('kampus.show', ['kampus' => $kampus->hashed_id]) }}"
                                class="block px-4 py-2 {{ \Route::is('kampus.show') ? 'bg-gray-100 dark:bg-gray-600 dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white' }}">Detail</a>
                        </li>
                        <li>
                            <a href="{{ route('kampus.edit', ['kampus' => $kampus->hashed_id]) }}"
                                class="block px-4 py-2 {{ \Route::is('kampus.edit') ? 'bg-gray-100 dark:bg-gray-600 dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white' }}">Edit</a>
                        </li>
                        <li>
                            <a href="{{ route('kampus.delete', ['kampus' => $kampus->hashed_id]) }}"
                                class="block px-4 py-2 {{ \Route::is('kampus.delete') ? 'bg-gray-100 dark:bg-gray-600 dark:text-white' : 'hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white' }}">Hapus</a>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('kampus.index') }}"
                    class="py-2 px-3 text-xs text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><i
                        class="fa-solid fa-arrow-left"></i><span class="ms-1">Kembali</span></a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 md:col-6">
                <div id="map" class="w-full md:h-full h-[400px]"></div>
            </div>
            <div class="col-12 mt-4 md:col-6 md:mt-0">
                <div class="mb-5">
                    <label for="nama_kampus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Kampus</label>
                    <input type="text" id="nama_kampus"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        value="{{ $kampus->nama_kampus }}" disabled />
                </div>
                <div class="mb-5">
                    <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi
                    </label>
                    <textarea id="lokasi" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        disabled>{{ $kampus->lokasi }}</textarea>
                </div>
                <div class="mb-5">
                    <label for="geom"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Geometry</label>
                    <textarea id="geom" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        disabled>{{ $kampus->geom }}</textarea>
                </div>
                <div class="mb-5">
                    <label for="luas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Luas</label>
                    <input type="text" id="luas" name="luas"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        value="{{ $kampus->luas }}" disabled />
                </div>

                <div class="mt-2 flex justify-end">
                    <button type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <div id="delete-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="delete-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah kamu yakin menghapus
                        kampus
                        {{ $kampus->nama_kampus }}?</h3>
                    <form action="{{ route('kampus.destroy', $kampus->hashed_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Hapus
                        </button>
                        <button data-modal-hide="delete-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    @vite('resources/js/map/mapbox-gl.js')

    <script type="module">
        const id = "{{ $kampus->hashed_id }}";

        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/outdoors-v12', // style URL
            center: [110.38315707889181, -7.8331772109174675], // starting position [lng, lat]
            zoom: 16 // starting zoom
        });

        // Fetch GeoJSON data
        fetch('/geojsonkampus')
            .then(response => response.json())
            .then(data => {
                initializeMap(data);
            });

        function initializeMap(data) {
            map.on('load', function() {
                // Add Kampus layer
                map.addSource('kampus', {
                    'type': 'geojson',
                    'data': data
                });

                // Get the feature corresponding to the current ID
                const feature = data.features.find(f => f.properties.id === id);

                if (feature) {
                    // Calculate the centroid using Turf.js
                    const centroid = turf.centroid(feature);

                    // Center the map on the centroid
                    map.setCenter(centroid.geometry.coordinates);

                    // Optionally adjust the zoom level
                    map.setZoom(16);

                    map.addLayer({
                        'id': 'kampus-layer',
                        'type': 'fill',
                        'source': 'kampus',
                        'layout': {},
                        'paint': {
                            'fill-color': '#088',
                            'fill-opacity': 0.5
                        },
                        'filter': ['==', ['get', 'id'], id]
                    });
                }
            });
        }
    </script>
@endpush
