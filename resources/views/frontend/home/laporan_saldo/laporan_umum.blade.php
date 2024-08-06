@extends('backend.template_backend.layout')

@section('content')
<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Laporan Kas</h5>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-wrench"></i>
                        </button>
                    </div>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <b> <a href="javascript:void(0)" class="product-title">Saldo Kas</a>
                                <h4>{{"Rp" . number_format(  $saldo_kas + $total_bayar_pinjaman_lebih + $total_bunga_neo + $total_bunga_tabungan -($total_pengeluaran_pinjaman - $total_bayar_pinjaman_semua) ,2,',','.')}}</h4>
                                <span class="text-success" style="font-size: 10px">Saldo Kas = {{ "Rp " . number_format($saldo_kas -($total_pengeluaran_pinjaman - $total_bayar_pinjaman_semua),2,',','.') }}. </span><br>
                                <span class="text-success" style="font-size: 10px">Total Lebih Pinjaman = {{ "Rp " . number_format($total_bayar_pinjaman_lebih,2,',','.') }}. </span><br>
                                
                                <span class="text-success" style="font-size: 10px">Bunga Neo Bank = {{ "Rp " . number_format($total_bunga_neo,2,',','.') }}. </span><br>
                                <span class="text-success" style="font-size: 10px">Bunga Tabungan = {{ "Rp " . number_format($total_bunga_tabungan,2,',','.') }}. </span>
                                
                                <p> Jumlah Total saldo anu aya di bendahara atawa sisa tina pengeluaran termasuk data pinjaman. </p>
                                <hr />
                            </b>
                        </ul>
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="{{route('anggaran.show',Crypt::encrypt(1))}}" class="product-title">Jumlah Dana Darurat</a>
                            <h5>{{ "Rp " . number_format($total_dana_darurat - $total_pengeluaran_darurat ,2,',','.') }}</h5>
                        </ul>
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="" class="product-title">Jumlah Dana Darurat nu tos ka angge </a>
                            <h7>{{ "Rp " . number_format($total_pengeluaran_darurat ,2,',','.') }}</h7>
                            <hr>
                        </ul>
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="{{route('anggaran.show',Crypt::encrypt(2))}}" class="product-title">Jumlah Dana Amal</a>
                            <h5>{{ "Rp " . number_format($total_dana_amal - $total_pengeluaran_amal,2,',','.') }}</h5>
                        </ul>
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="" class="product-title">Jumlah Dana Amal nu tos ka angge </a>
                            <h7>{{ "Rp " . number_format($total_pengeluaran_amal ,2,',','.') }}</h7>
                            <hr>
                        </ul>
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="{{route('anggaran.show',Crypt::encrypt(6))}}" class="product-title">Jumlah dana KAS</a>
                            <h5>{{"Rp" . number_format($total_dana_kas - $total_pengeluaran_kas_3 + $total_bayar_pinjaman_lebih,2,',','.')}}</h5>
                        </ul>
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="" class="product-title">Jumlah Dana Kas nu tos ka angge </a>
                            <h7>{{ "Rp " . number_format($total_pengeluaran_kas_3  ,2,',','.') }}</h7>
                            <hr>
                        </ul>
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="{{Route('anggaran.show',Crypt::encrypt(3))}}">Jumlah Dana Pinjam</a>
                            <h5>{{"Rp" . number_format($total_dana_pinjam -  $total_pengeluaran_pinjaman + $total_bayar_pinjaman_semua,2,',','.')}}</h5>
                        </ul>
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="" class="product-title">Sisa Uang nu di pinjem</a>
                            <h7>{{"Rp" . number_format($total_pengeluaran_pinjaman - $total_bayar_pinjaman_semua,2,',','.')}}</h7>
                            <hr />
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 0%</span>
                            <h5 class="description-header">{{"Rp" . number_format(  $total_dana_kas - $total_pengeluaran_kas_3 + $total_bayar_pinjaman_lebih,2,',','.')}}</h5>
                            <span class="description-text">TOTAL SALDO KAS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                            <h5 class="description-header">{{"Rp" . number_format( $total_dana_darurat - $total_pengeluaran_darurat,2,',','.')}}</h5>
                            <span class="description-text">TOTAL SALDO DARURAT</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                        <div class="description-block border-right">
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                            <h5 class="description-header">{{"Rp" . number_format( $total_dana_amal - $total_pengeluaran_amal,2,',','.')}}</h5>
                            <span class="description-text">TOTAL SALDO AMAL</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                        <div class="description-block">
                            <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                            <h5 class="description-header">{{"Rp" . number_format( $total_dana_pinjam -  $total_pengeluaran_pinjaman + $total_bayar_pinjaman_semua,2,',','.')}}</h5>
                            <span class="description-text">TOTAL SALDO PINJAMAN</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection
@section('script')
<script>
    $("#imah").addClass("active");
</script>
@endsection