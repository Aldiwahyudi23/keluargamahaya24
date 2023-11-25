@extends('backend.template_backend.layout')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DETAIL DATA ASET</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table" style="margin-top: -10px;">
                    <tr>
                        <td><b> Program</b></td>
                        <td>:</td>
                        <td><b> {{$data_aset->program->nama_program}}</b></td>
                    </tr>
                    <tr>
                        <td>Kode Barang</td>
                        <td>:</td>
                        <td>{{$data_aset->kode}}</td>
                    </tr>
                    <tr>
                        <td>aset</td>
                        <td>:</td>
                        <td>{{$data_aset->nama_aset}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Beli</td>
                        <td>:</td>
                        <td>{{$data_aset->tanggal}}</td>
                    </tr>
                    <tr>
                        <td>Persen</td>
                        <td>:</td>
                        <td>{{$data_aset->persen}}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Barang</td>
                        <td>:</td>
                        <td>{{$data_aset->qty}}</td>
                    </tr>
                    <tr>
                        <td>Kondisi</td>
                        <td>:</td>
                        <td>{{$data_aset->kondisi}}</td>
                    </tr>
                    <tr>
                        <td>Penyimpanan</td>
                        <td>:</td>
                        <td>{{$data_aset->lokasi}}</td>
                    </tr>

                </table>
                <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                    <p> {!! $data_aset->deskripsi !!}</p>
                    @if($data_aset->foto)
                    <hr>
                    <div class="product-img">
                        <a href="{{asset($data_aset->foto)}}" data-toggle="lightbox" data-title="Tanda Bukti" data-gallery="gallery">
                            <img src="{{asset($data_aset->foto)}}" alt="Product Image" width="50%" class=" brand-image elevation-3" style="display:block; margin:auto">
                        </a>
                    </div>
                    @endif
                </table>

            </div>

        </div><!-- /.container-fluid -->
</section>

@endsection
@section('script')
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#Dataaset").addClass("active");
</script>
@endsection