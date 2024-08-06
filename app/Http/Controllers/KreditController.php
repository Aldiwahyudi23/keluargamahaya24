<?php

namespace App\Http\Controllers;

use App\Models\Kredit;
use App\Models\DataWarga;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;


class KreditController extends Controller
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
    public function show(Kredit $kredit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kredit $kredit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kredit $kredit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kredit $kredit)
    {
        //
    }
    public function showForm()
    {
    // Ambil role pengguna yang sedang login, jika tidak login set role sebagai guest
        $userRole = Auth::check() ? Auth::user()->role->nama_role : 'guest';


        // Kirim role ke view
        
        return view('frontend.home.kredit.kredit_form', ['userRole' => $userRole]);
    }
    public function showInvoice(Request $request)
    {
        $nominal = $request->query('nominal');
        $tenor = $request->query('tenor');
        $angsuran = $request->query('angsuran');
        $dp = $request->query('dp', 0);
        
        // Ambil role pengguna yang sedang login, jika tidak login set role sebagai guest
        $userRole = Auth::check() ? Auth::user()->role->nama_role : 'guest';


        return view('frontend.home.kredit.invoice', compact('nominal', 'tenor', 'angsuran', 'dp','userRole'));
    }
    
    function checkDiscount(Request $request)
{
    $nama = $request->input('nama');
    $no_hp = $request->input('no_hp');
    $tanggal_lahir = $request->input('tanggal_lahir');

    // Cek apakah ada data di tabel DataWarga dengan data yang sama
    $dataWarga = DataWarga::where('nama', $nama)
        ->where('no_hp', $no_hp)
        ->where('tanggal_lahir', $tanggal_lahir)
        ->first();

    if ($dataWarga) {
        $response = [
            'discount' => true,
            'message' => 'Data ini terdeteksi Termasuk kedalam keluarga Alm. MaHaya maka Ada diskon untuk kredit.'
        ];
    } else {
        $response = [
            'discount' => false,
            'message' => ''
        ];
    }

    return Response::json($response);
}

}
