<?php

namespace App\Http\Controllers\Admin\Master;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'User';
        $user = User::all();
        $data = [
            'pageTitle' => $pageTitle,
            'user' => $user
        ];

        return view('admin.master.user.index', $data);
    }

    public function dataTables(Request $request)
    {
        if ($request->ajax()) {
            $result = User::query();
            return DataTables::of($result)
                ->addColumn('id', function (User $user) {
                    return $user->hashed_id; // Menggunakan hashed_id dari accessor
                })
                ->addColumn('action', function ($user) {
                    $buttons = [
                        [
                            'label' => '<i class="fa-solid fa-pencil"></i>',
                            'url' => route('user.edit', $user->hashed_id),
                        ],
                        [
                            'label' => '<i class="fa-solid fa-trash"></i>',
                            'url' => route('user.delete', $user->hashed_id),
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
        $pageTitle = 'Tambah Data User';
        $data = [
            'pageTitle' => $pageTitle,
        ];

        return view('admin.master.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:8',
            'role' => 'required',
            'status' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $pageTitle = 'Data User ' . $user->nama;
        $data = [
            'pageTitle' => $pageTitle,
            'user' => $user
        ];

        return view('admin.master.user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $pageTitle = 'Edit Data User';
        $data = [
            'pageTitle' => $pageTitle,
            'user' => $user
        ];

        return view('admin.master.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'role' => 'required'
        ]);

        $user->update($request->all());

        return redirect()->route('user.index')->with('success', 'Data user berhasil diubah');
    }

    public function delete(User $user)
    {
        $pageTitle = 'Hapus Data User';
        $data = [
            'pageTitle' => $pageTitle,
            'user' => $user
        ];

        return view('admin.master.user.delete', $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data user' . $user->email . 'berhasil dihapus');
    }
}
