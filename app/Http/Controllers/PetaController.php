<?php

namespace App\Http\Controllers;

use App\Models\Kampus;
use App\Models\KawasanHijau;
use App\Models\PenggunaanLahan;

class PetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Peta';

        $kampus = Kampus::all();

        $data = [
            'pageTitle' => $pageTitle,
            'kampus' => $kampus
        ];

        return view('peta', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function petaKampus()
    {
        $pageTitle = 'Peta Kampus';

        $kampus = Kampus::all();

        $data = [
            'pageTitle' => $pageTitle,
            'kampus' => $kampus
        ];

        return view('peta_kampus', $data);
    }

    public function getGeoJsonData()
    {
        // Dapatkan data dari model
        $geoDataKampus = Kampus::all();
        $geoDataKawasanHijau = KawasanHijau::all();
        $geoDataPenggunaanLahan = PenggunaanLahan::all();

        // Format setiap data menjadi FeatureCollection terpisah
        $kampusCollection = $this->getKampusFeatureCollection($geoDataKampus);
        $kawasanHijauCollection = $this->getKawasanHijauFeatureCollection($geoDataKawasanHijau);
        $penggunaanLahanCollection = $this->getPenggunaanLahanFeatureCollection($geoDataPenggunaanLahan);

        // Gabungkan semua FeatureCollection ke dalam satu array
        $formattedData = [
            'kampus' => $kampusCollection,
            'kawasan_hijau' => $kawasanHijauCollection,
            'penggunaan_lahan' => $penggunaanLahanCollection,
        ];

        // Kembalikan response JSON
        return response()->json($formattedData);
    }

    private function getKampusFeatureCollection($geoDataKampus)
    {
        $features = $geoDataKampus->map(function ($data) {
            return [
                'type' => 'Feature',
                'geometry' => json_decode($data->geom, true),
                'properties' => [
                    'id' => $data->id,
                    'name' => $data->nama,
                    'luas' => $data->luas,
                    'alamat' => $data->alamat,
                    'category' => 'kampus'
                ]
            ];
        });

        return [
            'type' => 'FeatureCollection',
            'features' => $features
        ];
    }

    private function getKawasanHijauFeatureCollection($geoDataKawasanHijau)
    {
        $features = $geoDataKawasanHijau->map(function ($data) {
            return [
                'type' => 'Feature',
                'geometry' => json_decode($data->geom, true),
                'properties' => [
                    'kampus_id' => $data->kampus->id,
                    'name' => $data->kampus->nama,
                    'deskripsi' => $data->deskripsi,
                    'luas' => $data->luas,
                    'category' => 'kawasan hijau'
                ]
            ];
        });

        return [
            'type' => 'FeatureCollection',
            'features' => $features
        ];
    }

    private function getPenggunaanLahanFeatureCollection($geoDataPenggunaanLahan)
    {
        $features = $geoDataPenggunaanLahan->map(function ($data) {
            return [
                'type' => 'Feature',
                'geometry' => json_decode($data->geom, true),
                'properties' => [
                    'kampus_id' => $data->kampus->id,
                    'name' => $data->kampus->nama,
                    'category' => 'penggunaan lahan'
                ]
            ];
        });

        return [
            'type' => 'FeatureCollection',
            'features' => $features
        ];
    }
}
