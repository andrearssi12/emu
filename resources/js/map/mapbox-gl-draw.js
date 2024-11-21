import "@mapbox/mapbox-gl-draw/dist/mapbox-gl-draw.css";
import MapboxDraw from "@mapbox/mapbox-gl-draw";

const draw = new MapboxDraw({
    displayControlsDefault: false, // Menonaktifkan semua kontrol default
    controls: {
        polygon: true, // Aktifkan kontrol polygon
        trash: true // Aktifkan kontrol trash
    },
    modes: {
        ...MapboxDraw.modes,
        simple_select: {
            ...MapboxDraw.modes.simple_select,
            dragMove() {} // Nonaktifkan dragging untuk simple_select
        },
        direct_select: {
            ...MapboxDraw.modes.direct_select,
            dragFeature() {} // Nonaktifkan dragging untuk direct_select
        }
    }
});

// Event listener untuk mengatur gaya kursor saat fitur dipilih
map.on('draw.selectionchange', function(e) {
    if (e.features.length > 0) {
        map.getCanvas().style.cursor = 'pointer'; // Atur kursor menjadi pointer saat fitur dipilih
    } else {
        map.getCanvas().style.cursor =
        ''; // Atur kursor menjadi default saat tidak ada fitur yang dipilih
    }
});

window.draw = draw;
