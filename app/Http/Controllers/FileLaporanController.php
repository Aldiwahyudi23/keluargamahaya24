<?php

namespace App\Http\Controllers;

use App\Models\FileLaporan;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class FileLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_file = FileLaporan::all();
        return view('backend.master_data.data_file_laporan.index', compact('data_file'));
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
                'judul' => 'required',
                'file' => 'required',
                'deskripsi' => 'required',
            ],
            [
                'judul.required' => "Judul Laporan kedah di isi",
                'file.required' => "file kedah di isi",
                'deskripsi.required' => "Deskripsi laporan kedah di isi",
            ]
        );

        $file = $request->file('file');
        $nama = 'file-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('laporan/file'), $nama);

        $data = new FileLaporan;
        $data->judul = $request->judul;
        $data->deskripsi = $request->deskripsi;
        $data->file          = "laporan/file/$nama";

        $data->save();

        return redirect()->back()->with('sukses', 'Laporan atos di tersimpen');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $file_laporan = FileLaporan::find($id);
        return view('backend.master_data.data_file_laporan.show', compact('file_laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $file_laporan = FileLaporan::find($id);
        $data_file = FileLaporan::all();
        return view('backend.master_data.data_file_laporan.edit', compact('file_laporan', 'data_file'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate(
            [
                'judul' => 'required',
                'deskripsi' => 'required',
            ],
            [
                'judul.required' => "Judul Laporan kedah di isi",
                'deskripsi.required' => "Deskripsi laporan kedah di isi",
            ]
        );
        if ($request->file) {
            $file = $request->file('file');
            $nama = 'file-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('laporan/file'), $nama);
        }

        $data = FileLaporan::find($id);
        $data->judul = $request->judul;
        $data->deskripsi = $request->deskripsi;
        if ($request->file) {
            $data->file          = "laporan/file/$nama";
        }

        $data->update();

        return redirect()->back()->with('infoes', 'Laporan atos di diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FileLaporan $fileLaporan)
    {
        //
    }

    public function downloadFile($nama)
    {

        $filePath = public_path('/laporan/file' . $nama);
        return storage::download($filePath);
    }
}
