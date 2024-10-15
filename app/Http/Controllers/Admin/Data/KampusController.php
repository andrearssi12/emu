<?php

namespace App\Http\Controllers\Admin\Data;

use App\Models\Kampus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class KampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Kampus';
        $kampus = Kampus::all();
        $data = [
            'pageTitle' => $pageTitle,
            'kampus' => $kampus
        ];

        return view('admin.data.kampus.index', $data);
    }

    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            $result = Kampus::query();
            return DataTables::of($result)
                ->addColumn('id', function (Kampus $kampus) {
                    return $kampus->hashed_id;
                })
                ->addColumn('action', function ($kampus) {
                    $buttons = [
                        [
                            'label' => '<i class="fa-solid fa-eye"></i>',
                            'url' => route('kampus.show', $kampus->hashed_id),
                        ],
                        [
                            'label' => '<i class="fa-solid fa-pencil"></i>',
                            'url' => route('kampus.edit', $kampus->hashed_id),
                        ],
                        [
                            'label' => '<i class="fa-solid fa-trash"></i>',
                            'url' => route('kampus.delete', $kampus->hashed_id),
                        ]
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
        $drawnFeatures = session('drawnFeatures');
        $pageTitle = 'Tambah Data Kampus';
        $kampus = Kampus::all();
        $data = [
            'pageTitle' => $pageTitle,
            'kampus' => $kampus
        ];

        return view('admin.data.kampus.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kampus' => 'required',
            'lokasi' => 'required',
            'geom' => 'required',
            'luas' => 'required'
        ]);

        if (Kampus::create($request->all())) {

            activity()
                ->causedBy(auth()->user())
                ->withProperties($request->all())
                ->log('Menambahkan data kampus');

            session()->forget('drawnFeatures');

            return redirect()->route('kampus.index')->with('success', 'Data berhasil ditambahkan');
        }

        return redirect()->route('kampus.index')->with('error', 'Data gagal ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kampus $kampus)
    {
        $pageTitle = 'Detail Kampus' . $kampus->name;
        $data = [
            'pageTitle' => $pageTitle,
            'kampus' => $kampus
        ];

        return view('admin.data.kampus.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kampus $kampus)
    {
        $pageTitle = 'Master - Edit Data Kampus';
        $data = [
            'pageTitle' => $pageTitle,
            'kampus' => $kampus
        ];

        return view('admin.data.kampus.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kampus $kampus)
    {
        $request->validate([
            'nama_kampus' => 'required',
            'lokasi' => 'required',
            'geom' => 'required',
            'luas' => 'required'
        ]);

        $kampus->update($request->all());

        return redirect()->route('kampus.index')->with('success', 'Data berhasil diupdate');
    }

    public function delete(Kampus $kampus)
    {
        $pageTitle = 'Hapus Data Kampus';
        $data = [
            'pageTitle' => $pageTitle,
            'kampus' => $kampus
        ];

        return view('admin.data.kampus.delete', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kampus $kampus)
    {
        $kampus->delete();

        return redirect()->route('kampus.index')->with('success', 'Data berhasil dihapus');
    }

    public function saveDrawnFeatures(Request $request)
    {
        session(['drawnFeatures' => $request->all()]);
        return response()->json(['success' => true]);
    }

    public function getDrawnFeatures()
    {
        return response()->json(session('drawnFeatures', []));
    }
}
