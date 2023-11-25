<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_aset = Aset::all();
        $data_program = Program::all();
        return view('frontend.home.data_aset.index', compact('data_aset', 'data_program'));
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
        $request->validate([
            'program_id' => 'required',
            'kode' => 'required',
            'nama_aset' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'qty' => 'required',
            'persen' => 'required',
            'kondisi' => 'required',
            'lokasi' => 'required',
        ], [
            'program_id.required' => 'Program keudah di isi',
            'kode.required' => 'Kode keudah di isi',
            'nama_aset.required' => ' Nama keudah di isi',
            'deskripsi.required' => 'Des keudah di isi',
            'tanggal.required' => 'Tanggal keudah di isi',
            'qty.required' => 'Jumlah keudah di isi',
            'persen.required' => 'kondisi berdasarkan persen keudah di isi',
            'kondisi.required' => 'kondisi keudah di isi',
            'lokasi.required' => 'lokasi keudah di isi',
        ]);
        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'Aset-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/aset'), $nama);
        }

        $data_aset = new Aset();
        $data_aset->program_id = $request->program_id;
        $data_aset->kode = $request->kode;
        $data_aset->nama_aset = $request->nama_aset;
        $data_aset->deskripsi = $request->deskripsi;
        $data_aset->tanggal = $request->tanggal;
        $data_aset->qty = $request->qty;
        $data_aset->persen = $request->persen;
        $data_aset->kondisi = $request->kondisi;
        $data_aset->lokasi = $request->lokasi;
        if ($request->foto) {
            $data_aset->foto          = "/img/aset/$nama";
        }

        $data_aset->save();
        return redirect()->back()->with('sukses', 'Wihhhhhh gaduh aset deui...allhamdulilahhh mudah mudahan lancarrr');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data_aset = Aset::find($id);

        return view('frontend.home.data_aset.show', compact('data_aset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data_aset = Aset::find($id);
        $data_aset_all = Aset::all();
        $data_program = Program::all();

        return view('frontend.home.data_aset.edit', compact('data_aset', 'data_program', 'data_aset_all'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate([
            'program_id' => 'required',
            'nama_aset' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'qty' => 'required',
            'persen' => 'required',
            'kondisi' => 'required',
            'lokasi' => 'required',
        ], [
            'program_id.required' => 'Program keudah di isi',
            'nama_aset.required' => ' Nama keudah di isi',
            'deskripsi.required' => 'Des keudah di isi',
            'tanggal.required' => 'Tanggal keudah di isi',
            'qty.required' => 'Jumlah keudah di isi',
            'persen.required' => 'kondisi berdasarkan persen keudah di isi',
            'kondisi.required' => 'kondisi keudah di isi',
            'lokasi.required' => 'lokasi keudah di isi',
        ]);
        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'Aset-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/aset'), $nama);
        }

        $data_aset = Aset::find($id);
        $data_aset->program_id = $request->program_id;
        $data_aset->nama_aset = $request->nama_aset;
        $data_aset->deskripsi = $request->deskripsi;
        $data_aset->tanggal = $request->tanggal;
        $data_aset->qty = $request->qty;
        $data_aset->persen = $request->persen;
        $data_aset->kondisi = $request->kondisi;
        $data_aset->lokasi = $request->lokasi;

        if ($request->foto) {
            $data_aset->foto          = "/img/aset/$nama";
        }

        $data_aset->update();
        return redirect()->back()->with('infoes', 'yeeeeeeeeee data aset atos kaedit deui...allhamdulilahhh mudah mudahan lancarrr');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data_aset = Aset::find($id);

        $data_aset->delete();

        return redirect()->back()->with('kuning', 'Data Parantos di hapus tina disimpen dina sampah )');
    }
    public function trash()
    {
        $data_aset = Aset::onlyTrashed()->get();

        return view('frontend.home.data_aset.trash', compact('data_aset'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_aset = Aset::withTrashed()->findorfail($id);
        $data_aset->restore();
        return redirect()->back()->with('infoes', 'Data Aset atos di kembalikeun deui tina sampah');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_aset = Aset::withTrashed()->findorfail($id);

        $data_aset->forceDelete();
        return redirect()->back()->with('kuning', 'Data Aset parantos di hapus dina sampah');
    }
}
