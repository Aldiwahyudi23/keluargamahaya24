@extends('backend.template_backend.layout')
@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Trash Data Pemasukan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Nominal</th>
                        <th>Bulan</th>
                        <th>Ket :</th>
                        <th>Pembayaran</th>
                        <th>Pengurus</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pemasukan as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$data->anggota->name}}</td>
                        <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
                        <td>{{date('M-y',strtotime($data->tanggal)) }}</td>
                        <td>{!!$data->keterangan!!}</td>
                        <td>{{$data->pembayaran}}</td>
                        <td>{{$data->pengurus->name}}</td>
                        <td>
                            <a href="{{ asset($data->foto) }}" data-toggle="lightbox" data-title="Foto {{ $data->nama_aset }}" data-gallery="gallery">
                                <img src="{{ asset($data->foto) }}" alt="Product Image" class="img-size-50 ">
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('pemasukan.kill',Crypt::encrypt($data->id)) }}" method="post">
                                @csrf
                                @method('post')
                                <a onclick="tombol()" id="myBtn" href="{{ route('pemasukan.restore',Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-undo"></i> &nbsp; Balikeun</a>
                                <div id="tombol_proses"></div>
                                <a href="{{route('pemasukan.show',Crypt::encrypt($data->id))}}" class="btn btn-primary btn-sm mt-2"><i class="nav-icon fas fa-book"></i> &nbsp; Tingal</a>
                                <button class="btn btn-danger btn-sm mt-2" onclick="return confirm('Leres bade ngahapus data anu namina {{$data->nama_pemasukan}}  ?')"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection