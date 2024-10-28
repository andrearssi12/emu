@extends('layout/app')

@push('stylesheet')
    @vite('resources/css/map/mapbox-gl.css')
@endpush

@section('content')
    <div
        class="flex flex-col md:flex-row w-full h-full md:h-screen p-4 pt-20 bg-gray-50 dark:bg-gray-900 space-y-2 md:space-x-2 md:space-y-0">
        <div class="w-full md:w-1/4 h-full p-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700">
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
            <p class="text-gray-500 mt-2">Klik pada kawasan hijau untuk melihat informasi lebih lanjut.</p>
        </div>
        <div class="flex flex-col w-full md:w-2/4 h-full space-y-2">
            <div id="map" class="w-full md:h-3/4 h-[300px]"></div>
            <div class="w-full h-1/4 p-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="w-full" id="new-products-chart"></div>
            </div>
        </div>
        <div class="w-full md:w-1/4 h-full p-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700"
            id="menu">

        </div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/map/mapbox-gl.js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('new-products-chart')) {
                var options = {
                    series: [44, 55, 13, 43, 22],
                    chart: {
                        width: 300,
                        type: 'pie',
                    },
                    labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#new-products-chart"), options);
                chart.render();
            }

            const map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/outdoors-v12',
                center: [110.38315707889181, -7.8331772109174675],
                zoom: 16
            });

            const fullScreen = new mapboxgl.FullscreenControl();
            map.addControl(fullScreen, 'top-left');

            let geojsonData;

            fetch('/geojsondata')
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
                        'source': 'kampus',
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
                        'source': 'kampus',
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

            // Function to toggle layer visibility with button-like list items
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
                    // Create button-like item
                    const button = document.createElement('div');
                    button.textContent = layer.name;
                    button.classList.add('cursor-pointer', 'text-white', 'text-center', 'border',
                        'bg-blue-700',
                        'font-medium', 'rounded-lg', 'text-sm', 'px-5', 'py-2.5', 'mb-2',
                        'border-gray-300',
                        'dark:bg-blue-600', 'dark:border-gray-600'
                    );

                    // Prevent text selection
                    button.style.userSelect = 'none';

                    // Set initial visibility
                    let isVisible = true;
                    map.setLayoutProperty(layer.id, 'visibility', 'visible');

                    // Add click event to toggle visibility
                    button.addEventListener('click', () => {
                        isVisible = !isVisible;
                        const visibility = isVisible ? 'visible' : 'none';
                        map.setLayoutProperty(layer.id, 'visibility', visibility);

                        // Change background and text color based on visibility
                        if (isVisible) {
                            button.classList.remove('bg-white', 'text-gray-900', 'dark:bg-gray-800',
                                'dark:text-white');
                            button.classList.add('bg-blue-700', 'text-white', 'dark:bg-blue-600');
                        } else {
                            button.classList.add('bg-white', 'text-gray-900', 'dark:bg-gray-800',
                                'dark:text-white');
                            button.classList.remove('bg-blue-700', 'text-white',
                                'dark:bg-blue-600');
                        }
                    });

                    menu.appendChild(button);
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
