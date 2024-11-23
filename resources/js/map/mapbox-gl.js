import "mapbox-gl/dist/mapbox-gl.css";
import "@mapbox/mapbox-gl-geocoder/dist/mapbox-gl-geocoder.css";
import mapboxgl from 'mapbox-gl';
import MapboxGeocoder from '@mapbox/mapbox-gl-geocoder';
import * as turf from '@turf/turf';

import "@mapbox/mapbox-gl-draw/dist/mapbox-gl-draw.css";
import MapboxDraw from "@mapbox/mapbox-gl-draw";

import {
    SnapPolygonMode,
    SnapModeDrawStyles,
  } from "mapbox-gl-draw-snap-mode";
  // or global variable mapboxGlDrawSnapMode when using script tag


mapboxgl.accessToken = import.meta.env.VITE_MAPBOX_TOKEN;

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v10',
    center: [110.36548916565643, -7.801549079776873],
    zoom: 12
});

window.map = map;
window.mapboxgl = mapboxgl;

window.turf = turf;

const coordinatesGeocoder = function(query) {
    const matches = query.match(
        /^[ ]*(?:Lat: )?(-?\d+\.?\d*)[, ]+(?:Lng: )?(-?\d+\.?\d*)[ ]*$/i
    );
    if (!matches) {
        return null;
    }

    function coordinateFeature(lng, lat) {
        return {
            center: [lng, lat],
            geometry: {
                type: 'Point',
                coordinates: [lng, lat]
            },
            place_name: 'Lat: ' + lat + ' Lng: ' + lng,
            place_type: ['coordinate'],
            properties: {},
            type: 'Feature'
        };
    }

    const coord1 = Number(matches[1]);
    const coord2 = Number(matches[2]);
    const geocodes = [];

    if (coord1 < -90 || coord1 > 90) {
        // must be lng, lat
        geocodes.push(coordinateFeature(coord1, coord2));
    }

    if (coord2 < -90 || coord2 > 90) {
        // must be lat, lng
        geocodes.push(coordinateFeature(coord2, coord1));
    }

    if (geocodes.length === 0) {
        // else could be either lng, lat or lat, lng
        geocodes.push(coordinateFeature(coord1, coord2));
        geocodes.push(coordinateFeature(coord2, coord1));
    }

    return geocodes;
};

window.MapboxGeocoder = MapboxGeocoder;
window.coordinatesGeocoder = coordinatesGeocoder;

const draw = new MapboxDraw({
    modes: {
      ...MapboxDraw.modes,
      draw_polygon: SnapPolygonMode,
    },
    // Styling guides
    styles: SnapModeDrawStyles,
    userProperties: true,
    // Config snapping features
    snap: true,
    snapOptions: {
      snapPx: 15, // defaults to 15
      snapToMidPoints: true, // defaults to false
      snapVertexPriorityDistance: 0.0025, // defaults to 1.25
    },
    guides: false,
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

draw.changeMode("draw_polygon");


window.draw = draw;




