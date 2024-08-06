@extends('backend.template_backend.layout')

@section('content')
<?php

$lahir    = new DateTime($data_warga->tanggal_lahir);
$today        = new DateTime();
$umur = $today->diff($lahir);
?>
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">DATA {{$data_warga->nama}} </h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="text-center">
                        <a href="{{ asset($foto->foto) }}" data-toggle="lightbox" data-title="Foto Profile {{ $data_warga->nama }}" data-gallery="gallery" data-footer=' <form action="{{ Route('data-warga.update', Crypt::encrypt($data_warga->id)) }}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}<input type="file" class="form-control"  name=" foto" id="foto"> <input type="hidden" class="form-control" name=" user" id="user" value=""> <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-file-upload"></i> </button></form>'>
                            <img src="{{ asset( $foto->foto) }}" width="130px" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                        </a>
                    </div>
                    <h3 class="profile-username text-center">{{ $data_warga->nama }} ({{$umur->y}})</h3>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>No Whatsapp</b> <a href="https://wa.me/62{{$data_warga->no_hp}}" class="float-right">{{ $data_warga->no_hp }}</a>
                        </li>
                    </ul>
                    <table id="exampl" class="table ">
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{$data_warga->nama}}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelammin</td>
                                <td>:</td>
                                <td>{{$data_warga->jenis_kelamin}}</td>
                            </tr>
                            <tr>
                                <td>Tempat, Tgl Lahir</td>
                                <td>:</td>
                                <td>{{$data_warga->tempat_lahir}}, {{$data_warga->tanggal_lahir}}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{$data_warga->alamat}}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td>{{$data_warga->agama}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{$data_warga->status}}</td>
                            </tr>
                            <tr>
                                <td>Status Pernikahan</td>
                                <td>:</td>
                                <td>{{$data_warga->status_pernikahan}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="examp" class="table">
                        <tbody>
                            <?php

                            use App\Models\HubunganWarga;
                            use App\Models\User;
                            ?>
                            @foreach($cek_data_hubungan as $data)
                            <?php

                            $lahir    = new DateTime($data->data_warga->tanggal_lahir);
                            $today        = new DateTime();
                            $umur = $today->diff($lahir);

                            $cek_data_hubungan_hapus = HubunganWarga::where('hubungan', $data->hubungan)->where('warga_id', $data_warga->id)->where('data_warga_id', $data->data_warga->id)->first();
                            $id_hubungan = $cek_data_hubungan_hapus->id;
                            ?>
                            <tr>
                                <td>
                                    {{$data->hubungan}}
                                </td>
                                <td>:</td>
                                <td><a href="{{route('data-warga.show',Crypt::encrypt($data->data_warga->id))}}">{{$data->data_warga->nama}} ({{$umur->y}})</a></td>
                                <td>
                                    <form action="{{route('data-hubungan-warga.destroy',Crypt::encrypt($id_hubungan))}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        @if (auth()->user()->role->nama_role == 'Admin')
                                        <button class="btn btn-link btn-sm "><i class="nav-icon fas fa-trash-alt" onclick="return confirm('Leres bade ngahapus data anu namina {{$data->data_warga->nama}}  ?')"></i> </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- /.table-body -->
                    <form action="{{Route('data-hubungan-warga.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-body">
                                <center>
                                    <h5 class="text-bold card-header bg-light p-0"> INPUT DATA HUBUNGAN KELUARGA</h5>
                                </center>
                                <div class="form-group">
                                    <label for="data_warga_id">Data Keluarga</label>
                                    <select id="data_warga_id" name="data_warga_id" class="select3bs4 form-control col-12 @error('data_warga_id') is-invalid @enderror">
                                        @if(old('data_warga_id') == true)
                                        <option value="{{old('data_warga_id')}}">{{old('data_warga_id')}}</option>
                                        @endif
                                        <option value="">-- Pilih Keluarga --</option>
                                        @foreach($data_warga_all as $data)
                                        <option value="{{$data->id}}">{{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                    @error('data_warga_id')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>

                                <?php

                                use App\Models\DataWarga;
                                use Illuminate\Support\Facades\Auth;

                                if ($data_warga->jenis_kelamin == "Laki-Laki") {
                                    $cek_data_hubungan = HubunganWarga::where('hubungan', 'Suami')->where('data_warga_id', $data_warga->id)->count();
                                }
                                if ($data_warga->jenis_kelamin == "Perempuan") {
                                    $cek_data_hubungan = HubunganWarga::where('hubungan', 'Istri')->where('data_warga_id', $data_warga->id)->count();
                                }

                                if ($data_warga->status_pernikahan == "Menikah") {
                                    if ($cek_data_hubungan == 1) {
                                        if ($data_warga->jenis_kelamin == "Laki-Laki") {
                                            $data_hubungan_ayah = HubunganWarga::where('hubungan', 'Suami')->where('data_warga_id', $data_warga->id)->first();
                                            $data_hubungan = DataWarga::find($data_hubungan_ayah->warga_id);
                                        }
                                        if ($data_warga->jenis_kelamin == "Perempuan") {
                                            $data_hubungan_istri = HubunganWarga::where('hubungan', 'Istri')->where('data_warga_id', $data_warga->id)->first();
                                            $data_hubungan = DataWarga::find($data_hubungan_istri->warga_id);
                                        }
                                    }
                                }
                                ?>
                                @if($data_warga->status_pernikahan == "Menikah")
                                @if ($cek_data_hubungan == 1)
                                <div class="form-group">
                                    <label for="warga_id_1">Untuk Pemilihan Hubungan Anak apakah benar Salah satu orang tua nya yang bernama {{$data_hubungan->nama}} ?</label>
                                    <span class="text-danger" style="font-size: 13px">Di isi jika HUBUNGAN nya sebagai Anak, Selain hubungan Anak pilih Bukan</span>
                                    <select id="warga_id_1" name="warga_id_1" class="select3bs4 form-control col-12 @error('warga_id_1') is-invalid @enderror">
                                        <option value="">Bukan</option>
                                        <option value="{{$data_hubungan->id}}">YA ({{$data_hubungan->nama}})</option>
                                    </select>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label for="hubungan">Hubungan</label>
                                    <select id="hubungan" name="hubungan" class="select3bs4 form-control col-12 @error('hubungan') is-invalid @enderror">
                                        @if(old('hubungan') == true)
                                        <option value="{{old('hubungan')}}">{{old('hubungan')}}</option>
                                        @endif
                                        <option value="">-- Pilih Hubungan Keluarga --</option>
                                        <option value="Anak">Anak</option>
                                        <option value="Ayah">Ayah</option>
                                        <option value="Ibu">Ibu</option>
                                        <option value="Suami">Suami</option>
                                        <option value="Istri">Istri</option>
                                    </select>
                                    @error('hubungan')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                @else
                                <div class="form-group">
                                    <label for="hubungan">Hubungan</label>
                                    <select id="hubungan" name="hubungan" class="select3bs4 form-control col-12 @error('hubungan') is-invalid @enderror">
                                        @if(old('hubungan') == true)
                                        <option value="{{old('hubungan')}}">{{old('hubungan')}}</option>
                                        @endif
                                        <option value="">-- Pilih Hubungan Keluarga --</option>
                                        <option value="Ayah">Ayah</option>
                                        <option value="Ibu">Ibu</option>
                                    </select>
                                    @error('hubungan')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                @endif
                                <input type="hidden" name="warga_id" id="warga_id" value="{{$data_warga->id}}">
                                <hr>
                                <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambahkan anak</button>
                                <div id="tombol_proses"></div>
                                <!-- /.card -->

                            </div>
                        </div>
                    </form>
                </div>



                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h5 class="text-bold card-header bg-light p-2 text-center"> Akun Yang Terkait</h5>
                    </div>
                    <div class="card-body">
                        @if ($data_akun == true)
                        <div class="form-group col-12">
                            <label for="navbar">{{$data_akun->email}}</label>
                        </div>
                        <div class="form-group col-12">
                            <label for="menu">{{$data_akun->role->nama_role}}</label>
                        </div>
                        <div class="form-group col-12">
                            @if($data_akun->is_active == 1)
                            <label for="sider">Aktif</label>
                            @else
                            <label for="sider">Tidak Aktif</label>
                            @endif
                        </div>
                        <div class="container">
        <div class="left-text" style="float: left;">
        <a href="{{Route('user.edit',Crypt::encrypt($data_akun->id))}}" class="btn btn-success ">Lihat Account</a>
        </div>
        @if ($data_akun->role->nama_role == "Keluarga") 
        <?php
$id_hubungan = User::where ('data_warga_id',$data_hubungan->id)->first();
$cek_user = User::where ('id',$data_akun->id);
$cek_user_hubungan = User::find($data_akun->user_id);
?>
@if ($cek_user->count() == 1 )
        
        <div class="right-text" style="float: right;">
        <form action="{{Route('user.hubungkan_akun')}}" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id_hub" id="id_hub" value="{{$data_akun->id}}">
                                        <input type="hidden" name="user_id" id="user_id" value="{{$id_hubungan->id}}">
                                        @if($cek_user->first()->user_id == False ) <button type="submit" class="btn btn-danger"> Sambungkan</button>
                                        @else
                                        <button type="submit" class="btn btn-success"> Putuskan</button>
                                        @endif
                                    </form>
    </div><br>
    @if($data_akun->user_id <= 1 )
    @else
        <div class="right-text" style="float: right;">{{$cek_user_hubungan->name}}</div>
    @endif
    @endif
                            @endif
                  
                        
                        @else
                        <label for="">Belum ada akun yang terkait, segera daftarkan jika ingin bisa masuk ke aplikasi</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($data_akun == true)
    <div class="col-12 col-sm-12">
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
                            <th>Jangka</th>
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
                            <td> {{$data->tenor}}</td>
                            <td>{{$data->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection