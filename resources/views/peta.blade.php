@extends('layout/app')

@push('stylesheet')
    @vite('resources/css/map/mapbox-gl.css')
@endpush

@section('content')
    <div
        class="flex flex-col md:flex-row w-full h-full md:h-screen p-4 pt-20 bg-gray-50 dark:bg-gray-900 space-y-2 md:space-x-2 md:space-y-0">
        <div class="w-full md:w-1/4 h-full p-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700">
            <h3 class="text-l font-bold dark:text-white">Pilih Kampus</h3>
            <ul id="kampus-list" class="ml-2 dark:text-white">
                @foreach ($kampus as $item)
                    <li id="button-{{ $item->hashed_id }}" onclick="selectKampus('{{ $item->hashed_id }}', this)"
                        class="ms-2 p-2 text-gray-700 hover:text-primary-700 dark:text-gray-400 dark:hover:text-white transition duration-200 cursor-pointer hover:list-disc">
                        {{ $item->nama_kampus }}
                    </li>
                @endforeach
            </ul>
            <p class="text-gray-500 mt-2">Klik pada kawasan hijau untuk melihat informasi lebih lanjut.</p>
        </div>
        <div class="flex flex-col w-full md:w-2/4 h-full space-y-2">
            <div id="map" class="w-full md:h-3/4 h-[300px]"></div>
            <div class="w-full h-1/4 p-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700">
            </div>
        </div>
        <div class="w-full md:w-1/4 h-full p-3 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700"
            id="menu">
        </div>
    </div>
@endsection

@push('modal')
    <!-- Modal -->
    <div id="modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-500/50">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="relative w-full max-w-lg p-4 bg-white rounded-lg shadow-lg dark:bg-gray-700">
                <div class="flex justify-between items-center pb-3">
                    <h3 id="modal-title" class="text-lg font-medium text-gray-900 dark:text-white">Information</h3>
                    <button id="close-modal" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="p-2 relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody id="table-body"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    @vite('resources/js/map/mapbox-gl.js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal');
            const closeModalButton = document.getElementById('close-modal');
            const modalTitle = document.getElementById('modal-title');
            const tableBody = document.getElementById('table-body');
            let selectedCampusId = null;

            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                // Clear table body content
                tableBody.innerHTML = '';
            });

            const fullScreen = new mapboxgl.FullscreenControl();
            map.addControl(fullScreen, 'top-left');

            let geojsonData;

            function initializeMap(data) {
                map.on('load', function() {
                    addMapLayers(data);
                    addLayerEventListeners();
                    addMapEventListeners();
                    addLayerControl(map);
                });
            }

            function addMapLayers(data) {
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
                        'fill-color': '#cca525',
                        'fill-opacity': 1
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
                        'fill-opacity': 1
                    },
                    'filter': ['==', ['get', 'kategori'], 'kawasan_hijau']
                });

                map.addLayer({
                    'id': 'penggunaan-lahan-layer',
                    'type': 'fill',
                    'source': 'kampus',
                    'layout': {},
                    'paint': {
                        'fill-color': '#ebe6d8',
                        'fill-opacity': 0.9
                    },
                    'filter': ['==', ['get', 'kategori'], 'penggunaan_lahan']
                });

                map.addLayer({
                    'id': 'outline',
                    'type': 'line',
                    'source': 'kampus',
                    'layout': {},
                    'paint': {
                        'line-color': '#FF0000',
                        'line-width': 2
                    },
                    'filter': ['all', ['==', 'id', ''],
                        ['==', 'kategori', '']
                    ] // Initially, no feature is selected
                });
            }

            function handleLayerClick(feature) {
                const properties = feature.properties;
                selectedCampusId = properties.id;

                if (properties.kategori === 'kawasan_hijau') {
                    modalTitle.textContent = 'Kawasan Hijau Information';
                    addTableRow('Kampus', properties.nama_kampus || 'N/A');
                    addTableRow('Jenis Vegetasi', properties.jenis_vegetasi || 'N/A');
                    addTableRow('Luas', properties.luas || 'N/A');
                    addTableRow('Foto', properties.foto || 'N/A');
                } else if (properties.kategori === 'penggunaan_lahan') {
                    modalTitle.textContent = 'Penggunaan Lahan Information';
                    addTableRow('Kampus', properties.nama_kampus || 'N/A');
                    addTableRow('Penggunaan Lahan', properties.nama_lahan || 'N/A');
                    addTableRow('Luas', properties.luas || 'N/A');
                } else {
                    modalTitle.textContent = 'Campus Information';
                    addTableRow('Nama', properties.nama_kampus || 'N/A');
                    addTableRow('Alamat', properties.lokasi || 'N/A');
                    addTableRow('Luas', properties.luas || 'N/A');
                }

                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');

                // Update filter outline layer untuk menampilkan fitur yang diklik
                map.setFilter('outline', ['all', ['==', 'id', properties.id],
                    ['==', 'kategori', properties.kategori]
                ]);
            }


            function addTableRow(label, value) {
                const row = document.createElement('tr');
                row.classList.add('border-b', 'border-gray-200', 'dark:border-gray-700');

                const th = document.createElement('th');
                th.scope = 'row';
                th.classList.add('px-6', 'py-4', 'font-medium', 'text-gray-900', 'whitespace-nowrap', 'bg-gray-50',
                    'dark:text-white', 'dark:bg-gray-800');
                th.textContent = label;

                const td = document.createElement('td');
                td.classList.add('px-6', 'py-4');
                td.textContent = value;

                row.appendChild(th);
                row.appendChild(td);
                tableBody.appendChild(row);
            }

            function addLayerEventListeners() {
                ['kawasan-hijau-layer', 'penggunaan-lahan-layer'].forEach(layer => {
                    map.on('mouseenter', layer, () => {
                        map.getCanvas().style.cursor = 'pointer';
                    });

                    map.on('mouseleave', layer, () => {
                        map.getCanvas().style.cursor = '';
                    });
                });

                map.on('click', function(e) {
                    const features = map.queryRenderedFeatures(e.point, {
                        layers: ['kawasan-hijau-layer', 'penggunaan-lahan-layer']
                    });

                    if (features.length) {
                        const topFeature = features[
                            0]; // Ambil fitur teratas (paling atas di array hasil query)
                        handleLayerClick(
                            topFeature); // Ubah fungsi handleLayerClick untuk menerima objek fitur langsung
                    } else {
                        // Tidak ada fitur yang diklik, reset filter outline
                        map.setFilter('outline', ['all', ['==', 'id', ''],
                            ['==', 'kategori', '']
                        ]);
                    }
                });
            }


            function addMapEventListeners() {
                map.on('mousemove', function(e) {
                    const features = map.queryRenderedFeatures(e.point, {
                        layers: ['kawasan-hijau-layer', 'penggunaan-lahan-layer']
                    });

                    if (features.length) {
                        map.getCanvas().style.cursor = 'pointer';
                    } else {
                        map.getCanvas().style.cursor = '';
                    }
                });

                map.on('click', function(e) {
                    const features = map.queryRenderedFeatures(e.point, {
                        layers: ['kawasan-hijau-layer', 'penggunaan-lahan-layer']
                    });

                    if (!features.length) {
                        // No features were clicked, reset the outline filter
                        map.setFilter('outline', ['all', ['==', 'id', ''],
                            ['==', 'kategori', '']
                        ]);
                    }
                });
            }

            function setActiveCampusButton(campusId) {
                const firstCampusButton = document.getElementById('button-' + campusId);
                firstCampusButton.classList.remove('text-gray-700', 'hover:text-primary-700', 'dark:text-gray-400',
                    'dark:hover:text-white');
                firstCampusButton.classList.add('text-primary-700', 'dark:text-primary-500', 'list-disc');
            }

            fetch('/geojsondata')
                .then(response => response.json())
                .then(data => {
                    geojsonData = data;
                    initializeMap(data);

                    const selectedCampusId = localStorage.getItem('selectedCampusId');
                    if (selectedCampusId) {
                        const feature = geojsonData.features.find(f => f.properties.id === selectedCampusId);
                        if (feature) {
                            const centroid = turf.centroid(feature);
                            map.flyTo({
                                center: centroid.geometry.coordinates,
                                zoom: 17,
                                essential: true
                            });

                            // Update the filter for the outline layer to show the selected feature
                            map.setFilter('outline', ['all', ['==', 'id', selectedCampusId],
                                ['==', 'kategori', feature.properties.kategori]
                            ]);

                            // Set the selected campus button as active
                            setActiveCampusButton(selectedCampusId);

                            // Remove the ID from localStorage after using it
                            localStorage.removeItem('selectedCampusId');
                        }
                    } else {
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
                            setActiveCampusButton(firstCampus.properties.id);
                        }
                    }
                });

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

                        // Remove active styles from all list items
                        document.querySelectorAll('#kampus-list li').forEach(listItem => {
                            listItem.classList.add('text-gray-700', 'hover:text-primary-700',
                                'dark:text-gray-400', 'dark:hover:text-white');
                            listItem.classList.remove('text-primary-700', 'dark:text-primary-500',
                                'list-disc');
                        });

                        const dropdownItem2 = document.getElementById('button-' + kampusId);
                        dropdownItem2.classList.remove('text-gray-700', 'hover:text-primary-700',
                            'dark:text-gray-400', 'dark:hover:text-white');
                        dropdownItem2.classList.add('text-primary-700', 'dark:text-primary-500', 'list-disc');
                    }
                }
            }

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
                    checkbox.classList.add('form-checkbox', 'mr-2', 'text-blue-500', 'dark:text-blue-600');
                    checkbox.checked = true; // Default to checked

                    // Create label
                    const label = document.createElement('label');
                    label.htmlFor = layer.id;
                    label.textContent = layer.name;
                    label.classList.add('text-gray-700', 'dark:text-gray-400');

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
        });
    </script>
@endpush
