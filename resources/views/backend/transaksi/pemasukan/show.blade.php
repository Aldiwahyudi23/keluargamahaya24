@extends('backend.template_backend.layout')


@section('content')
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <b><i class="fas fa-info"></i> INFO !!!</b> <br>
    Data nu handap sesuai sareng data pengajuan anau atos di <b>KONFIRMASI PEMBAYARAN </b>,Mangga cek deui datana bilih lepat
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-hover">
                            <tbody>
                            <tr>
                                    <td width="150px">ID Transaksi</td>
                                    <td width="10px">:</td>
                                    <td>{{ $data_pemasukan->kode}}</td>
                                </tr>
                                <tr>
                                <tr>
                                    <td width="150px">Kategori</td>
                                    <td width="10px">:</td>
                                    <td>{{ $data_pemasukan->kategori->nama_kategori }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Anggoota</td>
                                    <td>:</td>
                                    <td>{{ $data_pemasukan->data_Warga->nama}}</td>
                                </tr>
                                <tr>
                                    <td>Di Input oleh</td>
                                    <td>:</td>
                                    <td>{{ $data_pemasukan->pengaju->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Nominal</td>
                                    <td>:</td>
                                    <td>{{ "Rp " . number_format($data_pemasukan->jumlah,2,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td>Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ $data_pemasukan->pembayaran }}</td>
                                </tr>
                                <tr>
                                    <td>Tangaal Pengajuan</td>
                                    <td>:</td>
                                    <td>{{$data_pemasukan->tanggal }}</td>
                                </tr>
                                <tr>
                                    <td>Tangaal diKonfirmasi</td>
                                    <td>:</td>
                                    <td>{{$data_pemasukan->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Anu ngaKonfirmasi</td>
                                    <td>:</td>
                                    <td>{{$data_pemasukan->pengurus->nama }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="">
                            <h5 class=" text-center">Keterangan</h5>
                            {!!$data_pemasukan->keterangan!!}
                            @if($data_pemasukan->foto)
                            <hr>
                            <div class="product-img">
                                <a href="{{asset($data_pemasukan->foto)}}" data-toggle="lightbox" data-title="Tanda Bukti" data-gallery="gallery">
                                    <img src="{{asset($data_pemasukan->foto)}}" alt="Product Image" width="50%" class=" brand-image elevation-3" style="display:block; margin:auto">
                                </a>
                            </div>
                            @endif
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
<script>
    $("#bayar").addClass("active");
</script>
@endsection