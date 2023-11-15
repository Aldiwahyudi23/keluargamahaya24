@extends('backend.template_backend.layout')

@section('content')
<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <center>
                    <h5 class="text-bold card-header bg-light p-0"> EDIT DATA PROGRAM</h5>
                </center>
                <hr>
                <form action="{{ route('program.update',Crypt::encrypt($program->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="nama_program">Nama Program</label>
                        <input type="hidden" name="id" value="{{ $program->id }}">
                        <input type="text" id="nama_program" name="nama_program" value="{{ old('nama_program',$program->nama_program) }}" placeholder="Nama program" class="form-control col-12 @error('nama_program') is-invalid @enderror">
                        @error('nama_program')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="textarea form-control bg-light @error('deskripsi') is-invalid @enderror" id="summernote" rows="6" value="{{ old('deskripsi') }}">{!! $program->deskripsi !!}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="SnK">S&K</label>
                        <textarea name="SnK" class="textarea form-control bg-light @error('SnK') is-invalid @enderror" id="summernote1" rows="6" value="{{ old('SnK') }}">{!! $program->SnK !!}</textarea>
                        @error('SnK')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jumlah">jumlah untuk pembayaran </label>
                        <input type="number" name="jumlah" class=" form-control bg-light @error('jumlah') is-invalid @enderror" id="summernote1" rows="6" value="{{ old('jumlah',$program->jumlah) }}">
                        @error('jumlah')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal di resmikan </label>
                        <input type="datetime-local" name="tanggal" class=" form-control bg-light @error('tanggal') is-invalid @enderror" id="summernote1" rows="6" value="{{ old('tanggal',$program->tanggal) }}">
                        @error('tanggal')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <hr>
                    <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Geuntos</button>
                    <div id="tombol_proses"></div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DATA PROGRAM</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Nama program</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data_program as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->nama_program}}</td>
                            <td>
                                <form action="{{route('program.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('program.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-book"></i></a>
                                    <a href="{{route('program.edit',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                    @if (auth()->user()->role == 'Admin')
                                    <button class="btn btn-link btn-sm mt-2"><i class="nav-icon fas fa-trash-alt" onclick="return confirm('Leres bade ngahapus data anu namina {{$data->nama}}  ?')"></i> </button>
                                    @endif
                                </form>
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
@endsection