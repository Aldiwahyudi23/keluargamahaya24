<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Http\Controllers\Controller;
use App\Models\Access_Pemasukan;
use App\Models\AccessProgram;
use App\Models\DataWarga;
use App\Models\HubunganWarga;
use App\Models\KategoriAnggaranProgram;
use App\Models\Layout_Pemasukan;
use App\Models\LayoutPengeluaran;
use App\Models\Pengajuan;
use App\Models\Program;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_pemasukan = Pemasukan::orderByRaw('created_at DESC')->get();
        $data_warga_program = AccessProgram::where('program_id', 1);
        $data_kategori = KategoriAnggaranProgram::all();

        return view('backend.transaksi.pemasukan.index', compact('data_pemasukan', 'data_warga_program', 'data_kategori'));
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
            'kategori_id' => 'required',
            'pembayaran' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required',
        ], [
            'data_warga.required' => 'data_warga kedah di pilih',
            'kategori_id.required' => 'Kategori kedah di pilih',
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
        $data_ketegori = KategoriAnggaranProgram::find($request->kategori_id);

        $data_pemasukan = new Pemasukan();
        $data_pemasukan->data_warga_id = $request->data_warga;
        $data_pemasukan->pengaju_id = $request->pengaju_id;
        $data_pemasukan->jumlah = $request->jumlah;
        $data_pemasukan->pembayaran = $request->pembayaran;
        $data_pemasukan->kategori_id = $request->kategori_id;
        $data_pemasukan->keterangan = $request->keterangan;
        $data_pemasukan->tanggal = $request->tanggal;

        if ($request->foto) {
            $data_pemasukan->foto          = "/img/bukti/$nama";
        }
        if ($request->foto1) {
            $data_pemasukan->foto          = $request->foto1;
        }
        // ini untuk penginputan kusus admin
        if ($request->cek_data == "input_admin") {
            $data_pemasukan->pengurus_id = $request->pengurus_id;
            $data_pemasukan->kode =  $data_ketegori->kode . date('dmyhis', strtotime($request->tanggal));
        }
        // ini untuk ngambil data dari penginputan dari d=form bayar
        if ($request->cek_data == "admin") {
            $data_pemasukan->pengurus_id = Auth::user()->data_warga_id;
            $data_pemasukan->kode = $data_ketegori->kode . date('dmyhis');
        } elseif ($request->cek_data == "input_admin") {
            $data_pemasukan->pengurus_id = $request->pengurus_id;
            $data_pemasukan->kode =  $data_ketegori->kode . date('dmyhis', strtotime($request->tanggal));
        } else {
            $data_pemasukan->pengurus_id = Auth::user()->data_warga_id;
            $data_pemasukan->kode = $request->kode; //jika kode ini di ambil dari pengajuan maka ngambil dari sini
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
        $DataKategori = KategoriAnggaranProgram::find($request->kategori_id); //untuk mengambil data kategori
        $token = "@Mx6RkRVz60S#j8YGi6T";
        $target = "$ketua->data_warga->no_hp, $DataWarga->no_hp";
        $nominal = number_format($request->jumlah, 2, ',', '.');
        $pengurus = User::Find(auth::user()->id);
        $pengurus_acc = $pengurus->data_warga->nama;

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
Pengajuan atos di setujui atos di konfirmasi ku $pengurus_acc dengan data sesuai di Handap

ID : $data_pemasukan->kode
Tanggal : $request->tanggal
Kategori : $DataKategori->nama_kategori
Atas Nama : $DataWarga->nama
Yang mengajukan  : $DataPengaju->nama
Nominal : Rp.$nominal /$request->pembayaran

STATUS : SUKSES

Hatur Nuhun sagede badag atos pasrtisipasi kana program ieu,  kuyyy Ahhhh semangatttt semoga bisa

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

        $data_pemasukan = Pemasukan::Find($id);
        return view('backend.transaksi.pemasukan.show', compact('data_pemasukan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data_kategori = KategoriAnggaranProgram::all();
        $data_anggota = AccessProgram::where('program_id', 1)->get();
        $data_pemasukan = Pemasukan::Find($id);
        return view('backend.transaksi.pemasukan.edit', compact('data_pemasukan', 'data_kategori', 'data_anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate([
            'data_warga' => 'required',
            'kategori_id' => 'required',
            'pembayaran' => 'required',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required',
        ], [
            'data_warga.required' => 'data_warga kedah di pilih',
            'kategori_id.required' => 'Kategori kedah di pilih',
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

        $data_ketegori = KategoriAnggaranProgram::find($request->kategori_id);

        $data_pemasukan = Pemasukan::find($id);
        $data_pemasukan->data_warga_id = $request->data_warga;
        $data_pemasukan->jumlah = $request->jumlah;
        $data_pemasukan->pembayaran = $request->pembayaran;
        $data_pemasukan->kategori_id = $request->kategori_id;
        $data_pemasukan->keterangan = $request->keterangan;
        $data_pemasukan->pengurus_id = Auth::user()->data_warga_id;
        $data_pemasukan->kode =  $data_ketegori->kode . date('dmyhis', strtotime($request->tanggal));

        if ($request->foto) {
            $data_pemasukan->foto          = "/img/bukti/$nama";
        }
        if ($request->foto1) {
            $data_pemasukan->foto          = $request->foto1;
        }

        $data_pemasukan->update();
        return redirect()->back()->with('sukses', 'Wihhhh mantappp hatur nuhun atos masukeun data pembayaran KAS keluarga. Lancar selalu ATOS LEBET');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data_pemasukan = Pemasukan::find($id);

        $data_pemasukan->delete();

        return redirect()->back()->with('kuning', 'Data Parantos di hapus tina disimpen dina sampah )');
    }
    public function trash()
    {
        $data_pemasukan = Pemasukan::orderByRaw('created_at DESC')->onlyTrashed()->get();

        return view('backend.transaksi.pemasukan.trash', compact('data_pemasukan'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_pemasukan = Pemasukan::withTrashed()->findorfail($id);
        $data_pemasukan->restore();
        return redirect()->back()->with('infoes', 'Data pemasukan atos di kembalikeun deui tina sampah');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_pemasukan = Pemasukan::withTrashed()->findorfail($id);

        $data_pemasukan->forceDelete();
        return redirect()->back()->with('kuning', 'Data pemasukan parantos di hapus dina sampah');
    }

    public function pemasukan_index()
    {
        $access_pemasukan = Access_Pemasukan::where('role_id', Auth::user()->role_id)->where('Kategori', "Form");
        $access_pemasukan_form_1 = Access_Pemasukan::where('role_id', Auth::user()->role_id)->where('Kategori', "Form_1");
        $access_pemasukan_table = Access_Pemasukan::where('role_id', Auth::user()->role_id)->where('type', "table");
        $data_warga_program = AccessProgram::where('program_id', 1);
        $program = Program::find(1);
        $data_warga = DataWarga::all();
        $layout_pemasukan = Layout_Pemasukan::first();
        $data_kategori = KategoriAnggaranProgram::all();
        //Untuk menyingkronkan data pasanhan
        $user = DataWarga::find(Auth::user()->data_warga_id);
        if ($user->jenis_kelamin = "Laki-Laki") {
            $cek_hubungan = HubunganWarga::where('warga_id', $user->id)->where('hubungan', 'Istri');
            if ($cek_hubungan->count() == 1) {
                $cek_user = User::where('data_warga_id', $cek_hubungan->first()->data_warga_id)->first();
                $data_user = $cek_user->data_warga_id;
            } else {
                $data_user = Auth::user()->data_warga_id;
            }
        } else {
            $cek_hubungan = HubunganWarga::where('warga_id', $user->id)->where('hubungan', 'Suami');
            if ($cek_hubungan->count() == 1) {
                $cek_user = User::where('data_warga_id', $cek_hubungan->first()->data_warga_id)->first();
                $data_user = $cek_user->data_warga_id;
            } else {
                $data_user = Auth::user()->data_warga_id;
            }
        }
        //
        $data_pemasukan_kas_user = Pemasukan::orderByRaw('created_at DESC')->where('data_warga_id', $data_user)->where('kategori_id', 1)->get();
        $data_pemasukan_semua = Pemasukan::orderByRaw('created_at DESC')->where('kategori_id', '1')->get();
        $data_pemasukan_setor_tunai = Pemasukan::orderByRaw('created_at DESC')->where('kategori_id', '3')->get();

        $cek_pengajuan = Pengajuan::where('kategori_id', 1)->where('data_warga_id', $data_user)->count();
        $cek_pemasukan_terakhir = Pemasukan::orderByRaw('created_at DESC LIMIT 1')->where('kategori_id', 1)->where('data_warga_id', $data_user)->get();
        $cek_pemasukan_terakhir_total = Pemasukan::orderByRaw('created_at DESC LIMIT 1')->where('kategori_id', 1)->where('data_warga_id', $data_user)->count();
        $cek_pemasukan_terakhir_all = Pemasukan::orderByRaw('created_at DESC')->where('kategori_id', 1)->where('data_warga_id', $data_user)->sum('jumlah');

        // data untuk table data user 
        $data_anggota = User::all();

        return view('frontend.pemasukan.index', compact(
            'access_pemasukan',
            'access_pemasukan_form_1',
            'access_pemasukan_table',
            'data_warga_program',
            'data_warga',
            'program',
            'data_pemasukan_semua',
            'data_kategori',
            'data_pemasukan_kas_user',
            'data_pemasukan_setor_tunai',
            'layout_pemasukan',
            'cek_pengajuan',
            'cek_pemasukan_terakhir',
            'cek_pemasukan_terakhir_total',
            'cek_pemasukan_terakhir_all',
            'data_anggota',
        ));
    }

    // untuk melihat detail kas perorangan , , pengurus
    public function detail_anggota_kas($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        $data_pemasukan_kas_user = Pemasukan::where('kategori_id', 1)->where('data_warga_id', $user->data_warga_id)->orderByRaw('created_at DESC')->get();
        return view('frontend.pemasukan.show_anggota', compact('data_pemasukan_kas_user', 'user'));
    }
    // untuk melihat data tabungan  .  pengurus
    public function detail_anggota_tabungan($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::find($id);
        $data_pemasukan_kas_user = Pemasukan::where('kategori_id', 2)->where('data_warga_id', $user->data_warga_id)->orderByRaw('created_at DESC')->get();
        return view('frontend.pemasukan.show_anggota', compact('data_pemasukan_kas_user', 'user'));
    }
}
