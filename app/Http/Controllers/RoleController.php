<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_role = Role::all();

        return view('backend.master_data.data_role.index', compact('data_role'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_role' => 'Required|unique:roles',
                'deskripsi' => 'Required',
            ],
            [
                'nama_role.required' => "Nama Role kedah di isi",
                'nama_role.unique' => "Nama Role Atos Aya",
                'deskripsi.required' => "Deskripsi kedah di isi",
            ]
        );

        $data = new Role;
        $data->nama_role = $request->nama_role;
        $data->deskripsi = $request->deskripsi;
        $data->save();

        return redirect()->back()->with('sukses', 'Horeeeeeee Data Role atos di simpen, atos masuk kana data');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id =   Crypt::decrypt($id);
        $role = Role::find($id);
        $data_role = Role::all();

        return view('backend.master_data.data_role.show', compact('data_role', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id =   Crypt::decrypt($id);
        $role = Role::find($id);
        $data_role = Role::all();

        return view('backend.master_data.data_role.edit', compact('data_role', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate(
            [
                'nama_role' => 'required',
                'deskripsi' => 'required',
            ],
            [
                'nama_role.required' => 'Role kedah di isi',
                'deskripsi.required' => 'Deskripsi kedah di isi',
            ]
        );

        $data = Role::find($id);
        $data->nama_role = $request->nama_role;
        $data->deskripsi = $request->deskripsi;

        $data->update();
        return redirect()->back()->with('infoes', 'yeuhhhhhhh Data Role atos di geuntos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data = Role::find($id);

        $data->delete();
        return redirect()->back()->with('kuning', 'Hemmmmmm Data Role atos di hapus |:');
    }

    public function trash()
    {
        $data_role = Role::onlyTrashed()->get();
        return view('backend.master_data.data_role.trash', compact('data_role'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_role = Role::withTrashed()->findOrFail($id);
        $data_role->restore();
        return redirect()->back()->with('infoes', ' Data Role atos di balikeun deui');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_role = Role::withTrashed()->findOrFail($id);
        $data_role->forceDelete();
        return redirect()->back()->with('kuning', 'Data role atos di hapus ');
    }
}
