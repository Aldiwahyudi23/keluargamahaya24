<?php

namespace App\Http\Controllers;

use App\Models\BayarPinjaman;
use App\Http\Controllers\Controller;
use App\Models\AccessProgram;
use App\Models\DataWarga;
use App\Models\KategoriAnggaranProgram;
use App\Models\LayoutPengeluaran;
use App\Models\Pengajuan;
use App\Models\Pengeluaran;
use App\Models\Role;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BayarPinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_bayar_pinjaman = BayarPinjaman::orderByRaw('created_at DESC')->get();
        $data_warga_program = AccessProgram::where('program_id', 1);
        $data_kategori = KategoriAnggaranProgram::all();
        $data_pinjaman = Pengeluaran::where('anggaran_id', 3)->where('status', "Nunggak");
        $data_pinjaman_all = Pengeluaran::orderByRaw('created_at DESC')->where('anggaran_id', 3);




        return view('backend.transaksi.bayar_pinjaman.index', compact('data_bayar_pinjaman', 'data_warga_program', 'data_kategori', 'data_pinjaman', 'data_pinjaman_all'));
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
            'pembayaran' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required',
        ], [
            'data_warga.required' => 'data warga kedah di pilih',
            'pembayaran.required' => 'Pembayaran kedah di pilih',
            'jumlah.required' => 'Nominal kedah di isi',
            'jumlah.numeric' => 'Nominal teu kengeng kangge titik',
            'keterangan.required' => 'keterangan kedah di isi',
        ]);

        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'bukti-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/bukti'), $nama);
        }

        $data_pemasukan = new BayarPinjaman();
        $data_pemasukan->data_warga_id = $request->data_warga;
        $data_pemasukan->pengaju_id = $request->pengaju_id;
        $data_pemasukan->pembayaran = $request->pembayaran;
        $data_pemasukan->pengeluaran_id = $request->pengeluaran_id;
        $data_pemasukan->keterangan = $request->keterangan;
        $data_pemasukan->tanggal = $request->tanggal;
        $data_pemasukan->kode = $request->kode;
        $data_pemasukan->pengurus_id = Auth::user()->data_warga_id;

        if ($request->foto) {
            $data_pemasukan->foto          = "/img/bukti/$nama";
        }
        if ($request->foto1) {
            $data_pemasukan->foto          = $request->foto1;
        }

        $cek_pinjaman = Pengeluaran::Find($request->pengeluaran_id); // mengambil data dari pengeluaran sesuai id 
        $jumlah_pinjaman = $cek_pinjaman->jumlah; //jumlah pinjaman tina data nu di luhur

        $cek_bayarpinjaman = BayarPinjaman::where('pengeluaran_id', $request->pengeluaran_id)->sum('jumlah');
        $jumlah_bayarpinjaman = $cek_bayarpinjaman + $request->jumlah;

        if ($jumlah_bayarpinjaman >= $jumlah_pinjaman) {
            $data_pemasukan->jumlah = $jumlah_pinjaman - $cek_bayarpinjaman;
            $data_pemasukan->jumlah_lebih = $jumlah_bayarpinjaman - $jumlah_pinjaman;
        } else {
            $data_pemasukan->jumlah = $request->jumlah;
            $data_pemasukan->jumlah_lebih = 0;
        }

        // Untuk notif Wa
        $role_ketua = Role::where('nama_role', 'Ketua')->first(); //Untuk mengambil data sesuai nama role
        $ketua = User::where('role_id', $role_ketua->id)->first(); // mengambil satu data sesuai dengan role
        $role_bendahara = Role::where('nama_role', 'Bendahara')->first(); //Untuk mengambil data sesuai nama role
        $bendahara = User::where('role_id', $role_bendahara->id)->first(); // mengambil satu data sesuai dengan role
        $role_sekertaris = Role::where('nama_role', 'Sekertaris')->first(); //Untuk mengambil data sesuai nama role
        $sekertaris = User::where('role_id', $role_sekertaris->id)->first(); // mengambil satu data sesuai dengan role
        $role_penasehat = Role::where('nama_role', 'Penasehat')->first(); //Untuk mengambil data sesuai nama role
        $penasehat = User::where('role_id', $role_penasehat->id)->first(); // mengambil satu data sesuai dengan role

        $DataPengaju = DataWarga::find($request->pengaju_id); //Untuk mengambil data Warga sesuai dengtan id pengaju
        $DataWarga = DataWarga::find($request->data_warga); //Untuk mengambil data Warga sesuai dengtan id pengaju
        $token = "@Mx6RkRVz60S#j8YGi6T";
        $target = "$ketua->data_warga->no_hp,$DataWarga";
        $nominal = number_format($request->jumlah, 2, ',', '.');
        $pengurus = User::Find(auth::user()->id);
        $pengurus_acc = $pengurus->data_warga->nama;

        if ($jumlah_bayarpinjaman - $jumlah_pinjaman >= 0) {
            $RpSisaHutang = "LUNAS";
            $Lebih = $jumlah_bayarpinjaman - $jumlah_pinjaman;
            $RpLebih = number_format($Lebih, 2, ',', '.');
        } else {
            $SisaHutang = $jumlah_pinjaman - $jumlah_bayarpinjaman;
            $RpSisaHutang = number_format($SisaHutang, 2, ',', '.');
            $RpLebih = "Masih proses Pembayaran";
        }

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
                'message' => "Assalamualaikum palawargi

                        Pesan Otomatis       

Info ti pusattt
Pengajuan pembayaran pinjaman atos di setujui atos di konfirmasi ku $pengurus_acc dengan data sesuai di Handap

ID : $data_pemasukan->kode
Tanggal : $request->tanggal
Atas Nama : $DataWarga->nama
Yang mengajukan  : $DataPengaju->nama
Nominal : Rp.$nominal /$request->pembayaran

Sisa hutang : Rp.$RpSisaHutang
Lebih : Rp.$RpLebih

Mudah mudahan bermanfaat kanggo sadayana , tetep kedah kerjasama kanggo kalancaran program ieu, Nhun

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

        $data_pemasukan->save();
        //jika pembayaran Lunas Keterangan dina data pengeluaran berubah
        // Sekalian Edit pengeluaran

        if ($jumlah_bayarpinjaman >= $jumlah_pinjaman) {
            $data_pengeluaran = Pengeluaran::find($request->pengeluaran_id);
            $data_pengeluaran->status = "Lunas";
            $data_pengeluaran->update();
        }
        // jika ada pengajuan ID hapus
        if ($request->pengajuan_id) {
            $pengajuan = Pengajuan::find($request->pengajuan_id);
            $pengajuan->delete();


            return redirect('/pengajuans/kas')->with('sukses', 'Wihhhh mantappp hatur nuhun atos ngaKONFIRMASI pengajuan pemabyaran KAS keluarga. Lancar selalu');
        }
        return redirect()->back()->with('sukses', 'Wihhhh mantappp hatur nuhun data atos masuk. Lancar selalu');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data_bayar_pinjaman = BayarPinjaman::find($id);
        return view('backend.transaksi.bayar_pinjaman.show', compact('data_bayar_pinjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data_bayar_pinjaman = BayarPinjaman::find($id);
        $data_warga = DataWarga::all();
        $data_anggota = User::all();
        $data_pinjaman = Pengeluaran::where('anggaran_id', 3)->where('status', "Nunggak");

        return view('backend.transaksi.bayar_pinjaman.edit', compact('data_bayar_pinjaman', 'data_pinjaman', 'data_anggota', 'data_warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'bukti-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/bukti'), $nama);
        }

        $data_pemasukan = BayarPinjaman::find($id);
        $data_pemasukan->data_warga_id = $request->data_warga;
        $data_pemasukan->pengaju_id = $request->pengaju_id;
        $data_pemasukan->pembayaran = $request->pembayaran;
        $data_pemasukan->pengeluaran_id = $request->pengeluaran_id;
        $data_pemasukan->keterangan = $request->keterangan;
        $data_pemasukan->jumlah = $request->jumlah;

        if ($request->kode == false) {
            $data_pemasukan->kode = "BP" . date('dmyhis', strtotime($request->tanggal));
        }

        if ($request->foto) {
            $data_pemasukan->foto          = "/img/bukti/$nama";
        }

        $data_pemasukan->update();
        return redirect()->back()->with('infoes', 'data sudah di edit');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data_bayar_pinjaman = BayarPinjaman::find($id);

        $data_bayar_pinjaman->delete();

        return redirect()->back()->with('kuning', 'Data Parantos di hapus tina disimpen dina sampah )');
    }
    public function trash()
    {
        $data_bayar_pinjaman = BayarPinjaman::orderByRaw('created_at DESC')->onlyTrashed()->get();

        return view('backend.transaksi.bayar_pinjaman.trash', compact('data_bayar_pinjaman'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_bayar_pinjaman = BayarPinjaman::withTrashed()->findorfail($id);
        $data_bayar_pinjaman->restore();
        return redirect()->back()->with('infoes', 'Data bayar pinjaman atos di kembalikeun deui tina sampah');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_bayar_pinjaman = BayarPinjaman::withTrashed()->findorfail($id);

        $data_bayar_pinjaman->forceDelete();
        return redirect()->back()->with('kuning', 'Data bayar pinjaman parantos di hapus dina sampah');
    }
    public function form_bayar_pinjaman($id)
    {
        $id = Crypt::decrypt($id);
        $data_setor = Pengeluaran::orderByRaw('created_at DESC')->get();
        $data_data_warga = User::orderByRaw('name ASC')->get();

        // cek pengajuan
        $id_user = User::find(Auth::user()->id); // mengambil data user yang login
        $data_keluarga = DataWarga::find($id_user->keluarga_id); //mengambil data dari data keluarga sesuai dengan id dari yang login

        $cek_pengajuan = Pengajuan::where('kategori_id', '6')->where('data_warga_id', Auth::user()->data_warga_id)->count();

        $layout_pengeluaran = LayoutPengeluaran::first(); //Mengambil Layout data pengeluaran untuk batar pinjam


        $bayar_pinjam = BayarPinjaman::where('pengeluaran_id', $id)->get();
        $total_bayar_pinjam = BayarPinjaman::where('pengeluaran_id', $id)->sum('jumlah');
        $data_pinjaman = Pengeluaran::find($id);

        return view('frontend.pemasukan.bayar_pinjaman.form_bayar_pinjam', compact(
            'data_pinjaman',
            'data_setor',
            'data_data_warga',
            'bayar_pinjam',
            'total_bayar_pinjam',
            'cek_pengajuan',
            'layout_pengeluaran'
        ));
    }
    public function lihat_data_bayar($id)
    {
        $id = Crypt::decrypt($id);
        $data_bayar_pinjaman = BayarPinjaman::find($id);

        return view('frontend.pemasukan.bayar_pinjaman.show', compact('data_bayar_pinjaman'));
    }
}
