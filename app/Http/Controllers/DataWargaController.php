<?php

namespace App\Http\Controllers;

use App\Models\DataWarga;
use App\Http\Controllers\Controller;
use App\Models\AccessProgram;
use App\Models\FotoUser;
use App\Models\HubunganWarga;
use App\Models\LayoutAppUser;
use App\Models\UpdateKerja;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class DataWargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_warga = DataWarga::all();

        return view('backend.master_data.data_warga.index', compact('data_warga'));
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
        $request->validate(
            [
                'nama' => 'required',
                'tanggal_lahir' => 'required',
                'tempat_lahir' => 'required',
                'no_hp' => 'required',
                'agama' => 'required',
                'status_pernikahan' => 'required',
                'status' => 'required',

                'provinsi' => 'required',
                'kota' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'kampung' => 'required',
                'rt' => 'required',
                'rw' => 'required',

            ],
            [
                'nama.required' => 'Nama Harus Di Isi',
                'tanggal_lahir.required' => 'Tanggal lahir Harus Di Isi',
                'tempat_lahir.required' => 'Tempat Lahir Harus Di Isi',
                'no_hp.required' => 'No HP Harus Di Isi',
                'agama.required' => 'Agama Harus Di Isi',
                'status_pernikahan.required' => 'Status Pernikahan Harus Di Isi',
                'status.required' => 'Status Harus Di Isi',

                'provinsi.required' => 'provinsi Harus Di Isi',
                'kota.required' => 'kota Harus Di Isi',
                'kecamatan.required' => 'kecamatan Harus Di Isi',
                'kelurahan.required' => 'kelurahan Harus Di Isi',
                'kampung.required' => 'kampung Harus Di Isi',
                'rt.required' => 'rt Harus Di Isi',
                'rw.required' => 'rw Harus Di Isi',
            ]
        );

        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'profile-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/warga'), $nama);
        } else {
            if ($request->jenis_kelamin == "Laki-Laki") {
                $foto_template = "/img/template/52471919042020_male.jpg";
            } else {
                $foto_template = "/img/template/52471919042020_female.jpg";
            }
        }



        $data_warga = new DataWarga();
        $data_warga->nama = $request->nama;
        $data_warga->tempat_lahir = $request->tempat_lahir;
        $data_warga->tanggal_lahir = $request->tanggal_lahir;
        $data_warga->alamat =  $request->kampung . ", RT/RW " . $request->rt . "/" . $request->rw . ", Des. " . $request->kelurahan . ", Kec. " . $request->kecamatan . ", " . $request->kota . ", " . $request->provinsi;
        $data_warga->no_hp = $request->no_hp;
        $data_warga->agama = $request->agama;
        $data_warga->status_pernikahan = $request->status_pernikahan;
        $data_warga->status = $request->status;
        $data_warga->jenis_kelamin = $request->jenis_kelamin;

        $data_warga->save();

        $foto_user = new FotoUser();
        $foto_user->data_warga_id = $data_warga->id;
        $foto_user->is_active = 1;
        if ($request->foto) {
            $foto_user->foto = "/img/warga/$nama";
        } else {
            $foto_user->foto = $foto_template;
        }


        $foto_user->save();

        // untuk menyimpan data ke hubungan
        if ($request->pribadi) {
            $data_hubungan_keluarga = new HubunganWarga();

            $data_hubungan_keluarga->warga_id = $request->user;
            $data_hubungan_keluarga->data_warga_id = $data_warga->id;
            $data_hubungan_keluarga->hubungan = $request->hubungan;

            $data_hubungan_keluarga->save();
        }

        return redirect()->back()->with('sukses', 'Wihhhh mantapppp bener');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data_warga = DataWarga::find($id);
        $data_warga_all = DataWarga::all();
        $data_akun = User::where('data_warga_id', $id)->first();
        $foto = FotoUser::where('data_warga_id', $id)->where('is_active', 1)->first();
        $kerja = UpdateKerja::orderByRaw('created_at DESC')->where('user_id', $data_akun->id)->get();

        $cek_data_hubungan = HubunganWarga::where('warga_id', $id)->get();

        return view('backend.master_data.data_warga.show', compact('data_warga', 'data_akun', 'foto', 'cek_data_hubungan', 'data_warga_all', 'kerja')); //tidak aktive
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);

        $data_warga = DataWarga::find($id);
        $foto = FotoUser::where('data_warga_id', $data_warga->id)->where('is_active', 1)->first();

        return view('backend.master_data.data_warga.edit', compact('data_warga', 'foto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $request->validate(
            [
                'nama' => 'required',

            ],
            [
                'nama.required' => 'Nama Harus Di Isin',
            ]
        );

        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'profile-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/warga'), $nama);
        }

        $data_warga = DataWarga::find($id);
        $data_warga->nama = $request->nama;
        $data_warga->jenis_kelamin = $request->jenis_kelamin;
        $data_warga->tempat_lahir = $request->tempat_lahir;

        $data_warga->no_hp = $request->no_hp;
        $data_warga->agama = $request->agama;
        $data_warga->status_pernikahan = $request->status_pernikahan;
        if ($request->tanggal_lahir == true) {
            $data_warga->tanggal_lahir = $request->tanggal_lahir;
        }
        if ($request->kelurahan) {
            $data_warga->alamat =  $request->kampung . ", RT/RW " . $request->rt . "/" . $request->rw . ", Des. " . $request->kelurahan . ", Kec. " . $request->kecamatan . ", " . $request->kota . ", " . $request->provinsi;
        }
        if ($request->email) {
            $data_warga->email = $request->email;
        }

        // mengecek apakah user sudahbterdaftar
        $user = User::where('data_warga_id', $id);
        if ($request->status) {
            if ($user->count() == 1) {
                $user_program = AccessProgram::where('user_id', $user->first()->id)->where('program_id', 1);
                $cek_update_terakhir = UpdateKerja::orderByRaw('created_at DESC LIMIT 1')->where('user_id', $user->first()->id)->where('status', "Tidak Bekerja")->get();

                if ($user_program->count() == 1) {
                    $update = new UpdateKerja();
                    $update->user_id = $user->first()->id;
                    $update->status = $request->status;

                    // jika update kerja terakhirnya tidak bekerja trus akan update lagi ke bekerkja maka kode di bawah untuk menghitung tenor nya
                    foreach ($cek_update_terakhir as $data) {
                        if ($request->status == "Bekerja") {
                            $date = date("Y-m-d");
                            $data_created_at = date("Y-m-d", strtotime($data->created_at));
                            $timeStart = strtotime($data_created_at);
                            $timeEnd = strtotime("$date");
                            // Menambah bulan ini + semua bulan pada tahun sebelumnya
                            $numBulan = (date("Y", $timeEnd) - date("Y", $timeStart)) * 12;
                            // menghitung selisih bulan
                            $numBulan += date("m", $timeEnd) - date("m", $timeStart);

                            // tambahan untuk menambahkan tenor
                            $update->tenor = $numBulan;
                        }
                    }
                    $update->save();
                }
            }
            $data_warga->status = $request->status;
        }

        $data_warga->update();

        if ($request->foto) {
            $cek_foto = FotoUser::where('is_active', 1)->where('data_warga_id', $id)->first();
            $foto_no_active = FotoUser::find($cek_foto->id);
            $foto_no_active->is_active = 2;
            $foto_no_active->update();

            $foto_user = new FotoUser();
            $foto_user->data_warga_id = $data_warga->id;
            $foto_user->is_active = 1;
            if ($request->foto) {
                $foto_user->foto = "/img/warga/$nama";
            }
            $foto_user->save();
        }

        return redirect()->back()->with('infoes', 'Wihhhh mantapppp bener, Data atos ka gentos');
    }




    // Untuk mengaktifkan akun atau tidak aktif

    public function is_active($id)
    {
        $id = Crypt::decrypt($id);

        $data_user = User::find($id);
        if ($data_user->is_active == 1) {
            $data_user->is_active = 2;
        } else {
            $data_user->is_active = 1;
        }
        $data_user->update();

        return redirect()->back()->with('sukses', 'Akun Sudah di robah');
    }


    public function store_user(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'role_id' => 'required',
                'data_warga_id' => 'required',
            ],
            [
                'nama.required' => 'Nama Kedah di isin',
                'email.required' => 'email Kedah di isin',
                'role_id.required' => 'Role Kedah di isin',
                'data_warga_id.required' => 'Data Warga Kedah di isin',
            ]
        );

        $data_user = new User();
        $data_user->name = $request->name;
        $data_user->email = $request->email;
        $data_user->password = Hash::make('12345678');
        $data_user->role_id = $request->role_id;
        $data_user->data_warga_id = $request->data_warga_id;


        $data_email = DataWarga::find($request->data_warga_id);
        $data_email->email = $request->email;
        $data_email->update();

        $data_user->save();

        // Menambahkan user sekalian dengan menambhakan layout untuk tampilan
        $layout_user = new LayoutAppUser();
        $layout_user->user_id = $data_user->id;
        $layout_user->navbar = '#b7eb2a';
        $layout_user->menu = '#b7eb2a';
        $layout_user->sider = '#b7eb2a';
        $layout_user->save();

        return redirect()->back()->with('sukse', 'Wihhhh mantap bos account atos jadi, gaskeunnn');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        $data_warga = DataWarga::find($id);

        $foto = HubunganWarga::where('data_warga_id', $data_warga->id)->get();
        foreach ($foto as $data) {
            $hapus_foto = HubunganWarga::find($data->id);
            $hapus_foto->delete();
        }

        $data_warga->delete();

        return redirect()->back()->with('kuning', 'Data Parantos di hapus tina disimpen dina sampah )');
    }
    public function trash()
    {
        $data_warga = DataWarga::onlyTrashed()->get();

        return view('backend.master_data.data_warga.trash', compact('data_warga'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $data_warga = DataWarga::withTrashed()->findorfail($id);
        $data_warga->restore();
        return redirect()->back()->with('infoes', 'Data data warga atos di kembalikeun deui tina sampah');
    }

    public function kill($id)
    {
        $id = Crypt::decrypt($id);
        $data_warga = DataWarga::withTrashed()->findorfail($id);

        $data_warga->forceDelete();
        return redirect()->back()->with('kuning', 'Data data warga parantos di hapus dina sampah');
    }

    public function cari_keluarga(Request $request)
    {

        $cari = $request->cari;

        $data_keluarga = DataWarga::where('nama', 'like', "%" . $cari . "%")->paginate();


        return view('frontend.cari_keluarga.detail', compact('data_keluarga'));
    }

    public function data_warga_detail($id)
    {
        $id = Crypt::decrypt($id);
        $data_anggota = DataWarga::find($id);
        $foto = FotoUser::where('data_warga_id', $data_anggota->id)->get();

        $data_keluarga_hubungan = HubunganWarga::where('warga_id', $id)->get();
        $data_keluarga = DataWarga::all();

        $lahir    = new DateTime($data_anggota->tanggal_lahir);
        $today        = new DateTime();
        $umurr = $today->diff($lahir);


        return view('frontend.cari_keluarga.index', compact('umurr', 'foto', 'data_keluarga', 'data_anggota', 'data_keluarga_hubungan'));
    }
}
