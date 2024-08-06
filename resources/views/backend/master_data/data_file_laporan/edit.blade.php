@extends('backend.template_backend.layout')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- ./row -->
        <div class="row">
            @if (auth()->user()->role->nama_role == 'Admin' || auth()->user()->role->nama_role == 'Ketua' || auth()->user()->role->nama_role == 'Sekertaris' ||auth()->user()->role->nama_role == 'Bendahara' || auth()->user()->role->nama_role == 'Penasehat')
            <div class="col-12 col-sm-6">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-body">
                        <center>
                            <h5 class="text-bold card-header bg-light p-0"> TAMBAH DATA FILE LAPORAN</h5>
                        </center>
                        <hr>
                        <form action="{{ route('file-laporan.update',Crypt::encrypt($file_laporan->id)) }}" method="post" enctype="multipart/form-data">
                            @method('PATCH')
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="judul">Judul Laporan</label>
                                <input type="text" id="judul" name="judul" value="{{ old('judul',$file_laporan->judul) }}" placeholder="Judul Laporan" class="form-control col-12 @error('judul') is-invalid @enderror">
                                @error('judul')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="file">file Laporan</label>
                                <input type="file" id="file" name="file" value="{{ old('file',$file_laporan->file) }}" placeholder="Upload file" class="form-control col-12 @error('file') is-invalid @enderror">
                                @error('file')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" class="textarea form-control bg-light @error('deskripsi') is-invalid @enderror" id="summernote" rows="6" value="{{ old('deskripsi',$file_laporan->deskripsi) }}">{{ old('deskripsi',$file_laporan->deskripsi) }}</textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <hr>
                            <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPEN</button>
                            <div id="tombol_proses"></div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            @endif
            <div class="col-12 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DATA LAPORAN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-light">
                                    <th>No.</th>
                                    <th>Judul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 0; ?>
                                @foreach($data_file as $data)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td> <a href="{{route('file-laporan.show',Crypt::encrypt($data->id))}}" class="">{{$data->judul}}</a></td>
                                    <td>
                                        @if (auth()->user()->role->nama_role == 'Admin' || auth()->user()->role->nama_role == 'Ketua' || auth()->user()->role->nama_role == 'Sekertaris' ||auth()->user()->role->nama_role == 'Bendahara' || auth()->user()->role->nama_role == 'Penasehat')
                                        <form action="{{route('file-laporan.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="{{route('file-laporan.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-book"></i></a>
                                            <a href="{{route('file-laporan.edit',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                            @if (auth()->user()->role->nama_role == 'Admin')
                                            <button class="btn btn-link btn-sm mt-2"><i class="nav-icon fas fa-trash-alt" onclick="return confirm('Leres bade ngahapus data anu namina {{$data->nama}}  ?')"></i> </button>
                                            @endif
                                        </form>
                                        @endif
                                    </td>


                                </tr>
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
    </div><!--/. container-fluid -->
</section>
@endsection