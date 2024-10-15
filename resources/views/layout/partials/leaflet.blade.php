@push('stylesheet')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.css" />
@endpush

@push('modal')
    <div id="polygon-modal"
        class="hidden fixed inset-0 bg-gray-500/50 items-center justify-center z-50 transition-opacity duration-300">
        <div class="bg-white p-4 rounded-lg max-w-lg w-full">
            <h2 class="text-xl font-bold mb-4">Polygon Details</h2>
            <p><strong>ID:</strong> <span id="polygon-id"></span></p>
            <p><strong>Campus:</strong> <span id="polygon-campus"></span></p>
            <p><strong>Area:</strong> <span id="polygon-area"></span></p>
            <button onclick="hideModal()" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded">Close</button>
            <a id="edit-link" class="mt-4 bg-green-500 text-white py-2 px-4 rounded">Edit</a>
        </div>
    </div>
@endpush

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/0.4.2/leaflet.draw.js"></script>
<script src="leaflet.geometryutil.js"></script>

<script>
    const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    const osmHOT =
        L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank"> Humanitarian OpenStreetMap Team </a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'
        });

    const map = L.map('map', {
        center: [-7.833726709924965, 110.38179646573839],
        zoom: 17,
        layers: [osm]
    });

    function showModal(id, area, campus) {
        $('#polygon-id').text(id);
        $('#polygon-campus').text(campus);
        $('#polygon-area').text(area);

        var modal = $('#polygon-modal');
        modal.removeClass('hidden');
        modal.addClass('flex');
        $('body').addClass('overflow-hidden');

        setTimeout(() => {
            modal.addClass('opacity-100');
        }, 100);

        var editLink = "{{ route('maps.edit', ':id') }}".replace(':id', id);
        $('#edit-link').attr('href', editLink);
    }

    function hideModal() {
        var modal = $('#polygon-modal');
        modal.removeClass('opacity-100');
        modal.addClass('opacity-0');
        setTimeout(() => {
            $('body').removeClass('overflow-hidden');
            modal.removeClass('flex');
            modal.addClass('hidden');
        }, 300);
    }

    $(document).ready(function() {
        // Buat layer group untuk setiap kampus berdasarkan nama kampus
        var campusLayers = {};

        @foreach ($maps as $map)
            (function() {
                var polygonCoordinates = {!! $map->geom !!};
                polygonCoordinates['id'] = {{ $map->id }};
                polygonCoordinates['area'] = {{ $map->area }};
                polygonCoordinates['campus'] = '{{ $map->campus->name }}';
                var campusName = '{{ $map->campus->name }}'; // Gunakan nama kampus

                // Definisikan gaya untuk poligon
                var polygonStyle = {
                    color: "#ff7800", // Warna garis tepi poligon
                    weight: 2, // Ketebalan garis tepi
                    opacity: 0.65, // Opasitas garis tepi
                    fillColor: "{!! $map->color !!}", // Warna isian poligon
                    fillOpacity: 0.5 // Opasitas isian poligon
                };

                var polygon = L.geoJSON(polygonCoordinates, {
                    style: polygonStyle
                });

                polygon.on('click', function(e) {
                    showModal(polygonCoordinates.id, polygonCoordinates.area, polygonCoordinates
                        .campus);
                });

                // Jika layer group untuk kampus ini belum ada, buat baru
                if (!campusLayers[campusName]) {
                    campusLayers[campusName] = L.layerGroup().addTo(map);
                }

                // Tambahkan poligon ke layer group yang sesuai
                campusLayers[campusName].addLayer(polygon);
            })();
        @endforeach

        const baseLayers = {
            'OpenStreetMap': osm,
            'OpenStreetMap.HOT': osmHOT
        };

        // Buat overLayers menggunakan nama kampus sebagai kunci
        const overLayers = {};
        for (const campusName in campusLayers) {
            overLayers[`${campusName}`] = campusLayers[campusName];
        }

        const layerControl = L.control.layers(baseLayers, overLayers).addTo(map);
    });

    // FeatureGroup is to store editable layers
    var drawnItems = L.featureGroup(); // Use L.featureGroup() instead of new L.FeatureGroup()
    map.addLayer(drawnItems);

    var drawControl = new L.Control.Draw({
        draw: {
            polygon: true,
            polyline: false,
            rectangle: false,
            circle: false,
            marker: false
        },
        edit: {
            featureGroup: drawnItems
        }
    });

    map.addControl(drawControl);

    map.on('draw:created', function(e) {
        var type = e.layerType,
            layer = e.layer;

        var latLngs = layer.getLatLngs(); // Ambil semua titik dari layer yang baru saja digambar
        var drawnLayers = layer.toGeoJSON();
        var drawnLayersJSON = JSON.stringify(drawnLayers.geometry);

        var latLngJSON = JSON.stringify(latLngs);

        $('textarea[name="geom"]').val(drawnLayersJSON);

        // Menggunakan Leaflet.GeometryUtil untuk menghitung luas area
        var area = L.GeometryUtil.geodesicArea(layer.getLatLngs()[0]);
        $('input[name="area"]').val(area.toFixed(2));

        // Tambahkan layer ke dalam feature group
        drawnItems.addLayer(layer);
    });
</script>
