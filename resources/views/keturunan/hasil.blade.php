<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Keturunan</title>
</head>
<body>
    <h1>Hasil Keturunan</h1>

    @if ($keturunanSama->isEmpty())
        <p>Tidak ada keturunan yang sama.</p>
    @else
        <p>Keturunan yang sama:</p>
        <ul>
            @foreach ($keturunanSama as $warga)
                <li>{{ $warga->nama }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('keturunan.index') }}">Kembali</a>
</body>
</html>
