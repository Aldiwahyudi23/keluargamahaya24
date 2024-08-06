<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BayarPinjaman;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Saldo;
use App\Models\Konter;
use Illuminate\Http\Request;

class LaporanSaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    
    {
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


        // Perhitungan Tabungan
        $total_tabungan = Pemasukan::where('kategori_id', 2)->sum('jumlah');
        // Perhitungan nimonal di bank termasuk jumlah tabungan
        $saldo_bank = $total_pembayaran_tf - $total_pengeluaran_all + $total_bayar_pinjaman_tf;
        // Uang nu teu acan di transfer
        $uang_blum_diTF = $total_pembayaran_cash - $total_setor_tunai +  $total_bayar_pinjaman_cash;
        
                // Perhitungan Tabungan
        $total_bunga_neo = Pemasukan::where('kategori_id', 7)->sum('jumlah');
        // Perhitungan Tabungan
        $total_bunga_tabungan = Pemasukan::where('kategori_id', 8)->sum('jumlah');
        
        
        $saldo_2_data = Saldo::latest()->take(2)->get()->reverse();
    
    $saldo_akhir = Saldo::latest()->first(); //mengambil data yang terbaru


        return view('backend.master_data.data_saldo.index', compact(
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
            'total_bunga_neo',
            'total_bunga_tabungan',
            'saldo_2_data',
            'saldo_akhir',
            
        ));
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
        
      if($saldo_akhir_saldo_kas < $request->jumlah){ 
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
        $data_saldo->saldo_atm_kas = $saldo_akhir->saldo_atm_kas - $lain - $darurat - $amal ;
        $data_saldo->saldo_atm_tabungan = $saldo_akhir->saldo_atm_tabungan - $tabungan ;
        $data_saldo->total_diluar = $saldo_akhir->total_diluar;
        $data_saldo->total_kas = $saldo_akhir->total_kas -  $lain - $darurat - $amal;
        $data_saldo->total_tabungan = $saldo_akhir->total_tabungan - $tabungan;
        $data_saldo->saldo_darurat = $saldo_akhir->saldo_darurat - $darurat ;
        $data_saldo->saldo_amal = $saldo_akhir->saldo_amal - $amal ;
        $data_saldo->saldo_pinjaman = $saldo_akhir->saldo_pinjaman;
        
        $data_saldo->saldo_kas = $saldo_akhir->saldo_kas - $kas ;
        $data_saldo->bunga_neo = $saldo_akhir->bunga_neo;
        $data_saldo->bunga_tabungan = $saldo_akhir->bunga_tabungan ;
        $data_saldo->jumlah_lebih_pinjaman = $saldo_akhir->jumlah_lebih_pinjaman;
        
        
        $data_saldo->save();
        
        Return redirect()->back()->with('sukses',"cocok");
        
        
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

    public function laporan_saldo()
    {
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


        // Perhitungan Tabungan
        $total_tabungan = Pemasukan::where('kategori_id', 2)->sum('jumlah');
        // Perhitungan nimonal di bank termasuk jumlah tabungan
        $saldo_bank = $total_pembayaran_tf - $total_pengeluaran_all + $total_bayar_pinjaman_tf;
        // Uang nu teu acan di transfer
        $uang_blum_diTF = $total_pembayaran_cash - $total_setor_tunai +  $total_bayar_pinjaman_cash;
        
                // Perhitungan Tabungan
        $total_bunga_neo = Pemasukan::where('kategori_id', 7)->sum('jumlah');
        // Perhitungan Tabungan
        $total_bunga_tabungan = Pemasukan::where('kategori_id', 8)->sum('jumlah');


        return view('frontend.home.laporan_saldo.laporan_umum', compact(
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
            'total_bunga_neo',
            'total_bunga_tabungan'
            
        ));
    }
    public function laporan_saldo_admin()
    {
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


        // Perhitungan Tabungan
        $total_tabungan = Pemasukan::where('kategori_id', 2)->sum('jumlah');
        // Perhitungan nimonal di bank termasuk jumlah tabungan
        $saldo_bank = $total_pembayaran_tf - $total_pengeluaran_all + $total_bayar_pinjaman_tf;
        // Uang nu teu acan di transfer
        $uang_blum_diTF = $total_pembayaran_cash - $total_setor_tunai +  $total_bayar_pinjaman_cash;
        
                // Perhitungan Tabungan
        $total_bunga_neo = Pemasukan::where('kategori_id', 7)->sum('jumlah');
        // Perhitungan Tabungan
        $total_bunga_tabungan = Pemasukan::where('kategori_id', 8)->sum('jumlah');
        
        
        $saldo_2_data = Saldo::latest()->take(2)->get()->reverse();
        $kredit_sum = Saldo::sum('kredit');
    
    $saldo_akhir = Saldo::latest()->first(); //mengambil data yang terbaru
    $jumlah_konter =Konter::where('status', 'Belum Lunas')->sum('harga');
        $tagihan_konter =Konter::where('status', 'Belum Lunas')->sum('tagihan');
     $margin_konter =Konter::where('status', 'Lunas')->sum('margin');
     $diskon_konter_all =Konter::sum('diskon');
     $margin_konter_BLunas =Konter::where('status', 'Belum Lunas')->sum('margin');
      $diskon_konter =Konter::where('status', 'Lunas')->sum('diskon');
      $diskon_konter_BLunas =Konter::where('status', 'Belum Lunas')->sum('diskon');
      $jumlah_konter_Ukeluar =Konter::where('status', 'Belum Lunas')->sum('uang_keluar');


        return view('frontend.home.laporan_saldo.laporan_admin', compact(
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
            'total_bunga_neo',
            'total_bunga_tabungan',
            'saldo_2_data',
            'saldo_akhir',
            'margin_konter',
            'tagihan_konter',
            'diskon_konter',
            'jumlah_konter',
            'diskon_konter_BLunas',
            'margin_konter_BLunas',
            'kredit_sum',
            'jumlah_konter_Ukeluar',
            'diskon_konter_all',
        ));
    }
}
