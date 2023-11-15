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
                                    <td width="150px">ID Pinjaman</td>
                                    <td width="10px">:</td>
                                    <td>{{ $data_bayar_pinjaman->pengeluaran->kode}}</td>
                                </tr>
                                <tr>
                                    <td>Nama Anggoota</td>
                                    <td>:</td>
                                    <td>{{ $data_bayar_pinjaman->data_Warga->nama}}</td>
                                </tr>
                                <tr>
                                    <td>Di Input oleh</td>
                                    <td>:</td>
                                    <td>{{ $data_bayar_pinjaman->pengaju->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Nominal</td>
                                    <td>:</td>
                                    <td>{{ "Rp " . number_format($data_bayar_pinjaman->jumlah,2,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td>Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ $data_bayar_pinjaman->pembayaran }}</td>
                                </tr>
                                <tr>
                                    <td>Tangaal Pengajuan</td>
                                    <td>:</td>
                                    <td>{{$data_bayar_pinjaman->tanggal }}</td>
                                </tr>
                                <tr>
                                    <td>Tangaal diKonfirmasi</td>
                                    <td>:</td>
                                    <td>{{$data_bayar_pinjaman->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Anu ngaKonfirmasi</td>
                                    <td>:</td>
                                    <td>{{$data_bayar_pinjaman->pengurus->nama }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="">
                            <h5 class=" text-center">Keterangan</h5>
                            {!!$data_bayar_pinjaman->keterangan!!}
                            @if($data_bayar_pinjaman->foto)
                            <hr>
                            <div class="product-img">
                                <a href="{{asset($data_bayar_pinjaman->foto)}}" data-toggle="lightbox" data-title="Tanda Bukti" data-gallery="gallery">
                                    <img src="{{asset($data_bayar_pinjaman->foto)}}" alt="Product Image" width="50%" class=" brand-image elevation-3" style="display:block; margin:auto">
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