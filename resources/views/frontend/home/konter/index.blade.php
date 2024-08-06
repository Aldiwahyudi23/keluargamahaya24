@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
    <div class="card">
        
    <a href="#input" class="btn btn-info" data-toggle="collapse">Input Transaksi Penjualan</a>
           <div class="card-body">
            <div id="input" class="collapse">
            @include('frontend.home.konter.form.tambah')
            </div>
           </div>
    </div>
    
    <div class="card card-primary card-outline card-outline-tabs">
        <center>
    <h5 class="text-bold card-header bg-light p-0"> TABEL PENGAJUAN</h5>
</center>
            
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>waktu</th>
                                    <th>status</th>
                                    <th>Layanan</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                 ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($konter_pengajuan as $data)
                                <?php $no++; 
                                
                                ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    
                                    <td>{{$data->created_at}}</td>
                                    <td>{{$data->status}}</td>
                                    <td>{{$data->kategori}} {{$data->layanan}}</td>
                                     <td><a href="{{route('konter-konfirmasi_pembayaran_lihat',Crypt::encrypt($data->id))}}" class="">
                                     {{$data->nama}}
                                     </a></td>
                    
                                    <td>{{ "Rp " . number_format($data->nominal,2,',','.') }}</td>
                                    
                                    
                                    

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <!-- /.table-body -->
                    
                    
                    </div>
                   
        <div class="card card-primary card-outline card-outline-tabs">
        <center>
    <h5 class="text-bold card-header bg-light p-0"> TABEL TAGIHAN AKTIF</h5>
</center>
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Pulsa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Listrik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-kouta-tab" data-toggle="pill" href="#custom-tabs-four-kouta" role="tab" aria-controls="custom-tabs-four-kouta" aria-selected="false">Kouta</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    
                    <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sisa Hari</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Layanan</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Tagihan</th>
                                    <th>status</th>
                                    <th>Whatsapp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($konter_tagihan_pulsa as $data)
                                <?php $no++; 
                                // Tanggal pengajuan (misalnya dari form input)
                                $tanggal_pengajuan = $data->created_at;

                                // Mengonversi tanggal pengajuan menjadi waktu UNIX
                                $timestamp_pengajuan = strtotime($tanggal_pengajuan);

                                // Menambahkan tiga bulan ke waktu pengajuan
                                $timestamp_tiga_bulan = strtotime("+1 months", $timestamp_pengajuan);

                                // Mengonversi kembali waktu UNIX menjadi format tanggal yang diinginkan
                                $tanggal_tiga_bulan = date("Y-m-d", $timestamp_tiga_bulan);

                                // Tanggal jatuh tempo (misalnya dari database atau form input)
                                $tanggal_jatuh_tempo = $data->jatuh_tempo;

                                // Mengonversi tanggal jatuh tempo dan tanggal saat ini menjadi waktu UNIX
                                $timestamp_jatuh_tempo = strtotime($tanggal_jatuh_tempo);
                                $timestamp_sekarang = time();

                                // Menghitung selisih dalam detik antara tanggal jatuh tempo dan tanggal saat ini
                                $selisih_detik = $timestamp_jatuh_tempo - $timestamp_sekarang;

                                // Mengonversi selisih detik menjadi hari
                                $selisih_hari_awal = floor($selisih_detik / (60 * 60 * 24));
                                $selisih_hari = $selisih_hari_awal + 1;
                                if ($selisih_hari == 1 | $selisih_hari == 2) {
                                    $sisa_hari = "Segera Bayar (" . $selisih_hari . ")";
                                }
                                elseif($selisih_hari == 0){
                                $sisa_hari = "Sudah Jatuh Tempo";
                                }
                                elseif($selisih_hari < 0){
                                $sisa_hari = "Sudah Lewat Jatuh Tempo  (" . $selisih_hari . "), Segera bayar";
                                }
                                else {
                                    $sisa_hari = $selisih_hari ;
                                }
                                $isi = "Layanan          : $data->kategori ($data->layanan)
Nama                : $data->user_input
No HP               : $data->no_tujuan
Tanggal Pengajuan   : $data->created_at
jumlah              : Rp.$data->nominal
*Tagihan*             : *Rp.$data->tagihan*
Jatuh Tempo         : $data->jatuh_tempo
                                ";
                                
                                ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$sisa_hari}}</td>
                                    <td>{{$data->jatuh_tempo}}</td>
                                    <td>{{$data->kategori}} {{$data->layanan}}</td>
                                     <td><a href="{{route('konter-konfirmasi_pembayaran_lihat',Crypt::encrypt($data->id))}}" class="">
                                     {{$data->nama}}
                                     </a></td>
                    
                                    <td>{{ "Rp " . number_format($data->nominal,2,',','.') }}</td>
                                    <td>{{ "Rp " . number_format($data->tagihan,2,',','.') }}</td>
                                    <td>{{$data->status}}</td>
                                    <td>
                                     <form action="{{Route('pesan.kirim')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <input type="hidden" id="targets" name="targets" value="{{$data->no_tujuan}}">
                                            <input type="hidden" id="pembukaan" name="pembukaan" value="Ngemutan kana Tagihan {{$data->kategori}} ({{$data->layanan}}) anu sisa waktos {{$sisa_hari}} hari ">
                                            <input type="hidden" id="isi" name="isi" value="{{$isi}}">
                                            <input type="hidden" id="penutup" name="penutup" value="Mohon kerjasamana kanggo kalancaran program ieu, Hatur Nuhun">
                                            <button class="btn btn-sm bg-teal mt-2"><i class="nav-icon fas fa-comments" onclick="return confirm('Leres bade ngirim pesan ka {{$data->user_input}}  ?')"> Kirim</i> </button>
                                        </form>
                                    </td>
                                    

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <!-- /.table-body -->
                    
                    
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        <table id="table1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sisa Hari</th>
                                    <th>Jatuh Tempo</th>
                                    <th>Layanan</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Tagihan</th>
                                    <th>status</th>
                                    <th>Whatsapp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($konter_tagihan_listrik as $data)
                                <?php $no++; 
                                // Tanggal pengajuan (misalnya dari form input)
                                $tanggal_pengajuan = $data->created_at;

                                // Mengonversi tanggal pengajuan menjadi waktu UNIX
                                $timestamp_pengajuan = strtotime($tanggal_pengajuan);

                                // Menambahkan tiga bulan ke waktu pengajuan
                                $timestamp_tiga_bulan = strtotime("+1 months", $timestamp_pengajuan);

                                // Mengonversi kembali waktu UNIX menjadi format tanggal yang diinginkan
                                $tanggal_tiga_bulan = date("Y-m-d", $timestamp_tiga_bulan);

                                // Tanggal jatuh tempo (misalnya dari database atau form input)
                                $tanggal_jatuh_tempo =  $data->jatuh_tempo;;

                                // Mengonversi tanggal jatuh tempo dan tanggal saat ini menjadi waktu UNIX
                                $timestamp_jatuh_tempo = strtotime($tanggal_jatuh_tempo);
                                $timestamp_sekarang = time();

                                // Menghitung selisih dalam detik antara tanggal jatuh tempo dan tanggal saat ini
                                $selisih_detik = $timestamp_jatuh_tempo - $timestamp_sekarang;

                                // Mengonversi selisih detik menjadi hari
                                $selisih_hari_awal = floor($selisih_detik / (60 * 60 * 24));
                                $selisih_hari = $selisih_hari_awal + 1;
                                if ($selisih_hari == 1 | $selisih_hari == 2) {
                                    $sisa_hari = "Segera Bayar (" . $selisih_hari . ")";
                                }
                                elseif($selisih_hari == 0){
                                $sisa_hari = "Sudah Jatuh Tempo";
                                }
                                elseif($selisih_hari < 0){
                                $sisa_hari = "Sudah Lewat Jatuh Tempo  (" . $selisih_hari . "), Segera bayar";
                                }
                                else {
                                    $sisa_hari = $selisih_hari ;
                                }
                                $isi = "Layanan          : $data->kategori ($data->layanan)
Nama                : $data->user_input
No Listrik          : $data->no_listrik
Nama Listrik        : $data->nama
Tanggal Pengajuan   : $data->created_at
jumlah              : Rp.$data->nominal
Tagihan             : Rp.$data->tagihan
Jatuh Tempo         : $data->jatuh_tempo
                                ";
                                
                                ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$sisa_hari}}</td>
                                    <td>{{$data->jatuh_tempo}}</td>
                                    <td>{{$data->layanan}}</td>
                                     <td><a href="{{route('konter-konfirmasi_pembayaran_lihat',Crypt::encrypt($data->id))}}" class="">
                                     {{$data->nama}}
                                     </a></td>
                    
                                    <td>{{ "Rp " . number_format($data->nominal,2,',','.') }}</td>
                                    <td>{{ "Rp " . number_format($data->tagihan,2,',','.') }}</td>
                                    <td>{{$data->status}}</td>
                                    <td>
                                     <form action="{{Route('pesan.kirim')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <input type="hidden" id="targets" name="targets" value="{{$data->no_tujuan}}">
                                            <input type="hidden" id="pembukaan" name="pembukaan" value="Ngemutan kana Tagihan {{$data->kategori}} ({{$data->layanan}}) anu sisa waktos {{$sisa_hari}} hari ">
                                            <input type="hidden" id="isi" name="isi" value="{{$isi}}">
                                            <input type="hidden" id="penutup" name="penutup" value="Mohon kerjasamana kanggo kalancaran program ieu, Hatur Nuhun">
                                            <button class="btn btn-sm bg-teal mt-2"><i class="nav-icon fas fa-comments" onclick="return confirm('Leres bade ngirim pesan ka {{$data->user_input}}  ?')"> Kirim</i> </button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <!-- /.table-body -->
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-kouta" role="tabpanel" aria-labelledby="custom-tabs-four-kouta-tab">
                        <table id="table1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Layanan</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Tagihan</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($konter_tagihan_kouta as $data)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->kategori}} {{$data->layanan}}</td>
                                     <td><a href="{{route('konter-konfirmasi_pembayaran_lihat',Crypt::encrypt($data->id))}}" class="">
                                     {{$data->nama}}
                                     </a></td>
                    
                                    <td>{{ "Rp " . number_format($data->nominal,2,',','.') }}</td>
                                    <td>{{ "Rp " . number_format($data->tagihan,2,',','.') }}</td>
                                    <td>{{$data->status}}</td>
                                    

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <!-- /.table-body -->
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="card card-primary card-tabs">
        <center>
    <h5 class="text-bold card-header bg-light p-0"> DATA TRANSAKSI</h5>
</center>
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-Kas-tab" data-toggle="pill" href="#pulsa" role="tab" aria-controls="custom-tabs-one-Kas" aria-selected="true">pulsa</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-home-tab" data-toggle="pill" href="#listrik" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">listrik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-home-tab" data-toggle="pill" href="#kouta" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">kouta</a>
                    </li>
                    

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active " id="pulsa" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        <table id="table2" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Layanan</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Keuntungan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($all_pulsa as $data)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->kategori}} {{$data->layanan}}</td>
                                     <td><a href="{{route('konter-lihat',Crypt::encrypt($data->id))}}" class="">
                                     {{$data->nama}}
                                     </a></td>
                                    <td>{{ "Rp " . number_format($data->nominal,2,',','.') }}</td>
                                    <td>{{ "Rp " . number_format($data->diskon + $data->margin,2,',','.') }}</td>
                                    
                                    <td>{{$data->status}}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <!-- /.table-body -->
                    </div>
                    <div class="tab-pane fade show " id="listrik" role="tabpanel" aria-labelledby="custom-tabs-one-Kas-tab">
                        <table id="table3" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Layanan</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Keuntungan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($all_listrik as $data)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->layanan}}</td>
                                     <td><a href="{{route('konter-lihat',Crypt::encrypt($data->id))}}" class="">
                                     {{$data->nama}}
                                     </a></td>
                                    <td>{{ "Rp " . number_format($data->nominal,2,',','.') }}</td>
                                    <td>{{ "Rp " . number_format($data->diskon + $data->margin,2,',','.') }}</td>
                                    <td>{{$data->status}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-body -->
                    </div>
                    <div class="tab-pane fade show" id="kouta" role="tabpanel" aria-labelledby="custom-tabs-one-tabungan-tab">
                        <table id="table4" class="table table-bordered table-striped table-responsive">
  <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Layanan</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Keuntungan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($all_kouta as $data)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->kategori}} {{$data->layanan}}</td>
                                     <td><a href="{{route('konter-lihat',Crypt::encrypt($data->id))}}" class="">
                                     {{$data->nama}}
                                     </a></td>
                                    <td>{{ "Rp " . number_format($data->nominal,2,',','.') }}</td>
                                    <td>{{ "Rp " . number_format($data->diskon + $data->margin,2,',','.') }}</td>
                                    <td>{{$data->status}}</td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-body -->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    @endsection