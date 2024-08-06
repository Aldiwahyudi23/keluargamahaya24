<!DOCTYPE html>
<html>
<head>
    <title>Invoice Kredit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .strike-through {
            text-decoration: line-through;
            color: red; /* warna untuk coretan */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Invoice Kredit</h2>
    <p><strong>Nominal:</strong> {{ number_format($nominal, 2, ',', '.') }}</p>
    @if ($dp > 0)
        <p><strong>DP (Uang Muka):</strong> {{ number_format($dp, 2, ',', '.') }}</p>
    @endif
    <p><strong>Tenor:</strong> {{ $tenor }} Bulan</p>
    
    <form id="customerInfoForm">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" required>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
        </div>
    </form>
<div id="discountInfo" style="display: none; margin-top: 10px;"></div>
    
    <p class="original-installment"><strong>Angsuran per Bulan:</strong> {{ number_format($angsuran, 2, ',', '.') }}</p>

<div id="role-section" style="display: none;">
        <p><strong>Keuntungan :</strong> <span class="untung">{{ number_format($angsuran, 2, ',', '.') }}
</span></p>
         
        
    </div>

<div id="periodeTable" style="display: none;">
    <h3>Periode Jatuh Tempo</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <!-- Isi tabel periode di sini -->
            <thead>
            <tr>
            <th>No</th>
                <th>Periode</th>
                
                <th  >Angsuran per Bulan</th>
                
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= $tenor; $i++)
                <tr>
                <td>{{$i}}</td>
                    <td>{{ \Carbon\Carbon::now()->addMonths($i)->translatedFormat('d F Y') }}</td>
                    
                    <td  class="discounted-installment"  >{{ number_format($angsuran, 2, ',', '.') }}</td>
                    
                    
                </tr>
            @endfor
        </tbody>
        </table>
    </div>
</div>


</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
    $('#nama, #no_hp, #tanggal_lahir').on('input', function() {
        checkInputAndShowTable();
    });

    function checkInputAndShowTable() {
        var nama = $('#nama').val();
        var no_hp = $('#no_hp').val();
        var tanggal_lahir = $('#tanggal_lahir').val();

        // Memeriksa apakah semua input sudah diisi
        if (nama && no_hp && tanggal_lahir) {
            $('#discountInfo').show(); // Menampilkan div info diskon (opsional, sesuai kebutuhan)
            $('#periodeTable').show(); // Menampilkan tabel periode jatuh tempo
            checkDiscount(); // Melakukan pengecekan diskon seperti yang sebelumnya
            
            // Pengecekan role pengguna dari PHP
        const userRole = '{{ $userRole }}';

          if (['Admin', 'Ketua', 'Sekertaris', 'Bendahara'].includes(userRole)) {
            $('#role-section').show();
          } else {
            $('#role-section').hide();
          }
        } else {
            $('#discountInfo').hide(); // Menyembunyikan div info diskon jika input belum lengkap
            $('#periodeTable').hide(); // Menyembunyikan tabel periode jika input belum lengkap
        }
        
        
    }

    function checkDiscount() {
        var nama = $('#nama').val();
        var no_hp = $('#no_hp').val();
        var tanggal_lahir = $('#tanggal_lahir').val();

        $.ajax({
            url: '{{ route("checkDiscount") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                nama: nama,
                no_hp: no_hp,
                tanggal_lahir: tanggal_lahir
            },
            success: function(response) {
                if (response.discount) {
                    $('#discountInfo').html(response.message);
                    
                    applyDiscount();
                } else {
                    resetInstallments();
                }
            }
        });
    }

    function applyDiscount() {
        var angsuran = {{ $angsuran }};
        var discountedAngsuran = angsuran * 0.982;
        var tenor = {{ $tenor }};
        var nominal = {{ $nominal }};
        var keuntungan = discountedAngsuran * tenor;
        var untung =  keuntungan - nominal;
        $('.untung').text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(untung));
    
        $('.discounted-installment').text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(discountedAngsuran));
        $('.original-installment').addClass('strike-through'); 
    }

    function resetInstallments() {
        $('.original-installment').removeClass('strike-through');
        var angsuran = {{ $angsuran }};
        var tenor = {{ $tenor }};
        var nominal = {{ $nominal }};
        var keuntungan = angsuran * tenor;
        var untung =  keuntungan - nominal;
        $('.untung').text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(untung));
    
        $('.discounted-installment').text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(angsuran));
    }
});

</script>
</body>
</html>
