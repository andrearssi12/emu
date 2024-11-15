@extends('layout/app')

@push('vite')
    @vite(['resources/css/map/mapbox-gl.css', 'resources/js/map/mapbox-gl.js'])
@endpush

@section('content')
    <div class="flex flex-col md:flex-row w-full h-full md:h-screen p-4 pt-20 space-y-2 gap-2 md:space-y-0">
        <div
            class="w-full hidden lg:block md:w-1/4 h-full p-4 bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 rounded-md">
            <h3 class="text-l font-bold dark:text-white mb-2">Pilih Kampus</h3>
            <ul id="kampus-list" class="ml-2 dark:text-white">
                @foreach ($kampus as $item)
                    <li id="button-{{ $item->hashed_id }}" onclick="selectKampus('{{ $item->hashed_id }}', this)"
                        class="ms-2 p-2 text-gray-700 hover:text-primary-700 dark:text-gray-400 dark:hover:text-white transition duration-200 cursor-pointer hover:list-disc">
                        {{ $item->nama_kampus }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="w-full md:w-3/4 h-full order-first md:order-none">
            <div id="map" class="w-full h-[calc(100vh-20rem)] mb-2 md:h-full rounded-md">
                <button id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="left"
                    class="block lg:hidden absolute top-2 right-2 z-20 p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    type="button">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 4 15">
                        <path
                            d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownLeft"
                    class="z-10 overflow-y-auto hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 absolute !top-2">
                    <ul class="text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLeftButton">
                        @foreach ($kampus as $item)
                            <li id="dropdown-button-{{ $item->hashed_id }}"
                                onclick="selectKampus('{{ $item->hashed_id }}', this)"
                                class="w-full text-left p-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 transition duration-200 cursor-pointer hover:list-disc">
                                {{ $item->nama_kampus }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <!-- Modal -->
    <div id="modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-500/50">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="relative w-full max-w-lg p-4 bg-gray-50 rounded-lg shadow-lg dark:bg-gray-900">
                <div class="flex justify-between items-center pb-3">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Campus Information</h3>
                    <button id="close-modal" class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="p-2 relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                Nama Kampus
                            </th>
                            <td class="px-6 py-4">
                                Silver
                            </td>
                            <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                Laptop
                            </td>
                            <td class="px-6 py-4">
                                $2999
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                Alamat
                            </th>
                            <td class="px-6 py-4">
                                White
                            </td>
                            <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                Laptop PC
                            </td>
                            <td class="px-6 py-4">
                                $1999
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                Luas
                            </th>
                            <td class="px-6 py-4">
                                Black
                            </td>
                            <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                Accessories
                            </td>
                            <td class="px-6 py-4">
                                $99
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                Kawasan Hijau
                            </th>
                            <td class="px-6 py-4">
                                Gray
                            </td>
                            <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                Phone
                            </td>
                            <td class="px-6 py-4">
                                $799
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="p-4">
                    <p id="campus-name" class="text-gray-700 dark:text-gray-300"></p>
                    <p id="campus-address" class="text-gray-700 dark:text-gray-300"></p>
                    <p id="campus-area" class="text-gray-700 dark:text-gray-300"></p>

                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal');
            const closeModalButton = document.getElementById('close-modal');
            const campusName = document.getElementById('campus-name');
            const campusAddress = document.getElementById('campus-address');
            const campusArea = document.getElementById('campus-area');

            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });

            const fullScreen = new mapboxgl.FullscreenControl();
            map.addControl(fullScreen, 'top-left');

            let geojsonData;

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

                    // Add click event listener for the layer
                    map.on('click', 'kampus-layer', function(e) {
                        const properties = e.features[0].properties;
                        campusName.textContent = `Nama Kampus: ${properties.nama_kampus}`;
                        campusAddress.textContent += `Alamat: ${properties.lokasi}`;
                        campusArea.textContent += `Luas: ${properties.luas}`;
                        modal.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    });

                    // Change the cursor to a pointer when
                    // the mouse is over the states layer.
                    map.on('mouseenter', 'kampus-layer', () => {
                        map.getCanvas().style.cursor = 'pointer';
                    });

                    // Change the cursor back to a pointer
                    // when it leaves the states layer.
                    map.on('mouseleave', 'kampus-layer', () => {
                        map.getCanvas().style.cursor = '';
                    });
                });
            }

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
                        firstCampusButton.classList.remove('text-gray-700', 'hover:text-primary-700',
                            'dark:text-gray-400', 'dark:hover:text-white'); // Active styles
                        firstCampusButton.classList.add('text-primary-700',
                            'dark:text-primary-500', 'list-disc'); // Active styles

                        // Set the first dropdown button as active
                        const firstDropdownButton = document.getElementById('dropdown-button-' + firstCampus
                            .properties.id);
                        firstDropdownButton.classList.remove('bg-gray-200',
                            'dark:bg-gray-700'); // Active styles
                        firstDropdownButton.classList.add('bg-gray-400', 'dark:bg-gray-600',
                            'list-disc'); // Active styles
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
                            listItem.classList.add('text-gray-700',
                                'hover:text-primary-700',
                                'dark:text-gray-400', 'dark:hover:text-white'); // Active styles
                            listItem.classList.remove('text-primary-700',
                                'dark:text-primary-500', 'list-disc'); // Active styles
                        });

                        // Remove active styles from all dropdown items
                        document.querySelectorAll('#dropdownLeft li').forEach(listItem => {
                            listItem.classList.add('bg-gray-200',
                                'dark:bg-gray-700'); // Inactive styles
                            listItem.classList.remove('bg-gray-400',
                                'dark:bg-gray-600', 'list-disc'); // Active styles
                        });

                        // Set the corresponding dropdown item as active
                        const dropdownItem = document.getElementById('dropdown-button-' + kampusId);
                        dropdownItem.classList.add('bg-gray-400', 'dark:bg-gray-600',
                            'list-disc'); // Active styles
                        dropdownItem.classList.remove('bg-gray-200', 'dark:bg-gray-700'); // Inactive styles

                        const dropdownItem2 = document.getElementById('button-' + kampusId);
                        dropdownItem2.classList.remove('text-gray-700',
                            'hover:text-primary-700',
                            'dark:text-gray-400', 'dark:hover:text-white'); // Active styles
                        dropdownItem2.classList.add('text-primary-700',
                            'dark:text-primary-500', 'list-disc'); // Active styles
                    }
                }
            }
        });
    </script>
@endpush
