@extends('backend.template_backend.layout')
@section('content')
<!-- /.row -->
<div class="card">
    <div class="card card-primary card-tabs">
        <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-kas-tab" data-toggle="pill" href="#custom-tabs-one-kas" role="tab" aria-controls="custom-tabs-one-kas" aria-selected="true">Pemasukan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-lain-tab" data-toggle="pill" href="#custom-tabs-one-lain" role="tab" aria-controls="custom-tabs-one-lain" aria-selected="true">Lain-Lain</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="custom-tabs-one-darurat-tab" data-toggle="pill" href="#custom-tabs-one-darurat" role="tab" aria-controls="custom-tabs-one-darurat" aria-selected="false">Darurat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="custom-tabs-one-usaha-tab" data-toggle="pill" href="#custom-tabs-one-usaha" role="tab" aria-controls="custom-tabs-one-usaha" aria-selected="false">Usaha</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="custom-tabs-one-amal-tab" data-toggle="pill" href="#custom-tabs-one-amal" role="tab" aria-controls="custom-tabs-one-amal" aria-selected="false">Amal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="custom-tabs-one-pinjam-tab" data-toggle="pill" href="#custom-tabs-one-pinjam" role="tab" aria-controls="custom-tabs-one-pinjam" aria-selected="false">Pinjaman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="custom-tabs-one-file-tab" data-toggle="pill" href="#custom-tabs-one-file" role="tab" aria-controls="custom-tabs-one-file" aria-selected="false">File Laporan Tahunan</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">

                <div class="tab-pane fade show active" id="custom-tabs-one-kas" role="tabpanel" aria-labelledby="custom-tabs-one-kas-tab">
                    <table id="table1" class="table table-bordered table-striped table-responsive">
                        @include('backend.transaksi.pemasukan.laporan.table.data_pemasukan')
                    </table>
                    <!-- /.table-body -->
                </div>
                <div class="tab-pane fade show" id="custom-tabs-one-lain" role="tabpanel" aria-labelledby="custom-tabs-one-lain-tab">
                    <table id="table2" class="table table-bordered table-striped table-responsive">
                        @include('backend.transaksi.pengeluaran.laporan.table.dana_lain')
                    </table>
                    <!-- /.table-body -->
                </div>
                <div class="tab-pane fade show" id="custom-tabs-one-darurat" role="tabpanel" aria-labelledby="custom-tabs-one-darurat-tab">
                    <table id="table3" class="table table-bordered table-striped table-responsive">
                        @include('backend.transaksi.pengeluaran.laporan.table.dana_darurat')
                    </table>
                    <!-- /.table-body -->
                </div>
                <div class="tab-pane fade show" id="custom-tabs-one-usaha" role="tabpanel" aria-labelledby="custom-tabs-one-usaha-tab">
                    <table id="table4" class="table table-bordered table-striped table-responsive">
                        @include('backend.transaksi.pengeluaran.laporan.table.dana_usaha')
                    </table>
                    <!-- /.table-body -->
                </div>
                <div class="tab-pane fade show" id="custom-tabs-one-amal" role="tabpanel" aria-labelledby="custom-tabs-one-amal-tab">
                    <table id="table5" class="table table-bordered table-striped table-responsive">
                        @include('backend.transaksi.pengeluaran.laporan.table.dana_amal')
                    </table>
                    <!-- /.table-body -->
                </div>
                <div class="tab-pane fade show" id="custom-tabs-one-pinjam" role="tabpanel" aria-labelledby="custom-tabs-one-pinjam-tab">
                    <table id="table6" class="table table-bordered table-striped table-responsive">
                        @include('backend.transaksi.pengeluaran.laporan.table.data_pinjaman_umum')
                    </table>
                    <!-- /.table-body -->
                </div>
                <div class="tab-pane fade show" id="custom-tabs-one-file" role="tabpanel" aria-labelledby="custom-tabs-one-file-tab">
                    <table id="table7" class="table table-bordered table-striped table-responsive">
                        @include('backend.transaksi.pengeluaran.laporan.table.data_file_laporan_tahunan')
                    </table>
                    <!-- /.table-body -->
                </div>

            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
@section('script')
<script>
    $("#pinja").addClass("active");
</script>
@endsection