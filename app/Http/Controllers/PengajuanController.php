<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Http\Controllers\Controller;
use App\Models\AccessProgram;
use App\Models\Anggaran;
use App\Models\DataWarga;
use App\Models\HubunganWarga;
use App\Models\KategoriAnggaranProgram;
use App\Models\Pengeluaran;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PHPUnit\Framework\TestSize\Known;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pengajuan = Pengajuan::all();

        return view('backend.transaksi.pengajuan.index', compact('pengajuan'));
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
            'jumlah' => 'required',
            'pembayaran' => 'required',
            'keterangan' => 'required',
        ], [
            'jumlah.required' => "Nominal kedah di isi, kade tong ngange titik atau koma",
            'pembayaran.required' => "Metode Pembayaran kedah di pilih, Transfer atau Uang tunai",
            'keterangan.required' => "Keterangan kedah di isi secara detail",
        ]);

        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'bukti-' . date('Y-m-dhis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/bukti'), $nama);
        }

        $tanggal = Carbon::now();
        $data_ketegori = KategoriAnggaranProgram::find($request->kategori_id);

        // jika pembayaran transfer
        if ($request->no_req) {
            $pembayaran = $request->keterangan . "<br>" . "No Req / E-wallet    :" . $request->no_req . "<br>" . "Nama Bank    :" . $request->nama_bank . "<br>" . "Atas Nama    :" . $request->ana;
        }
        if ($request->pengambilan) {
            $pembayaran = $request->keterangan . "<br>" . "Akan di Ambil secara     :" . $request->pengambilan;
        }

        $data_pengajuan = new Pengajuan();
        $data_pengajuan->kode = $data_ketegori->kode . date('dmyhis');
        $data_pengajuan->jumlah = $request->jumlah;
        $data_pengajuan->pembayaran = $request->pembayaran;
        $data_pengajuan->data_warga_id = $request->data_warga;
        $data_pengajuan->pengaju_id = $request->pengaju_id;
        $data_pengajuan->kategori_id = $request->kategori_id;
        $data_pengajuan->tanggal = $tanggal;
        $data_pengajuan->status = "Proses";

        if ($request->kategori_id == 5) {
            $data_pengajuan->keterangan = $pembayaran;
        } else {
            $data_pengajuan->keterangan = $request->keterangan;
        }

        if ($request->foto) {
            $data_pengajuan->foto = "/img/bukti/$nama";
        }
        if ($request->pengeluaran_id) {
            $data_pengajuan->pengeluaran_id = $request->pengeluaran_id;
        }

        // Untuk notif Wa

        // sampe die
        // jang pengurus

        // ============================


        $data_pengajuan->save();

        return redirect()->back()->with('sukses', 'Wihhhhh Alhamdulilahhh pengajuan nuju di proses heula nya, antosan sakedap. Hatur Nuhun Pisan');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengajuan = Pengajuan::Find($id);


        if ($data_pengajuan->kategori_id == 1) {
            return view('backend.transaksi.pengajuan.konfirmasi.kas', compact('data_pengajuan'));
        } elseif ($data_pengajuan->kategori_id == 2) {
            return view('backend.transaksi.pengajuan.konfirmasi.kas', compact('data_pengajuan'));
        } elseif ($data_pengajuan->kategori_id == 3) {
            return view('backend.transaksi.pengajuan.konfirmasi.kas', compact('data_pengajuan'));
        } elseif ($data_pengajuan->kategori_id == 4) {
            return view('backend.transaksi.pengajuan.konfirmasi.pinjaman', compact('data_pengajuan'));
        } elseif ($data_pengajuan->kategori_id == 5) {
            return view('backend.transaksi.pengajuan.konfirmasi.tarik_tunai', compact('data_pengajuan'));
        } elseif ($data_pengajuan->kategori_id == 6) {
            return view('backend.transaksi.pengajuan.konfirmasi.bayar_pinjaman', compact('data_pengajuan'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengajuan = Pengajuan::Find($id);
        $data_kategori = KategoriAnggaranProgram::all();
        $data_warga = DataWarga::all();
        $data_warga_program = AccessProgram::where('program_id', 1);

        $data_pinjaman = Pengeluaran::where('anggaran_id', 3)->where('status', "Nunggak");

        return view('backend.transaksi.pengajuan.edit', compact('data_pengajuan', 'data_kategori', 'data_warga', 'data_warga_program', 'data_pinjaman'));
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
                'kategori_id' => 'required',
                'jumlah' => 'required',
                'keterangan' => 'required',
            ],
            [
                'pengaju_id.required' => 'Anggota yang nginput kedah di isi',
                'data_warga.required' => 'Data Warga yang kedah di isi',
                'kategori_id.required' => 'kategori kedah di isi',
                'jumlah.required' => 'Nominal kedah di isi',
                'keterangan.required' => 'Alasan kedah di isi',
            ]
        );

        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'bukti-' . date('Y-m-dhis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/bukti'), $nama);
        }

        $data_pengajuan = Pengajuan::find($id);
        $data_pengajuan->pengaju_id = $request->pengaju_id;
        $data_pengajuan->kategori_id = $request->kategori_id;
        $data_pengajuan->data_warga_id = $request->data_warga;
        $data_pengajuan->jumlah = $request->jumlah;
        $data_pengajuan->keterangan = $request->keterangan;
        $data_pengajuan->ketua = $request->ketua;
        $data_pengajuan->sekertaris = $request->sekertaris;
        $data_pengajuan->bendahara = $request->bendahara;
        if ($request->tanggal == true) {
            $data_pengajuan->tanggal = $request->tanggal;
        }
        if ($request->foto) {
            $data_pengajuan->foto = "/img/bukti/$nama";
        }


        $data_pengajuan->update();
        return redirect()->back()->with('infoes', ' Data Pengajuan atos di ganti, cek data lagi');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengajuan = Pengajuan::find($id);

        $data_pengajuan->delete();

        return redirect()->back()->with('kuning', 'Data Parantos di hapus tina disimpen dina sampah )');
    }
    public function trash()
    {
        $data_pengajuan = Pengajuan::orderByRaw('created_at DESC')->onlyTrashed()->get();

        return view('backend.transaksi.pengajuan.trash', compact('data_pengajuan'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengajuan = Pengajuan::withTrashed()->findorfail($id);
        $data_pengajuan->restore();
        return redirect()->back()->with('infoes', 'Data pengajuan atos di kembalikeun deui tina sampah');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengajuan = Pengajuan::withTrashed()->findorfail($id);

        $data_pengajuan->forceDelete();
        return redirect()->back()->with('kuning', 'Data pengajuan parantos di hapus dina sampah');
    }

    // Pengajuan ==================================================================================================
    public function index_pemasukan()
    {
        $data_pengajuan = Pengajuan::orderByRaw('created_at DESC')->where('kategori_id', 1)->get();

        return view('frontend.pengajuan.index', compact('data_pengajuan'));
    }
    // ------------------------------------------------------------------------------------------------------------
    // Pengluaran==================================================================================================
    public function index_tabungan()
    {
        $data_pengajuan = Pengajuan::orderByRaw('created_at DESC')->where('kategori_id', 2)->get();

        return view('frontend.pengajuan.index', compact('data_pengajuan'));
    }
    // -----------------------------------------------------------------------------------------------------------
    // Pengluaran==================================================================================================
    public function tarik_tabungan()
    {
        $data_pengajuan = Pengajuan::orderByRaw('created_at DESC')->where('kategori_id', 5)->get();

        return view('frontend.pengajuan.index', compact('data_pengajuan'));
    }
    // -----------------------------------------------------------------------------------------------------------
    // Pinjaman ==================================================================================================
    public function index_pinjam()
    {
        $data_pengajuan = Pengajuan::orderByRaw('created_at DESC')->where('kategori_id', 4)->get();

        return view('frontend.pengajuan.index', compact('data_pengajuan'));
    }
    // ------------------------------------------------------------------------------------------------------------
    // Bayar Pinjaman =============================================================================================
    public function index_bayar_pinjam()
    {
        $data_pengajuan = Pengajuan::orderByRaw('created_at DESC')->where('kategori_id', 6)->get();

        return view('frontend.pengajuan.index', compact('data_pengajuan'));
    }
    // ------------------------------------------------------------------------------------------------------------

    public function pengajuan_user($id)
    {
        $id = Crypt::decrypt($id);

        $data_pengajuan = Pengajuan::Find($id);
        return view('frontend.pengajuan.show', compact('data_pengajuan'));
    }

    public function edit_user($id)
    {
        $id = Crypt::decrypt($id);
        $data_pengajuan = Pengajuan::Find($id);
        $data_kategori = KategoriAnggaranProgram::all();
        $data_warga = DataWarga::all();

        $data_hubungan = HubunganWarga::where('warga_id', Auth::user()->data_warga_id)->get(); //mengambil data hubungan dengan anggota

        return view('frontend.pengajuan.edit_user', compact('data_pengajuan', 'data_warga', 'data_kategori', 'data_hubungan'));
    }

    public function store_pinjaman(Request $request)
    {
        $request->validate([
            'jumlah' => 'required',
            'pembayaran' => 'required',
            'keterangan' => 'required',
        ], [
            'jumlah.required' => "Nominal kedah di isi, kade tong ngange titik atau koma",
            'pembayaran.required' => "Metode Pembayaran kedah di pilih, Transfer atau Uang tunai",
            'keterangan.required' => "Keterangan kedah di isi secara detail",
        ]);

        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'bukti-' . date('Y-m-dhis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/bukti'), $nama);
        }

        $tanggal = Carbon::now();
        $data_anggaran = Anggaran::find(3);
        $data_ketegori = KategoriAnggaranProgram::find($request->kategori_id);

        if ($request->jumlah > $data_anggaran->persen) {
            return redirect()->back()->with('kuning', 'Hapunten pisan Max Nominal Pinjaman teu kenging lebih ti Rp.500.000, punten input sesuai kesepakatan');
        } else {

            // jika pembayaran transfer
            if ($request->no_req) {
                $pembayaran = $request->keterangan . "<br>" . "No Req / E-wallet    :" . $request->no_req . "<br>" . "Nama Bank    :" . $request->nama_bank . "<br>" . "Atas Nama    :" . $request->ana . "<br>" . "Tanggal di Kembalikan    :" . $request->tanggal_pengembalian;
            }
            if ($request->pengambilan) {
                $pembayaran = $request->keterangan . "<br>" . "Akan di Ambil secara     :" . $request->pengambilan . "<br>" . "Tanggal di Kembalikan    :" . $request->tanggal_pengembalian;
            }

            $data_pengajuan = new Pengajuan();
            $data_pengajuan->kode = $data_ketegori->kode . date('dmyhis');
            $data_pengajuan->jumlah = $request->jumlah;
            $data_pengajuan->pembayaran = $request->pembayaran;
            $data_pengajuan->data_warga_id = $request->data_warga;
            $data_pengajuan->pengaju_id = $request->pengaju_id;
            $data_pengajuan->kategori_id = $request->kategori_id;
            $data_pengajuan->tanggal = $tanggal;
            $data_pengajuan->status = "Proses";

            if ($request->kategori_id == 4) {
                $data_pengajuan->keterangan = $pembayaran;
            } else {
                $data_pengajuan->keterangan = $request->keterangan;
            }
            if ($request->pengeluaran_id) {
                $data_pengajuan->pengeluaran_id = $request->pengeluaran_id;
            }
            if ($request->sekertaris) {
                $data_pengajuan->sekertaris = $request->sekertaris;
            }
            if ($request->bendahara) {
                $data_pengajuan->bendahara = $request->bendahara;
            }
            if ($request->foto) {
                $data_pengajuan->foto = "/img/bukti/$nama";
            }

            // Untuk notif Wa

            // sampe die
            // jang pengurus

            // ============================


            $data_pengajuan->save();

            return redirect()->back()->with('sukses', 'Wihhhhh Alhamdulilahhh pengajuan pinjaman atos ka kirim, nuju di proses heula nya, antosan 1x24 jam, Soal na pengurus na nuju sibuk damel. Hatur Nuhun Pisan');
        }
    }
    public function cekPengajuan()
    {
        // Lakukan logika untuk memeriksa apakah ada data masuk di pengajuan
        $adaDataPengajuan = Pengajuan::whereNull('deleted_at')->exists();

        return response()->json(['adaDataPengajuan' => $adaDataPengajuan]);
    }
}
