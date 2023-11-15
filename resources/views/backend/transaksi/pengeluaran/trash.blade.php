@extends('backend.template_backend.layout')

@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Trash Data Pengeluaran</h3>
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
                        <th>status</th>
                        <th>Pengurus</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pengeluaran as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$data->data_warga->nama}}</td>
                        <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
                        <td>{{date('M-y',strtotime($data->tanggal)) }}</td>
                        <td>{!!$data->alasan!!}</td>
                        <td>{{$data->status}}</td>
                        <td>{{$data->pengurus->nama}}</td>
                        <td>
                            <a href="{{ asset($data->foto) }}" data-toggle="lightbox" data-title="Foto {{ $data->nama_aset }}" data-gallery="gallery">
                                <img src="{{ asset($data->foto) }}" alt="Product Image" class="img-size-50 ">
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('pengeluaran.kill',Crypt::encrypt($data->id)) }}" method="post">
                                @csrf
                                @method('post')
                                <a onclick="tombol()" id="myBtn" href="{{ route('pengeluaran.restore',Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-undo"></i> &nbsp; Balikeun</a>
                                <div id="tombol_proses"></div>
                                <a href="{{route('pengeluaran.show',Crypt::encrypt($data->id))}}" class="btn btn-primary btn-sm mt-2"><i class="nav-icon fas fa-book"></i> &nbsp; Tingal</a>
                                <button class="btn btn-danger btn-sm mt-2" onclick="return confirm('Leres bade ngahapus data anu namina {{$data->nama_pengeluaran}}  ?')"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
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