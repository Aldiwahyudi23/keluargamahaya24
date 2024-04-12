@extends('layouts.app')

@section('content')

<body class="justify-content-center">
    <center>
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('Mangga leubetkeun Email anu terdaftar di KAS KELUARGA.') }}
        </div>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button>
                    {{ __('Kirim, Dapatkan link') }}
                </button>
            </div>
        </form>
    </center>
</body>
@endsection