@extends('backend.template_backend.layout')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- ./row -->
        <div class="row">
            @if (auth()->user()->role->nama_role == 'Admin' || auth()->user()->role->nama_role == 'Ketua' || auth()->user()->role->nama_role == 'Sekertaris' ||auth()->user()->role->nama_role == 'Bendahara' || auth()->user()->role->nama_role == 'Penasehat')
            <div class="col-12 col-sm-6">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-body">
                        <center>
                            <h5 class="text-bold card-header bg-light p-0"> Isi Pesan Atau Pengumuman lewat Wa</h5>
                        </center>
                        <hr>
                        <form action="{{Route('pesan.kirim')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="targets">Tujuan</label>
                                <select name="targets" id="targets" class="form-control select2bs4 @error('targets') is-invalid @enderror">
                                    @if (old('targets') == true)
                                    <option value="{{old('targets')}}">{{old('targets')}}</option>
                                    @endif
                                    <option value="">-- Pilih Penerima --</option>
                                    <option value="083825740395,085721635845,083879437221,081316563786,088229055820,083193829532,085942004204,083172488211,083183160853,083899197503,087721037865,083817331411">Semua Anggota Kas</option>
                                    @foreach($data_warga as $user)
                                    <option value="{{$user->no_hp}}">{{$user->nama}} - {{$user->no_hp}}</option>
                                    @endforeach
                                </select>
                                @error('targets')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
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
                                    <th>Jatuh tempo</th>
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
                                $nama = $data->data_warga->nama;
                                $no_hp = $data->data_warga->no_hp;
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
Tanggal Pengajuan   : $tanggal_tiga_bulan
jumlah pinjaman     : Rp.$jumlah
Yang sudah masuk    : Rp.$total_bayar
Sisa                : Rp.$sisaa
                                ";

                                ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->kode}}</td>
                                    <td>{{$data->tanggal}} Jatuh tempo pada {{$tanggal_tiga_bulan}}</td>
                                    @if ($selisih_hari < 3) <td>Sudah Jatuh Tempo</td>
                                        @else
                                        <td>{{$selisih_hari}} hari lagi</td>
                                        @endif
                                        <td> <a href="{{route('pinjaman.show',Crypt::encrypt($data->id))}}" class="">{{$data->data_warga->nama}}</a></td>
                                        <td>
                                            <form action="{{Route('pesan.kirim')}}" method="POST" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <input type="hidden" id="targets" name="targets" value="{{no_hp}}">
                                                <input type="hidden" id="pembukaan" name="pembukaan" value="Ngemutan kana pinjaman anu sisa waktos {{$selisih_hari}} hari deui">
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