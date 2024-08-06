<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Http\Controllers\Controller;
use App\Notifications\EmailNotification;
use App\Models\AccessProgram;

use App\Models\Anggaran;
use App\Models\BayarPinjaman;
use App\Models\DataWarga;
use App\Models\FileLaporan;
use App\Models\HubunganWarga;
use App\Models\KategoriAnggaranProgram;
use App\Models\LayoutPengeluaran;
use App\Models\Pemasukan;
use App\Models\Pengajuan;
use App\Models\Role;
use App\Models\Saldo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_pengeluaran = Pengeluaran::orderByRaw('created_at DESC')->get();
        $data_warga_program = AccessProgram::where('program_id', 1);
        $data_warga = DataWarga::all();
        $data_anggaran = Anggaran::all();

        return view('backend.transaksi.pengeluaran.index', compact('data_pengeluaran', 'data_warga_program', 'data_warga', 'data_anggaran'));
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
            'data_warga' => 'required',
            'anggaran_id' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required',
        ], [
            'data_warga.required' => 'data_warga kedah di pilih',
            'anggaran_id.required' => 'anggaran kedah di pilih',
            'jumlah.required' => 'Nominal kedah di isi',
            'jumlah.numeric' => 'Nominal teu kengeng kangge titik',
            'keterangan.required' => 'keterangan kedah di isi',
        ]);
        $data_anggaran = Anggaran::find($request->anggaran_id);

        $data_pengeluaran = new Pengeluaran();
        $data_pengeluaran->data_warga_id = $request->data_warga;
        $data_pengeluaran->pengaju_id = $request->pengaju_id;
        $data_pengeluaran->jumlah = $request->jumlah;
        $data_pengeluaran->anggaran_id = $request->anggaran_id;
        $data_pengeluaran->alasan = $request->keterangan;
        $data_pengeluaran->tanggal = $request->tanggal;
        // ini di ambil jika ada reques jika tidak kosongkan
        if ($request->status) {
            $data_pengeluaran->status          = $request->status;
        }
        if ($request->ketua) {
            $data_pengeluaran->ketua          = $request->ketua;
        }
        if ($request->bendahara) {
            $data_pengeluaran->bendahara          = $request->bendahara;
        }
        if ($request->sekertaris) {
            $data_pengeluaran->sekertaris          = $request->sekertaris;
        }

        // ini untuk ngambil data dari penginputan dari d=form bayar
        if ($request->cek_data == "admin") {
            $data_pengeluaran->pengurus_id = Auth::user()->data_warga_id;
            $data_pengeluaran->kode = $data_anggaran->kode . date('dmyhis');
            $kode =  $data_anggaran->kode . date('dmyhis');
        } elseif ($request->cek_data == "input_admin") {
            $data_pengeluaran->pengurus_id = $request->pengurus_id;
            $data_pengeluaran->kode =  $data_anggaran->kode . date('dmyhis', strtotime($request->tanggal));
            $kode =  $data_anggaran->kode . date('dmyhis', strtotime($request->tanggal));
        } else {
            $data_pengeluaran->pengurus_id = Auth::user()->data_warga_id;
            $data_pengeluaran->kode =  $data_anggaran->kode . date('dmyhis', strtotime($request->tanggal)); //jika kode ini di ambil dari pengajuan maka ngambil dari sini
            $kode =  $data_anggaran->kode . date('dmyhis', strtotime($request->tanggal));
        }
        
        //untuk pengeluaran
        $id_anggaran = Anggaran::find($request->anggaran_iqd);
        if($request->anggaran_id = 1){
           $darurat =  $request->jumlah ;
        }else{
           $darurat = 0; 
        }
        if($request->anggaran_id = 2){
           $amal =  $request->jumlah ;
        }else{
           $amal = 0; 
        }

        if($request->anggaran_id = 7){
           $tabungan =  $request->jumlah ;
        }else{
           $tabungan = 0; 
        }
        
        $saldo_akhir = Saldo::latest()->first(); //mengambil data yang terbaru
        
      if($saldo_akhir->saldo_kas > $request->jumlah){ 
        if ($request->anggaran_id == 4 || $request->anggaran_id == 5 || $request->anggaran_id == 6) {
          $kas = $request->jumlah;
        } else {
          $kas = 0;
        }
       }else{
        return redirect()->back()->with('kuning','Saldo kas tidak cukup');
       }

        
        $data_saldo = new Saldo();
        $data_saldo->id_transaksi = $saldo_akhir->id_transaksi ;
        $data_saldo->saldo_atm_kas = $saldo_akhir->saldo_atm_kas - $kas - $darurat - $amal ;
        $data_saldo->saldo_atm_tabungan = $saldo_akhir->saldo_atm_tabungan - $tabungan ;
        $data_saldo->total_diluar = $saldo_akhir->total_diluar;
        $data_saldo->total_kas = $saldo_akhir->total_kas -  $kas - $darurat - $amal;
        $data_saldo->total_tabungan = $saldo_akhir->total_tabungan - $tabungan;
        $data_saldo->saldo_darurat = $saldo_akhir->saldo_darurat - $darurat ;
        $data_saldo->saldo_amal = $saldo_akhir->saldo_amal - $amal ;
        $data_saldo->saldo_pinjaman = $saldo_akhir->saldo_pinjaman;
        
        $data_saldo->saldo_kas = $saldo_akhir->saldo_kas - $kas ;
        $data_saldo->bunga_neo = $saldo_akhir->bunga_neo;
        $data_saldo->bunga_tabungan = $saldo_akhir->bunga_tabungan ;
        $data_saldo->jumlah_lebih_pinjaman = $saldo_akhir->jumlah_lebih_pinjaman;
        
        
        $data_saldo->save();
        
        // Untuk notif Wa
        $role_ketua = Role::where('nama_role', 'Ketua')->first(); //Untuk mengambil data sesuai nama role
        $ketua = User::where('role_id', $role_ketua->id)->first(); // mengambil satu data sesuai dengan role
        $role_bendahara = Role::where('nama_role', 'Bendahara')->first(); //Untuk mengambil data sesuai nama role
        $bendahara = User::where('role_id', $role_bendahara->id)->first(); // mengambil satu data sesuai dengan role
        $role_sekertaris = Role::where('nama_role', 'Sekertaris')->first(); //Untuk mengambil data sesuai nama role
        $sekertaris = User::where('role_id', $role_sekertaris->id)->first(); // mengambil satu data sesuai dengan role
        $role_penasehat = Role::where('nama_role', 'Penasehat')->first(); //Untuk mengambil data sesuai nama role
        $penasehat = User::where('role_id', $role_penasehat->id)->first(); // mengambil satu data sesuai dengan role

        $DataWarga = DataWarga::find($request->data_warga); //Untuk mengambil data Warga sesuai dengtan id pengaju
        $Sekertaris = User::find($request->data_warga); //Untuk mengambil data Warga sesuai dengtan id pengaju
        $DataKategori = KategoriAnggaranProgram::find($request->kategori_id); //untuk mengambil data kategori
        $all = User::where('role_id', 3)->get();

        $token = "@Mx6RkRVz60S#j8YGi6T";

        
        $nominal = number_format($request->jumlah, 2, ',', '.');
        $pengurus = Auth::User()->data_warga->nama;
        
        $access_program_kas = AccessProgram::where('program_id', 1)->get();
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
                'message' => "Pesan Otomatis   

Alhamdulilah
Penginputan PENGELUARAN atos di input ku $pengurus dengan data sesuai di Handap

ID : $kode
Tanggal : $request->tanggal
Kategori : $data_anggaran->nama_anggaran
Nominal : Rp.$nominal

Pengeluaran atos di input, Mangga di cek supados jelas. Nuhun

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
        //sampe die
        // Kanggo send notifikasi
        $all = User::all();
        
        

        $project = [
            'greeting' => 'Ralat, Update Info yang Tadi',
            'body' => 'Ngalaporkeun Pengeluaran KAS seseuai DATA di Handap anu di Input ku ' . Auth::user()->name . ' Mangga cek deui, kedah selalu ngecek kana data',
            'nama' => 'Di Input ku ' . Auth::user()->name . '/' . $kode,
            'kategori' => $data_anggaran->nama_anggaran,
            'pembayaran' => 'Jumlah Nu di Kaluarkeun',
            'jumlah' => 'Rp ' . number_format($request->jumlah, 2, ',', '.'),
            'tanggal' => $request->tanggal,
            'thanks' => 'Laporan sesuai data nu tercantum, Hatur nuhun kana perhatosanna',
            'actionText' => 'cek kanggo ningal secara detail',
            'actionURL' => url('/'),
            'id' => 57
        ];

        Notification::sendnow($all, new EmailNotification($project));

       // $data_pengeluaran->save();

        // jika ada pengajuan ID hapus
        if ($request->pengajuan_id) {

            $pengajuan = Pengajuan::find($request->pengajuan_id);
            $pengajuan->delete();
            return redirect('/pengajuans/kas')->with('sukses', 'Wihhhh mantappp hatur nuhun atos ngaKONFIRMASI pengajuan pemabyaran KAS keluarga. Lancar selalu');
        } else {
            return redirect()->back()->with('sukses', 'Wihhhh mantappp hatur nuhun atos masukeun data pembayaran KAS keluarga. Lancar selalu ATOS LEBET');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);

        $data_pengeluaran = Pengeluaran::Find($id);
        return view('backend.transaksi.pengeluaran.show', compact('data_pengeluaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengeluaran = Pengeluaran::Find($id);
        $data_anggaran = Anggaran::all();
        $data_warga = DataWarga::all();
        $data_warga_program = AccessProgram::where('program_id', 1);
        return view('backend.transaksi.pengeluaran.edit', compact('data_pengeluaran', 'data_anggaran', 'data_warga', 'data_warga_program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate(
            [
                'pengaju_id' => 'required',
                'data_warga' => 'required',
                'anggaran_id' => 'required',
                'jumlah' => 'required',
                'keterangan' => 'required',
                'pengurus_id' => 'required',
            ],
            [
                'pengaju_id.required' => 'Anggota yang nginput kedah di isi',
                'data_warga.required' => 'Data Warga yang kedah di isi',
                'anggaran_id.required' => 'Anggaran kedah di isi',
                'jumlah.required' => 'Nominal kedah di isi',
                'keterangan.required' => 'Alasan kedah di isi',
                'pengurus_id.required' => 'Yang menyutujui kedah di isi',
            ]
        );
        $data_anggaran = Anggaran::find($request->anggaran_id);

        $data_pengeluaran = Pengeluaran::find($id);
        $data_pengeluaran->pengaju_id = $request->pengaju_id;
        $data_pengeluaran->pengurus_id = $request->pengurus_id;
        $data_pengeluaran->anggaran_id = $request->anggaran_id;
        $data_pengeluaran->data_warga_id = $request->data_warga;
        $data_pengeluaran->jumlah = $request->jumlah;
        $data_pengeluaran->alasan = $request->keterangan;
        $data_pengeluaran->ketua = $request->ketua;
        $data_pengeluaran->sekertaris = $request->sekertaris;
        $data_pengeluaran->bendahara = $request->bendahara;
        if ($request->status == true) {
            $data_pengeluaran->status = $request->status;
        }
        if ($request->tanggal == true) {
            $data_pengeluaran->tanggal = $request->tanggal;
            $data_pengeluaran->kode = $data_anggaran->kode . date('dmyhis', strtotime($request->tanggal));
        }

        $data_pengeluaran->update();
        return redirect()->back()->with('infoes', ' Data Pengeluaran atos di ganti, cek data lagi');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengeluaran = Pengeluaran::find($id);

        $data_pengeluaran->delete();

        return redirect()->back()->with('kuning', 'Data Parantos di hapus tina disimpen dina sampah )');
    }
    public function trash()
    {
        $data_pengeluaran = Pengeluaran::orderByRaw('created_at DESC')->onlyTrashed()->get();

        return view('backend.transaksi.pengeluaran.trash', compact('data_pengeluaran'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengeluaran = Pengeluaran::withTrashed()->findorfail($id);
        $data_pengeluaran->restore();
        return redirect()->back()->with('infoes', 'Data pengeluaran atos di kembalikeun deui tina sampah');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengeluaran = Pengeluaran::withTrashed()->findorfail($id);

        $data_pengeluaran->forceDelete();
        return redirect()->back()->with('kuning', 'Data pengeluaran parantos di hapus dina sampah');
    }

    public function pengeluaran_index()
    {


        //Untuk menyingkronkan data pasanhan
        $cek_user = User::find(Auth::user()->user_id);
        if (Auth::user()->user_id == false) {
            $data_user_hubungan = Auth::user()->data_warga_id;
        } else {
            $data_user_hubungan = $cek_user->data_warga_id;
        }
        //
        // untuk mengecek saldo pinjaman
        // untuk info saldo
        // data Pemasukan
        $data_pemasukan = Pemasukan::all();
        $total_pemasukan_kas = Pemasukan::where('kategori_id', '1')->sum('jumlah'); //Menghitung semua pemasukan kas
        $kas_dibagi2 = $total_pemasukan_kas / 2;
        $kas_pembagian = $kas_dibagi2 * 90 / 100;
        $total_dana_amal = $kas_dibagi2 * 10 / 100; //mengambil jumlah dana kas AMAL sebesar 10/100
        $total_dana_darurat = $kas_pembagian / 2; //mengambil jumlah dana darurat
        $total_dana_pinjam = $kas_pembagian / 2; //mengambil jumlah dana darurat
        $total_dana_kas = $kas_dibagi2; //mengambil jumlah dana darurat

        // data pengeluaran
        $data_pengeluaran = Pengeluaran::all();
        $total_pengeluaran_all = Pengeluaran::all()->sum('jumlah');
        $total_pengeluaran_darurat = Pengeluaran::where('anggaran_id', 1)->sum('jumlah');
        $total_pengeluaran_amal = Pengeluaran::where('anggaran_id', 2)->sum('jumlah');
        $total_pengeluaran_pinjaman = Pengeluaran::where('anggaran_id', 3)->sum('jumlah');
        $total_pengeluaran_usaha = Pengeluaran::where('anggaran_id', 4)->sum('jumlah');
        $total_pengeluaran_acara = Pengeluaran::where('anggaran_id', 5)->sum('jumlah');
        $total_pengeluaran_lain = Pengeluaran::where('anggaran_id', 6)->sum('jumlah');
        $total_pengeluaran_tarik_pinjaman = Pengeluaran::where('anggaran_id', 7)->sum('jumlah');



        $total_pengeluaran_kas = $total_pengeluaran_darurat + $total_pengeluaran_amal  + $total_pengeluaran_usaha + $total_pengeluaran_acara + $total_pengeluaran_lain;
        $total_pengeluaran_kas_3 = $total_pengeluaran_lain + $total_pengeluaran_usaha + $total_pengeluaran_acara;

        // Perhitungan uang yang masuk lewat Transfer
        $total_pembayaran_tf = Pemasukan::where('pembayaran', 'Transfer')->sum('jumlah');
        // Perhitungan uang yang masuk lewat cash
        $total_pembayaran_cash = Pemasukan::where('pembayaran', 'Cash')->sum('jumlah');
        // menghitung jumlah setor tunai
        $total_setor_tunai = Pemasukan::where('kategori_id', '3')->sum('jumlah');

        // Perhitungan saldo kas
        $saldo_kas = $total_pemasukan_kas - $total_pengeluaran_kas;
        // Perhitungan pembayaran pinjaman
        $total_bayar_pinjaman_semua = BayarPinjaman::all()->sum('jumlah');
        $total_bayar_pinjaman_lebih = BayarPinjaman::all()->sum('jumlah_lebih');
        $total_bayar_pinjaman_cash = BayarPinjaman::where('pembayaran', 'Cash')->sum('jumlah');
        $total_bayar_pinjaman_tf = BayarPinjaman::where('pembayaran', 'Transfer')->sum('jumlah');

        $total_sisa_pinjaman = $total_dana_pinjam -  $total_pengeluaran_pinjaman + $total_bayar_pinjaman_semua;

        // Perhitungan Tabungan
        $total_tabungan = Pemasukan::where('kategori_id', 2)->sum('jumlah');
        // Perhitungan nimonal di bank termasuk jumlah tabungan
        $saldo_bank = $total_pembayaran_tf - $total_pengeluaran_all + $total_bayar_pinjaman_tf;
        // Uang nu teu acan di transfer
        $uang_blum_diTF = $total_pembayaran_cash - $total_setor_tunai +  $total_bayar_pinjaman_cash;
        // ===========================================================

        $data_user = User::all();
        $data_pengeluaran_pinjaman = Pengeluaran::where('pengaju_id', $data_user_hubungan)->where('anggaran_id', 3); //mengambil data pinjaman user
        $data_pengeluaran_pinjaman_warga = Pengeluaran::where('data_warga_id', $data_user_hubungan)->where('anggaran_id', 3); //mengambil data pinjaman user
        $data_hubungan = HubunganWarga::where('warga_id', $data_user_hubungan)->get(); //mengambil data hubungan dengan anggota
        $data_warga = DataWarga::all(); //mengambil data data warga

        $cek_pengajuan = Pengajuan::where('data_warga_id', $data_user_hubungan)->where('kategori_id', 4)->count();
        $cek_pengajuan_proses = Pengajuan::where('pengaju_id', $data_user_hubungan)->get();

        $cek_pengeluaran_pinjaman = Pengeluaran::where('anggaran_id', 3)->where('status', 'Nunggak')->count(); //mengecek apakah pinjaman yang masih nunggak sudah melebihi batas yang telah di tentukan
        $cek_pengeluaran_pinjaman_user = Pengeluaran::where('anggaran_id', 3)->where('data_warga_id', $data_user_hubungan)->where('status', 'Nunggak')->count(); //mengecek pinjaman apakah sudah lunas atau masih nunggak

        // Data Anggaran
        $data_anggaran = Anggaran::all();
        $data_anggaran_max_pinjaman = Anggaran::find(3);
        $cek_semua_pemasukan = Pemasukan::where('kategori_id', 1)->sum('jumlah');
        $cek_pemasukan_2 = $cek_semua_pemasukan / 2; // Membagi jumlah semua pemasukan
        $tahap_1 = $cek_pemasukan_2 * 90 / 100; // Menghitung Jumlah anggaran pinjaman dari hasil pembagian 2,
        $cek_total_pinjaman = $tahap_1 / 2; // Menghitung total Anggaran
        $jatah = $cek_total_pinjaman * $data_anggaran_max_pinjaman->persen / 100; //Jath Persenan di ambil dari data anggaran

        $layout_pengeluaran = LayoutPengeluaran::first();

        return view('frontend.pengeluaran.pinjaman.index', compact(
            'data_user',
            'data_warga',
            'data_pengeluaran_pinjaman',
            'data_pengeluaran_pinjaman_warga',
            'data_hubungan',
            'cek_pengajuan',
            'cek_pengajuan_proses',
            'cek_pengeluaran_pinjaman',
            'cek_pengeluaran_pinjaman_user',
            'data_anggaran',
            'data_anggaran_max_pinjaman',
            'layout_pengeluaran',
            'cek_total_pinjaman',

            'total_pemasukan_kas',
            'total_pengeluaran_kas',
            'total_dana_amal',
            'total_dana_darurat',
            'total_dana_pinjam',
            'total_dana_kas',
            'total_pengeluaran_all',
            'total_pengeluaran_darurat',
            'total_pengeluaran_amal',
            'total_pengeluaran_pinjaman',
            'total_pengeluaran_usaha',
            'total_pengeluaran_acara',
            'total_pengeluaran_lain',
            'total_bayar_pinjaman_semua',
            'total_tabungan',
            'total_pengeluaran_tarik_pinjaman',
            'saldo_kas',
            'saldo_bank',
            'uang_blum_diTF',
            'total_pengeluaran_kas_3',
            'total_bayar_pinjaman_lebih',
            'jatah',
            'total_sisa_pinjaman',
            'data_user_hubungan'
        ));
    }

    public function laporan_pengeluaran()
    {
        $dana_darurat = Pengeluaran::orderByRaw('created_at DESC')->where('anggaran_id', 1)->get();
        $dana_amal = Pengeluaran::orderByRaw('created_at DESC')->where('anggaran_id', 2)->get();
        $dana_pinjam = Pengeluaran::orderByRaw('created_at DESC')->where('anggaran_id', 3)->get();
        $dana_usaha = Pengeluaran::orderByRaw('created_at DESC')->where('anggaran_id', 4)->get();
        $dana_acara = Pengeluaran::orderByRaw('created_at DESC')->where('anggaran_id', 5)->get();
        $dana_lain = Pengeluaran::orderByRaw('created_at DESC')->where('anggaran_id', 6)->get();
        $data_pemasukan = Pemasukan::orderByRaw('created_at DESC')->where('kategori_id', 1)->get();
        $data_file_laporan = FileLaporan::all();

        return view('frontend.pengeluaran.laporan.index', compact('dana_darurat', 'dana_amal', 'dana_pinjam', 'dana_usaha', 'dana_acara', 'dana_lain', 'data_pemasukan', 'data_file_laporan'));
    }

    public function detail_pengeluaran($id)
    {
        $id = Crypt::decrypt($id);

        $data_pengeluaran = Pengeluaran::Find($id);
        return view('frontend.pengeluaran.laporan.show', compact('data_pengeluaran'));
    }

    public function input_pengeluaran()
    {
        $data_anggaran = Anggaran::all();

        return view('frontend.pengeluaran.input_laporan', compact('data_anggaran'));
    }
    public function laporan_pinjaman_admin()
    {
        $laporan_pinjaman = Pengeluaran::orderByRaw('created_at DESC')->where('anggaran_id', 3)->get();

        return view('backend.transaksi.pinjaman.index', compact('laporan_pinjaman'));
    }
    public function pengeluaran_pinjaman(Request $request)
    {
        $request->validate([
            'pengaju_id' => 'required',
            'data_warga' => 'required',
            'kategori_id' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required',
            'bendahara' => 'required',
            'sekertaris' => 'required',
            'ketua' => 'required',
        ], [
            'pengaju.required' => 'Data Pengaju harus ada',
            'data_warga.required' => 'data_warga kedah di pilih',
            'kategori_id.required' => 'anggaran kedah di pilih',
            'jumlah.required' => 'Nominal kedah di isi',
            'jumlah.numeric' => 'Nominal teu kengeng kangge titik',
            'bendahara.required' => 'Laporan bendahara masih kosong',
            'sekertaris.required' => 'Laporan sekertaris masih kosong',
            'ketua.required' => 'laporan kedah di isian kedah di isi',
        ]);
        $data_anggaran = Anggaran::find($request->anggaran_id);

        $data_pengeluaran = new Pengeluaran();
        $data_pengeluaran->data_warga_id = $request->data_warga;
        $data_pengeluaran->pengaju_id = $request->pengaju_id;
        $data_pengeluaran->jumlah = $request->jumlah;
        $data_pengeluaran->alasan = $request->keterangan;
        $data_pengeluaran->tanggal = $request->tanggal;
        if ($request->kategori_id == 4) {
            $data_pengeluaran->anggaran_id = 3;
        } else {
            return redirect()->back()->with('kuning', 'Sorry bos anggaran tidak sesuai sareng data pinjaman');
        }
        // ini di ambil jika ada reques jika tidak kosongkan
        $data_pengeluaran->status          = $request->status;
        $data_pengeluaran->ketua          = $request->ketua;
        $data_pengeluaran->bendahara          = $request->bendahara;
        $data_pengeluaran->sekertaris          = $request->sekertaris;

        // ini untuk ngambil data dari penginputan dari d=form bayar
        $data_pengeluaran->pengurus_id = Auth::user()->data_warga_id;
        $data_pengeluaran->kode = $request->kode;

       //untuk pinjaman
       $saldo_akhir = Saldo::latest()->first(); //mengambil data yang terbaru
       $data_saldo = new Saldo();
       $data_saldo->id_transaksi = $request->kode  ;
        $data_saldo->saldo_atm_kas = $saldo_akhir->saldo_atm_kas - $request->jumlah ;
        $data_saldo->saldo_atm_tabungan = $saldo_akhir->saldo_atm_tabungan ;
        $data_saldo->total_diluar = $saldo_akhir->total_diluar;
        $data_saldo->total_kas = $saldo_akhir->total_kas -  $request->jumlah;
        $data_saldo->total_tabungan = $saldo_akhir->total_tabungan;
        $data_saldo->saldo_kas = $saldo_akhir->saldo_kas ;
        $data_saldo->saldo_darurat = $saldo_akhir->saldo_darurat ;
        $data_saldo->saldo_amal = $saldo_akhir->saldo_amal ;
        $data_saldo->saldo_pinjaman = $saldo_akhir->saldo_pinjaman -  $request->jumlah;
        $data_saldo->bunga_neo = $saldo_akhir->bunga_neo;
        $data_saldo->bunga_tabungan = $saldo_akhir->bunga_tabungan ;
        $data_saldo->jumlah_lebih_pinjaman = $saldo_akhir->jumlah_lebih_pinjaman;
        
        $data_saldo->save();


        // Untuk notif Wa
        $role_ketua = Role::where('nama_role', 'Ketua')->first(); //Untuk mengambil data sesuai nama role
        $ketua = User::where('role_id', $role_ketua->id)->first(); // mengambil satu data sesuai dengan role
        $role_bendahara = Role::where('nama_role', 'Bendahara')->first(); //Untuk mengambil data sesuai nama role
        $bendahara = User::where('role_id', $role_bendahara->id)->first(); // mengambil satu data sesuai dengan role
        $role_sekertaris = Role::where('nama_role', 'Sekertaris')->first(); //Untuk mengambil data sesuai nama role
        $sekertaris = User::where('role_id', $role_sekertaris->id)->first(); // mengambil satu data sesuai dengan role
        $role_penasehat = Role::where('nama_role', 'Penasehat')->first(); //Untuk mengambil data sesuai nama role
        $penasehat = User::where('role_id', $role_penasehat->id)->first(); // mengambil satu data sesuai dengan role

        $DataWarga = DataWarga::find($request->data_warga); //Untuk mengambil data Warga sesuai dengtan id pengaju
        $DataPengaju = DataWarga::find($request->pengaju_id); //Untuk mengambil data Warga sesuai dengtan id pengaju
        $Sekertaris = User::find($request->data_warga); //Untuk mengambil data Warga sesuai dengtan id pengaju
        $DataKategori = KategoriAnggaranProgram::find($request->kategori_id); //untuk mengambil data kategori
        $token = "@Mx6RkRVz60S#j8YGi6T";
        $target = "$bendahara->data_warga->no_hp, $penasehat->data_warga->no_hp, $DataWarga->no_hp";
        $nominal = number_format($request->jumlah, 2, ',', '.');
        $pengurus = Auth::User()->data_warga->nama;

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
                'message' => "Pesan Otomatis   
                
Alhamdulilah
Pengajuan atos di setujui atos di konfirmasi ku $pengurus dengan data sesuai di Handap

ID : $request->kode
Tanggal : $request->tanggal
Kategori : Pinjaman
Atas Nama : $DataWarga->nama
Yang mengajukan  : $DataPengaju->nama
Nominal : Rp.$nominal
Pengambilan : $request->pembayaran

Status : Proses

Pinjaman atos di setujui kantun ngambil artosna, Nuhun

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
        $data_pengeluaran->save();

        // jika ada pengajuan ID hapus
        if ($request->pengajuan_id) {
            $pengajuan = Pengajuan::find($request->pengajuan_id);
            $pengajuan->delete();
        }
        return redirect('/pengajuans/pinjam')->with('sukses', 'Wihhhh mantappp hatur nuhun atos ngaKONFIRMASI pengajuan pemabyaran KAS keluarga. Lancar selalu');
    }
}
