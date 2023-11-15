@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <center>
                    <h5 class="text-bold card-header bg-light p-0"> EDIT DATA MENU</h5>
                </center>
                <hr>
                <form action="{{ Route('menu.update',Crypt::encrypt($menu->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="kategori">Type Class</label>
                        <select name="kategori" id="kategori" class="select2bs4 form-control col-12">
                            @if($menu->kategori == "sidebar")
                            <option value="{{$menu->kategori}}">{{$menu->kategori}}</option>
                            <option value="setting">Setting</option>
                            @endif
                            @if($menu->kategori == "setting")
                            <option value="{{$menu->kategori}}">{{$menu->kategori}}</option>
                            <option value="sidebar">Sidebar</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group row">
                        <label for="nama">Nama Role</label>
                        <input type="hidden" name="id" value="{{ $menu->id }}">
                        <input type="text" id="nama" name="nama" value="{{ old('nama',$menu->nama) }}" placeholder="Nama role" class="form-control col-12 @error('nama') is-invalid @enderror">
                        @error('nama')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="icon">Icon / Logo <i class="{{$menu->icon}}"></i> </label>
                        <input type="text" id="icon" name="icon" value="{{old('icon',$menu->icon)}}" placeholder="fas fe-call" class="form-control col-12 @error('icon') is-invalid @enderror">
                        @error('icon')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="route_url_id">Url</label>
                        <select name="route_url_id" id="route_url_id" class="select2bs4 form-control col-12 @error('route_url_id') is-invalid @enderror">
                            @if($menu->route_url_id == true)
                            <option value="{{$menu->route_url_id}}">{{$menu->route_url->nama}}</option>
                            @endif
                            <option value="">--Pilih Url--</option>
                            @foreach($data_route_url as $data)
                            <option value="{{$data->id}}">{{$data->nama}}</option>
                            @endforeach
                        </select>
                        @error('route_url_id')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="class">Type Class</label>
                        <select name="class" id="class" class="select2bs4 form-control col-12">
                            @if($menu->class == false)
                            <option value="{{$menu->class}}">Tutup</option>
                            <option value="menu-open">Open</option>
                            @endif
                            @if($menu->class == 'menu-open')
                            <option value="{{$menu->class}}">Open</option>
                            <option value="0">Tutup</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="textarea form-control bg-light @error('deskripsi') is-invalid @enderror" id="summernote" rows="6" value="{{ old('deskripsi') }}">{!! $menu->deskripsi !!}</textarea>
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
                <h3 class="card-title">DATA MENU</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Nama Menu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data_menu as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td><i class="{{$data->icon}}"></i> {{$data->nama}}</td>
                            <td>
                                <form action="{{route('menu.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('menu.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-book"></i></a>
                                    <a href="{{route('menu.edit',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
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