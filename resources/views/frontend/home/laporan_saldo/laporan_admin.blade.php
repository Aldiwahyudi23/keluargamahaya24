@extends('backend.template_backend.layout')

@section('content')
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
                <ul class="products-list product-list-in-card pl-1 pr-1">
                    <a href="javascript:void(0)" class="product-title">Saldo ATM Kas</a>
                    <h5>{{"Rp" . number_format($saldo_akhir->saldo_atm_kas  + $margin_konter + $diskon_konter_all + $kredit_sum - $jumlah_konter_Ukeluar ,2,',','.')}}</h5>
                    <p>Saldo ATM, saldo anu aya tina tabungan kas keluarga. Jumlah <b>saldo ATM</b> di tambah artos nu masih di <b>bendahara</b> kedah <b>sami</b> sareng jumlah <b>SALDO tiap Laporan</b> </p>
                    <hr />
                </ul>
                <ul class="products-list product-list-in-card pl-1 pr-1">
                    <a href="javascript:void(0)" class="product-title">Saldo ATM Tabungan</a>
                    <h5>{{"Rp" . number_format($saldo_akhir->saldo_atm_tabungan,2,',','.')}}</h5>
                    
                    <hr />
                </ul>
                <ul class="products-list product-list-in-card pl-1 pr-1">
                    <a href="{{Route('setor_tunai')}}" class="product-title">Uang dibendahara nu teu acan di TF</a>
                    <h5>{{"Rp" . number_format( $saldo_akhir->total_diluar,2,',','.')}}</h5>
                    <p>Artos nu teu acan di setor tunai keun ku bendahara, sareng nu masih di pegang ku bendahara atanapi sekertaris</p>
                    <hr />
                </ul>
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
                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 0%</span>
                            <h5 class="description-header">{{"Rp" . number_format( $total_dana_amal - $total_pengeluaran_amal,2,',','.')}}</h5>
                            <span class="description-text">TOTAL SALDO AMAL</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                        <div class="description-block">
                            <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 0%</span>
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

<!-- /.row -->

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Laporan KAS</h5>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <a href="#" class="dropdown-item">Action</a>
                            <a href="#" class="dropdown-item">Another action</a>
                            <a href="#" class="dropdown-item">Something else here</a>
                            <a class="dropdown-divider"></a>
                            <a href="#" class="dropdown-item">Separated link</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="/pemasukan/detail" class="product-title">Jumlah Pemasukan Kas</a>
                            <h5>{{ "Rp " . number_format($total_pemasukan_kas,2,',','.') }}</h5>
                            <p>Jumlah sadayana artos pemasukan uang kas nu terkumpul ti awal sareng dugi ayeuna</p>
                            <hr>
                        </ul>

                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="/pengeluaran/detail" class="product-title">Jumlah Pengeluaran Kas</a>
                            <h5>{{ "Rp " . number_format( $total_pengeluaran_kas  ,2,',','.') }}</h5>
                            <p> Jumlah sadayana pengluaran sesuai data anggaran, kecuali data pinjaman tidak termasuk pengluaran.</p>
                            <hr>
                        </ul>
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <b> <a href="javascript:void(0)" class="product-title">Saldo Kas</a>
                                <h4>{{"Rp" . number_format(  $saldo_kas + $total_bayar_pinjaman_lebih + $total_bunga_neo + $total_bunga_tabungan + $kredit_sum - ($total_pengeluaran_pinjaman - $total_bayar_pinjaman_semua) ,2,',','.')}}</h4>
                                <span class="text-success" style="font-size: 10px">Saldo Kas = {{ "Rp " . number_format($saldo_kas -($total_pengeluaran_pinjaman - $total_bayar_pinjaman_semua),2,',','.') }}. </span><br>
                                <span class="text-success" style="font-size: 10px">Total Lebih Pinjaman = {{ "Rp " . number_format($total_bayar_pinjaman_lebih,2,',','.') }}. </span><br>
                                
                                <span class="text-success" style="font-size: 10px">Bunga Neo Bank = {{ "Rp " . number_format($total_bunga_neo,2,',','.') }}. </span><br>
                                <span class="text-success" style="font-size: 10px">Bunga Tabungan = {{ "Rp " . number_format($total_bunga_tabungan,2,',','.') }}. </span><br>
                                <span class="text-success" style="font-size: 10px">Keuntungan Konter = {{ "Rp " . number_format($margin_konter,2,',','.') }}. </span><br>
                                <span class="text-success" style="font-size: 10px">Keuntungan dari Diskon Konter= {{ "Rp " . number_format($diskon_konter,2,',','.') }}. </span><br>
                                <span class="text-success" style="font-size: 10px">Kredit = {{ "Rp " . number_format($kredit_sum,2,',','.') }}. </span>
                                
                                
                                
                                
                                <p> Jumlah Total saldo anu aya di bendahara atawa sisa tina pengeluaran termasuk data pinjaman, Plus uang lebihna tina peminjaman. </p>
                                <hr />
                            </b>
                        </ul>

                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="javascript:void(0)" class="product-title">Uang nu di pinjem</a>
                            <h5>{{"Rp" . number_format( $total_pengeluaran_pinjaman - $total_bayar_pinjaman_semua ,2,',','.')}}</h5>
                            <hr />
                        </ul>
                        
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="javascript:void(0)" class="product-title">Tagihan Konter (pulsa,listrik)</a>
                            <h5>{{"Rp" . number_format( $tagihan_konter ,2,',','.')}}</h5>
                            <span class="text-success" style="font-size: 10px">Uang yang keluar dari saldo = {{ "Rp " . number_format($jumlah_konter_Ukeluar,2,',','.') }}. </span><br>
                            <span class="text-success" style="font-size: 10px">Diskon yang ngendap di Saldo (Belum Lunas) = {{ "Rp " . number_format($diskon_konter_BLunas,2,',','.') }}. </span><br>
                                <span class="text-success" style="font-size: 10px">Keuntungan yang masih di luar (Belum Lunas) = {{ "Rp " . number_format($margin_konter_BLunas,2,',','.') }}. </span>
                                
                                
                            <hr />
                        </ul>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- ./card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Laporan TABUNGAN</h5>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <a href="#" class="dropdown-item">Action</a>
                            <a href="#" class="dropdown-item">Another action</a>
                            <a href="#" class="dropdown-item">Something else here</a>
                            <a class="dropdown-divider"></a>
                            <a href="#" class="dropdown-item">Separated link</a>
                        </div>
                    </div>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="/pemasukan/detail" class="product-title">Jumlah Pemasukan Tabungan</a>
                            <h5>{{ "Rp " . number_format( $total_tabungan,2,',','.') }}</h5>
                            <p>Jumlah sadayana artos tabungan anggota</p>
                            <hr>
                        </ul>
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <a href="/pengeluaran/detail" class="product-title">Jumlah Penarikan Tabungan</a>
                            <h5>{{ "Rp " . number_format($total_pengeluaran_tarik_pinjaman,2,',','.') }}</h5>
                            <p> Jumlah sadayana Penarikan tabungan anggota.</p>
                            <hr>
                        </ul>
                        <ul class="products-list product-list-in-card pl-1 pr-1">
                            <b> <a href="javascript:void(0)" class="product-title">Jumlah sisa Tabungan</a>
                                <h4>{{"Rp" . number_format($total_tabungan - $total_pengeluaran_tarik_pinjaman,2,',','.')}}</h4>
                                <span class="text-success" style="font-size: 10px">Bunga Tabungan = {{ "Rp " . number_format($total_bunga_tabungan,2,',','.') }}. </span>
                                <p> Jumlah sisa tabungan anggota, sisa tina penarikan. </p>
                                <hr />
                            </b>
                        </ul>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- ./card-body -->
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