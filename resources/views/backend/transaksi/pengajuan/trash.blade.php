@extends('backend.template_backend.layout')

@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Trash Data Pengajuan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Di Input Oleh</th>
                        <th>Nominal</th>
                        <th>Bulan</th>
                        <th>Ket :</th>
                        <th>Pembayaran</th>
                        <th>Bukti</th>
                        <th>Pengeluaran</th>
                        <th>Laporan Sekertaris</th>
                        <th>Laporan Bendahara</th>
                        <th>Laporan Ketua</th>
                        <th>Tanggal Input</th>
                        <th>Tanggal di konfirmasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pengajuan as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$data->kode}}</td>
                        <td>{{$data->kategori->nama_kategori}}</td>
                        <td>{{$data->data_warga->nama}}</td>
                        <td>{{$data->pengaju->nama}}</td>
                        <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
                        <td>{{date('M-y',strtotime($data->tanggal)) }}</td>
                        <td>{!!$data->keterangan!!}</td>
                        <td>{{$data->pembayaran}}</td>
                        <td>
                            <a href="{{ asset($data->foto) }}" data-toggle="lightbox" data-title="Foto {{ $data->nama_aset }}" data-gallery="gallery">
                                <img src="{{ asset($data->foto) }}" alt="Product Image" class="img-size-50 ">
                            </a>
                        </td>
                        <td>{{$data->pengeluaran_id}}</td>
                        <td>{{$data->sekertaris}}</td>
                        <td>{{$data->bendahara}}</td>
                        <td>{{$data->ketua}}</td>
                        <td>{{$data->created_at}}</td>
                        <td>{{$data->deleted_at}}</td>
                        <td>
                            <form action="{{ route('pengajuan.kill',Crypt::encrypt($data->id)) }}" method="post">
                                @csrf
                                @method('post')
                                <a onclick="tombol()" id="myBtn" href="{{ route('pengajuan.restore',Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-undo"></i> &nbsp; Balikeun</a>
                                <div id="tombol_proses"></div>
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