@extends('backend.template_backend.layout')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">SALDO PINJAMAN</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-footer text-center">
        <a href="{{route('laporan_umum')}}">
            <h3>{{"Rp" . number_format($total_dana_pinjam -  $total_pengeluaran_pinjaman + $total_bayar_pinjaman_semua,2,',','.')}}</h3>
        </a>
        <label for="">Artos nu di pinjam {{"Rp" . number_format($total_pengeluaran_pinjaman - $total_bayar_pinjaman_semua,2,',','.')}}</label>
    </div>
    <!-- /.card-footer -->
</div>
<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">PINJAM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Deskripsi</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <!-- Form Admin -->
                        @if (Auth::user()->role->nama_role == "Admin")
                        @include('backend.transaksi.pengeluaran.form.pinjaman_admin')
                        @else
                        <!-- Form Anggota -->
                        @if($cek_pengajuan >= 1)

                        <body class="justify-content-center">
                            {!!$layout_pengeluaran->info_proses!!}
                        </body>
                        @elseif($cek_pengeluaran_pinjaman_user >= 1)

                        <body class="justify-content-center">
                            {!!$layout_pengeluaran->info_nunggak!!}
                        </body>
                        @elseif($total_sisa_pinjaman <= $data_anggaran_max_pinjaman->max_orang)

                            <body class="justify-content-center">
                                {!!$layout_pengeluaran->info_full!!}
                            </body>
                            @elseif($cek_total_pinjaman <= $data_anggaran_max_pinjaman->nominal_max_anggaran)

                                <body class="justify-content-center">
                                    {!!$layout_pengeluaran->info_saldo!!}
                                </body>
                                @else
                                @include('backend.transaksi.pengajuan.form.form_pinjaman')
                                @endif

                                @endif

                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        {!!$data_anggaran_max_pinjaman->deskripsi!!}
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
                        <a class="nav-link active" id="custom-tabs-one-pinjaman-warga-tab" data-toggle="pill" href="#custom-tabs-one-pinjaman-warga" role="tab" aria-controls="custom-tabs-one-pinjaman-warga" aria-selected="true">pribadi</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-pinjaman-tab" data-toggle="pill" href="#custom-tabs-one-pinjaman" role="tab" aria-controls="custom-tabs-one-pinjaman" aria-selected="true">pinjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="custom-tabs-one-pengajuan-tab" data-toggle="pill" href="#custom-tabs-one-pengajuan" role="tab" aria-controls="custom-tabs-one-pengajuan" aria-selected="false">pengajuan</a>
                    </li>

                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

                    <div class="tab-pane fade show active" id="custom-tabs-one-pinjaman-warga" role="tabpanel" aria-labelledby="custom-tabs-one-pinjaman-warga-tab">
                        <table id="table1" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr class="bg-light">
                                    <th>No.</th>
                                    <th>Ket.</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                use Illuminate\Support\Facades\DB;

                                $no = 0;
                                ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($data_pengeluaran_pinjaman_warga->get() as $data)
                                <?php $no++;
                                $status2 = DB::table('pengeluarans')->find($data->id);
                                ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>
                                        <a href="{{Route('form.bayar.pinjaman',Crypt::encrypt($data->id))}}" class="">
                                            @if ( $status2->status == 'Lunas')
                                            <i class="btn btn-success "> LUNAS </i>
                                            @elseif ( $status2->status == 'Nunggak')
                                            <i class=" btn btn-warning "> Bayar </i>
                                            @endif
                                            </i></a>
                                    </td>
                                    <td>{{$data->tanggal}}</td>
                                    <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>

                                </tr>

                                @php
                                $total += $data->jumlah;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-body -->
                    </div>


                    <div class="tab-pane fade show" id="custom-tabs-one-pinjaman" role="tabpanel" aria-labelledby="custom-tabs-one-pinjaman-tab">
                        <table id="table2" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr class="bg-light">
                                    <th>No.</th>
                                    <th>Ket.</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php



                                $no = 0;
                                ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($data_pengeluaran_pinjaman->get() as $data)
                                <?php $no++;
                                $status2 = DB::table('pengeluarans')->find($data->id);
                                ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>
                                        <a href="{{Route('form.bayar.pinjaman',Crypt::encrypt($data->id))}}" class="">
                                            @if ( $status2->status == 'Lunas')
                                            <i class="btn btn-success "> LUNAS </i>
                                            @elseif ( $status2->status == 'Nunggak')
                                            <i class=" btn btn-warning "> Bayar </i>
                                            @endif
                                            </i></a>
                                    </td>
                                    <td>{{$data->tanggal}}</td>
                                    <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>

                                </tr>

                                @php
                                $total += $data->jumlah;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-body -->
                    </div>
                    <div class="tab-pane fade show" id="custom-tabs-one-pengajuan" role="tabpanel" aria-labelledby="custom-tabs-one-pengajuan-tab">
                        <table id="table3" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr class="bg-light">
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Proses</th>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                ?>
                                @php
                                $total = 0;
                                @endphp
                                @foreach($cek_pengajuan_proses as $data)
                                <?php $no++;
                                $status2 = DB::table('pengeluarans')->find($data->id);
                                ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->kategori->nama_kategori}}</td>
                                    <td>
                                        <a href="{{Route('pengajuan.user',Crypt::encrypt($data->id))}} " class="">
                                            @if ( $data->status == 'Proses')
                                            <i class="btn btn-success "> {{ $data->status}} </i>
                                            @else
                                            <i class=" btn btn-warning "> {{ $data->status}} Sementara </i>
                                            @endif
                                            </i></a>
                                    </td>
                                    <td>{{$data->tanggal}}</td>
                                    <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
                                    <td>
                                        <form action="{{route('pengajuan.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-link btn-sm mt-2"><i class="nav-icon fas fa-trash-alt" onclick="return confirm('Leres bade ngahapus data anu namina   ?')"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- /.table-body -->
                    </div>

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection