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
        <div class="row">
            <div class="col-12 md:col-6">
                <div id="map" class="w-full md:h-full h-[400px] rounded-md"></div>
            </div>
            <div class="col-12 md:col-6">
                <form action="{{ route('kampus.store') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="nama_kampus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Kampus</label>
                        <input type="text" id="nama_kampus" name="nama_kampus"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Nama Kampus" required value="{{ old('nama_kampus') }}" />
                    </div>
                    <div class="mb-5">
                        <label for="lokasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lokasi
                            Kampus</label>
                        <input type="text" id="lokasi" name="lokasi"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Alamat Kampus" required value="{{ old('lokasi') }}" />
                    </div>
                    <div class="mb-5">
                        <label for="geom"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Geometry</label>
                        <textarea id="geom" rows="4" name="geom"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Titik Koordinat">{{ old('geom') }}</textarea>
                    </div>
                    <div class="mb-5">
                        <label for="luas"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Luas</label>
                        <input type="text" id="luas" name="luas"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="Luas" required value="{{ old('luas') }}" />
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
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/outdoors-v12',
            center: [110.37099577170582, -7.801250488421439],
            zoom: 11
        });

        const geoCoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            localGeocoder: coordinatesGeocoder,
            zoom: 16,
            placeholder: 'Try: -40, 170',
            mapboxgl: mapboxgl,
            reverseGeocode: true
        });

        const fullScreen = new mapboxgl.FullscreenControl();

        const draw = new MapboxDraw({
            displayControlsDefault: false,
            controls: {
                polygon: true,
                trash: true
            }
        });

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

                map.addLayer({
                    'id': 'kampus-layer',
                    'type': 'fill',
                    'source': 'kampus',
                    'layout': {},
                    'paint': {
                        'fill-color': '#088',
                        'fill-opacity': 0.5
                    }
                });
            });
        }

        function saveToSession() {
            const data = draw.getAll();

            if (data.features.length > 0) {
                const area = turf.area(data);
                const rounded_area = Math.round(area * 100) / 100;

                const geomGeoJSON = JSON.stringify(data.features[0].geometry);

                document.getElementById('geom').value = geomGeoJSON;
                document.getElementById('luas').value = rounded_area;
            } else {
                document.getElementById('geom').value = '';
                document.getElementById('luas').value = '';
            }

            fetch('/save-drawn-features', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            }).catch(error => console.error('Error saving features:', error));
        }

        function loadFromSession() {
            fetch('/get-drawn-features')
                .then(response => response.json())
                .then(data => {
                    if (data.features.length > 0) {
                        const area = turf.area(data);
                        const rounded_area = Math.round(area * 100) / 100;

                        const geomGeoJSON = JSON.stringify(data.features[0].geometry);

                        document.getElementById('geom').value = geomGeoJSON;
                        document.getElementById('luas').value = rounded_area;
                        draw.set(data);
                    } else {
                        document.getElementById('geom').value = '';
                        document.getElementById('luas').value = '';
                    }
                })
                .catch(error => console.error('Error loading features:', error));
        }

        map.addControl(geoCoder);
        map.addControl(fullScreen, 'top-left');
        map.addControl(draw, 'top-left');

        loadFromSession();

        map.on('draw.create', saveToSession);
        map.on('draw.update', saveToSession);
        map.on('draw.delete', saveToSession);
    </script>
@endpush
