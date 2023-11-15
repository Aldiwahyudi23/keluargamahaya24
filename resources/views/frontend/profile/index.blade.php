@extends('backend.template_backend.layout')

@section('content')

<div class="col-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">

                <a href="{{ asset($foto->where('is_active', 1)->first()->foto) }}" data-toggle="lightbox" data-title="Foto Profile {{ Auth::user()->name }}" data-gallery="gallery" data-footer=' <form action="" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}<input type="file" class="form-control"  name=" foto" id="foto"> <input type="hidden" class="form-control" name=" user" id="user" value="{{$data_warga->keluarga_id}}"> <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-file-upload"></i> </button></form>'>
                    <img src="{{ asset($foto->where('is_active', 1)->first()->foto) }}" width="130px" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                </a>

            </div>


            <h3 class="profile-username text-center">{{ $data_warga->nama }}</h3>
            <h5 class="profile-username text-center">( {{ Auth::user()->name }} )</h5>
            <!-- <p class="text-muted text-center">{{ Auth::user()->role }}</p> -->
            <!-- <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>No INduk</b> <a class="float-right">{{ $data_warga->id }}</a>
                </li>
            </ul> -->
            <a href="{{route('profile.edit',Crypt::encrypt($data_warga->id))}}" class="btn btn-primary btn-block"><b>Edit Profile</b></a>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<div class="col-12">
    <!-- Profile Image -->
    <form action="" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <label for="foto">Ganti Foto Profile</label>
        <input type="file" class="form-control" name="foto" id="foto"> <input type="hidden" class="form-control" name=" user" id="user" value="{{$data_warga->keluarga_id}}">

        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach($foto->get() as $data1)
                    <div class="product-img">
                        <a href="{{ asset( $data1->foto) }}" data-toggle="lightbox" data-title="Foto {{ Auth::user()->name }}" data-gallery="gallery">
                            <img src="{{ asset( $data1->foto) }}" alt="Product Image" width="65px" height="65px" alt="Saya" class="brand-image img-circle elevation-3">
                        </a>

                    </div>
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-file-upload"></i> Upload</button>
    </form>
</div>
<!-- /.card -->
</div>
<div class="col-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Profil</h3>
        </div>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th style="width:50%">Nama</th>
                    <td>{{ $data_warga->nama}}</td>
                </tr>
                <tr>
                    <th style="width:50%">Jenis Kelamin</th>
                    <td>{{ $data_warga->jenis_kelamin}}</td>
                </tr>
                <tr>
                    <th style="width:50%">Tempat,Tanggal Lahir</th>
                    <td>{{ $data_warga->tempat_lahir}},{{ $data_warga->tanggal_lahir}}</td>
                </tr>
                <tr>
                    <th style="width:50%">Alamat</th>
                    <td>{{ $data_warga->alamat}}</td>
                </tr>
                <tr>
                    <th>No Handphone</th>
                    <td>{{ $data_warga->no_hp}}</td>
                </tr>

                <tr>
                    <th>Pekerjaan</th>
                    <td>{{$data_warga->status}}</td>
                </tr>
                <tr>
                    <td>Status Pernikahan</td>
                    <td>{{$data_warga->status_pernikahan}}</td>
                </tr>

                @foreach($cek_data_hubungan as $data)
                <tr>
                    <td>{{$data->hubungan}}</td>
                    <td>{{$data->data_warga->nama}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<div class="col-12">
    <div class="row">
        <div class="col-6 table-responsiv ">
            <!-- About Me Box -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Akun</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="far fa-envelope mr-1"></i> Email</strong>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                    <hr>

                    <strong><i class="fas fa-phone mr-1"></i> No Telepon</strong>
                    <p class="text-muted">{{ $data_warga->no_hp}}</p>
                    <hr>
                    <strong><i class="fas fa-setting mr-1"></i> Program</strong>
                    <p class="text-muted"></p> <br>


                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-6 table-responsive">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Pengaturan Akun</h3>
                </div>
                <div class="card-body">
                    <table class="table" style="margin-top: -21px;">
                        <tr>
                            <td width="50"><i class="nav-icon fas fa-envelope"></i></td>
                            <td> <a href="{{ route('pengaturan.email') }}">Ubah Email<a></td>
                        </tr>
                        <tr>
                            <td width="50"><i class="nav-icon fas fa-key"></i></td>
                            <td><a href="{{ route('pengaturan.password') }}">Ubah Password</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title">Rekap Pekerjaan</h3>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr class="bg-light">
                        <th>No.</th>
                        <th>Status</th>
                        <th>Di Input pada tanggal</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 0; ?>
                    @foreach($kerja as $data)
                    <?php $no++;
                    ?>
                    <tr>
                        <td>{{$no}}</td>
                        <td> {{$data->status}}</td>
                        <td>{{$data->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section(' script') <script>
    $("#profile").addClass("active");
</script>
@endsection