 <?php

    use App\Models\AccessProgram;
    use App\Models\MenuFooter;
    use App\Models\ProfileApp;
    use Illuminate\Support\Facades\Auth;

    $profile_app = ProfileApp::first();
    $data_menu_footer = MenuFooter::where('is_active', 1)->get();
    ?>

 <aside class="control-sidebar control-sidebar-dark">
     <!-- Control sidebar content goes here -->
 </aside>
 <!-- /.control-sidebar -->

 <!-- Main Footer -->
 <footer class=" navbar-light bg-white navbar-expand d-md-none d-lg-none d-xl-none" id="headera">
     <ul class="navbar-nav nav-justified nav nav-treeview nav-pills" data-widget="treeview" role="menu" data-accordion="false">
         @foreach($data_menu_footer as $data)
         <?php $access_program = AccessProgram::where('user_id', Auth::user()->id)->where('program_id', $data->program_id); ?>
         @if( $access_program->count() == 1)
         @if($data->kategori == 1)
         <li class="nav-item">
             <a href="{{Route($data->route_url->route_name)}}" id="{{$data->nama}}" class="nav-link text-center">
                 @if($data->foto == true)
                 <img src="" width="45px" height="45px" alt="Saya" class="brand-image img-circle elevation-3">
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
                 <img src="" width="45px" height="45px" alt="Saya" class="brand-image img-circle elevation-3">
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
     $(function() {
         //Initialize Select2 Elements
         $('.select2').select2()

         //Initialize Select2 Elements
         $('.select2bs4').select2({
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