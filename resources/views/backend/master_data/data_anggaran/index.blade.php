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
                            <h5 class="text-bold card-header bg-light p-0"> TAMBAH DATA ANGGARAN</h5>
                        </center>
                        <hr>
                        <form action="{{Route('anggaran.store')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="program_id">Program</label>
                                <select name="program_id" id="program_id" class="form-control select2bs4 @error('program_id') is-invalid @enderror">
                                    @if (old('program_id') == true)
                                    <option value="{{old('program_id')}}">{{old('$program->nama_program')}}</option>
                                    @endif
                                    <option value="">-- Pilih Program --</option>
                                    @foreach($data_program as $program)
                                    <option value="{{$program->id}}">{{$program->nama_program}}</option>
                                    @endforeach
                                </select>
                                @error('program_id')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="nama_anggaran">Nama Anggaran</label>
                                <input type="text" id="nama_anggaran" name="nama_anggaran" value="{{ old('nama_anggaran') }}" placeholder="Nama Anggaran" class="form-control col-12 @error('nama_anggaran') is-invalid @enderror">
                                @error('nama_anggaran')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="kode">Kode Anggaran</label>
                                <input type="text" id="kode" name="kode" value="{{ old('kode') }}" placeholder="Nama Anggaran" class="form-control col-12 @error('kode') is-invalid @enderror">
                                @error('kode')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" class="textarea form-control bg-light @error('deskripsi') is-invalid @enderror" id="summernote" rows="6" value="{{ old('deskripsi') }}"></textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="persen">Nominal berdasarekan persen</label>
                                <input value="{{old('persen')}}" name="persen" type="text" class="form-control bg-light @error('persen') is-invalid @enderror" id="persen">
                                @error('persen')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="max_orang">Limit Orang</label>
                                <input value="{{old('max_orang')}}" name="max_orang" type="text" class="form-control bg-light @error('max_orang') is-invalid @enderror" id="max_orang">
                                @error('max_orang')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="nominal_max_anggaran">Limit Max Uang</label>
                                <input value="{{old('nominal_max_anggaran')}}" name="nominal_max_anggaran" type="text" class="form-control bg-light @error('nominal_max_anggaran') is-invalid @enderror" id="nominal_max_anggaran">
                                @error('nominal_max_anggaran')
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
                        <h3 class="card-title">DATA ANGGARAN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-light">
                                    <th>No.</th>
                                    <th>Kode anggaran</th>
                                    <th>Nama anggaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 0; ?>
                                @foreach($data_anggaran as $data)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->kode}}</td>
                                    <td> <a href="{{route('anggaran.show',Crypt::encrypt($data->id))}}" class="">{{$data->nama_anggaran}}</a></td>
                                    <td>
                                        @if (auth()->user()->role->nama_role == 'Admin' || auth()->user()->role->nama_role == 'Ketua' || auth()->user()->role->nama_role == 'Sekertaris' ||auth()->user()->role->nama_role == 'Bendahara' || auth()->user()->role->nama_role == 'Penasehat')
                                        <form action="{{route('anggaran.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="{{route('anggaran.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-book"></i></a>
                                            <a href="{{route('anggaran.edit',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
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