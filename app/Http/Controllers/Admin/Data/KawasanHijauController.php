<?php

namespace App\Http\Controllers\Admin\Data;

use App\Models\KawasanHijau;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class KawasanHijauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Kawasan Hijau';

        $data = [
            'pageTitle' => $pageTitle,
        ];

        return view('admin.data.kawasan_hijau.index', $data);
    }

    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            $result = KawasanHijau::with('kampus');
            return DataTables::of($result)
                ->addColumn('action', function ($kawasan) {
                    $buttons = [
                        [
                            'type' => 'link',
                            'label' => '<i class="fa-solid fa-eye"></i>',
                            'url' => route('kawasan-hijau.show', $kawasan->hashed_id),
                        ],
                        [
                            'type' => 'link',
                            'label' => '<i class="fa-solid fa-pencil"></i>',
                            'url' => route('kawasan-hijau.edit', $kawasan->hashed_id),
                        ],
                        [
                            'type' => 'delete',
                            'label' => '<i class="fa-solid fa-trash"></i>',
                            'url' => route('kawasan-hijau.destroy', $kawasan->hashed_id),
                            'confirm' => 'Are you sure you want to delete this kampus?',
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
        $pageTitle = 'Tambah Kawasan Hijau';

        $data = [
            'pageTitle' => $pageTitle,
        ];

        return view('admin.data.kawasan_hijau.create', $data);
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

        KawasanHijau::create($request->all());

        return redirect()->route('kawasan-hijau.index')->with('success', 'Data kawasan hijau berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(KawasanHijau $kawasanHijau)
    {
        $pageTitle = 'Detail Kawasan Hijau ' . $kawasanHijau->nama_kawasan;
        $data = [
            'pageTitle' => $pageTitle,
            'kawasan' => $kawasanHijau
        ];

        return view('admin.kawasan_hijau.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KawasanHijau $kawasanHijau)
    {
        $pageTitle = 'Edit Kawasan Hijau';
        $data = [
            'pageTitle' => $pageTitle,
            'kawasan' => $kawasanHijau
        ];

        return view('admin.kawasan_hijau.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KawasanHijau $kawasanHijau)
    {
        $request->validate([
            'kampus_id' => 'required',
            'nama_kawasan' => 'required',
            'luas' => 'required',
            'geom' => 'required',
            'jenis_vegetasi' => 'required',
            'foto' => 'required'
        ]);

        $kawasanHijau->update($request->all());

        return redirect()->route('kawasan-hijau.show', $kawasanHijau->id)->with('success', 'Data kawasan hijau berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KawasanHijau $kawasanHijau)
    {
        $kawasanHijau->delete();

        return redirect()->route('kawasan-hijau.index')->with('success', 'Data kawasan hijau berhasil dihapus');
    }
}
