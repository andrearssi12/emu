@extends('layout/app')

@push('stylesheet')
    @vite('resources/css/map/mapbox-gl.css')
@endpush

@section('content')
    <div
        class="flex flex-col md:flex-row w-full h-full md:h-screen p-4 pt-20 bg-gray-50 dark:bg-gray-900 space-y-2 gap-2 md:space-y-0">
        <div
            class="w-full md:w-1/4 h-full p-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 rounded-md">
            <h3 class="text-l font-bold dark:text-white">Pilih Kampus</h3>
            <ul id="kampus-list" class="list-inside ml-2 dark:text-white">
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
    @vite('resources/js/map/mapbox-gl.js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/outdoors-v12',
                center: [110.38315707889181, -7.8331772109174675], // Default center
                zoom: 13
            });

            const fullScreen = new mapboxgl.FullscreenControl();
            map.addControl(fullScreen, 'top-left');

            let geojsonData;

            fetch('/geojsonkampus')
                .then(response => response.json())
                .then(data => {
                    geojsonData = data;
                    initializeMap(data);

                    // Focus on campus 4 after loading the map
                    const campus4 = data.features.find(feature => feature.properties.id === 'Gk9B9EB5dN');
                    if (campus4) {
                        const centroid = turf.centroid(campus4);
                        map.flyTo({
                            center: centroid.geometry.coordinates,
                            zoom: 17,
                            essential: true
                        });

                        // Set campus 4 button as active
                        const campus4Button = document.getElementById('button-' + campus4.properties.id);
                        campus4Button.classList.add('bg-gray-400', 'dark:bg-gray-600'); // Active styles
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
                        document.querySelectorAll('.list-inside li button').forEach(button => {
                            button.classList.remove('bg-gray-400', 'dark:bg-gray-600');
                        });

                        // Set the clicked button as active
                        element.querySelector('button').classList.add('bg-gray-400', 'dark:bg-gray-600');
                    }
                }
            }
        });
    </script>
@endpush
