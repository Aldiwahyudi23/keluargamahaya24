<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BayarPinjaman;
use App\Models\DataWarga;
use App\Models\HubunganWarga;
use App\Models\Pengeluaran;
use App\Models\AccessProgram;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PesanController extends Controller
{
    public function index()
    {
        $data_warga = DataWarga::all();
        $data_user = User::all();
        $data_pinjaman = Pengeluaran::where('anggaran_id', 3)->where('status', "Nunggak");
        
        $access_program_kas = AccessProgram::where('program_id', 1)->get();
        $target = [];
        $data_warga_all = [];
Foreach ($access_program_kas as $data) {
$data_wargas = User::find($data->user_id);
        $target[] = $data_wargas->data_warga->no_hp;
        $data_warga_all[] = $data_wargas->data_warga->nama . "(" . $data_wargas->data_warga->no_hp . ")";
        }
        $coba1 = implode(", ", $target);
        $targets_all = implode("<br>", $data_warga_all);
        
        $validPhoneNumbers = DataWarga::whereRaw('LENGTH(no_hp) >= 10 AND LENGTH(no_hp) <= 13')->get();
$target2 =[];
Foreach ($validPhoneNumbers as $data) {
        $target2[] = $data->nama . "(" .$data->no_hp .")";
        }
$coba2 = implode("<br>", $target2);


        return view('pesan.index', compact('data_warga', 'data_user', 'data_pinjaman','coba1','targets_all','coba2'));
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
        
        if($request->targets == 1){
        $access_program_kas = AccessProgram::where('program_id', $request->targets)->get();

        $token = "@Mx6RkRVz60S#j8YGi6T";
        
        $target =[];
Foreach ($access_program_kas as $data) {
$data_warga = User::find($data->user_id);
        $target[] = $data_warga->data_warga->no_hp;
        }
$coba1 = implode(", ", $target);

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
                'target' => $coba1,
                'message' => " *السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ*

$request->pembukaan

$request->isi

$request->penutup

 *وَ السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ*

Kas Keluarga Ma HAYA
http://keluargamahaya.cekmobil.online
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
        
        return redirect()->back()->with('sukses', 'Pengumuman kanggo Anggota KAS Keluarga Atos di kirim ka perorang');
        
        }if($request->targets == 1){
        $access_program_kas = AccessProgram::where('program_id', $request->targets)->get();

        $token = "@Mx6RkRVz60S#j8YGi6T";
        
        $target =[];
Foreach ($access_program_kas as $data) {
$data_warga = User::find($data->user_id);
        $target[] = $data_warga->data_warga->no_hp;
        }
$coba1 = implode(", ", $target);

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
                'target' => $coba1,
                'message' => " *السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ*

$request->pembukaan

$request->isi

$request->penutup

 *وَ السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ*

Kas Keluarga Ma HAYA
http://keluargamahaya.cekmobil.online
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
        
        return redirect()->back()->with('sukses', 'Pengumuman kanggo Seluru Atos di kirim ka perorang');
        
        }elseif($request->targets == 2){
        

$validPhoneNumbers = DataWarga::whereRaw('LENGTH(no_hp) >= 10 AND LENGTH(no_hp) <= 13')->get();


        $token = "@Mx6RkRVz60S#j8YGi6T";
        
        $target =[];
Foreach ($validPhoneNumbers as $data) {
        $target[] = $data->no_hp;
        }
$coba1 = implode(", ", $target);

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
                'target' => $coba1,
                'message' => " *السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ*

$request->pembukaan

$request->isi

$request->penutup

 *وَ السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ*

Kas Keluarga Ma HAYA
http://keluargamahaya.cekmobil.online
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
        
        return redirect()->back()->with('sukses', 'Pengumuman kanggo Seluruh Data Atos di kirim ka perorang');
        
        }
        else{

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
http://keluargamahaya.cekmobil.online
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
        return redirect()->back()->with('sukses', 'Pesan Atos di kirim');
        
        }
    }
    
    public function kirim_pengumuman_perbulan(Request $request)
    {
       $waktu = new Carbon();
$waktu_penentuan = date('d-M-Y', strtotime($waktu));

        $token = "@Mx6RkRVz60S#j8YGi6T";
        $target = "083825740395";

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

Ngemutan kana Program KAS

Alhamdulilah program KAS atos berjalan dengan lancar, Yuuukkk kanggo kalancaranna ayeuna tos masuk di akhir bulan
$waktu_penentuan
bade masuk di awal bulan 

Mohon kerjasamana kanggo kalancaran program ieu, Hatur Nuhun

Lewat Bank 
No Rek : 5859459276533014
Bank : Neo Bank
A/n : Rangga Mulyana


No Rek :
Bank : BRI
A/n : Rifki Alfarez Putra

Lewat DANA
No : 085942004204
A/n : Rangga Mulyana

 *وَ السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ*

Kas Keluarga Ma HAYA
http://keluargamahaya.cekmobil.online
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
    public function kirim_pesan_wa(Request $request)
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

$access_program_kas = AccessProgram::where('program_id', 1)->get();

Foreach ($access_program_kas as $data) {
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
http://keluargamahaya.cekmobil.online
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
}

        return redirect()->back()->with('sukses', 'Wihhhhh Alhamdulilahhh  Hatur Nuhun Pisan');
    }
    public function percobaan (){
    $data_warga = DataWarga::all(); //mengambil semua data warga
    
    
    Return view ('percobaan.index',compact(
    'data_warga'
    ));
    }
    public function percobaan_store (Request $Request) {

     Return response()->Json(['status' => 'success','message' => 'Mantap' ]);
    }
    
    
        
}

