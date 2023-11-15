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
                            <th>Pengaju</th>
                            <th>Ket.</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        use App\Models\BayarPinjaman;
                        use Illuminate\Support\Facades\DB;

                        $no = 0;
                        ?>
                        @php
                        $total = 0;
                        @endphp
                        @foreach($laporan_pinjaman as $data)
                        <?php $no++;
                        $status2 = DB::table('pengeluarans')->find($data->id);
                        ?>
                        <tr class="text-bold">
                            <td>{{$no}}</td>
                            <td>{{$data->data_warga->nama}}</td>
                            <td>{{$data->tanggal}}</td>
                            <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
                            <td>
                                <a href="{{Route('form.bayar.pinjaman',Crypt::encrypt($data->id))}}" class="">
                                    @if ( $status2->status == 'Lunas')
                                    <i class="btn btn-success "> LUNAS </i>
                                    @elseif ( $status2->status == 'Nunggak')
                                    <i class=" btn btn-warning "> Bayar </i>
                                    @endif
                                    </i></a>
                            </td>

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