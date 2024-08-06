<?php

namespace App\Http\Controllers;

use App\Models\Konter;
use App\Models\DataKonter;
use App\Models\DataWarga;
use App\Http\Controllers\Controller;
use App\Models\AccessProgram;
use App\Models\Menu;
use App\Models\Role;
use App\Models\SubMenu;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KonterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DataKonter::select('kategori')->distinct()->get();
        $data_warga = DataWarga::all(); 
        $data_konter = Konter::all();
        return view('backend.bisnis.master_data_bisnis.data_konter.index', compact('data_konter'       ,'categories',
        'data_warga'));
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
        // Validasi input
        $request->validate([
            'tujuan' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
            'layanan' => 'required',
            'harga_beli' => 'numeric|required',
            'harga_jual' => 'numeric|required',
        ],[
            'tujuan.required' => 'No Tujuan kedah di isi',
            'nama.required' => 'Nama kedah di isi',
            'kategori.required' => 'Kategori kedah di isi',
            'layanan.required' => 'No Tujuan kedah di isi',
            'harga_beli.required' => 'Nominal Harga Beli kedah di isi',
            'harga_jual.required' => 'Nominal Harga Jual kedah di isi',
            'harga_beli.numeric' => 'Nominal Harga Beli kedah Angka',
            'harga_jual.numeric' => 'Nominal Harga Jual kedah Angka',
        
        ]);
        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'bukti-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/bukti'), $nama);
        }
        if($request->nominal1){
         $nominal = $request->nominal1;
        }
        if($request->nominal2){
         $nominal = $request->nominal2;
        }

        $data_konter = new Konter;
        $data_konter->user_input = Auth::user()->id;
        $data_konter->no_tujuan = $request->tujuan;
        $data_konter->nama = $request->nama;
        $data_konter->kategori = $request->kategori;
        $data_konter->status = $request->payment_method;
        $data_konter->layanan = $request->layanan;
        $data_konter->nominal = $nominal;
        $data_konter->harga = $request->harga_beli;
        $data_konter->tagihan = $request->harga_jual;
        $data_konter->diskon = $request->diskon;
        $data_konter->margin = $request->margin;
        $data_konter->keterangan = $request->keterangan;
        $data_konter->uang_keluar = $request->uang_keluar;
        if ($request->foto) {
            $data_konter->foto          = "/img/konter/$nama";
        }
        
        $data_konter->save();
        return redirect()->back()->with('sukses', 'Data Parantos ka simpen');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $data_konter = Konter::find($id);

        return view('backend.bisnis.master_data_bisnis.data_konter.show', compact('data_konter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $data_konter = Konter::find($id);

        return view('backend.bisnis.master_data_bisnis.data_konter.edit', compact('data_konter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        // Validasi input
        $request->validate([
            'tujuan' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
            'layanan' => 'required',
            'harga_beli' => 'numeric|required',
            'harga_jual' => 'numeric|required',
        ],[
            'tujuan.required' => 'No Tujuan kedah di isi',
            'nama.required' => 'Nama kedah di isi',
            'kategori.required' => 'Kategori kedah di isi',
            'layanan.required' => 'No Tujuan kedah di isi',
            'harga_beli.required' => 'Nominal Harga Beli kedah di isi',
            'harga_jual.required' => 'Nominal Harga Jual kedah di isi',
            'harga_beli.numeric' => 'Nominal Harga Beli kedah Angka',
            'harga_jual.numeric' => 'Nominal Harga Jual kedah Angka',
        
        ]);
        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'bukti-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/bukti'), $nama);
        }
        if($request->nominal1){
         $nominal = $request->nominal1;
        }
        if($request->nominal2){
         $nominal = $request->nominal2;
        }

        $data_konter = new Konter;
        $data_konter->user_id = Auth::user()->id;
        $data_konter->no_tujuan = $request->tujuan;
        $data_konter->nama = $request->nama;
        $data_konter->kategori = $request->kategori;
        $data_konter->type = $request->payment_method;
        $data_konter->layanan = $request->layanan;
        $data_konter->nominal = $nominal;
        $data_konter->harga = $request->harga_beli;
        $data_konter->tagihan = $request->harga_jual;
        $data_konter->diskon = $request->diskon;
        $data_konter->margin = $request->margin;
        $data_konter->keterangan = $request->keterangan;
        $data_konter->uang_keluar = $request->uang_keluar;
        if ($request->foto) {
            $data_konter->foto          = "/img/konter/$nama";
        }

        $data_konter->update();
        return redirect()->back()->with('infoes', 'Data Konter Parantos ka geuntos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    
    }
        
    public function trash()
    {
        
    }

    public function restore($id)
    {
        
    }

    public function kill($id)
    {
        
    }
    //oke
    public function konter_home()
    {
        $konter_tagihan_pulsa = Konter::where('status','Belum Lunas')->where('kategori','Pulsa')->get();
        $konter_tagihan_listrik = Konter::where('status','Belum Lunas')->where('kategori','Listrik')->get();
        $konter_tagihan_kouta = Konter::where('status','Belum Lunas')->where('kategori','Kouta')->get();
        $all_pulsa = Konter::where('kategori','Pulsa')->get();
        $all_listrik = Konter::where('kategori','Listrik')->get();
        $all_kouta = Konter::where('kategori','Kouta')->get();
        $konter_pengajuan = Konter::where('status','Pengajuan')->get();
        $categories = DataKonter::select('kategori')->distinct()->get();
        $data_warga = DataWarga::all();
        
        Return view ('frontend.home.konter.index', Compact('konter_tagihan_pulsa',
        'konter_tagihan_listrik',
        'konter_tagihan_kouta',
        'all_pulsa',
        'all_listrik',
        'all_kouta',
        'categories',
        'konter_pengajuan',
        'data_warga'
        ));
    }
    public function lihat($id)
    {
        $id = Crypt::decrypt($id);
        $data_konter = Konter::find($id);

        return view('frontend.home.konter.show', compact('data_konter'));
    }
    
    
    public function getServices(Request $request)
    {
        $services = DataKonter::where('kategori', $request->kategori)->groupBy('layanan')->pluck('layanan', 'layanan');
        return response()->json($services);
    }

    public function getPrices(Request $request)
    {
        $prices = DataKonter::where('kategori', $request->kategori)
                            ->where('layanan', $request->layanan)
                            ->pluck('nominal', 'id');
        return response()->json($prices);
    }

    public function getPriceDetails(Request $request)
    {
        $price = DataKonter::Find($request->nominal);
                            
                            
        if($request->payment_method == 'Langsung') {
            return response()->json(['nominal' => $price->nominal,'harga_beli' => $price->harga_beli, 'harga_jual' => $price->harga_jual_cash]);
        } else {
            return response()->json(['nominal' => $price->nominal,'harga_beli' => $price->harga_beli, 'harga_jual' => $price->harga_jual_tenor]);
        }
    }

    public function checkPhone(Request $request)
{
    $no_hp = $request->get('no_hp');

    $prefixes = [
        'AXIS' => ['0831', '0832', '0833', '0838'],
        'simPATI' => ['0811', '0812', '0813', '0821', '0822', '0852', '0853', '0823'],
        'Im3' => ['0814', '0815', '0816', '0855', '0856', '0857', '0858'],
        'XL' => ['0817', '0818', '0819', '0859', '0877', '0878'],
        '3' => ['0895', '0896', '0897', '0898', '0899'],
        'Smartfren' => ['0881', '0882', '0883', '0884', '0885', '0886', '0887', '0888', '0889']
    ];

    $layanan = null;
    foreach ($prefixes as $key => $values) {
        foreach ($values as $prefix) {
            if (strpos($no_hp, $prefix) === 0) {
                $layanan = $key;
                break 2;
            }
        }
    }

    $nominals = DataKonter::where('kategori', 'Pulsa')
                          ->where('layanan', $layanan)
                          ->pluck('nominal', 'id');

    $data_warga = DataWarga::where('no_hp', $no_hp)->first();

    if ($layanan) {
        return response()->json([
            'layanan' => $layanan,
            'nominals' => $nominals,
            'exists' => $data_warga ? true : false,
            'nama' => $data_warga ? $data_warga->nama : null
        ]);
    }

    return response()->json([
        'layanan' => null,
        'nominals' => null,
        'exists' => $data_warga ? true : false,
        'nama' => $data_warga ? $data_warga->nama : null
    ]);
}

public function getHargaJual(Request $request)
{
    $kategori = $request->get('kategori');
    $layanan = $request->get('layanan');
    $nominal = $request->get('nominal');

    $dataKonter = DataKonter::where('kategori', $kategori)
                            ->where('layanan', $layanan)
                            ->where('nominal', $nominal)
                            ->first();

    if ($dataKonter) {
        return response()->json([
            'harga_beli' => $dataKonter->harga_beli,
            'harga_cash' => $dataKonter->harga_jual_cash,
            'harga_tenor' => $dataKonter->harga_jual_tenor
        ]);
    }

    return response()->json([
        'harga_beli' => null,
        'harga_cash' => null,
        'harga_tenor' => null
    ]);
}

public function checkIdListrik(Request $request)
{
    $id_listrik = $request->get('id_listrik');

    // Cari data di tabel Konter untuk ID Listrik yang diinput
    $data_konter = Konter::where('no_listrik', $id_listrik)->where('layanan', 'Token Listrik')->latest()->first();

    // Ambil nominal dari DataKonter berdasarkan kategori dan layanan
    $nominals = DataKonter::where('kategori', 'Listrik')
                           ->where('layanan', 'Token Listrik')
                           ->pluck('nominal', 'id');

    if ($data_konter) {
        if ($data_konter->status == 'Pengajuan') {
            return response()->json([
                'exists' => true,
                'status' => 'Pengajuan',
                'message' => 'No Listrik / ID Listrik masih dalam pengajuan harap konfirmasi ke Admin'
            ]);
        } else {
            return response()->json([
                'exists' => true,
                'nama' => $data_konter->nama,
                'user_input' => $data_konter->user_input,
                'no_hp' => $data_konter->no_tujuan,
                'nominals' => $nominals
            ]);
        }
    } else {
        return response()->json([
            'exists' => false,
            'nominals' => $nominals
        ]);
    }
}

// YourController.php
public function checkIdListrikStatus(Request $request)
{
    $id_listrik = $request->get('id_listrik');
    $data = Konter::where('no_listrik', $id_listrik)->where('layanan', 'Tagihan Listrik')->latest()->first();

    if ($data) {
        if ($data->status === 'Pengajuan') {
            return response()->json(['status' => 'Pengajuan']);
        } else {
            return response()->json([
                'status' => 'Tersedia',
                'nama' => $data->nama,
                'user_input' => $data->user_input,
                'no_hp' => $data->no_tujuan
            ]);
        }
    }
    return response()->json(['status' => 'Tidak ditemukan']);
}

    public function store_umum(Request $request)
    {
        // Validasi input
        $request->validate([
            'tujuan' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
            'layanan' => 'required',
            'harga_beli' => 'numeric|required',
            'harga_jual' => 'numeric|required',
        ],[
            'tujuan.required' => 'No Tujuan kedah di isi',
            'nama.required' => 'Nama kedah di isi',
            'kategori.required' => 'Kategori kedah di isi',
            'layanan.required' => 'No Tujuan kedah di isi',
            'harga_beli.required' => 'Nominal Harga Beli kedah di isi',
            'harga_jual.required' => 'Nominal Harga Jual kedah di isi',
            'harga_beli.numeric' => 'Nominal Harga Beli kedah Angka',
            'harga_jual.numeric' => 'Nominal Harga Jual kedah Angka',
        
        ]);
        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'konter-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/konter'), $nama);
        }
        if($request->nominal1){
         $nominal = $request->nominal1;
        }
        if($request->nominal2){
         $nominal = $request->nominal2;
        }
        if($request->payment_method == "Hutang"){
        $status = 'Belum Lunas';
        
        }
        if($request->payment_method == "Langsung"){
        $status = 'Lunas';
        
        }
        

        $data_konter = new Konter;
        $data_konter->user_input = Auth::user()->data_warga->nama;
        $data_konter->no_tujuan = $request->tujuan;
        $data_konter->nama = $request->nama;
        $data_konter->kategori = $request->kategori;
        $data_konter->type = $request->payment_method;
        $data_konter->layanan = $request->layanan;
        $data_konter->nominal = $nominal;
        $data_konter->harga = $request->harga_beli;
        $data_konter->tagihan = $request->harga_jual;
        $data_konter->diskon = $request->diskon;
        $data_konter->margin = $request->margin;
        $data_konter->keterangan = $request->keterangan;
        $data_konter->uang_keluar = $request->uang_keluar;
        $data_konter->status = $status;
        if ($request->foto) {
            $data_konter->foto          = "/img/konter/$nama";
        }
        if($request->no_listrik){
        $data_konter->no_listrik = $request->no_listrik;
        }
        if($request->payment_method == "Langsung"){
         $data_konter->pembayaran = $request->harga_jual;
         $data_konter->type_bayar = $request->type_bayar;
         $data_konter->konfirmasi = Auth::user()->data_warga->nama ;
         $tanggal = Carbon::now();
         $data_konter->tanggal_bayar = $tanggal;
        }
        
        $data_konter->save();
        
        // Proses penyimpanan transaksi
        // (Tambahkan kode sesuai dengan kebutuhan aplikasi Anda)
        
        return redirect()->back()->with('sukses', 'Transaksi berhasil disimpan.');
    }
    
    public function konfirmasi_transaksi(Request $request, $id)
    {
    $id = Crypt::decrypt($id);
        // Validasi input
        $request->validate([
            'no_tujuan' => 'required',
            'nama' => 'required',
            'kategori' => 'required',
            
            'harga_beli' => 'numeric|required',
            'harga_jual' => 'numeric|required',
        ],[
            'no_tujuan.required' => 'No Tujuan kedah di isi',
            'nama.required' => 'Nama kedah di isi',
            'kategori.required' => 'Kategori kedah di isi',
            
            'harga_beli.required' => 'Nominal Harga Beli kedah di isi',
            'harga_jual.required' => 'Nominal Harga Jual kedah di isi',
            'harga_beli.numeric' => 'Nominal Harga Beli kedah Angka',
            'harga_jual.numeric' => 'Nominal Harga Jual kedah Angka',
        
        ]);
        if ($request->foto) {
            $file = $request->file('foto');
            $nama = 'konter-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/konter'), $nama);
        }
        if($request->nominal1){
         $nominal = $request->nominal1;
        }
        if($request->nominal2){
         $nominal = $request->nominal2;
        }
        if($request->payment_method == "Hutang"){
        $status = "Belum Lunas";
        
        }
        if($request->payment_method == "Langsung"){
        $status = "Lunas";
        
        }
        
        $data_konter = Konter::find($id);
        
        $keterangan = 'Keterangan pembeli :' . $data_konter->keterangan . '<br>'.
        'Keterangan tambahan : ' . $request->keterangan ;
        
        $data_konter->nominal = $nominal;
        $data_konter->no_tujuan = $request->no_tujuan;
        $data_konter->harga = $request->harga_beli;
        $data_konter->tagihan = $request->harga_jual;
        $data_konter->diskon = $request->diskon;
        $data_konter->margin = $request->margin;
        $data_konter->keterangan = $keterangan;
        $data_konter->uang_keluar = $request->uang_keluar;
        $data_konter->status = $status;
        if ($request->foto) {
            $data_konter->foto          = "/img/konter/$nama";
        }
        if($request->payment_method == "Langsung"){
         $data_konter->pembayaran = $request->harga_jual;
         
         $data_konter->konfirmasi = Auth::user()->data_warga->nama ;
         $tanggal = Carbon::now();
         $data_konter->tanggal_bayar = $tanggal;
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


        $DataWarga = DataWarga::find($request->data_warga); //Untuk mengambil data Warga sesuai dengtan id pengaju
        $DataPengaju = DataWarga::find($request->pengaju_id); //Untuk mengambil data Warga sesuai dengtan id pengaju
        
        $token = "@Mx6RkRVz60S#j8YGi6T";
        $target = "$bendahara->data_warga->no_hp, $sekertaris->data_warga->no_hp, $penasehat->data_warga->no_hp";
        $nominall = number_format($data_konter->nominal, 2, ',', '.');
        $tagihan = number_format($data_konter->tagihan, 2, ',', '.');
        // =============
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
                'target' => $request->no_tujuan,
                'message' => "
🥳🥳🥳Yeee Transaksi atos Berhasil, Mangga du cek

Kategori : *$data_konter->kategori ,$data_konter->layanan*
*Token* : $request->token
Nominall: *$nominall*
No Listrik : *$data_konter->no_listrik*
No Handphone: *$data_konter->no_tujuan*
Yang mengajukan  : $data_konter->nama
Jatuh tempo : $data_konter->jatuh_tempo
            *TAGIHAN* : *$tagihan*

Semoga bermanfaat, Terimakasih

Kel. Ma Haya
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
        
        $data_konter->update();
        
        // Proses penyimpanan transaksi
        // (Tambahkan kode sesuai dengan kebutuhan aplikasi Anda)
        
        return redirect()->back()->with('sukses', 'Transaksi berhasil disimpan.');
    }
    
    
    public function konfirmasi_pembayaran_lihat($id)
    {
        $id = Crypt::decrypt($id);
        $data_konter = Konter::find($id);
        $categories = DataKonter::select('kategori')->distinct()->get();

        return view('frontend.home.konter.konfirmasi_pembayaran', compact('categories','data_konter'));
    }
    
    
    public function konfirmasi_pembayaran(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        // Validasi input
        $request->validate([
            'pembayaran' => 'numeric|required',
            'type_bayar' => 'required',
        ],[
            'pembayaran.required' => 'Nominal Harga Jual kedah di isi',
            'pembayaran.numeric' => 'Nominal Harga Jual kedah Angka',
            'type_bayar.required' => 'Metode Pembayaraan Jual kedah di isi',
        
        ]);
        $cek_pembayaran = $request->sisa_bayar +  $request->pembayaran ;
        $cek_tagihan = $request->tagihan -  $cek_pembayaran ;
        $tanggal = Carbon::now();
        if($cek_tagihan < 1){
          $status = 'Lunas';
          
        }else{
          $status = 'Belum Lunas';
          
        }
        
        $data_konter = Konter::find($id);
        $data_konter->pembayaran = $cek_pembayaran;
        $data_konter->type_bayar = $request->type_bayar;
        $data_konter->konfirmasi = Auth::user()->data_warga->nama ;
        
        $data_konter->tanggal_bayar = $tanggal;
        $data_konter->status = $status;
        
        
        $data_konter->update();
        
        // Proses penyimpanan transaksi
        // (Tambahkan kode sesuai dengan kebutuhan aplikasi Anda)
        
        return redirect()->back()->with('sukses', 'Transaksi sudah selesai.');
    }
    public function konter_cek_pulsa()
    {
        $all_pengajuan = Konter::where('Status','Pengajuan')->get();
        $all_konter = Konter::all();
        $kategori="Pulsa";
        
        
        Return view ('frontend.home.konter.cek_harga_pengajuan_umum', Compact(
        'kategori',
        'all_pengajuan',
        'all_konter',
        
        ));
    }
    public function konter_cek_tagihan_listrik()
    {
        $all_pengajuan = Konter::where('Status','Pengajuan')->get();
        $all_konter = Konter::all();
        $kategori="Tagihan Listrik";
        
        
        Return view ('frontend.home.konter.cek_harga_pengajuan_umum', Compact(
        'kategori',
        'all_pengajuan',
        'all_konter',
        
        ));
    }
    public function konter_cek_token_listrik()
    {
        $all_pengajuan = Konter::where('Status','Pengajuan')->get();
        $all_konter = Konter::all();
        $kategori="Token Listrik";
        
        
        Return view ('frontend.home.konter.cek_harga_pengajuan_umum', Compact(
        'kategori',
        'all_pengajuan',
        'all_konter',
        
        ));
    }
    
    // app/Http/Controllers/TransactionController.php

public function preview(Request $request)
{
    $request->validate([
        'no_hp' => 'required|min:10|max:12',
        'layanan' => 'required',
        'kategori' => 'required',
        
        
        'payment_method' => 'required',
        'payment_type' => 'required_if:payment_method,Langsung',
        'keterangan' => 'required_if:payment_method,Langsung',
    ]);
$cek1 = Konter::where('kategori','Pulsa')->where('no_tujuan',$request->no_hp);
$cek_pulsa = $cek1->where('status','Pengajuan')->count();
  if($cek_pulsa >= 2 ){

   return redirect()->back()->with('kuning', 'Mohon Maaf Anda sudah mempunyai Pengajuan ke 2, Tunggu dulu sampai di proses.');
}else{
    // Simpan data ke session
    $data = $request->all();
    
    session(['transaction_data' => $data]);

    // Tampilkan halaman preview
    return view('frontend.home.konter.preview', compact('data'));
}
}



public function submit(Request $request)
{
    // Ambil data dari session
    $data = session('transaction_data');

    if (!$data) {
        return redirect()->route('transactions.create')->with('error', 'Data transaksi tidak ditemukan.');
    }
    $hariRange =  $request->durasi;
    // Tentukan penambahan hari berdasarkan pilihan
        switch ($hariRange) {
            case '1-7':
                $daysToAdd = 7;
                break;
            case '8-14':
                $daysToAdd = 14;
                break;
            case '8-17':
                $daysToAdd = 17;
                break;
            case '15-21':
                $daysToAdd = 21;
                break;
            case '18-30':
                $daysToAdd = 14;
                break;
            case '22-30':
                $daysToAdd = 30;
                break;
            default:
                $daysToAdd = 0;
                break;
        }

        // Hitung tanggal baru
        $newDate = Carbon::now()->addDays($daysToAdd);

    
    if($request->kategori == 'Pulsa'){
    $pengaju = $request->user_input;
    $nama = $request->user_input;
    }else{
    $pengaju = $request->user_input;
    $nama = $request->nama;
    }

  // Simpan ke database
    $data_konter = new Konter;
        $data_konter->user_input = $pengaju;
        $data_konter->no_tujuan = $request->no_hp;
        $data_konter->nama = $nama;
        $data_konter->kategori = $request->kategori;
        $data_konter->type = $request->payment_method;
        $data_konter->type_bayar = $request->payment_type;
        $data_konter->layanan = $request->layanan;
        $data_konter->nominal = $request->nominal_input;
        $data_konter->harga = $request->harga_beli;
        $data_konter->tagihan = $request->harga_jual;
        $data_konter->diskon = 0;
        $data_konter->margin =0;
        $data_konter->jatuh_tempo = $newDate;
        
        $data_konter->uang_keluar = 0;
        $data_konter->status = "Pengajuan";
        if($request->id_listrik){
        $data_konter->no_listrik = $request->id_listrik;
        $listrik =  $request->id_listrik;
        }else{
        $listrik = "-";
        }
        
        if($request->payment_method == "Langsung"){
         $data_konter->pembayaran = $request->harga_jual;
         $data_konter->type_bayar = $request->payment_type;
         $data_konter->keterangan = $request->keterangan;
         $tanggal = Carbon::now();
         $data_konter->tanggal_bayar = $tanggal;
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


        $DataWarga = DataWarga::find($request->data_warga); //Untuk mengambil data Warga sesuai dengtan id pengaju
        $DataPengaju = DataWarga::find($request->pengaju_id); //Untuk mengambil data Warga sesuai dengtan id pengaju
        
        $token = "@Mx6RkRVz60S#j8YGi6T";
        $target = "$bendahara->data_warga->no_hp, $sekertaris->data_warga->no_hp, $penasehat->data_warga->no_hp";
        $nominal = number_format($request->nominal_input, 2, ',', '.');
        $tagihan = number_format($request->harga_jual, 2, ',', '.');
        // =============
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
                'message' => "
Aya Pengajuan anu masuk, Sok gra cek konfirmasi leres teu meh mantulll. Grecepkeun ahhh yuuukkk cek meh jongjon. Data na nu di handap

Kategori : *$request->kategori ,$request->layanan*
Nominal: *$nominal*
No Listrik : *$listrik*
No Handphone: *$request->no_hp*
Yang mengajukan  : $nama
Pembayaran : $request->payment_method
Durasi Pembayaran (Hari) : $request->durasi 
sampai tanggal : $newDate
Tagihan : $tagihan

BURU PROSES, meh teu di tungguan, Gassskeunnnnn ...

*Catatan!!!*
1. Pami aya WA pengajuan Ieu langsung kirim na group pengurus meh langsung di proses.
2. Pami bade di proses ku salah sahiji info di Group kasih keterangan ( On Proses).
3. Transaksi di lakukeun ku 2 akun, Akun Neo Angga sareng Aldi, supaya cepet prosesnya.

Kas Keluarga Ma HAYA

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
        
        $data_konter->save();

    // Hapus data dari session
    session()->forget('transaction_data');
if($request->layanan == "Tagihan Listrik"){
    return redirect()->route('transactions.cek_tagihan_listrik')->with('sukses', 'Transaksi Tagihan Listrik berhasil.');
    }
elseif($request->layanan == "Token Listrik"){
    return redirect()->route('transactions.cek_token_listrik')->with('sukses', 'Transaksi Token Listrik berhasil .');
}else{
    return redirect()->route('transactions.cek_pulsa')->with('sukses', 'Pengajuan Pulsa berhasil disimpan Kantun ngantosan di konfirmasi.');
    }
   
}

}