@extends('layouts.app')

@section('content')

<body class="justify-content-center">
    <center>
        <h1>Hapunten !</h1>
        <img src="https://c.tenor.com/Z8ezUHZzcLoAAAAC/love.gif" alt="">

        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Link kanggo verifikasi atos di kirim ka email anu terdaftar, mangga cek heula email na tras klik verifikasi.') }}
        </div>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4">
                <x-primary-button>
                    {{ __('Confirm') }}
                </x-primary-button>
            </div>
        </form>
    </center>
</body>
@endsection