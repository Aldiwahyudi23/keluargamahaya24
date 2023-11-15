<?php

namespace App\Http\Controllers;

use App\Models\KategoriAnggaranProgram;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KategoriAnggaranProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_kategori = KategoriAnggaranProgram::all();

        return view('backend.master_data.data_program.kategori.index', compact('data_kategori'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_kategori' => 'Required|unique:kategori_anggaran_programs',
                'deskripsi' => 'Required',
            ],
            [
                'nama_kategori.required' => "Nama kategori kedah di isi",
                'nama_kategori.unique' => "Nama kategori Atos Aya",
                'deskripsi.required' => "Deskripsi kedah di isi",
            ]
        );

        $data = new KategoriAnggaranProgram;
        $data->nama_kategori = $request->nama_kategori;
        $data->deskripsi = $request->deskripsi;
        $data->kode = $request->kode;
        $data->save();

        return redirect()->back()->with('sukses', 'Horeeeeeee Data kategori atos di simpen, atos masuk kana data');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id =   Crypt::decrypt($id);
        $kategori = KategoriAnggaranProgram::find($id);
        $data_kategori = KategoriAnggaranProgram::all();

        return view('backend.master_data.data_program.kategori.show', compact('data_kategori', 'kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id =   Crypt::decrypt($id);
        $kategori = KategoriAnggaranProgram::find($id);
        $data_kategori = KategoriAnggaranProgram::all();

        return view('backend.master_data.data_program.kategori.edit', compact('data_kategori', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate(
            [
                'nama_kategori' => 'required',
                'deskripsi' => 'required',
            ],
            [
                'nama_kategori.required' => 'kategori kedah di isi',
                'deskripsi.required' => 'Deskripsi kedah di isi',
            ]
        );

        $data = KategoriAnggaranProgram::find($id);
        $data->nama_kategori = $request->nama_kategori;
        $data->deskripsi = $request->deskripsi;
        $data->kode = $request->kode;

        $data->update();
        return redirect()->back()->with('infoes', 'yeuhhhhhhh Data kategori atos di geuntos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data = KategoriAnggaranProgram::find($id);

        $data->delete();
        return redirect()->back()->with('kuning', 'Hemmmmmm Data kategori atos di hapus |:');
    }

    public function trash()
    {
        $data_kategori = KategoriAnggaranProgram::onlyTrashed()->get();
        return view('backend.master_data.data_program.kategori.trash', compact('data_kategori'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_kategori = KategoriAnggaranProgram::withTrashed()->findOrFail($id);
        $data_kategori->restore();
        return redirect()->back()->with('infoes', ' Data kategori atos di balikeun deui');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_kategori = KategoriAnggaranProgram::withTrashed()->findOrFail($id);
        $data_kategori->forceDelete();
        return redirect()->back()->with('kuning', 'Data kategori atos di hapus ');
    }
}
