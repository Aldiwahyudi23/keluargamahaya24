<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Keturunan</title>
</head>
<body>
    <h1>Cari Keturunan</h1>

    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form action="{{ route('keturunan.cari') }}" method="POST">
        @csrf
        <label for="nama1">Nama 1:</label>
        <select name="nama1" id="nama1">
            @foreach ($dataWarga as $warga)
                <option value="{{ $warga->nama }}">{{ $warga->nama }}</option>
            @endforeach
        </select>
        <br>

        <label for="nama2">Nama 2:</label>
        <select name="nama2" id="nama2">
            @foreach ($dataWarga as $warga)
                <option value="{{ $warga->nama }}">{{ $warga->nama }}</option>
            @endforeach
        </select>
        <br>

        <button type="submit">Cari</button>
    </form>
</body>
</html>
