@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-12 ">
        <div class="card card-primary card-outline dialog-scrollable">
            <div class="card-header">
                <h5 class="text-bold card-header bg-light p-2 text-center"> Profile</h5>
            </div>
            <div class="card-body">
                <table class="table" style="margin-top: -21px;">
                    <tr>
                        <td width="50"><i class="nav-icon fas fa-user-edit"></i></td>
                        <td> <a href="{{Route('profile.edit.data')}}" class="text-dark">Edit Data Diri<a></td>
                    </tr>
                    <tr>
                        <td width="50"><img src="{{ asset( Auth::user()->foto) }}" class="img-fluid img-circle" alt="User profile picture"></td>
                        <td>
                            <a href="" data-toggle="lightbox" data-title="Foto {{ Auth::user()->name }}" data-gallery="gallery" data-footer=' <form action="" method="post" enctype="multipart/form-data">
                                            {{csrf_field()}}<input type="file" class="form-control"  name=" foto" id="foto"> <input type="hidden" class="form-control" name=" user" id="user" value="{{Auth::user()->id}}"> <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-file-upload"></i> </button></form>' class="text-dark"> Edit Foto
                            </a>
                        </td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="card card-danger card-outline">
            <div class="card-header">
                <h5 class="text-bold card-header bg-light p-2 text-center"> Pengaturan Akun</h5>
            </div>
            <div class="card-body">
                <table class="table" style="margin-top: -21px;">
                    <tr>
                        <td width="50"><i class="nav-icon fas fa-envelope"></i></td>
                        <td> <a href="" class="text-dark">Ubah Email<a></td>
                    </tr>
                    <tr>
                        <td width="50"><i class="nav-icon fas fa-key"></i></td>
                        <td> <a href="" class="text-dark"> Ubah Password
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td width="50"><i class="nav-icon fas fa-check"></i></td>
                        <td>Sambungkan</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>

                        </td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h5 class="text-bold card-header bg-light p-2 text-center"> Program</h5>
            </div>
            <div class="card-body">
                <table class="table" style="margin-top: -21px;">
                    <tr>
                        <td width="50"><i class="nav-icon fas fa-list"></i></td>
                        <td> <a href="/roleprogram " class="text-dark">Program<a></td>
                    </tr>
                    <tr>
                        <td width="50"><i class="nav-icon fas fa-list"></i></td>
                        <td> <a href=" " class="text-dark">Cek Tugas<a></td>
                    </tr>
                    <tr>
                        <td width="50"><i class="nav-icon fas fa-list"></i></td>
                        <td> <a href="" class="text-dark">Cek keluarga<a></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h5 class="text-bold card-header bg-light p-2 text-center"> Bantuan</h5>
            </div>
            <div class="card-body">
                <table class="table" style="margin-top: -21px;">
                    <tr>
                        <td width="50"><i class="nav-icon fas fa-list"></i></td>
                        <td> <a href="/roleprogram " class="text-dark">Bantuan<a></td>
                    </tr>
                    <tr data-toggle="modal" data-target="#layout_app">
                        <td width="50"><i class="nav-icon fas fa-list"></i></td>
                        <td> Edit Warna Aplikasi</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<div class="modal fade" id="layout_app" tabindex="-1" role="dialog" aria-labelledby="layout_appTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">YUUUU Ganti Warna </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ Route('layout-app-user.update',Crypt::encrypt($data_layout_app->id)) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                {{csrf_field()}}
                <div class="form-group col-12">
                    <label for="navbar">Bagian Atas</label>
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                    <input type="color" name="navbar" id="navbar" value="{{$data_layout_app->navbar}}">
                </div>
                <div class="form-group col-12">
                    <label for="sider">Bagian Samping</label>
                    <input type="color" name="sider" id="sider" value="{{$data_layout_app->sider}}">
                </div>
                <div class="form-group col-12">
                    <label for="menu">Bagian Bawah</label>
                    <input type="color" name="menu" id="menu" value="{{$data_layout_app->menu}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ganti</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $("#{{$title->nama}}").addClass("active");
</script>
@endsection