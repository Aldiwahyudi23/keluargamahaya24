<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BayarPinjaman;
use App\Models\DataWarga;
use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index()
    {
        $data_warga = DataWarga::all();
        $data_user = User::all();
        $data_pinjaman = Pengeluaran::where('anggaran_id', 3)->where('status', "Nunggak");

        return view('pesan.index', compact('data_warga', 'data_user', 'data_pinjaman'));
    }
    public function kirim_pesan(Request $request)
    {
        $request->validate([
            'targets' => 'required',
            'pembukaan' => 'required',
            'isi' => 'required',
            'penutup' => 'required',
        ], [
            'targets.required' => 'tujuan kedah di pilih',
            'pembukaan.required' => 'Isi Awalan kedah di pilih',
            'isi.required' => 'Isi Pesan kedah di isi',
            'penutup.required' => 'Isi Pesan penutup kedah di isi',
        ]);

        $token = "@Mx6RkRVz60S#j8YGi6T";
        $target = "$request->targets";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'target' => $target,
                'message' => " *السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ*

$request->pembukaan

$request->isi

$request->penutup

 *وَ السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ*

Kas Keluarga Ma HAYA
http://keluargamahaya.online
",

            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        // sampe die


        return redirect()->back()->with('sukses', 'Wihhhhh Alhamdulilahhh  Hatur Nuhun Pisan');
    }
}
