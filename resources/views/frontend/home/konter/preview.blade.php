
<!-- resources/views/transactions/preview.blade.php -->

<!DOCTYPE html>
<html>
    
    <?php

use App\Models\ProfileApp;

$profile_app = ProfileApp::first();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$profile_app->nama}}</title>
    <link rel="shrotcut icon" href="{{$profile_app->logo}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('layouts/dist/css/adminlte.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('layouts/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

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

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            margin: auto;
            max-width: 100%;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            text-align: center;
        }
        .logo {
            width: 100px;
            margin-bottom: 20px;
        }
        .btn {
            width: 100%;
        }
        .card-body {
            text-align: left;
        }
        .info-label {
            font-weight: bold;
        }
        .info-value {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
    @if(session('sukses'))
<div class="container">
    <div class="callout callout-success alert alert-success alert-dismissible fade show" role="alert">
        <h5><i class="fas fa-check"></i> Sukses :</h5>
        {{session('sukses')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

@if(session('kuning'))
<div class="container">
    <div class="callout callout-warning alert alert-warning alert-dismissible fade show" role="alert">
        <h5><i class="fas fa-info"></i> Informasi :</h5>
        {{session('kuning')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if(session('infoes'))
<div class="container">
    <div class="callout callout-primary alert alert-primary alert-dismissible fade show" role="alert">
        <h5><i class="fas fa-info"></i> Informasi :</h5>
        {{session('infoes')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if ($errors->any())
<div class="container">
    <div class="callout callout-danger alert alert-danger alert-dismissible fade show">
        <h5><i class="fas fa-exclamation-triangle"></i> Peringatan :</h5>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
        <div class="card">
            <div class="card-header">
                <img src="{{ asset('$profile_app->logo') }}" alt="Logo" class="logo">
                <h2>Cek Transaksi Anda </h2>
            </div>
            <div class="card-body">
                <div class="info">
                    <div class="info-label">No Handphone:</div>
                    <div class="info-value">{{ $data['no_hp'] }}</div>
                </div>
                <div class="info">
                    <div class="info-label">Layanan:</div>
                    <div class="info-value">{{ $data['layanan'] }}</div>
                </div>
                @if($data['kategori'] === 'Listrik')
                <div class="info">
                    <div class="info-label">ID Listrik:</div>
                    <div class="info-value">{{ $data['id_listrik'] }}</div>
                </div>
                <div class="info">
                    <div class="info-label">Nama Listrik:</div>
                    <div class="info-value">{{ $data['nama'] }}</div>
                </div>
                @endif
                <div class="info">
                    <div class="info-label">Nominal:</div>
                    <div class="info-value">{{ $data['nominal_input'] }}</div>
                </div>
                <div class="info">
                    <div class="info-label">Metode Pembayaran:</div>
                    <div class="info-value">{{ $data['payment_method'] }}</div>
                </div>
                @if ($data['payment_method'] === 'Langsung')
                    <div class="info">
                        <div class="info-label">Jenis Pembayaran:</div>
                        <div class="info-value">{{ $data['payment_type'] }}</div>
                    </div>
                    <div class="info">
                        <div class="info-label">Keterangan:</div>
                        <div class="info-value">{{ $data['keterangan'] }}</div>
                    </div>
                @endif
                <div class="info">
                    <div class="info-label">Harga Jual:</div>
                    <div class="info-value">{{ $data['harga_jual'] }}</div>
                </div>
                <div class="info">
                    <div class="info-label">Durasi Pembayaran:</div>
                    <div class="info-value">{{ $data['payment_duration_input'] }}</div>
                </div>
                
                <form action="{{ route('transactions.submit') }}" method="POST" class="mt-4" enctype="multipart/form-data">
                @method('POST')
                            {{csrf_field()}}
       
                    
                    <input type="hidden" name="no_hp" Value="{{ $data['no_hp'] }}">
                    <input type="hidden" name="layanan" Value="{{ $data['layanan'] }}">
                    <input type="hidden" name="harga_beli" Value="{{ $data['harga_beli'] }}">
                    <input type="hidden" name="payment_method" Value="{{ $data['payment_method'] }}">
                    <input type="hidden" name="payment_type" Value="{{ $data['payment_type'] }}">
                    <input type="hidden" name="keterangan" Value="{{ $data['keterangan'] }}">
                    <input type="hidden" name="durasi" Value="{{ $data['payment_duration_input'] }}">
                    
                    <input type="hidden" name="kategori" Value="{{ $data['kategori'] }}">
                    @if($data['layanan'] === 'Tagihan Listrik')
                    <input type="hidden" name="nominal_input" Value="0">
                    <input type="hidden" name="harga_jual" Value="0">
                    @else
                    <input type="hidden" name="harga_jual" Value="{{ $data['harga_jual'] }}">
                    <input type="hidden" name="nominal_input" Value="{{ $data['nominal_input'] }}">
                    @endif
                    @if($data['kategori'] === 'Listrik')
                    <input type="hidden" name="id_listrik" Value="{{ $data['id_listrik'] }}">
                    <input type="hidden" name="nama" Value="{{ $data['nama'] }}">
                    @endif
                    <div class="form-group">
                        <label for="user input">Masukan Nama Anda Sebagai Pengaju:</label>
                        <input type="text" class="form-control" name="user_input" id="user_input" value="{{ old('nama',$data['user_input']) }}" Required>
                    </div>
                    <button type="submit"  id="submit_button" class="btn btn-success mb-3" >Ajukan</button>
                </form>
                <button onclick="history.back()" class="btn btn-secondary">Kembali</button>
            </div>
        </div>
    </div>
    <script>
    $('#submit_button').on('click', function() {
                $(this).prop('disabled', false);
                $(this).text('Loading...');
                $(this).closest('form').submit();
                
                
            });
         </script>  
</body>
</html>