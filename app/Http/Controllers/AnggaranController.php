<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_anggaran = Anggaran::all();
        $data_program = Program::all();
        return view('backend.master_data.data_anggaran.index', compact('data_anggaran', 'data_program'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'program_id' => 'required',
                'nama_anggaran' => 'required|unique:anggarans',
                'deskripsi' => 'required',
                'kode' => 'required|unique:anggarans',
            ],
            [
                'program_id.required' => "Program kedah di pilih",
                'nama_anggaran.required' => 'Nama Anggaran kedah di isi',
                'nama_anggaran.unique' => 'Nama Anggaran atos aya',
                'deskripsi.required' => ' Deskripsi kedah di isi',
                'kode.required' => ' kode kedah di isi',
            ]
        );

        $data = new Anggaran;
        $data->program_id = $request->program_id;
        $data->nama_anggaran = $request->nama_anggaran;
        $data->deskripsi = $request->deskripsi;
        $data->kode = $request->kode;

        $data->persen       = $request->persen;
        $data->max_orang    = $request->max_orang;
        $data->nominal_max_anggaran    = $request->nominal_max_anggaran;

        $data->save();
        return redirect()->back()->with('sukses', 'wahhhhhh data anggaran atos masuk data.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data_anggaran = Anggaran::find($id);
        return view('backend.master_data.data_anggaran.show', compact('data_anggaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $anggaran = Anggaran::find($id);
        $data_program = Program::all();
        $data_anggaran = Anggaran::all();
        return view('backend.master_data.data_anggaran.edit', compact('anggaran', 'data_program', 'data_anggaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate(
            [
                'program_id' => 'required',
                'nama_anggaran' => 'required',
                'deskripsi' => 'required',
                'kode' => 'required',
            ],
            [
                'program_id.required' => 'Program kedah di pilih',
                'nama_anggaran.required' => 'Anggaran kedah di isi',
                'deskripsi.required' => 'Deskripsi kedah di isi',
                'kode.required' => 'Kode kedah di isi',
            ]
        );

        $data = Anggaran::find($id);
        $data->program_id = $request->program_id;
        $data->nama_anggaran = $request->nama_anggaran;
        $data->deskripsi = $request->deskripsi;
        $data->kode = $request->kode;

        $data->persen       = $request->persen;
        $data->max_orang    = $request->max_orang;
        $data->nominal_max_anggaran    = $request->nominal_max_anggaran;
        $data->update();

        return redirect()->back()->with('infoes', 'Horeeeeee Data anggaran atos di geuntos yeee');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data_anggaran = Anggaran::find($id);

        $data_anggaran->delete();

        return redirect()->back()->with('kuning', 'Data Parantos di hapus tina disimpen dina sampah )');
    }
    public function trash()
    {
        $data_anggaran = Anggaran::onlyTrashed()->get();

        return view('backend.master_data.data_anggaran.trash', compact('data_anggaran'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_anggaran = Anggaran::withTrashed()->findorfail($id);
        $data_anggaran->restore();
        return redirect()->back()->with('infoes', 'Data Anggaran atos di kembalikeun deui tina sampah');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_anggaran = Anggaran::withTrashed()->findorfail($id);

        $data_anggaran->forceDelete();
        return redirect()->back()->with('kuning', 'Data Anggaran parantos di hapus dina sampah');
    }
}
