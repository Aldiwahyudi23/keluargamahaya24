@extends('backend.template_backend.layout')

@section('content')
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <b><i class="fas fa-info"></i> INFO !!!</b> <br>
    Data anu di handap nyaeta data pemasukan ti anggota anu atos bayar. Supados data lebet kana pendataan kas Punten ka bendahara <b>KONFIRMASI PEMABAYARAN </b> ieu sesuai keterangan anu atos anggota input
    <br> <br> Tombol<b> Lihat</b> nu di pinggir kanan Fungsina kanggo ningal detail data eta, sareng kanggo ngakonfirmasi.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<!-- Main content -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pengajuan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Anggota</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_pengajuan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->data_warga->nama }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>
                                @if($data->kategori_id == 2)
                                <a href="{{Route('pengajuan.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-id-card">Laporkan</i></a>
                                @else
                                <a href="{{Route('pengajuan.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-id-card">Lihat</i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<!-- /.content -->
@endsection