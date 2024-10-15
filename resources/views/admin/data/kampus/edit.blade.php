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
                <div id="map" class="w-full  h-[400px]"></div>
            </div>
            <div class="col-12 mt-4 md:col-6 md:mt-0">
                <form action="{{ route('kampus.update', ['kampus' => $kampus->hashed_id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="nama_kampus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Kampus</label>
                        <input type="text" id="nama_kampus" name="nama_kampus"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Nama Kampus" required
                            value="{{ old('nama_kampus', $kampus->nama_kampus ?? '') }}" />
                    </div>
                    <div class="mb-5">
                        <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi
                        </label>
                        <textarea id="lokasi" rows="4" name="lokasi"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Lokasi">{{ $kampus->lokasi }}</textarea>
                    </div>
                    <div class="mb-5">
                        <label for="geom"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Geometry</label>
                        <textarea id="geom" rows="4" name="geom"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Titik Koordinat" readonly>{{ $kampus->geom }}</textarea>
                    </div>
                    <div class="mb-5">
                        <label for="luas"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Luas</label>
                        <input type="text" id="luas" name="luas"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Luas" required value="{{ old('luas', $kampus->luas ?? '') }}" readonly />
                    </div>

                    <button type="submit"
                        class="w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Simpan
                        Data</button>
                </form>
            </div>
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

        const draw = new MapboxDraw({
            displayControlsDefault: false, // Menonaktifkan semua kontrol default
            controls: {
                polygon: true, // Aktifkan kontrol polygon
                trash: true // Aktifkan kontrol trash
            },
            modes: {
                ...MapboxDraw.modes,
                simple_select: {
                    ...MapboxDraw.modes.simple_select,
                    dragMove() {} // Nonaktifkan dragging untuk simple_select
                },
                direct_select: {
                    ...MapboxDraw.modes.direct_select,
                    dragFeature() {} // Nonaktifkan dragging untuk direct_select
                }
            }
        });
        map.addControl(draw, 'top-right');


        const fullScreen = new mapboxgl.FullscreenControl();
        map.addControl(fullScreen, 'top-left');

        map.on('draw.create', updateArea);
        map.on('draw.delete', updateArea);
        map.on('draw.update', updateArea);

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
                    draw.add(feature);
                }

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

        function updateArea(e) {
            const data = draw.getAll();

            if (data.features.length > 0) {
                const area = turf.area(data);
                const rounded_area = Math.round(area * 100) / 100;

                // Konversi seluruh koleksi fitur GeoJSON menjadi string
                const geomGeoJSON = JSON.stringify(data.features[0].geometry);

                // Perbarui input dengan GeoJSON dan area
                document.getElementById('geom').value = geomGeoJSON;
                document.getElementById('luas').value = rounded_area;
            } else {
                alert('Click the map to draw a polygon.');
                document.getElementById('geom').value = '';
                document.getElementById('luas').value = '';
            }
        }
    </script>
@endpush
