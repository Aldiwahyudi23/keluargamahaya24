 <?php

    use App\Models\AccessProgram;
    use App\Models\DataWarga;
    use App\Models\FotoUser;
    use App\Models\LayoutAppUser;
    use App\Models\MenuFooter;
    use App\Models\ProfileApp;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;

    $profile_app = ProfileApp::first();
    $warna_menu = LayoutAppUser::where('user_id', Auth::user()->id)->first();
    $data_menu_footer = MenuFooter::where('is_active', 1)->get();

    $user = DataWarga::find(Auth::user()->data_warga_id);
    $foto = FotoUser::where('data_warga_id', $user->id)->where('is_active', 1)->first();
    ?>

 <aside class="control-sidebar control-sidebar-dark">
     <!-- Control sidebar content goes here -->
 </aside>
 <!-- /.control-sidebar -->

 <!-- Main Footer -->
 <footer class=" navbar-light navbar-expand d-md-none d-lg-none d-xl-none" style="background-color: {{$warna_menu->menu}};" id="headera">
     <ul class="navbar-nav nav-justified nav nav-treeview nav-pills" data-widget="treeview" role="menu" data-accordion="false">
         @foreach($data_menu_footer as $data)
         <?php $access_program = AccessProgram::where('user_id', Auth::user()->id)->where('program_id', $data->program_id); ?>
         @if( $access_program->count() == 1)
         @if($data->kategori == 1)
         <li class="nav-item">
             <a href="{{Route($data->route_url->route_name)}}" id="{{$data->nama}}" class="nav-link text-center">
                 @if($data->foto == true)
                 <img src="{{asset($foto->foto)}}" width="45px" height="45px" alt="Saya" class="brand-image img-circle elevation-3">
                 @else
                 <i class="nav-icon {{$data->icon}} nav-icon"></i> <span class="small d-block">{{$data->nama}}</span>
                 @endif
             </a>
         </li>
         @endif
         @endif
         @if($data->program_id == 0)
         <li class="nav-item">
             <a href="{{Route($data->route_url->route_name)}}" id="{{$data->nama}}" class="nav-link text-center">
                 @if($data->foto == true)
                 <img src="{{asset($foto->foto)}}" width="45px" height="45px" alt="Saya" class="brand-image img-circle elevation-3">
                 @else
                 <i class="nav-icon {{$data->icon}} nav-icon"></i> <span class="small d-block">{{$data->nama}}</span>
                 @endif
             </a>
         </li>
         @endif
         @endforeach

     </ul>

     <marquee>
         <strong>{!!$profile_app->footer!!}</strong>
     </marquee>
 </footer>
 </div>
 <!-- ./wrapper -->

 <!-- REQUIRED SCRIPTS -->
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