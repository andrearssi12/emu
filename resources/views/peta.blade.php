@extends('layout/app')

@push('stylesheet')
    @vite('resources/css/map/mapbox-gl.css')
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
    <div
        class="flex flex-col md:flex-row w-full h-full md:h-screen p-4 pt-20 bg-gray-50 dark:bg-gray-900 space-y-2 md:space-x-2 md:space-y-0">
        <div class="w-full md:w-1/4 h-full p-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700">
            <h3 class="text-l font-bold dark:text-white">Pilih Kampus</h3>
            <ul class="list-inside list-disc ml-2 dark:text-white">
                @foreach ($kampus as $item)
                    <li><a href="" class="text-sm dark:text-gray-400">{{ $item->nama_kampus }}</a></li>
                @endforeach
            </ul>
            <p class="text-gray-500 mt-2">Klik pada kawasan hijau untuk melihat informasi lebih lanjut.</p>
        </div>
        <div class="flex flex-col w-full md:w-2/4 h-full space-y-2">
            <div id="map" class="w-full md:h-3/4 h-[300px]"></div>
            <div class="w-full h-1/4 p-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700">
                <h3 class="text-l font-bold dark:text-white">Pilih Kampus</h3>
                <p class="text-gray-500">Klik pada kawasan hijau untuk melihat informasi lebih lanjut.</p>
            </div>
        </div>
        <div class="w-full md:w-1/4 h-full p-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700"
            id="menu">

        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/map/mapbox-gl.js')

    <script type="module">
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/outdoors-v12', // style URL
            center: [110.38315707889181, -7.8331772109174675], // starting position [lng, lat]
            zoom: 16 // starting zoom
        });

        const fullScreen = new mapboxgl.FullscreenControl();
        map.addControl(fullScreen, 'top-left');

        // Fetch GeoJSON data
        fetch('/geojsondata')
            .then(response => response.json())
            .then(data => {
                // const kampusData = data.kampus;
                // const kawasanHijauData = data.kawasan_hijau;
                // const penggunaanLahanData = data.penggunaan_lahan;

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
                    },
                    'filter': ['==', ['get', 'kategori'], 'kampus']
                });

                map.addLayer({
                    'id': 'kawasan-hijau-layer',
                    'type': 'fill',
                    'source': 'kawasan_hijau',
                    'layout': {},
                    'paint': {
                        'fill-color': '#0a0',
                        'fill-opacity': 0.5
                    },
                    'filter': ['==', ['get', 'kategori'], 'kawasan_hijau']
                });

                map.addLayer({
                    'id': 'penggunaan-lahan-layer',
                    'type': 'fill',
                    'source': 'penggunaan_lahan',
                    'layout': {},
                    'paint': {
                        'fill-color': '#800',
                        'fill-opacity': 0.5
                    },
                    'filter': ['==', ['get', 'kategori'], 'penggunaan_lahan']
                });

                addLayerControl(map);
            });
        }

        // Function to toggle layer visibility with checkboxes
        function addLayerControl(map) {
            const layers = [{
                    id: 'kampus-layer',
                    name: 'Kampus'
                },
                {
                    id: 'kawasan-hijau-layer',
                    name: 'Kawasan Hijau'
                },
                {
                    id: 'penggunaan-lahan-layer',
                    name: 'Penggunaan Lahan'
                }
            ];

            const menu = document.getElementById('menu');
            menu.innerHTML = ''; // Clear existing content if any

            layers.forEach(layer => {
                // Create checkbox container
                const container = document.createElement('div');
                container.classList.add('flex', 'items-center', 'mb-2');

                // Create checkbox input
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.id = layer.id;
                checkbox.classList.add('form-checkbox', 'mr-2', 'text-blue-500', 'dark:text-blue-300');
                checkbox.checked = true; // Default to checked

                // Create label
                const label = document.createElement('label');
                label.htmlFor = layer.id;
                label.textContent = layer.name;
                label.classList.add('text-gray-700', 'dark:text-gray-300');

                // Append checkbox and label to container
                container.appendChild(checkbox);
                container.appendChild(label);

                // Append container to menu
                menu.appendChild(container);

                // Add event listener for checkbox change
                checkbox.addEventListener('change', () => {
                    const visibility = checkbox.checked ? 'visible' : 'none';
                    map.setLayoutProperty(layer.id, 'visibility', visibility);
                });
            });
        }
    </script>
@endpush
