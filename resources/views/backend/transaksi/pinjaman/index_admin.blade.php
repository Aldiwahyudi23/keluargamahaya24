@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DATA SEMUA PINJAMAN</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-responsive">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>ID Transaksi</th>
                            <th>Pengaju</th>
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
                        @foreach($laporan_pinjaman as $data)
                        <?php $no++;
                        $bayar_pinjaman = DB::table('bayar_pinjamen')->where('pengeluaran_id', $data->id);
                        ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td> {{$data->kode}}</td>
                            <td>{{$data->data_warga->nama}}</td>
                            <td>
                                {{$data->status}}
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
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- /.row -->
@endsection