<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- pengambil data untuk profile app -->
<?php

use App\Models\ProfileApp;

$profile_app = ProfileApp::first();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $profile_app->nama }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('layouts/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('layouts/plugins/toastr/toastr.min.css') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('layouts/dist/css/adminlte.min.css')}}">
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
    <link rel="shrotcut icon" href="{{ asset($profile_app->logo_login) }}">

</head>

<body class="hold-transition login-page" style="background-image: url('{{ asset($profile_app->background_login) }}'); background-size: cover; background-attachment: fixed;">
    <div class="login-box">
        <p data-toggle="modal" data-target="#info_login">
            <marquee>
                {!!$profile_app->info_login!!}
            </marquee>
        </p>
        <div class="login-logo" data-toggle="modal" data-target="#icon-foto_login">
            <img src="{{ asset($profile_app->foto_login) }}" width="50%" alt="">
        </div>
        <div>
            <style type="text/css">
                .card-body {
                    background: rgba(4, 29, 23, 0.5);
                }
            </style>

            <div class="card-body login-card-body">
                <div class="" data-toggle="modal" data-target="#tittle_login">
                    {!!$profile_app->title_login!!}
                </div>

                <form action="" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail') }}" name="email" value="{{ old('email') }}" autocomplete="off" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" placeholder="{{ __('Kata Sandi') }}" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row mb-1">
                        <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" style="color: white;">
                                    {{ __('Tetep Masuk') }}
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class=" col-5">
                            <button type="button" id="btn-login" class="btn btn-primary btn-block">{{ __('Masuk') }} &nbsp; <i class="nav-icon fas fa-sign-in-alt"></i></button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mb-1" style="color: white" data-toggle="modal" data-target="#pw_login">
                    @if($profile_app->lupa_password == 1)
                    @if (Route::has('password.request'))
                    <a>
                        {{ __('Lupa Kata Sandi?') }}
                    </a>
                    @endif
                    @else
                    Pami Kata sandi na hilap, kontak ka sekertaris.
                    @endif
                </p>
                <div>
                    <a href="">Bantuan tutor</a>
                </div>

            </div>
        </div>

        <footer data-toggle="modal" data-target="#footer_login">
            <marquee>
                {!!$profile_app->footer_login!!}
            </marquee>
        </footer>
    </div>

    <center>
        <a href="/">
            <h5 class="text-bold card-header bg-white p-3"> KEMBALI</h5>
        </a>
    </center>
    <!-- Modal -->
    <!-- info login -->
    <div class="modal fade" id="info_login" tabindex="-1" role="dialog" aria-labelledby="info_loginTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Info Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ Route('profile-app.update',Crypt::encrypt($profile_app->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea name="info_login" class="textarea form-control bg-light" id="summernote" rows="6" value="{{ old('info_login') }}">{!! $profile_app->info_login !!}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Geuntos</button>
                        <div id="tombol_proses"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- info title -->
    <div class="modal fade" id="tittle_login" tabindex="-1" role="dialog" aria-labelledby="tittle_loginTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Tittle Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ Route('profile-app.update',Crypt::encrypt($profile_app->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea name="title_login" class="textarea form-control bg-light" id="summernote1" rows="6" value="{{ old('title_login') }}">{!! $profile_app->title_login !!}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Geuntos</button>
                        <div id="tombol_proses"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- info footer -->
    <div class="modal fade" id="footer_login" tabindex="-1" role="dialog" aria-labelledby="footer_loginTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Footer Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ Route('profile-app.update',Crypt::encrypt($profile_app->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="form-group">
                        <textarea name="footer_login" class="textarea form-control bg-light" id="summernote2" rows="6" value="{{ old('footer_login') }}">{!! $profile_app->footer_login !!}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Geuntos</button>
                        <div id="tombol_proses"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- info Icon / Foto -->
    <div class="modal fade" id="icon-foto_login" tabindex="-1" role="dialog" aria-labelledby="icon-foto_loginTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Footer Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ Route('profile-app.update',Crypt::encrypt($profile_app->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="form-group col-12">
                        <label for="foto_login">Foto</label>

                        <input type="file" name="foto_login" id="foto_login" class="form-control col-12" value="{{$profile_app->foto_login}}">

                    </div>
                    <div class="form-group col-12">
                        <label for="logo">logo</label>

                        <input type="file" name="logo_login" id="logo_login" class="form-control col-12" value="{{$profile_app->logo_login}}">

                    </div>
                    <div class="form-group col-12">
                        <label for="background">background</label>

                        <input type="file" name="background_login" id="background_login" class="form-control col-12" value="{{$profile_app->background_login}}">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Geuntos</button>
                        <div id="tombol_proses"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- info Icon / Foto -->
    <div class="modal fade" id="pw_login" tabindex="-1" role="dialog" aria-labelledby="pw_loginTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Link Untuk Lupa Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ Route('profile-app.update',Crypt::encrypt($profile_app->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <input type="hidden" name="lupa_password" id="lupa_password" value="{{$profile_app->lupa_password}}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ganti</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('layouts/plugins/toastr/toastr.min.js') }}"></script>
    <!-- page script -->
    @yield('script')

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
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
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
</body>

</html>