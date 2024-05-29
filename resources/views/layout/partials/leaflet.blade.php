@push('stylesheet')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="leaflet.geometryutil.js"></script>

<script>
    var map = L.map('map').setView([-7.833726709924965, 110.38179646573839], 17);
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 21
    }).addTo(map);
</script>

@if (\Route::is('maps.view'))
    <script>
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

            var drawnLayers = drawnItems.toGeoJSON(); // Mendapatkan GeoJSON dari feature group

            // Mengonversi GeoJSON menjadi JSON dan menyimpannya dalam textarea
            var drawnLayersJSON = JSON.stringify(drawnLayers);
            $('textarea[name="drawnLayers"]').val(drawnLayersJSON);

            var latLng = layer.getLatLngs()[0];
            var latLngJSON = JSON.stringify(latLng);
            $('textarea[name="geom"]').val(latLngJSON);

            var area = L.GeometryUtil.geodesicArea(latLng);
            $('input[name="area"]').val(area.toFixed(2));
            console.log(area.toFixed(2));

            // Menambahkan layer ke dalam feature group
            drawnItems.addLayer(layer);
        });
    </script>
@endif

@foreach ($maps as $map)
    <script>
        var polygonCoordinates = {!! $map->geom !!};
        polygonCoordinates['id'] = {!! $map->id !!};

        // Definisikan gaya untuk poligon
        var polygonStyle = {
            color: "#ff7800", // Warna garis tepi poligon
            weight: 2, // Ketebalan garis tepi
            opacity: 0.65, // Opasitas garis tepi
            fillColor: "#{!! $map->color !!}", // Warna isian poligon
            fillOpacity: 0.5 // Opasitas isian poligon
        };

        var polygon = L.geoJSON(polygonCoordinates, {
            style: polygonStyle
        }).addTo(map);

        polygon.on('click', function(e) {

        });
    </script>
@endforeach
