@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Form Bayar KAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Deskripsi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">S & K</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <!-- Akses kanggo admin -->
                        @foreach($access_pemasukan_form_1->get() as $data)
                        @if($data->is_active == 1)
                        @include('backend.transaksi.pengajuan.form.form_kas_admin')
                        @else
                        <p>
                            <center>Akses teu acan aktif
                                <br>
                                Mangga Kontak we Admin kanggo minta aksesna
                            </center>

                        </p>
                        @endif
                        @endforeach

                        <!-- Akses kanggo form biasa -->
                        @if($cek_pengajuan >= 1)

                        <body class="justify-content-center">
                            {!!$layout_pemasukan->info_proses!!}
                        </body>
                        @else
                        @foreach($access_pemasukan->get() as $data)
                        @if($data->is_active == 1)
                        @include('backend.transaksi.pengajuan.form.form_kas')
                        @else
                        <p>
                            <center>Akses teu acan aktif
                                <br>
                                Mangga Kontak we Admin kanggo minta aksesna
                            </center>

                        </p>
                        @endif
                        @endforeach
                        @endif



                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        {!!$program->deskripsi!!}
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                        {!!$program->SnK!!}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-Kas-tab" data-toggle="pill" href="#custom-tabs-one-Kas" role="tab" aria-controls="custom-tabs-one-Kas" aria-selected="true">Kas</a>
                    </li>
                    @foreach($access_pemasukan_table->get() as $data)
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-home-tab" data-toggle="pill" href="#{{$data->kategori}}" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">{{$data->kategori}}</a>
                    </li>
                    @endforeach

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade " id="Semua" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Nominal</th>
                                    <th>Bulan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($data_pemasukan_semua as $data)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->kode}}</td>
                                    <td>{{$data->data_warga->nama}}</td>
                                    <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
                                    <td>{{date('M-y',strtotime($data->tanggal)) }}</td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <!-- /.table-body -->
                    </div>
                    <div class="tab-pane fade show active" id="custom-tabs-one-Kas" role="tabpanel" aria-labelledby="custom-tabs-one-Kas-tab">
                        <table id="table1" class="table table-bordered table-striped table-responsive">
                            @include('frontend.pemasukan.table.kas_user')
                        </table>
                        <!-- /.table-body -->
                    </div>
                    <div class="tab-pane fade show" id="custom-tabs-one-tabungan" role="tabpanel" aria-labelledby="custom-tabs-one-tabungan-tab">
                        <table id="table4" class="table table-bordered table-striped table-responsive">

                        </table>
                        <!-- /.table-body -->
                    </div>
                    <div class="tab-pane fade" id="Anggota" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                        <table id="table2" class="table table-bordered table-striped table-responsive">
                            @include('frontend.pemasukan.table.perAnggota')
                        </table>
                        <!-- /.table-body -->
                    </div>
                    <div class="tab-pane fade" id="Setor" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
                        <table id="table3" class="table table-bordered table-striped table-responsive">
                            @include('frontend.pemasukan.table.setor_tunai')
                        </table>
                        <!-- /.table-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    @endsection