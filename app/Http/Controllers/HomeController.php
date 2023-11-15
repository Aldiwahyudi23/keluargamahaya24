<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccessMenu;
use App\Models\AccessSubMenu;
use App\Models\BayarPinjaman;
use App\Models\LayoutAppUser;
use App\Models\Menu;
use App\Models\MenuFooter;
use App\Models\Pemasukan;
use App\Models\Pengajuan;
use App\Models\Pengeluaran;
use App\Models\User;
use Database\Seeders\AccessSubMenuSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data_login = User::select('*')
            ->whereNotNull('last_seen')
            ->orderBy('last_seen', 'DESC')
            ->paginate();


        $access_menu = AccessMenu::where('role_id', Auth::user()->role_id)->get();
        $sub_menu = AccessSubMenu::where('menu_id', 11)->where('user_id', Auth::user()->id)->get(); //mengambil datda dari home accessubmenu , , 

        // untuk tampilan proses pemasukan dan pengluaran
        $data_pemasukan_baru = Pemasukan::orderByRaw('created_at DESC LIMIT 5')->where('kategori_id', '1')->get();
        $data_pengeluaran_baru = Pengeluaran::orderByRaw('created_at DESC LIMIT 5')->get();
        $data_pengajuan_baru =  Pengajuan::orderByRaw('created_at DESC LIMIT 5')->get();


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


        // Perhitungan Tabungan
        $total_tabungan = Pemasukan::where('kategori_id', 2)->sum('jumlah');
        // Perhitungan nimonal di bank termasuk jumlah tabungan
        $saldo_bank = $total_pembayaran_tf - $total_pengeluaran_all + $total_bayar_pinjaman_tf;
        // Uang nu teu acan di transfer
        $uang_blum_diTF = $total_pembayaran_cash - $total_setor_tunai +  $total_bayar_pinjaman_cash;
        // ===========================================================

        return view('home', compact(
            'access_menu',
            'sub_menu',
            'data_login',
            'data_pemasukan_baru',
            'data_pengeluaran_baru',
            'data_pengajuan_baru',

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
            'total_bayar_pinjaman_lebih'
        ));
    }
    public function setting()
    {
        $title = MenuFooter::find(5);
        $data_layout_app = LayoutAppUser::where('user_id', Auth::user()->id)->first();

        return view('frontend.setting.index', compact('data_layout_app', 'title'));
    }

    public function simulasi_kredit()
    {
        return view('kredit.index');
    }
}
