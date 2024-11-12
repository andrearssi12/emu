@extends('layout/app')

@push('vite')
    @vite(['resources/css/map/mapbox-gl.css', 'resources/js/map/mapbox-gl.js'])
@endpush

@section('content')
    <div class="p-4 w-full pt-20 bg-gray-900">

        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center flex items-center justify-between dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">Dropdown button <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div id="dropdown" class="w-full z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                </li>
                <li>
                    <a href="#"
                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                </li>
            </ul>
        </div>

    </div>
    <div
        class="flex flex-col md:flex-row w-full h-full md:h-screen p-4  bg-gray-50 dark:bg-gray-900 space-y-2 gap-2 md:space-y-0">
        <div
            class="w-full md:w-1/4 h-full p-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 rounded-md">
            <h3 class="text-l font-bold dark:text-white">Pilih Kampus</h3>
            <ul id="kampus-list" class="list-disc ml-2 dark:text-white">
                @foreach ($kampus as $item)
                    <li onclick="selectKampus('{{ $item->hashed_id }}', this)" class="my-2">
                        <button id="button-{{ $item->hashed_id }}"
                            class="w-full text-left p-2 rounded-md bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 transition duration-200">
                            {{ $item->nama_kampus }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <p id="instruction" class="text-gray-500 mt-2">Pilih pada kampus untuk melihat informasi lebih lanjut.</p>
        </div>
        <div class="w-full md:w-3/4 h-full order-first md:order-none">
            <div id="map" class="w-full h-[400px] md:h-full rounded-md"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const fullScreen = new mapboxgl.FullscreenControl();
            map.addControl(fullScreen, 'top-left');

            let geojsonData;

            fetch('/geojsonkampus')
                .then(response => response.json())
                .then(data => {
                    geojsonData = data;
                    initializeMap(data);

                    // Dynamically find the first campus to focus on
                    const firstCampus = data.features[0]; // Change this logic if needed
                    if (firstCampus) {
                        const centroid = turf.centroid(firstCampus);
                        map.flyTo({
                            center: centroid.geometry.coordinates,
                            zoom: 17,
                            essential: true
                        });

                        // Set the first campus button as active
                        const firstCampusButton = document.getElementById('button-' + firstCampus.properties
                            .id);
                        firstCampusButton.classList.remove('bg-gray-200', 'dark:bg-gray-700'); // Active styles
                        firstCampusButton.classList.add('bg-gray-400', 'dark:bg-gray-600'); // Active styles
                    }
                });

            function initializeMap(data) {
                map.on('load', function() {
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
                            'fill-color': '#686868',
                            'fill-opacity': 1
                        }
                    });

                    data.features.forEach(feature => {
                        const centroid = turf.centroid(feature);

                        const marker = new mapboxgl.Marker()
                            .setLngLat(centroid.geometry.coordinates)
                            .setPopup(new mapboxgl.Popup().setHTML(
                                `<strong>${feature.properties.nama_kampus}</strong>`
                            ))
                            .addTo(map);
                    });
                });
            }

            window.selectKampus = function(kampusId, element) {
                if (geojsonData) {
                    const feature = geojsonData.features.find(f => f.properties.id === kampusId);
                    if (feature) {
                        const centroid = turf.centroid(feature);

                        map.flyTo({
                            center: centroid.geometry.coordinates,
                            zoom: 17,
                            essential: true
                        });

                        // Remove active styles from all buttons
                        document.querySelectorAll('.list-disc li button').forEach(button => {
                            button.classList.add('bg-gray-200', 'dark:bg-gray-700'); // Active styles
                            button.classList.remove('bg-gray-400', 'dark:bg-gray-600');
                        });

                        // Set the clicked button as active
                        element.querySelector('button').classList.add('bg-gray-400', 'dark:bg-gray-600');
                        element.querySelector('button').classList.remove('bg-gray-200', 'dark:bg-gray-700');
                    }
                }
            }
        });
    </script>
@endpush
