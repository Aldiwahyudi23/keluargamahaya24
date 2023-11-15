@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <center>
                    <h5 class="text-bold card-header bg-light p-0"> EDIT DATA ROLE /AKSES</h5>
                </center>
                <hr>
                <form action="{{ Route('sub-menu.update',Crypt::encrypt($submenu->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="menu_id">Menu</label>
                        <select id="menu_id" name="menu_id" class="select2bs4 form-control @error('menu_id') is-invalid @enderror">
                            @if($submenu->menu_id == true)
                            <option value="{{$submenu->menu_id}}">{{$submenu->menu->nama}}</option>
                            @endif
                            <option value="">-- Pilih Menu --</option>
                            @foreach ($data_menu as $data)
                            <option value="{{$data->id}}"> {{$data->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="nama">Sub Menu</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama',$submenu->nama) }}" placeholder="Nama role" class="form-control col-12 @error('nama') is-invalid @enderror">
                        @error('nama')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="icon">Icon / Logo <i class="{{$submenu->icon}}"></i></label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon',$submenu->icon) }}" placeholder="icon role" class="form-control col-12 @error('icon') is-invalid @enderror">
                        @error('icon')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="route_url_id">Url</label>
                        <select name="route_url_id" id="route_url_id" class="select2bs4 form-control @error('menu_id') is-invalid @enderror">
                            @if($submenu->route_url_id == true)
                            <option value="{{$submenu->route_url_id}}">{{$submenu->route_url->nama}}</option>
                            @endif
                            <option value="">-- Pilih Url --</option>
                            @foreach ($data_route_url as $data)
                            <option value="{{$data->id}}">{{$data->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="is_active">On / Off</label>
                        <select name="is_active" id="is_active" class="select2bs4 form-control @error('menu_id') is-invalid @enderror">
                            @if($submenu->is_active == 1)
                            <option value="{{$submenu->is_active}}">On</option>
                            <option value="0">Off</option>
                            @else
                            <option value="{{$submenu->is_active}}">Off</option>
                            <option value="1">On</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="textarea form-control bg-light @error('deskripsi') is-invalid @enderror" id="summernote" rows="6" value="{{ old('deskripsi') }}">{!! $submenu->deskripsi !!}</textarea>
                        @error('deskripsi')
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
                <h3 class="card-title">DATA SUB MENU</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Nama Role</th>
                            <th>Nama Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data_submenu as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td> {{$data->menu->nama}}</td>
                            <td><i class="{{$data->icon}}"></i> {{$data->nama}}</td>
                            <td>
                                <form action="{{route('sub-menu.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('sub-menu.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-book"></i></a>
                                    <a href="{{route('sub-menu.edit',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                    @if (auth()->user()->role->nama_role == 'Admin')
                                    <button class="btn btn-link btn-sm mt-2"><i class="nav-icon fas fa-trash-alt" onclick="return confirm('Leres bade ngahapus data anu namina {{$data->nama}}  ?')"></i> Hapus</button>
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
@endsection