@extends('backend.template_backend.layout')

@section('content')

<body class="justify-content-center">
    <center>
        <h1>Hapunten !</h1>
        <img src="https://c.tenor.com/Z8ezUHZzcLoAAAAC/love.gif" alt="">
        @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Link kanggo verifikasi atos di kirim ka email anu terdaftar, mangga cek heula email na tras klik verifikasi.') }}
        </div>
        @else
        <h4>Akun Anjeun Teu Acan di Verifikasi</h4>
        <h6>Punten anjen teu acan verifikasi emailna, Kanggo ngange aplikasi KAS KELUARGA kedah ngange email nu aktif soal na pemberitahuan pasti lewat email. Janten punten sakali deui mangga verifikasi heula atanapi pami email na teu acan sesuai mangga gera gentos. Hatur Nuhun</h6>

        @endif
        <a id="btn_mau" href="http://api.whatsapp.com/send?phone=6283825740395&text=Punten A Admin, Akun Abdi teu acan AKTIF . Hoyong di aktifkeun nya, Nuhun">Chat Official</a>
        <button id="btn_gamau" onclick="gamau(this)" style="position: relative;">Gamau</button>
        <br>
        @if (session('status') == 'verification-link-sent')
        @else
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Kirim Verifikasi') }}
                </button>
            </div>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Log Out') }}
            </button>
        </form>
        @endif
    </center>
</body>
@endsection