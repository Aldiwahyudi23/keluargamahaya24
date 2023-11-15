<!DOCTYPE html>
<html lang="en">
<?php

use Illuminate\Support\Facades\Auth;

$cek_status_user = Auth::user()->is_active;
?>

@include('backend.template_backend.header')

<body class="hold-transition white-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        @if(Auth::user()->is_active == true)
        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->
        <!-- Navbar -->
        @include('backend.template_backend.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('backend.template_backend.sider')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Notifikasi -->
            @include('backend.template_backend.notifikasi')

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-1">
                        <div class="col-sm-6">
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="contsiner-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('backend.template_backend.footer')
        @else

        <body class="justify-content-center">
            <center>
                <h1>Hapunten !</h1>
                <img src="https://c.tenor.com/Z8ezUHZzcLoAAAAC/love.gif" alt="">
                <h1>Akun Anjeun Teu Aktif</h1>
                <h3>Kanggo ngaktifkeun deui, mangga chat wae ka Official </h3>
                <a id="btn_mau" href="http://api.whatsapp.com/send?phone=6283825740395&text=Punten A Admin, Akun Abdi teu acan AKTIF . Hoyong di aktifkeun nya, Nuhun">Chat Official</a>
                <button id="btn_gamau" onclick="gamau(this)" style="position: relative;">Gamau</button>
            </center>
        </body>

        <script>
            function gamau(id) {
                var mau = document.getElementById("btn_mau");
                var i = Math.floor(Math.random() * 150) + 1;
                var j = Math.floor(Math.random() * 50) + mau.offsetHeight;
                id.style.left = i + "px";
                id.style.top = j + "px";
            }
        </script>
        @endif
</body>

</html>