<?php

namespace App\Http\Controllers\GeoJson;

use App\Models\Kampus;
use App\Models\KawasanHijau;
use App\Models\PenggunaanLahan;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class GeoJsonController extends Controller
{
    /**
     * Method untuk mengambil data Kawasan Hijau, Penggunaan Lahan, dan Kampus dalam format GeoJSON
     */
    public function getGeoJsonData(): JsonResponse
    {
        $kampus = Kampus::all();
        $kawasanHijau = KawasanHijau::all();
        $penggunaanLahan = PenggunaanLahan::all();

        $geoJson = [
            'type' => 'FeatureCollection',
            'features' => collect()
                ->merge($kampus->map(fn($item) => [
                    'type' => 'Feature',
                    'geometry' => json_decode($item->geom),
                    'properties' => [
                        'id' => $item->hashed_id,
                        'lokasi' => $item->lokasi,
                        'nama_kampus' => $item->nama_kampus,
                        'luas' => $item->luas,
                        'kategori' => 'kampus',
                    ],
                ]))
                ->merge($kawasanHijau->map(fn($item) => [
                    'type' => 'Feature',
                    'geometry' => json_decode($item->geom),
                    'properties' => [
                        'id' => $item->hashed_id,
                        'nama_kampus' => $item->kampus->nama_kampus,
                        'jenis_vegetasi' => $item->jenis_vegetasi,
                        'luas' => $item->luas,
                        'foto' => $item->foto,
                        'kategori' => 'kawasan_hijau',
                    ],
                ]))
                ->merge($penggunaanLahan->map(fn($item) => [
                    'type' => 'Feature',
                    'geometry' => json_decode($item->geom),
                    'properties' => [
                        'id' => $item->hashed_id,
                        'nama_kampus' => $item->kampus->nama_kampus,
                        'nama_lahan' => $item->nama_lahan,
                        'luas' => $item->luas,
                        'kategori' => 'penggunaan_lahan',
                    ],
                ]))
                ->toArray(),
        ];

        return response()->json($geoJson);
    }

    /**
     * Method untuk mengambil data Kampus dalam format GeoJSON
     */
    public function getGeoJsonKampusData(): JsonResponse
    {
        $kampus = Kampus::all();
        $geoJson = [
            'type' => 'FeatureCollection',
            'features' => $kampus->map(function ($item) {
                return [
                    'type' => 'Feature',
                    'geometry' => json_decode($item->geom),
                    'properties' => [
                        'id' => $item->hashed_id,
                        'nama_kampus' => $item->nama_kampus,
                        'lokasi' => $item->lokasi,
                        'luas' => $item->luas,
                    ],
                ];
            })->toArray(),
        ];

        return response()->json($geoJson);
    }
}
