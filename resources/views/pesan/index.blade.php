@extends('backend.template_backend.layout')

@section('content')

<?php

use Carbon\Carbon;
use App\Models\AccessProgram;
use App\Models\User;
use Illuminate\Support\Facades\Date;

$waktu = new Carbon();
$waktu_penentuan = date('d-M-Y', strtotime($waktu));

$isi = "Alhamdulilah 🙏 program KAS atos berjalan dengan lancar, Yuuukkk kanggo kalancaranna ayeuna tos masuk di akhir bulan

🗓️ $waktu_penentuan
📝 bade masuk di awal bulan
";

$penutup = " Mohon kerjasamana kanggo kalancaran program ieu, Hatur Nuhun🙏

===============================
Bank : *Neo Bank*

No Rek : 5859459403511164
A/n : Rangga Mulyana

Bank : *BRI*
No Rek : 077801030733539
A/n : Rifki Alfarez Putra

*DANA*
No : 085942004204
A/n : Rangga Mulyana
______________________________________
*Pembayaran Khusus Tabungan*

Bank : *Neo Bank*
No Rek : 5859459276533014
A/n : Rangga Mulyana ";


?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- ./row -->
        <div class="row">
            @if (auth()->user()->role->nama_role == 'Admin' || auth()->user()->role->nama_role == 'Ketua' || auth()->user()->role->nama_role == 'Sekertaris' ||auth()->user()->role->nama_role == 'Bendahara' || auth()->user()->role->nama_role == 'Penasehat')
            <div class="col-12 col-sm-6">
                <div class="card card-primary card-outline card-outline-tabs">
                    <a href="#pesan" class="btn btn-success" data-toggle="collapse">Klik Untuk Pengumuman Perbulan</a>
                    <div id="pesan" class="collapse">
                        <div class="card-body">
                            <center>
                                <h5 class="text-bold card-header bg-light p-0"> Ini Pesan Untuk Pengingat Kas perbulan</h5>
                            </center>
                            <br>
                            <p>Ngemutan kana Program KAS</p>
                            <p>{{$isi}}</p>
                            <p> Mohon kerjasamana kanggo kalancaran program ieu, Hatur Nuhun
                            </p><p>No Rekening tercantum di bawah (otomatis)</p>
                            
                            <hr>
                            <p><b>Target No Whatsapp</b></p>
                            {!!$targets_all!!}
                            
                            
                            <p><b>Sebelum kirim pesan/pengumuman harap di cek target pesan nya dan pastikan no Whatsapp-nya Aktif</b></p>
                            <form action="{{Route('pesan.kirim')}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" id="targets" name="targets" value="1">
                                <input type="hidden" id="pembukaan" name="pembukaan" value="📢 *Ngemutan kana Program KAS* 📢">
                                <input type="hidden" id="isi" name="isi" value="{{$isi}}">
                                <input type="hidden" id="penutup" name="penutup" value="{{$penutup}}">
                                <button id="myButton" class="btn btn-sm bg-teal mt-2"><i class="nav-icon fas fa-comments" onclick="return confirm('Yuuukkk kirim pengumuman ?')"> Kirim ke semua orang</i> </button>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <hr>
                    <hr>
                    <center>
                        <h6 class="text-bold card-header bg-light p-0">Jika ingin membuat pesan atau pengumuman klik tombol di bawah ini</h6>
                    </center>
                    <a href="#input" class="btn btn-info" data-toggle="collapse">Klik Untuk Tambah Pesan / Pengumuman</a>
                    <div id="input" class="collapse">
                        <div class="card-body">
                            <center>
                                <h5 class="text-bold card-header bg-light p-0"> Isi Pesan Atau Pengumuman lewat Wa</h5>
                            </center>
                            <form action="{{Route('pesan.kirim')}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                
                                
                                   <div class="form-group">
            <label for="targets">Tujuan</label>
            <select name="targets" id="targetss" class="form-control select2bs4 @error('targets') is-invalid @enderror" >
                @if (old('targets') == true)
                <option value="{{ old('targets') }}">{{ old('targets') }}</option>
                @endif
                <option value="">-- Pilih Penerima --</option>
                <option value="1">Semua Anggota Kas</option>
                <option value="2">Semua Data Warga</option>
                @foreach($data_warga as $user)
                <option value="{{ $user->no_hp }}">{{ $user->nama }} - {{ $user->no_hp }}</option>
                @endforeach
            </select>
            @error('targets')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
  <div class="form-group" id="target1" style="display: none;">
            <label for="target1">Semua Anggota Kas:</label>
            <br>{!!$targets_all!!}
        </div>

        <div class="form-group" id="target2" style="display: none;">
            <label for="target2">Semua Data Warga:</label>
            <br>{!!$coba2!!}
        </div>
        
                                <center>
                                    <h6 class="text-bold card-header bg-light p-0"> Isi Pesan Atau Pengumuman</h6>
                                </center>
                                <div class="form-group row">
                                    <label for="pembukaan">Pembukaan</label>
                                    <textarea type="text" id="pembukaan" name="pembukaan" value="{{ old('pembukaan') }}" placeholder="Sehubungan" class="form-control col-12 @error('pembukaan') is-invalid @enderror">{{ old('pembukaan') }}</textarea>
                                    @error('pembukaan')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="isi">Isi Pesan</label>
                                    <textarea type="text" id="isi" name="isi" value="{{ old('isi') }}" placeholder="Isi pesan" class="form-control col-12 @error('isi') is-invalid @enderror">{{ old('isi') }}</textarea>
                                    @error('isi')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="penutup">Penutup Pesan</label>
                                    <textarea type="text" id="penutup" name="penutup" value="{{ old('penutup') }}" placeholder="Penutup pesan" class="form-control col-12 @error('penutup') is-invalid @enderror">{{ old('penutup') }}</textarea>
                                    @error('penutup')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <hr>
                                <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-comments"></i> Kirim Pesan</button>
                                <div id="tombol_proses"></div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            @endif
            <div class="col-12 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DATA PINJAMAN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-light">
                                    <th>No.</th>
                                    <th>Kode Pinjaman</th>
                                    <th>Pengajuan</th>
                                    <th>Sisa Waktu</th>
                                    <th>Nama anggaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                use App\Models\BayarPinjaman;

                                $no = 0; ?>
                                @foreach($data_pinjaman->get() as $data)
                                <?php $no++;


                                // Tanggal pengajuan (misalnya dari form input)
                                $tanggal_pengajuan = $data->tanggal;

                                // Mengonversi tanggal pengajuan menjadi waktu UNIX
                                $timestamp_pengajuan = strtotime($tanggal_pengajuan);

                                // Menambahkan tiga bulan ke waktu pengajuan
                                $timestamp_tiga_bulan = strtotime("+3 months", $timestamp_pengajuan);

                                // Mengonversi kembali waktu UNIX menjadi format tanggal yang diinginkan
                                $tanggal_tiga_bulan = date("Y-m-d", $timestamp_tiga_bulan);

                                // Tanggal jatuh tempo (misalnya dari database atau form input)
                                $tanggal_jatuh_tempo = $tanggal_tiga_bulan;

                                // Mengonversi tanggal jatuh tempo dan tanggal saat ini menjadi waktu UNIX
                                $timestamp_jatuh_tempo = strtotime($tanggal_jatuh_tempo);
                                $timestamp_sekarang = time();

                                // Menghitung selisih dalam detik antara tanggal jatuh tempo dan tanggal saat ini
                                $selisih_detik = $timestamp_jatuh_tempo - $timestamp_sekarang;

                                // Mengonversi selisih detik menjadi hari
                                $selisih_hari = floor($selisih_detik / (60 * 60 * 24));
                                if ($selisih_hari < 3) {
                                    $sisa_hari = "Sudah Jatuh Tempo (" . $selisih_hari . " hari)";
                                } else {
                                    $sisa_hari = $selisih_hari . " hari lagi";
                                }
                                $nama = $data->data_warga->nama;
                                $wa = $data->data_warga->no_hp;
                                $kategori = $data->anggaran->nama_anggaran;
                                $jumlah = number_format($data->jumlah, 2, ',', '.');
                                $total_bayar_pinjam = BayarPinjaman::where('pengeluaran_id', $data->id)->sum('jumlah');
                                $total_bayar = number_format($total_bayar_pinjam, 2, ',', '.');
                                $sisa = $data->jumlah - $total_bayar_pinjam;
                                $sisaa = number_format($sisa, 2, ',', '.');
                                $isi = "Kode   : $data->kode
Nama                : $nama
Kategori            :  $kategori
Tanggal Pengajuan   : $data->tanggal
Jatuh Tempo         : $tanggal_tiga_bulan
jumlah pinjaman     : Rp.$jumlah
Yang sudah masuk    : Rp.$total_bayar
Sisa                : Rp.$sisaa
                                ";

                                ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->kode}}</td>
                                    <td>{{$data->tanggal}} <b>Jatuh tempo pada</b> {{$tanggal_tiga_bulan}}</td>

                                    <td>{{$sisa_hari}}</td>

                                    <td> <a href="{{Route('form.bayar.pinjaman',Crypt::encrypt($data->id))}}" class="">{{$data->data_warga->nama}}</a></td>
                                    <td>
                                        <form action="{{Route('pesan.kirim')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <input type="hidden" id="targets" name="targets" value="{{$wa}}">
                                            <input type="hidden" id="pembukaan" name="pembukaan" value="Ngemutan kana pinjaman anu sisa waktos {{$sisa_hari}} ">
                                            <input type="hidden" id="isi" name="isi" value="{{$isi}}">
                                            <input type="hidden" id="penutup" name="penutup" value="Mohon kerjasamana kanggo kalancaran program ieu, Hatur Nuhun">
                                            <button class="btn btn-sm bg-teal mt-2"><i class="nav-icon fas fa-comments" onclick="return confirm('Leres bade ngirim pesan ka {{$data->data_warga->nama}}  ?')"> Kirim</i> </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-body -->

                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!--/. container-fluid -->
</section>
@endsection

@section('script')
    <!-- SCrip Untuk tanda bukti pembayaran -->
    <script>
        $(document).ready(function() {
            $('#targetss').change(function() {
                var kel = $('#targetss option:selected').val();
                if (kel == "1") {
                   target1.style.display = 'block';
                   target2.style.display = 'none';
            
                }else if (kel == "2") {
                target1.style.display = 'none';
                    target2.style.display = 'block';
            
                } else {
                target1.style.display = 'none';
                target2.style.display = 'none';

                     
                }
                
            });
        });
    </script>
    @endsection