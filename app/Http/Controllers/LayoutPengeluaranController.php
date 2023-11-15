<?php

namespace App\Http\Controllers;

use App\Models\LayoutPengeluaran;
use App\Http\Controllers\Controller;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LayoutPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layout_pengeluaran = LayoutPengeluaran::first();

        return view('backend.setting.profile_app.layout_pengeluaran.hal_pinjaman', compact('layout_pengeluaran'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LayoutPengeluaran $layoutPengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LayoutPengeluaran $layoutPengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        if ($request->gambar) {
            $file = $request->file('gambar');
            $nama = 'layout-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/profile_app'), $nama);
        }

        $data = LayoutPengeluaran::find($id);
        $data->tittle = $request->tittle;
        $data->nominal_min = $request->nominal_min;
        $data->info_proses = $request->info_proses;
        $data->info_saldo = $request->info_saldo;
        $data->info_nunggak = $request->info_nunggak;
        $data->temp_keterangan = $request->temp_keterangan;
        $data->info_proses_bayar = $request->info_proses_bayar;
        $data->info_full = $request->info_full;

        if ($request->gambar) {
            $data->gambar = "/img/profile_app/$nama";
        }

        $data->update();
        return redirect()->back()->with('sukses', 'Tampilan Halaman Pemasukan Sudah Di Rubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LayoutPengeluaran $layoutPengeluaran)
    {
        //
    }
}
