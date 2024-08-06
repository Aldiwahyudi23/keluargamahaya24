@extends('backend.template_backend.layout')

@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Trash Data anggaran</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_anggaran as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_anggaran }}</td>
                        <td>
                            <form action="{{ route('anggaran.kill',Crypt::encrypt($data->id)) }}" method="post">
                                @csrf
                                @method('post')
                                <a onclick="tombol()" id="myBtn" href="{{ route('anggaran.restore',Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm mt-2"><i class="nav-icon fas fa-undo"></i> &nbsp; Restore</a>
                                <div id="tombol_proses"></div>
                                <button class="btn btn-danger btn-sm mt-2" onclick="return confirm('Leres bade ngahapus data anu namina {{$data->nama_anggaran}}  ?')"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
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
@section('script')
<script>
    $(" #ViewTrash").addClass("active");
    $("#liViewTrash").addClass("menu-open");
    $("#Trashanggaran").addClass("active");
</script>
@endsection