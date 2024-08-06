<!DOCTYPE html>
<html lang="en">

<?php

use App\Models\ProfileApp;

$profile_app = ProfileApp::first();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$profile_app->nama}}</title>
    <link rel="shrotcut icon" href="{{$profile_app->logo}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('layouts/dist/css/adminlte.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/summernote/summernote-bs4.min.css')}}">
    <!-- Theme style -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('layouts/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    #harga_jual {
        font-size: 2em;
        color: red;
    }
    .hidden {
        display: none;
    }
    .small-red-label {
        font-size: 12px;
        color: red;
    }
    .nominal-btn.active {
        background-color: #007bff;
        color: white;
    }
</style>

</head>


<body class="hold-transition white-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        
        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Notifikasi -->
            @if(session('sukses'))
<div class="container">
    <div class="callout callout-success alert alert-success alert-dismissible fade show" role="alert">
        <h5><i class="fas fa-check"></i> Sukses :</h5>
        {{session('sukses')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

@if(session('kuning'))
<div class="container">
    <div class="callout callout-warning alert alert-warning alert-dismissible fade show" role="alert">
        <h5><i class="fas fa-info"></i> Informasi :</h5>
        {{session('kuning')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if(session('infoes'))
<div class="container">
    <div class="callout callout-primary alert alert-primary alert-dismissible fade show" role="alert">
        <h5><i class="fas fa-info"></i> Informasi :</h5>
        {{session('infoes')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if ($errors->any())
<div class="container">
    <div class="callout callout-danger alert alert-danger alert-dismissible fade show">
        <h5><i class="fas fa-exclamation-triangle"></i> Peringatan :</h5>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

            <!-- Main content -->
            <section class="content">
                <div class="contsiner-fluid">
                    
                    
                    <!-- ./row -->
<div class="row">

<div class="col-12 col-sm-6">
        <div class="card card-primary card-tabs">
        @if($kategori == "Pulsa")
        <center>
    <h5 class="text-bold card-header bg-light p-0">YUK CEK HARGA</h5>
</center>
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-Kas-tab" data-toggle="pill" href="#pulsaa" role="tab" aria-controls="custom-tabs-one-Kas" aria-selected="true">Pulsa</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#listriik" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false"></a>
                    </li>
                    
                    

                </ul>
            </div>
            <div class="card-body">
                
                @include('frontend.home.konter.form.cek_harga_pulsa')
                
             </div>
             @endif
             @if($kategori == "Token Listrik")
        <center>
    <h5 class="text-bold card-header bg-light p-0">YUK BELI TOKEN DI SINI</h5>
</center>
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" href="#" role="tab"  aria-selected="true">Token Listrik</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('transactions.cek_tagihan_listrik')}}" role="tab"  aria-selected="false">Tagihan Listrik</a>
                    </li>
                    
                    

                </ul>
            </div>
            <div class="card-body">
                
                @include('frontend.home.konter.form.cek_harga_token_listrik')
                
             </div>
             @endif
             @if($kategori == "Tagihan Listrik")
        <center>
    <h5 class="text-bold card-header bg-light p-0">YUK BAYAR LISTRIK DI SINI</h5>
</center>
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                   
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('transactions.cek_token_listrik')}}" role="tab"  aria-selected="true">Token Listrik</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="#" role="tab"  aria-selected="false">Tagihan Listrik</a>
                    </li>
                    
                    

                </ul>
            </div>
            <div class="card-body">
                
                @include('frontend.home.konter.form.cek_harga_tagihan_listrik')
                
             </div>
             @endif
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
                        <a class="nav-link active" id="custom-tabs-one-Kas-tab" data-toggle="pill" href="#pulsa" role="tab" aria-controls="custom-tabs-one-Kas" aria-selected="true">Pengajuan</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-home-tab" data-toggle="pill" href="#listrik" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">Semua Transaksi</a>
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
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($all_pengajuan as $data)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->kategori}} {{$data->layanan}}</td>
                                     <td><a href="{{route('konter-lihat',Crypt::encrypt($data->id))}}" class="">
                                     {{$data->nama}}
                                     </a></td>
                                    <td>{{ "Rp " . number_format($data->nominal,2,',','.') }}</td>
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
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($all_konter as $data)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->layanan}}</td>
                                     <td><a href="{{route('konter-lihat',Crypt::encrypt($data->id))}}" class="">
                                     {{$data->nama}}
                                     </a></td>
                                    <td>{{ "Rp " . number_format($data->nominal,2,',','.') }}</td>
                                    
                                    

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
        </div>
                    
                    
                    
                    
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        


 <!-- REQUIRED SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <!-- jQuery -->
 <script src="{{asset('layouts/plugins/jquery/jquery.min.js')}}"></script>
 <!-- Bootstrap -->
 <script src="{{asset('layouts/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- overlayScrollbars -->
 <script src="{{asset('layouts/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
 <!-- AdminLTE App -->
 <script src="{{asset('layouts/dist/js/adminlte.js')}}"></script>

 <!-- PAGE PLUGINS -->
 <!-- jQuery Mapael -->
 <script src="{{asset('layouts/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
 <script src="{{asset('layouts/plugins/raphael/raphael.min.js')}}"></script>
 <script src="{{asset('layouts/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
 <script src="{{asset('layouts/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
 <!-- ChartJS -->
 <script src="{{asset('layouts/plugins/chart.js/Chart.min.js')}}"></script>

 <script src="{{asset('layouts/dist/js/pages/dashboard2.js')}}"></script>
 <!-- scrip untuk navigasi bawah -->
 <!-- DataTables  & Plugins -->
 <script src="{{asset('layouts/plugins/datatables/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('layouts/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
 <script src="{{asset('layouts/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{asset('layouts/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
 <script src="{{asset('layouts/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
 <script src="{{asset('layouts/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
 <script src="{{asset('layouts/plugins/jszip/jszip.min.js')}}"></script>
 <script src="{{asset('layouts/plugins/pdfmake/pdfmake.min.js')}}"></script>
 <script src="{{asset('layouts/plugins/pdfmake/vfs_fonts.js')}}"></script>
 <script src="{{asset('layouts/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
 <script src="{{asset('layouts/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
 <script src="{{asset('layouts/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
 <!-- Summernote -->
 <script src="{{asset('layouts/plugins/summernote/summernote-bs4.min.js')}}"></script>
 <!-- Select2 -->
 <script src="{{asset('layouts/plugins/select2/js/select2.full.min.js')}}"></script>
 <!-- Bootstrap Switch -->
 <script src="{{asset('layouts/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
 @yield('script')
 <!-- Page specific script -->
 
 <!-- resources/views/your_page.blade.php -->
 
 
 <!-- Validasi jumlah  ============================================-->
    
<script>
     $(function() {
         $("#example1").DataTable({
             "responsive": true,
             "lengthChange": true,
             "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
         $("#table1").DataTable({
             "responsive": true,
             "lengthChange": true,
             "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');
         $("#table2").DataTable({
             "responsive": true,
             "lengthChange": true,
             "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#table2_wrapper .col-md-6:eq(0)');
         $("#table3").DataTable({
             "responsive": true,
             "lengthChange": true,
             "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#table3_wrapper .col-md-6:eq(0)');
         $("#table4").DataTable({
             "responsive": true,
             "lengthChange": true,
             "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#table4_wrapper .col-md-6:eq(0)');
         $("#table5").DataTable({
             "responsive": true,
             "lengthChange": true,
             "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#table5_wrapper .col-md-6:eq(0)');
         $("#table6").DataTable({
             "responsive": true,
             "lengthChange": true,
             "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#table6_wrapper .col-md-6:eq(0)');
         $("#table7").DataTable({
             "responsive": true,
             "lengthChange": true,
             "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#table7_wrapper .col-md-6:eq(0)');
         $("#table8").DataTable({
             "responsive": true,
             "lengthChange": true,
             "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#table8_wrapper .col-md-6:eq(0)');
         $("#table9").DataTable({
             "responsive": true,
             "lengthChange": true,
             "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#table9_wrapper .col-md-6:eq(0)');
         $("#table10").DataTable({
             "responsive": true,
             "lengthChange": true,
             "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#table10_wrapper .col-md-6:eq(0)');

     });
 </script>
 <!-- Page specific script -->
 <script>
     $("#MasterData").addClass("active");
     $("#liMasterData").addClass("menu-open");
     $("#DataKeluarga").addClass("active");
 </script>

 <script>
     fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
         .then((response) => response.json())
         .then((provinces) => {
             var data = provinces;
             var tampung = `<option>Pilih</option>`;
             data.forEach((element) => {
                 tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
             });
             document.getElementById("provinsi").innerHTML = tampung;
         });
 </script>
 <script>
     const selectProvinsi = document.getElementById('provinsi');
     const selectKota = document.getElementById('kota');
     const selectKecamatan = document.getElementById('kecamatan');
     const selectKelurahan = document.getElementById('kelurahan');

     selectProvinsi.addEventListener('change', (e) => {
         var provinsi = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
             .then((response) => response.json())
             .then((regencies) => {
                 var data = regencies;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kota').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kecamatan').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kota").innerHTML = tampung;
             });
     });

     selectKota.addEventListener('change', (e) => {
         var kota = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kota}.json`)
             .then((response) => response.json())
             .then((districts) => {
                 var data = districts;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kecamatan').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kecamatan").innerHTML = tampung;
             });
     });
     selectKecamatan.addEventListener('change', (e) => {
         var kecamatan = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
             .then((response) => response.json())
             .then((villages) => {
                 var data = villages;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kelurahan').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kelurahan").innerHTML = tampung;
             });
     });
 </script>

 <script>
     fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
         .then((response) => response.json())
         .then((provinces) => {
             var data = provinces;
             var tampung = `<option>Pilih</option>`;
             data.forEach((element) => {
                 tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
             });
             document.getElementById("provinsi1").innerHTML = tampung;

         });
 </script>
 <script>
     const selectProvinsi1 = document.getElementById('provinsi1');
     const selectKota1 = document.getElementById('kota1');
     const selectKecamatan1 = document.getElementById('kecamatan1');
     const selectKelurahan1 = document.getElementById('kelurahan1');

     selectProvinsi1.addEventListener('change', (e) => {
         var provinsi = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
             .then((response) => response.json())
             .then((regencies) => {
                 var data = regencies;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kota1').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kecamatan1').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan1').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kota1").innerHTML = tampung;
             });
     });

     selectKota1.addEventListener('change', (e) => {
         var kota = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kota}.json`)
             .then((response) => response.json())
             .then((districts) => {
                 var data = districts;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kecamatan1').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan1').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kecamatan1").innerHTML = tampung;
             });
     });
     selectKecamatan1.addEventListener('change', (e) => {
         var kecamatan = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
             .then((response) => response.json())
             .then((villages) => {
                 var data = villages;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kelurahan1').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kelurahan1").innerHTML = tampung;
             });
     });
 </script>

 <script>
     fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
         .then((response) => response.json())
         .then((provinces) => {
             var data = provinces;
             var tampung = `<option>Pilih</option>`;
             data.forEach((element) => {
                 tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
             });
             document.getElementById("provinsi2").innerHTML = tampung;
         });
 </script>
 <script>
     const selectProvinsi2 = document.getElementById('provinsi2');
     const selectKota2 = document.getElementById('kota2');
     const selectKecamatan2 = document.getElementById('kecamatan2');
     const selectKelurahan2 = document.getElementById('kelurahan2');

     selectProvinsi2.addEventListener('change', (e) => {
         var provinsi = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
             .then((response) => response.json())
             .then((regencies) => {
                 var data = regencies;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kota2').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kecamatan2').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan2').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kota2").innerHTML = tampung;
             });
     });

     selectKota2.addEventListener('change', (e) => {
         var kota = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kota}.json`)
             .then((response) => response.json())
             .then((districts) => {
                 var data = districts;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kecamatan2').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan2').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kecamatan2").innerHTML = tampung;
             });
     });
     selectKecamatan2.addEventListener('change', (e) => {
         var kecamatan = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
             .then((response) => response.json())
             .then((villages) => {
                 var data = villages;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kelurahan2').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kelurahan2").innerHTML = tampung;
             });
     });
 </script>

 <script>
     fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
         .then((response) => response.json())
         .then((provinces) => {
             var data = provinces;
             var tampung = `<option>Pilih</option>`;
             data.forEach((element) => {
                 tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
             });
             document.getElementById("provinsi4").innerHTML = tampung;
         });
 </script>
 <script>
     const selectProvinsi4 = document.getElementById('provinsi4');
     const selectKota4 = document.getElementById('kota4');
     const selectKecamatan4 = document.getElementById('kecamatan4');
     const selectKelurahan4 = document.getElementById('kelurahan4');

     selectProvinsi4.addEventListener('change', (e) => {
         var provinsi = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
             .then((response) => response.json())
             .then((regencies) => {
                 var data = regencies;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kota4').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kecamatan4').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan4').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kota4").innerHTML = tampung;
             });
     });

     selectKota4.addEventListener('change', (e) => {
         var kota = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kota}.json`)
             .then((response) => response.json())
             .then((districts) => {
                 var data = districts;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kecamatan4').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan4').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kecamatan4").innerHTML = tampung;
             });
     });
     selectKecamatan4.addEventListener('change', (e) => {
         var kecamatan = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
             .then((response) => response.json())
             .then((villages) => {
                 var data = villages;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kelurahan4').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kelurahan4").innerHTML = tampung;
             });
     });
 </script>

 <script>
     fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
         .then((response) => response.json())
         .then((provinces) => {
             var data = provinces;
             var tampung = `<option>Pilih</option>`;
             data.forEach((element) => {
                 tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
             });
             document.getElementById("provinsi5").innerHTML = tampung;
         });
 </script>
 <script>
     const selectProvinsi5 = document.getElementById('provinsi5');
     const selectKota5 = document.getElementById('kota5');
     const selectKecamatan5 = document.getElementById('kecamatan5');
     const selectKelurahan5 = document.getElementById('kelurahan5');

     selectProvinsi5.addEventListener('change', (e) => {
         var provinsi = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
             .then((response) => response.json())
             .then((regencies) => {
                 var data = regencies;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kota5').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kecamatan5').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan5').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kota5").innerHTML = tampung;
             });
     });

     selectKota5.addEventListener('change', (e) => {
         var kota = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kota}.json`)
             .then((response) => response.json())
             .then((districts) => {
                 var data = districts;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kecamatan5').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan5').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kecamatan5").innerHTML = tampung;
             });
     });
     selectKecamatan5.addEventListener('change', (e) => {
         var kecamatan = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
             .then((response) => response.json())
             .then((villages) => {
                 var data = villages;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kelurahan5').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kelurahan5").innerHTML = tampung;
             });
     });
 </script>

 <script>
     fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
         .then((response) => response.json())
         .then((provinces) => {
             var data = provinces;
             var tampung = `<option>Pilih</option>`;
             data.forEach((element) => {
                 tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
             });
             document.getElementById("provinsi6").innerHTML = tampung;
         });
 </script>
 <script>
     const selectProvinsi6 = document.getElementById('provinsi6');
     const selectKota6 = document.getElementById('kota6');
     const selectKecamatan6 = document.getElementById('kecamatan6');
     const selectKelurahan6 = document.getElementById('kelurahan6');

     selectProvinsi6.addEventListener('change', (e) => {
         var provinsi = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
             .then((response) => response.json())
             .then((regencies) => {
                 var data = regencies;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kota6').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kecamatan6').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan6').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kota6").innerHTML = tampung;
             });
     });

     selectKota6.addEventListener('change', (e) => {
         var kota = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kota}.json`)
             .then((response) => response.json())
             .then((districts) => {
                 var data = districts;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kecamatan6').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan6').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kecamatan6").innerHTML = tampung;
             });
     });
     selectKecamatan6.addEventListener('change', (e) => {
         var kecamatan = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
             .then((response) => response.json())
             .then((villages) => {
                 var data = villages;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kelurahan6').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kelurahan6").innerHTML = tampung;
             });
     });
 </script>

 <script>
     fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
         .then((response) => response.json())
         .then((provinces) => {
             var data = provinces;
             var tampung = `<option>Pilih</option>`;
             data.forEach((element) => {
                 tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
             });
             document.getElementById("provinsi7").innerHTML = tampung;
         });
 </script>
 <script>
     const selectProvinsi7 = document.getElementById('provinsi7');
     const selectKota7 = document.getElementById('kota7');
     const selectKecamatan7 = document.getElementById('kecamatan7');
     const selectKelurahan7 = document.getElementById('kelurahan7');

     selectProvinsi7.addEventListener('change', (e) => {
         var provinsi = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
             .then((response) => response.json())
             .then((regencies) => {
                 var data = regencies;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kota7').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kecamatan7').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan7').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kota7").innerHTML = tampung;
             });
     });

     selectKota7.addEventListener('change', (e) => {
         var kota = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kota}.json`)
             .then((response) => response.json())
             .then((districts) => {
                 var data = districts;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kecamatan7').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan7').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kecamatan7").innerHTML = tampung;
             });
     });
     selectKecamatan7.addEventListener('change', (e) => {
         var kecamatan = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
             .then((response) => response.json())
             .then((villages) => {
                 var data = villages;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kelurahan7').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kelurahan7").innerHTML = tampung;
             });
     });
 </script>

 <script>
     fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
         .then((response) => response.json())
         .then((provinces) => {
             var data = provinces;
             var tampung = `<option>Pilih</option>`;
             data.forEach((element) => {
                 tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
             });
             document.getElementById("provinsi3").innerHTML = tampung;
         });
 </script>
 <script>
     const selectProvinsi3 = document.getElementById('provinsi3');
     const selectKota3 = document.getElementById('kota3');
     const selectKecamatan3 = document.getElementById('kecamatan3');
     const selectKelurahan3 = document.getElementById('kelurahan3');

     selectProvinsi3.addEventListener('change', (e) => {
         var provinsi = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
             .then((response) => response.json())
             .then((regencies) => {
                 var data = regencies;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kota3').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kecamatan3').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan3').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kota3").innerHTML = tampung;
             });
     });

     selectKota3.addEventListener('change', (e) => {
         var kota = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kota}.json`)
             .then((response) => response.json())
             .then((districts) => {
                 var data = districts;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kecamatan3').innerHTML = '<option>Pilih</option>';
                 document.getElementById('kelurahan3').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kecamatan3").innerHTML = tampung;
             });
     });
     selectKecamatan3.addEventListener('change', (e) => {
         var kecamatan = e.target.options[e.target.selectedIndex].dataset.prov;
         fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
             .then((response) => response.json())
             .then((villages) => {
                 var data = villages;
                 var tampung = `<option>Pilih</option>`;
                 document.getElementById('kelurahan3').innerHTML = '<option>Pilih</option>';
                 data.forEach((element) => {
                     tampung += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                 });
                 document.getElementById("kelurahan3").innerHTML = tampung;
             });
     });
 </script>
 <script>
     $(function() {
         //Initialize Select2 Elements
         $('.select2').select2()

         //Initialize Select2 Elements
         $('.select2bs4').select2({
             theme: 'bootstrap4'
         })
         //Initialize Select2 Elements
         $('.select3').select2()

         //Initialize Select2 Elements
         $('.select3bs4').select2({
             theme: 'bootstrap4'
         })
         //Initialize Select2 Elements
         $('.select4').select2()

         //Initialize Select2 Elements
         $('.select4bs4').select2({
             theme: 'bootstrap4'
         })
         //Initialize Select2 Elements
         $('.select5').select2()

         //Initialize Select2 Elements
         $('.select5bs5').select2({
             theme: 'bootstrap4'
         })
         //Initialize Select2 Elements
         $('.select6').select2()

         //Initialize Select2 Elements
         $('.select6bs6').select2({
             theme: 'bootstrap4'
         })
         //Initialize Select2 Elements
         $('.select7').select2()

         //Initialize Select2 Elements
         $('.select7bs7').select2({
             theme: 'bootstrap4'
         })
         //Initialize Select2 Elements
         $('.select8').select2()

         //Initialize Select2 Elements
         $('.select8bs8').select2({
             theme: 'bootstrap4'
         })
         $('.select9').select2()

         //Initialize Select2 Elements
         $('.select9bs9').select2({
             theme: 'bootstrap4'
         })
         $('.select10').select2()

         //Initialize Select2 Elements
         $('.select10bs10').select2({
             theme: 'bootstrap4'
         })
         // Summernote
         $('#summernote').summernote()

         // CodeMirror
         CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
             mode: "htmlmixed",
             theme: "monokai"
         });
     })
 </script>
 <script>
     $(function() {
         // Summernote
         $('#summernote1').summernote()

         // CodeMirror
         CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
             mode: "htmlmixed",
             theme: "monokai"
         });
     })
     $(function() {
         // Summernote
         $('#summernote2').summernote()

         // CodeMirror
         CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
             mode: "htmlmixed",
             theme: "monokai"
         });
     })
     $(function() {
         // Summernote
         $('#summernote3').summernote()

         // CodeMirror
         CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
             mode: "htmlmixed",
             theme: "monokai"
         });
     })
     $(function() {
         // Summernote
         $('#summernote4').summernote()

         // CodeMirror
         CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
             mode: "htmlmixed",
             theme: "monokai"
         });
     })
     $(function() {
         // Summernote
         $('#summernote5').summernote()

         // CodeMirror
         CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
             mode: "htmlmixed",
             theme: "monokai"
         });
     })
     $(function() {
         // Summernote
         $('#summernote6').summernote()

         // CodeMirror
         CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
             mode: "htmlmixed",
             theme: "monokai"
         });
     })
     $(function() {
         // Summernote
         $('#summernote7').summernote()

         // CodeMirror
         CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
             mode: "htmlmixed",
             theme: "monokai"
         });
     })
     $(function() {
         // Summernote
         $('#summernote8').summernote()

         // CodeMirror
         CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
             mode: "htmlmixed",
             theme: "monokai"
         });
     })
     $(function() {
         // Summernote
         $('#summernote9').summernote()

         // CodeMirror
         CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
             mode: "htmlmixed",
             theme: "monokai"
         });
     })
     $(function() {
         // Summernote
         $('#summernote10').summernote()

         // CodeMirror
         CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
             mode: "htmlmixed",
             theme: "monokai"
         });
     })
 </script>
 <script>
     $.widget.bridge('uibutton', $.ui.button)
 </script>
 <!-- page script -->
 <!-- scrip untuk navigasi bawah -->
 <script>
     /*
 $("#headera").addClass("fixed-bottom");
  
    Sticky Header. Auto hide on scroll bottom, show on scroll top.
    By: www.igniel.com
  */
     var prevScrollpos = window.pageYOffset;
     window.onscroll = function() {
         var currentScrollPos = window.pageYOffset;
         if (prevScrollpos > currentScrollPos) {
             $("#headera").addClass("fixed-bottom");

         } else {
             $("#headera").removeClass("fixed-bottom");

         }
         prevScrollpos = currentScrollPos;
     }
 </script>
 <script>
     function tombol() {
         if (document.getElementById("myBtn").hidden = true) {
             // membuat objek elemen
             // alert("Nuju di proses...");
             var hasil = document.getElementById("tombol_proses");
             hasil.innerHTML = "Nuju di proses ...";
         }
     }
 </script>
 <script>
     $(document).ready(function() {
         $('#pilih').change(function() {
             var kel = $('#pilih option:selected').val();
             if (kel == "foto") {
                 $("#noId").html('<label for="account-company">Foto</label><input type="file" class="form-control" name="foto" id="foto" required /><span class="text-danger" style="font-size: 13px">Harap cantumkan Foto.</span>');
             } else {
                 $("#noId").html('<label for="account-company">Icon</label><input type="text" class="form-control" name="icon" id="icon" required /><span class="text-danger" style="font-size: 13px">Harap Cantumkan Icon.</span>');
             }
         });
     });
 </script>

 </body>

 </html>
</body>
</html>