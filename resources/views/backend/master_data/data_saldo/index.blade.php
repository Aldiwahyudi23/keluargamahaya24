@extends('backend.template_backend.layout')

@section('content')

<!-- Main content -->
<section class="content">
<?php
        $cek_bayar_pinjaman = $saldo_akhir->total_kas + $saldo_akhir->bunga_neo + $saldo_akhir->bunga_tabungan + $saldo_akhir->jumlah_lebih_pinjaman;
           $bayar_pinjaman = $cek_bayar_pinjaman - $saldo_akhir->saldo_atm_kas;
           //cek bayar Pinjaman apakah ada lebih dari saldo atam 
           $cek_total_kas = $saldo_akhir->saldo_kas + $saldo_akhir->saldo_darurat + $saldo_akhir->saldo_amal + $saldo_akhir->saldo_pinjaman + $saldo_akhir->bunga_neo + $saldo_akhir->bunga_tabungan + $saldo_akhir->jumlah_lebih_pinjaman;;
           //mengambil data bayar pinjaman
           $kas = ($cek_total_kas - $saldo_akhir->saldo_atm_kas) - $bayar_pinjaman ;
           //mengambil data Tabungan 
           $tabungan =$saldo_akhir->total_tabungan - $saldo_akhir->saldo_atm_tabungan;
           //menghitung Total Kas
           $total_semua_kas = $saldo_akhir->total_kas + $saldo_akhir->bunga_neo + $saldo_akhir->bunga_tabungan + $saldo_akhir->jumlah_lebih_pinjaman + $kas;
           //menghitung Saldo Kas Keseluruhan
           $saldo_semua_kas = $saldo_akhir->saldo_kas + $saldo_akhir->bunga_neo + $saldo_akhir->bunga_tabungan + $saldo_akhir->jumlah_lebih_pinjaman + $kas;
           
           
           
//menghitung semua data Sesuai data 
$ot_kas = $total_dana_kas - $total_pengeluaran_kas_3 + $total_bayar_pinjaman_lebih;
$ot_darurat = $total_dana_darurat - $total_pengeluaran_darurat;
$ot_amal = $total_dana_amal - $total_pengeluaran_amal;
$ot_pinjaman = $total_dana_pinjam -  $total_pengeluaran_pinjaman + $total_bayar_pinjaman_semua;
$ot_atm_tabungan = $total_tabungan - $total_pengeluaran_tarik_pinjaman ;
$ot_atm_kas = $saldo_bank  + $total_bayar_pinjaman_lebih - $ot_atm_tabungan;


$ot_total_kas = $saldo_kas + $total_bayar_pinjaman_lebih + $total_bunga_neo + $total_bunga_tabungan -($total_pengeluaran_pinjaman - $total_bayar_pinjaman_semua) ;

$cek_kas = $ot_kas - ($saldo_akhir->saldo_kas + $saldo_akhir->jumlah_lebih_pinjaman) ;
if($cek_kas == 0) {
$hasil_cek_kas = 0;
}else{
$hasil_cek_kas = $cek_kas;
}

$cek_darurat = $ot_darurat - $saldo_akhir->saldo_darurat ;
if($cek_darurat == 0) {
$hasil_cek_darurat = 0;
}else{
$hasil_cek_darurat = $cek_darurat;
}

$cek_amal = $ot_amal - $saldo_akhir->saldo_amal ;
if($cek_amal == 0) {
$hasil_cek_amal = 0;
}else{
$hasil_cek_amal = $cek_amal;
}
$cek_pinjaman = $ot_pinjaman - $saldo_akhir->saldo_pinjaman ;
if($cek_pinjaman == 0) {
$hasil_cek_pinjaman = 0;
}else{
$hasil_cek_pinjaman = $cek_pinjaman;
}
$cek_total_kas = $ot_total_kas - $total_semua_kas ;
if($cek_total_kas == 0) {
$hasil_cek_total_kas = 0;
}else{
$hasil_cek_total_kas = $cek_total_kas;
}
$cek_atm_kas = $ot_atm_kas - $saldo_akhir->saldo_atm_kas ;
if($cek_atm_kas == 0) {
$hasil_cek_atm_kas = 0;
}else{
$hasil_cek_atm_kas = $cek_atm_kas;
}
$cek_atm_tabungan = $ot_atm_tabungan - $saldo_akhir->saldo_atm_tabungan ;
if($cek_atm_tabungan == 0) {
$hasil_cek_atm_tabungan = 0;
}else{
$hasil_cek_atm_tabungan = $cek_atm_tabungan;
}
$cek_bunga_tabungan = $total_bunga_tabungan - $saldo_akhir->bunga_tabungan;
if($cek_bunga_tabungan == 0) {
$hasil_cek_bunga_tabungan = 0;
}else{
$hasil_cek_bunga_tabungan = $cek_bunga_tabungan;
}
$cek_bunga_neo = $total_bunga_neo - $saldo_akhir->bunga_neo;
if($cek_bunga_neo == 0) {
$hasil_cek_bunga_neo = 0;
}else{
$hasil_cek_bunga_neo = $cek_bunga_neo;
}
$cek_lebih_pinjaman = $total_bayar_pinjaman_lebih - $saldo_akhir->jumlah_lebih_pinjaman;
if($cek_lebih_pinjaman == 0) {
$hasil_cek_lebih_pinjaman = 0;
}else{
$hasil_cek_lebih_pinjaman = $cek_lebih_pinjaman;
}
        ?>   

<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <b><i class="fas fa-info"></i> INFO !!!</b> <br>
    @if($kas > 1)
    Segera Setorkeun artos KAS : {{ "Rp " . number_format($kas,2,',','.') }}
    @endif
    @if($tabungan > 1)
    Segera Setorkeun artos Tabungan : {{ "Rp " . number_format($tabungan,2,',','.') }}
    @endif
    @if($bayar_pinjaman > 1)
    Segera Setorkeun artos Bayar Pinjaman: {{ "Rp " . number_format($bayar_pinjaman,2,',','.') }}
    @endif
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


    <div class="container-fluid">
        <!-- ./row -->
        <div class="row">
            @if (auth()->user()->role->nama_role == 'Admin' || auth()->user()->role->nama_role == 'Ketua' || auth()->user()->role->nama_role == 'Sekertaris' ||auth()->user()->role->nama_role == 'Bendahara' || auth()->user()->role->nama_role == 'Penasehat')   
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Laporan</h3
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table">
                        
                            <tbody>
                              <tr>
                                <td><b> Saldo ATM Kas</b></td>
                                <td>:</td>
                                <td>
                                {{ "Rp " . number_format($saldo_akhir->saldo_atm_kas,2,',','.') }}
                               <span class="text-warning" style="font-size: 13px">
                               {{ "Rp " . number_format($total_semua_kas - $saldo_akhir->saldo_atm_kas,2,',','.') }}
                               </span><br>
                               <span class="text-danger" style="font-size: 13px">
                               {{ "Rp " . number_format($hasil_cek_atm_kas,2,',','.') }}
                               </span>
                                </td>
                             </tr>
                             
                             <tr>
                                <td><b> Total Kas</b></td>
                                <td>:</td>
                                <td>
                                {{ "Rp " . number_format($total_semua_kas,2,',','.') }}
                                <span class="text-danger" style="font-size: 13px">
                               {{ "Rp " . number_format($hasil_cek_total_kas,2,',','.') }}
                               </span>
                                </td>
                             </tr>
                             <tr>
                                <td><b> Saldo Semua Kas</b></td>
                                <td>:</td>
                                <td>
                                {{ "Rp " . number_format($saldo_semua_kas,2,',','.') }}
                                <span class="text-danger" style="font-size: 13px">
                              
                               </span>
                                </td>
                             </tr>
                             <tr>
                                <td><b> Saldo Kas</b></td>
                                <td>:</td>
                                <td>
                                {{ "Rp " . number_format($saldo_akhir->saldo_kas,2,',','.') }}
                                <span class="text-danger" style="font-size: 13px">
                                 {{ "Rp " . number_format($hasil_cek_kas,2,',','.') }}
                               </span>
                                </td>
                             </tr>
                             <tr>
                                <td><b> Saldo Amal</b></td>
                                <td>:</td>
                                <td>
                                {{ "Rp " . number_format($saldo_akhir->saldo_amal,2,',','.') }}
                                <span class="text-danger" style="font-size: 13px">
                               {{ "Rp " . number_format($hasil_cek_amal,2,',','.') }}
                               </span>
                                </td>
                             </tr>
                             <tr>
                                <td><b> Saldo Darurat</b></td>
                                <td>:</td>
                                <td>
                                {{ "Rp " . number_format($saldo_akhir->saldo_darurat,2,',','.') }}
                                <span class="text-danger" style="font-size: 13px">
                               {{ "Rp " . number_format($hasil_cek_darurat,2,',','.') }}
                               </span>
                                </td>
                             </tr>
                             <tr>
                                <td><b> Saldo Pinjaman</b></td>
                                <td>:</td>
                                <td>
                                {{ "Rp " . number_format($saldo_akhir->saldo_pinjaman,2,',','.') }}
                                <span class="text-warning" style="font-size: 13px">
                               {{ "Rp " . number_format($bayar_pinjaman,2,',','.') }}
                               </span><br>
                               <span class="text-danger" style="font-size: 13px">
                               {{ "Rp " . number_format($hasil_cek_pinjaman,2,',','.') }}
                               </span>
                                </td>
                             </tr>
                             <tr>
                                <td><b> Bunga Neo</b></td>
                                <td>:</td>
                                <td>
                                {{ "Rp " . number_format($saldo_akhir->bunga_neo,2,',','.') }}
                                <span class="text-danger" style="font-size: 13px">
                               {{ "Rp " . number_format($hasil_cek_bunga_neo,2,',','.') }}
                               </span>
                                </td>
                             </tr>
                             <tr>
                                <td><b> Bunga Tabungan Neo</b></td>
                                <td>:</td>
                                <td>
                                {{ "Rp " . number_format($saldo_akhir->bunga_tabungan,2,',','.') }}
                                <span class="text-danger" style="font-size: 13px">
                               {{ "Rp " . number_format($hasil_cek_bunga_tabungan,2,',','.') }}
                               </span>
                                </td>
                             </tr>
                             <tr>
                                <td><b> Jumlah Lebih Pinjaman</b></td>
                                <td>:</td>
                                <td>
                                {{ "Rp " . number_format($saldo_akhir->jumlah_lebih_pinjaman,2,',','.') }}
                                <span class="text-danger" style="font-size: 13px">
                               {{ "Rp " . number_format($hasil_cek_lebih_pinjaman,2,',','.') }}
                               </span>
                                </td>
                             </tr>
                             
                            </tbody>
                        </table>
                        <!-- /.table-body -->

                    </div>
                    <div class="card-header">
                        <h3 class="card-title">Laporan Tabungan</h3
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table">
                        
                            <tbody>
                              
                             <tr>
                                <td><b> Saldo ATM Tabungan</b></td>
                                <td>:</td>
                                <td>
                                {{ "Rp " . number_format($saldo_akhir->saldo_atm_tabungan,2,',','.') }}
                                <span class="text-danger" style="font-size: 13px">
                               {{ "Rp " . number_format($saldo_akhir->total_tabungan - $saldo_akhir->saldo_atm_tabungan,2,',','.') }}
                               </span>
                                </td>
                             </tr>
                            
                             <tr>
                                <td><b> Total Tabungan</b></td>
                                <td>:</td>
                                <td>
                                {{ "Rp " . number_format($saldo_akhir->total_tabungan,2,',','.') }}
                                <span class="text-danger" style="font-size: 13px">
                               Input
                               </span>
                                </td>
                             </tr>
                             
                            </tbody>
                        </table>
                        <!-- /.table-body -->

                    </div>
                    
                    
                    
                </div>
                <!-- /.card -->
            </div>
            
            
            
            
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Saldo</h3>
                        
                    </div>
                    <!-- /.card-header -->
                    
                        <table id="table1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr class="bg-light">
                                    <th>No.</th>
                                    <th>ID Transaksi</th>
                                    <th>ATM Kas</th>
                                    <th>ATM Tabungan</th>
                                    <th>Saldo Belum TF</th>
                                    <th>Total Kas</th>
                                    <th>Total Tabungan</th>
                                    <th>Saldo Kas</th>
                                    <th>Saldo Darurat</th>
                                    <th>Saldo Amal</th>
                                    <th>Saldo Pinjaman</th>
                                    <th>Bunga Neo</th>
                                    <th>Bunga Tabungan Neo</th>
                                    <th>Saldo Lebih Pinjaman</th>
                                    <th>Tanggal Masuk</th>
                                    
                                 
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 0; ?>
                                @foreach($saldo_2_data as $data)
                                <?php $no++; ?>
                                 <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->id_transaksi}}</td>
                                    <td> {{ "Rp " . number_format($data->saldo_atm_kas,2,',','.') }}</td>
                                    <td> {{ "Rp " . number_format($data->saldo_atm_tabungan,2,',','.') }}</td>
                                    <td> {{ "Rp " . number_format($data->total_diluar,2,',','.') }}</td>
                                    <td> {{ "Rp " . number_format($data->total_kas,2,',','.') }}</td>
                                    <td> {{ "Rp " . number_format($data->total_tabungan,2,',','.') }}</td>
                                    <td> {{ "Rp " . number_format($data->saldo_kas,2,',','.') }}</td>
                                    <td> {{ "Rp " . number_format($data->saldo_darurat,2,',','.') }}</td>
                                    <td> {{ "Rp " . number_format($data->saldo_amal,2,',','.') }}</td>
                                    <td> {{ "Rp " . number_format($data->saldo_pinjaman,2,',','.') }}</td>
                                    <td> {{ "Rp " . number_format($data->bunga_neo,2,',','.') }}</td>
                                    <td> {{ "Rp " . number_format($data->bunga_tabungan,2,',','.') }}</td>
                                    <td> {{ "Rp " . number_format($data->jumlah_lebih_pinjaman,2,',','.') }}</td>
                                    <td> {{$data->created_at}}</td>
                                  
                                </tr>
                                @endforeach
                            </tbody>
                            <tr>
                                    <td></td>
                                    <td>Selisih</td>
                                    <td class="text-danger" style="font-size: 13px"> {{ "Rp " . number_format($saldo_2_data[0]->saldo_atm_kas - $saldo_2_data[1]->saldo_atm_kas,2,',','.') }}</td>
                                    <td  class="text-danger" style="font-size: 13px"> {{ "Rp " . number_format($saldo_2_data[0]->saldo_atm_tabungan - $saldo_2_data[1]->saldo_atm_tabungan,2,',','.') }}</td>
                                    <td  class="text-danger" style="font-size: 13px"> {{ "Rp " . number_format($saldo_2_data[0]->total_tabungan - $saldo_2_data[1]->total_tabungan,2,',','.') }}</td>
                                    <td  class="text-danger" style="font-size: 13px"> {{ "Rp " . number_format($saldo_2_data[0]->total_diluar - $saldo_2_data[1]->total_diluar,2,',','.') }}</td>
                                    <td  class="text-danger" style="font-size: 13px"> {{ "Rp " . number_format($saldo_2_data[0]->total_tabungan - $saldo_2_data[1]->total_tabungan,2,',','.') }}</td>
                                    <td  class="text-danger" style="font-size: 13px"> {{ "Rp " . number_format($saldo_2_data[0]->saldo_kas - $saldo_2_data[1]->saldo_kas,2,',','.') }}</td>
                                    <td  class="text-danger" style="font-size: 13px"> {{ "Rp " . number_format($saldo_2_data[0]->saldo_darurat - $saldo_2_data[1]->saldo_darurat,2,',','.') }}</td>
                                    <td  class="text-danger" style="font-size: 13px"> {{ "Rp " . number_format($saldo_2_data[0]->saldo_amal - $saldo_2_data[1]->saldo_amal,2,',','.') }}</td>
                                    <td  class="text-danger" style="font-size: 13px"> {{ "Rp " . number_format($saldo_2_data[0]->saldo_pinjaman - $saldo_2_data[1]->saldo_pinjaman,2,',','.') }}</td>
                                    <td  class="text-danger" style="font-size: 13px"> {{ "Rp " . number_format($saldo_2_data[0]->bunga_neo - $saldo_2_data[1]->bunga_neo,2,',','.') }}</td>
                                    <td  class="text-danger" style="font-size: 13px"> {{ "Rp " . number_format($saldo_2_data[0]->bunga_tabungan - $saldo_2_data[1]->bunga_tabungan,2,',','.') }}</td>
                                    <td  class="text-danger" style="font-size: 13px"> {{ "Rp " . number_format($saldo_2_data[0]->jumlah_lebih_pinjaman 
- $saldo_2_data[1]->jumlah_lebih_pinjaman ,2,',','.') }}</td>
                                    <td></td>
                                  
                                </tr>
                        </table>
                        <!-- /.table-body -->

                    
                </div>
                <!-- /.card -->
            </div>
            @endif
        </div>
        <!-- /.row -->
    </div><!--/. container-fluid -->
</section>
@endsection