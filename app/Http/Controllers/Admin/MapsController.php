<?php

namespace App\Http\Controllers\Admin;

use App\Models\Maps;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MapsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Data Peta';
        $data = [
            'pageTitle' => $pageTitle,
        ];

        return view('admin.maps.index', $data);
    }

    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            $result = Maps::with('Campus')->get();
            return DataTables::of($result)
                ->addColumn('action', function () {
                    return '<a href="' . route('maps.view') . '" class="py-2 px-3 text-black">Lihat</a>';
                })

                ->toJson();
        }
    }

    /**
     * Display a maps.
     */
    public function mapsView()
    {
        $pageTitle = 'Peta';
        $maps = Maps::all();
        $data = [
            'pageTitle' => $pageTitle,
            'maps' => $maps
        ];

        return view('admin.maps.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Peta';
        $maps = Maps::all();
        $data = [
            'pageTitle' => $pageTitle,
            'maps' => $maps
        ];

        return view('admin.maps.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'campus_id' => 'required',
            'geom' => 'required',
            'area' => 'required',
        ]);

        $data = [
            'campus_id' => $request->campus_id,
            'geom' => $request->geom,
            'area' => $request->area
        ];

        Maps::create($data);

        return redirect()->route('maps.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maps $maps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maps $maps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maps $maps)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maps $maps)
    {
        //
    }
}
