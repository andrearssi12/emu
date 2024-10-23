@extends('layout/app')

@push('stylesheet')
    @vite('resources/css/map/mapbox-gl.css')
    <style>
        .active {
            font-weight: bold;
            color: #4A5568;
            /* Ganti dengan warna yang sesuai */
        }
    </style>
@endpush

@section('content')
    <div
        class="flex flex-col md:flex-row w-full h-full md:h-screen p-4 pt-20 bg-gray-50 dark:bg-gray-900 space-y-2 gap-2 md:space-y-0">
        <div
            class="w-full md:w-1/4 h-full p-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 rounded-md">
            <h3 class="text-l font-bold dark:text-white">Pilih Kampus</h3>
            <ul class="list-inside list-disc ml-2 dark:text-white">
                @foreach ($kampus as $item)
                    <li onclick="selectKampus('{{ $item->hashed_id }}', this)"
                        class="text-sm dark:text-gray-400 cursor-pointer">
                        {{ $item->nama_kampus }}
                    </li>
                @endforeach
            </ul>
            <p class="text-gray-500 mt-2">Pilih pada kampus untuk melihat informasi lebih lanjut.</p>
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
                center: [110.38315707889181, -7.8331772109174675],
                zoom: 13
            });

            const fullScreen = new mapboxgl.FullscreenControl();
            map.addControl(fullScreen, 'top-left');

            let geojsonData; // Simpan data GeoJSON di sini

            fetch('/geojsonkampus')
                .then(response => response.json())
                .then(data => {
                    geojsonData = data; // Simpan data GeoJSON
                    initializeMap(data);
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

                    // Add markers for each campus at centroid
                    data.features.forEach(feature => {
                        const centroid = turf.centroid(feature); // Calculate centroid using Turf.js

                        const marker = new mapboxgl.Marker()
                            .setLngLat(centroid.geometry.coordinates)
                            .setPopup(new mapboxgl.Popup().setHTML(
                                `<strong>${feature.properties.nama_kampus}</strong>`
                            )) // Set popup content
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

                        document.querySelectorAll('.list-inside li').forEach(link => {
                            link.classList.remove('active');
                        });
                        element.classList.add('active');
                    }
                }
            }
        });
    </script>
@endpush
