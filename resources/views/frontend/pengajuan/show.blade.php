@extends('backend.template_backend.layout')

@section('content')


<div class="alert alert-info alert-dismissible fade show" role="alert">
    <b><i class="fas fa-info"></i> INFO !!!</b> <br>
    Data masih di proses nuju di cek ku pengurus, nuju di<b>KONFIRMASI </b> heula.
    <br> <br> mangga<b> Cek deui</b>bilih aya nu lepat, pami bade ngedit mangga klik wae tombol <a href="{{Route('pengajuan.edit.user',Crypt::encrypt($data_pengajuan->id))}}" type="" class="btn btn-primary btn-sm" onclick="return confirm('Leres bade ngedit data ieu ? , Pengeditan kedah sepengetahuan nu sanes !')">Gentos data</a>
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
                    <center>
                        <h5 class="text-bold card-header bg-light p-0"> {{$data_pengajuan->status}}</h5>
                    </center>
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-hover">
                            <tbody>
                                <tr>
                                    <td width="150px">Pengajuan</td>
                                    <td width="10px">:</td>
                                    <td>{{ $data_pengajuan->kategori->nama_kategori }}</td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Nama Anggoota</td>
                                    <td>:</td>
                                    <td>{{ $data_pengajuan->data_warga->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Di Input Oleh</td>
                                    <td>:</td>
                                    <td>{{ $data_pengajuan->pengaju->nama }}</td>
                                </tr>
                                <td>Nominal</td>
                                <td>:</td>
                                <td>{{ "Rp " . number_format($data_pengajuan->jumlah,2,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td>Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ $data_pengajuan->pembayaran }}</td>
                                </tr>
                                <tr>
                                    <td>Tangaal Pengajuan</td>
                                    <td>:</td>
                                    <td>{{$data_pengajuan->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="">
                            <h5 class=" text-center">Keterangan</h5>
                            {!!$data_pengajuan->keterangan!!}
                            @if($data_pengajuan->foto)
                            <hr>
                            <div class="product-img">
                                <a href="{{asset($data_pengajuan->foto)}}" data-toggle="lightbox" data-title="Tanda Bukti" data-gallery="gallery">
                                    <img src="{{asset($data_pengajuan->foto)}}" alt="Product Image" width="50%" class=" brand-image elevation-3" style="display:block; margin:auto">
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