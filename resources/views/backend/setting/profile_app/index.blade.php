@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <center>
                    <a href="{{Route('profile-app-login')}}">
                        <h5 class="text-bold card-header bg-light p-2"> Layout Login</h5>
                    </a>
                </center>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <center>
                    <h5 class="text-bold card-header bg-light p-2"> Layout Home</h5>
                </center>
            </div>
            <form action="{{ Route('profile-app.update',Crypt::encrypt($data_profileApp->id)) }}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                {{csrf_field()}}
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>Nama</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$data_profileApp->nama}}</td>
                            <td>
                                <input type="text" name="nama" id="nama" value="{{$data_profileApp->nama}}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{asset($data_profileApp->foto)}}" alt="" width="50%">
                            </td>
                            <td>
                                <input type="file" name="foto" id="foto">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{asset($data_profileApp->logo)}}" alt="" width="50%">
                            </td>
                            <td>
                                <input type="file" name="logo" id="logo">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambihkeun</button>
                <div id="tombol_proses"></div>
            </form>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- /.row -->
@endsection