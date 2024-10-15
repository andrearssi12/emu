@extends('layout.admin.app')

@push('styles')
    @vite('resources/css/map/mapbox-gl.css')
    @vite('resources/css/map/mapbox-gl-draw.css')

    <style>
        /* Atur ukuran kontrol pencarian untuk tampilan ponsel */
        @media (max-width: 768px) {
            .mapboxgl-ctrl-geocoder.mapboxgl-ctrl {
                width: 33.3333%;
                font-size: 15px;
                line-height: 20px;
                max-width: 360px;
            }
        }
    </style>
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
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('kampus.index') }}"
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Kampus</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span
                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $kampus->hashed_id }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div
        class="w-full p-4 my-6 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 dark:border-gray-700 dark:bg-gray-800 xl:mb-0">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mb-4 items-center">
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

        <div class="w-full h-full">
            <div id="map" class="w-full  h-[400px]"></div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/map/mapbox-gl.js')
    @vite('resources/js/map/mapbox-gl-draw.js')

    <script type="module">
        const id = "{{ $kampus->hashed_id }}";

        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/outdoors-v12', // style URL
            center: [110.38315707889181, -7.8331772109174675], // starting position [lng, lat]
            zoom: 16 // starting zoom
        });

        const fullScreen = new mapboxgl.FullscreenControl();
        map.addControl(fullScreen, 'top-left');

        // Fetch GeoJSON data
        fetch('/geojsonkampus')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                initializeMap(data);
            })
            .catch(error => {
                console.error('Error fetching GeoJSON data:', error);
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
                    map.setZoom(16);

                    // Add the selected kampus layer
                    map.addLayer({
                        'id': 'kampus-now-layer',
                        'type': 'fill',
                        'source': 'kampus',
                        'layout': {},
                        'paint': {
                            'fill-color': '#088',
                            'fill-opacity': 0.9
                        },
                        'filter': ['==', ['get', 'id'], id]
                    });
                }

                // Add the general kampus layer
                map.addLayer({
                    'id': 'kampus-layer',
                    'type': 'fill',
                    'source': 'kampus',
                    'layout': {},
                    'paint': {
                        'fill-color': '#088',
                        'fill-opacity': 0.5
                    },
                    'filter': ['!=', ['get', 'id'], id]
                });
            });
        }
    </script>
@endpush
