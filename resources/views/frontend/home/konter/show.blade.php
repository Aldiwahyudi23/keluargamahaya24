@extends('backend.template_backend.layout')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DETAIL DATA </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table" style="margin-top: -10px;">
                    <tr>
                        <td><b> Layanan</b></td>
                        <td>:</td>
                        <td><b> {{$data_konter->kategori}} {{$data_konter->layanan}}</b></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{$data_konter->nama}}</td>
                    </tr>
                    <tr>
                        <td>No Tujuan</td>
                        <td>:</td>
                        <td>{{$data_konter->no_tujuan}}</td>
                    </tr>
                    <tr>
                        <td>Di Input</td>
                        <td>:</td>
                        <td>{{$data_konter->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>{{$data_konter->status}}</td>
                    </tr>
                    <tr>
                        <td>Nominal</td>
                        <td>:</td>
                        <td>{{$data_konter->nominal}}</td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td>{{$data_konter->harga}}</td>
                    </tr>
                    <tr>
                        <td>Harga Jual</td>
                        <td>:</td>
                        <td>{{$data_konter->tagihan}}</td>
                    </tr>

                    

                </table>
                <hr>
                <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                    <p> {{$data_konter->keterangan}}</p>
                </table>
                <div>
                  Keuntungan yang di peroleh dari transaksi tersebut {{$data_konter->margin}} dan Di Tambah Diskon  {{$data_konter->diskon}} Jadi Uang yang di keluarkan dari trandaksi tersebut  {{$data_konter->uang_keluar}} karena dari Harga di kurangi Diskon
                </div>
                
                @if($data_konter->foto)
                            <hr>
                            <div class="product-img">
                                <a href="{{asset($data_konter->foto)}}" data-toggle="lightbox" data-title="Tanda Bukti" data-gallery="gallery">
                                    <img src="{{asset($data_konter->foto)}}" alt="Product Image" width="50%" class=" brand-image elevation-3" style="display:block; margin:auto">
                                </a>
                            </div>
                            @endif

            </div>

        </div><!-- /.container-fluid -->
</section>

@endsection
@section('script')
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#Dataanggaran").addClass("active");
</script>
@endsection