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

    <link rel="stylesheet" href="{{ asset('layouts/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('layouts/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('layouts/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('layouts/dist/css/adminlte.min.css') }}">
    <link rel="shrotcut icon" href="{{ asset($profile_app->logo_login) }}">

</head>

<body class="hold-transition login-page" style="background-image: url('{{ asset($profile_app->foto_login) }}'); background-size: cover; background-attachment: fixed;">
    <div class="login-box">
        <marquee>
            {!!$profile_app->info_login!!}
        </marquee>
        <div class="login-logo">
            <img src="{{ asset($profile_app->logo) }}" width="50%" alt="">
        </div>

        <div>
            @yield('content')
        </div>

        <footer>
            <marquee>
                {!!$profile_app->footer_login!!}
            </marquee>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('layouts/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('layouts/plugins/toastr/toastr.min.js') }}"></script>
    <!-- page script -->
    @yield('script')

    @error('id_card')
    <script>
        toastr.error("Maaf User ini tidak terdaftar sebagai Guru SMKN 1 Jenangan Ponorogo!");
    </script>
    @enderror
    @error('guru')
    <script>
        toastr.error("Maaf Guru ini sudah terdaftar sebagai User!");
    </script>
    @enderror
    @error('no_induk')
    <script>
        toastr.error("Maaf User ini tidak terdaftar sebagai Siswa SMKN 1 Jenangan Ponorogo!");
    </script>
    @enderror
    @error('siswa')
    <script>
        toastr.error("Maaf Siswa ini sudah terdaftar sebagai User!");
    </script>
    @enderror
    @if (session('status'))
    <script>
        toastr.success("{{ Session('success') }}");
    </script>
    @endif
    @if (Session::has('error'))
    <script>
        toastr.error("{{ Session('error') }}");
    </script>
    @endif

</body>

</html>