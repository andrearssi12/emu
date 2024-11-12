<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kampus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Dashboard';

        return view('admin.dashboard.index', compact('pageTitle'));
    }

    public function proporsiLuasKawasanHijau()
    {
        $kampus = Kampus::with('kawasanHijau')->get();

        $data = [];

        foreach ($kampus as $k) {
            $totalLuasKawasanHijau = 0;
            foreach ($k->kawasanHijau as $kh) {
                $totalLuasKawasanHijau += $kh->luas;
            }

            $data[] = [
                'nama_kampus' => $k->nama_kampus,
                'luas_kampus' => $k->luas,
                'total_luas_kawasan_hijau' => $totalLuasKawasanHijau,
                'proporsi_luas_kawasan_hijau' => $totalLuasKawasanHijau / $k->luas * 100
            ];
        }

        return response()->json($data);
    }
}
