@extends('layout.admin.app')

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb>
        <x-breadcrumb-link>Master</x-breadcrumb-link>
        <x-breadcrumb-link href="{{ route('kampus.index') }}">Kampus</x-breadcrumb-link>
        <x-breadcrumb-link active="true">Create</x-breadcrumb-link>
    </x-breadcrumb>

    <div class="grid grid-cols-1 md:grid-cols-2 my-6 gap-6">
        <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div id="map" class="w-full h-96 md:h-full border border-gray-200 rounded-md"></div>
        </div>
        <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <form>
                <div class="mb-5">
                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Kampus</label>
                    <input type="text" id="nama"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Nama Kampus" required />
                </div>
                <div class="mb-5">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat
                        Kampus</label>
                    <input type="text" id="alamat"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Alamat Kampus" required />
                </div>
                <div class="mb-5">
                    <label for="geom"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Geometry</label>
                    <textarea id="geom" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Titik Koordinat"></textarea>
                </div>
                <div class="mb-5">
                    <label for="luas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Luas</label>
                    <input type="text" id="luas"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="Luas" required />
                </div>

                <button type="submit"
                    class="w-full focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Simpan
                    Data</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
            style: 'mapbox://styles/mapbox/outdoors-v12', // style URL
            center: [110.37099577170582, -7.801250488421439], // starting position [lng, lat]
            zoom: 11 // starting zoom
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

        map.addControl(geoCoder);
        map.addControl(fullScreen, 'top-left');
        map.addControl(draw, 'top-left');


        map.on('draw.create', updateArea);
        map.on('draw.delete', updateArea);
        map.on('draw.update', updateArea);

        fetch('/master/kampus/geojson')
            .then(response => response.json())
            .then(data => {
                const kampusData = data.kampus;

                initializeMap(kampusData);
            });

        function initializeMap(kampusData) {
            map.on('load', function() {

                // Add Kampus layer
                map.addSource('kampus', {
                    'type': 'geojson',
                    'data': kampusData
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
