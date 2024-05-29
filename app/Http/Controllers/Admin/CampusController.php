<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Campus';
        $data = [
            'pageTitle' => $pageTitle
        ];

        return view('admin.campus.index', $data);
    }

    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            $result = Campus::all();
            return DataTables::of($result)
                ->addColumn('action', function ($campus) {
                    $showLink = '<a href="' . route('campus.show', $campus->id) . '" class="py-2 px-3 bg-blue-500 rounded-md text-white"><i class="fa-solid fa-eye"></i></a>';
                    $editLink = '<a href="' . route('campus.edit', $campus->id) . '" class="py-2 px-3 bg-green-500 rounded-md text-white"><i class="fa-solid fa-pencil"></i></a>';
                    $deleteForm = '<form action="' . route('campus.destroy', $campus->id) . '" method="POST" class="delete-form">' .
                        csrf_field() .
                        method_field('DELETE') .
                        '<button type="submit" class="py-2 px-3 bg-red-500 rounded-md text-white" onclick="return confirm(\'Are you sure you want to delete this campus?\')"><i class="fa-solid fa-trash"></i></button>' .
                        '</form>';
                    return '<div class="inline-flex gap-2">' . $showLink . $editLink . $deleteForm . '</div>';
                })
                ->toJson();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Tambah Campus';
        $data = [
            'pageTitle' => $pageTitle
        ];

        return view('admin.campus.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ]);

        Campus::create($request->all());

        return redirect()->route('campus.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Campus $campus)
    {
        $pageTitle = 'Detail Campus';
        $data = [
            'pageTitle' => $pageTitle,
            'campus' => $campus
        ];

        return view('admin.campus.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campus $campus)
    {
        $pageTitle = 'Edit Campus';
        $data = [
            'pageTitle' => $pageTitle,
            'campus' => $campus
        ];

        return view('admin.campus.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campus $campus)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'long' => 'required'
        ]);

        $campus->update($request->all());

        return redirect()->route('campus.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campus $campus)
    {
        $campus->delete();

        return redirect()->route('campus.index')->with('success', 'Data berhasil dihapus');
    }
}
