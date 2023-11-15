@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <center>
                    <h5 class="text-bold card-header bg-light p-0"> HALAMAN LAYOUT PEMASUKAN</h5>
                </center>
                <hr>

                <form action="{{ Route('layout-halaman-pemasukan.update',Crypt::encrypt($layout_pemasukan->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="tittle">tittle Menu</label>
                        <input type="text" id="tittle" name="tittle" value="{{ old('tittle',$layout_pemasukan->tittle) }}" placeholder="tittle Pemasukan" class="form-control col-12 @error('tittle') is-invalid @enderror">
                        @error('tittle')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="gambar">Gambar Form Pemasukan</label>
                        <input type="file" id="gambar" name="gambar" placeholder="fas fe-call" class="form-control col-12 @error('gambar') is-invalid @enderror">
                        @error('gambar')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>
                    <img src="{{asset($layout_pemasukan->gambar)}}" alt="">
                    <div class="form-group">
                        <label for="info_proses">info_proses</label>
                        <textarea name="info_proses" class="textarea form-control bg-light @error('info_proses') is-invalid @enderror" id="summernote" rows="6" value="{{ old('info_proses') }}">{{ old('info_proses',$layout_pemasukan->info_proses) }}</textarea>
                        @error('info_proses')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <hr>
                    <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> EDIT</button>
                    <div id="tombol_proses"></div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">AKSES LAYOUT</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="#input" class="btn btn-info" data-toggle="collapse">Tambah Akses</a>
                <div id="input" class="collapse">
                    <form action="{{Route('access-pemasukan')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="select2 form-control col-12 @error('type') is-invalid @enderror">
                                <option value="">--Pilih--</option>
                                <option value="Form_input">Form Input</option>
                                <option value="table">Table</option>
                            </select>
                            @error('type')
                            <div class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Nama Role</label>
                            <select name="role_id" id="role_id" class="select2 form-control col-12 @error('role_id') is-invalid @enderror">
                                <option value="">--Pilih--</option>
                                @foreach($role as $data)
                                <option value="{{$data->id}}">{{$data->nama_role}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <div class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="select2 form-control col-12 @error('kategori') is-invalid @enderror">
                                <option value="">--Pilih--</option>
                                <option value="Form_1">Form Admin</option>
                                <option value="Form">Form</option>
                                <option value="Semua">Table Semua</option>
                                <option value="Anggota">Table Anggota</option>
                                <option value="Setor">Table Setor Tunai</option>
                            </select>
                            @error('kategori')
                            <div class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">Simpen</button>
                    </form>
                </div>
                <!-- table akses -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Type</th>
                            <th>Role</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 0; ?>
                        @foreach($access_pemasukan as $data)
                        <?php $no++;
                        ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->type}}</td>
                            <td>{{$data->role->nama_role}}</td>
                            <td>{{$data->kategori}}</td>
                            <td>
                                <form action="{{Route('is_active_access',Crypt::encrypt($data->id))}}" method="post" enctype="multipart/form-data">
                                    @method('POST')
                                    {{csrf_field()}}
                                    @if($data->is_active == 1)
                                    <input type="hidden" name="is_active" id="is_active" value="0">
                                    <button type="submit" class="btn btn-success">Aktif</button>
                                    @else
                                    <input type="hidden" name="is_active" id="is_active" value="1">
                                    <button type="submit" class="btn btn-danger">Tidak Aktif</button>
                                    @endif
                                </form>
                            </td>
                            <td>

                                <form action="{{route('access_pemasukan_hapus',Crypt::encrypt($data->id))}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    @if (auth()->user()->role->nama_role == 'Admin')
                                    <button class="btn btn-link btn-sm mt-2"><i class="nav-icon fas fa-trash-alt" onclick="return confirm('Leres bade ngahapus data anu namina  ?')"></i> Hapus</button>
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
@section('script')
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#Dataanggaran").addClass("active");
</script>
@endsection