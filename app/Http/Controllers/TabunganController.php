<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataWarga;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function tabungan_user($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        $data_warga = DataWarga::find(Auth::user()->data_warga_id);
        $data_tabungan_user = Pemasukan::orderByRaw('created_at DESC')->where('kategori_id', 2)->where('data_warga_id', $data_warga->id)->get();
        $data_pengeluaran_user = Pengeluaran::orderByRaw('created_at DESC')->where('anggaran_id', 7)->where('data_warga_id', $data_warga->id)->get();

        return view('frontend.home.tabungan.index', compact('data_tabungan_user', 'data_pengeluaran_user', 'data_warga'));
    }
}
