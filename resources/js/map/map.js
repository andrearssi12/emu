import mapboxgl from 'mapbox-gl';
import MapboxDraw from '@mapbox/mapbox-gl-draw';
import {
  SnapPolygonMode,
  SnapPointMode,
  SnapLineMode,
  SnapModeDrawStyles,
  SnapDirectSelect,
} from "mapbox-gl-draw-snap-mode";
import "mapbox-gl/dist/mapbox-gl.css";
import "@mapbox/mapbox-gl-draw/dist/mapbox-gl-draw.css";

mapboxgl.accessToken = import.meta.env.VITE_MAPBOX_TOKEN;

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/light-v10',
    center: [110.36548916565643, -7.801549079776873],
    zoom: 12,
});

map.on('style.load', () => {``
// or global variable mapboxGlDrawSnapMode when using script tag

const draw = new MapboxDraw({
  modes: {
    ...MapboxDraw.modes,
    draw_point: SnapPointMode,
    draw_polygon: SnapPolygonMode,
    draw_line_string: SnapLineMode,
    direct_select: SnapDirectSelect,
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

map.addControl(draw, "top-right");

draw.changeMode("draw_polygon");
});

