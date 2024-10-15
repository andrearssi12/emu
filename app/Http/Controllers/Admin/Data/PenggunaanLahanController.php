<?php

namespace App\Http\Controllers\Admin\Data;

use Illuminate\Http\Request;
use App\Models\PenggunaanLahan;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PenggunaanLahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Penggunaan Lahan';

        $data = [
            'pageTitle' => $pageTitle,
        ];

        return view('admin.penggunaan_lahan.index', $data);
    }

    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            $result = PenggunaanLahan::with('kampus');
            return DataTables::of($result)
                ->addColumn('action', function ($penggunaan) {
                    $buttons = [
                        [
                            'type' => 'link',
                            'label' => '<i class="fa-solid fa-eye"></i>',
                            'url' => route('penggunaan.show', $penggunaan->id),
                        ],
                        [
                            'type' => 'link',
                            'label' => '<i class="fa-solid fa-pencil"></i>',
                            'url' => route('penggunaan.edit', $penggunaan->id),
                        ],
                        [
                            'type' => 'delete',
                            'label' => '<i class="fa-solid fa-trash"></i>',
                            'url' => route('penggunaan.destroy', $penggunaan->id),
                            'confirm' => 'Are you sure you want to delete this penggunaan lahan?',
                        ],
                    ];
                    return view('components.button-group', ['buttons' => $buttons])->render();
                })
                ->rawColumns(['action'])
                ->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Tambah Penggunaan Lahan';

        $data = [
            'pageTitle' => $pageTitle,
        ];

        return view('admin.penggunaan_lahan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kampus_id' => 'required',
            'nama_kawasan' => 'required',
            'luas' => 'required',
            'geom' => 'required',
            'jenis_vegetasi' => 'required',
            'foto' => 'required'
        ]);

        PenggunaanLahan::create($request->all());

        return redirect()->route('penggunaan-lahan.index')->with('success', 'Data Penggunaan Lahan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenggunaanLahan $penggunaanLahan)
    {
        $pageTitle = 'Detail Penggunaan Lahan ' . $penggunaanLahan->nama_kawasan;
        $data = [
            'pageTitle' => $pageTitle,
            'kawasan' => $penggunaanLahan
        ];

        return view('admin.kawasan_hijau.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenggunaanLahan $penggunaanLahan)
    {
        $pageTitle = 'Edit Kawasan Hijau';
        $data = [
            'pageTitle' => $pageTitle,
            'kawasan' => $penggunaanLahan
        ];

        return view('admin.kawasan_hijau.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenggunaanLahan $penggunaanLahan)
    {
        $request->validate([
            'kampus_id' => 'required',
            'nama_kawasan' => 'required',
            'luas' => 'required',
            'geom' => 'required',
            'jenis_vegetasi' => 'required',
            'foto' => 'required'
        ]);

        $penggunaanLahan->update($request->all());

        return redirect()->route('kawasan-hijau.show', $penggunaanLahan->id)->with('success', 'Data kawasan hijau berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenggunaanLahan $penggunaanLahan)
    {
        $penggunaanLahan->delete();

        return redirect()->route('kawasan-hijau.index')->with('success', 'Data kawasan hijau berhasil dihapus');
    }
}
