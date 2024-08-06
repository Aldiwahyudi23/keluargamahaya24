<?php

use App\Models\User;

$cek_user = User::where('data_warga_id', $suami->id);
?>
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">DATA SUAMI </h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <div class="text-center">
                        <a href="{{ asset( $foto_user_suami->foto) }}" data-toggle="lightbox" data-title="Foto Profile {{ Auth::user()->name }}" data-gallery="gallery" data-footer=' <form action="{{ Route('data-warga.update', Crypt::encrypt($suami->id)) }}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}<input type="file" class="form-control"  name=" foto" id="foto"> <input type="hidden" class="form-control" name=" user" id="user" value=""> <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-file-upload"></i> </button></form>'>
                            <img src="{{ asset( $foto_user_suami->foto) }}" width="130px" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                        </a>
                    </div>
                    <h3 class="profile-username text-center">{{ $suami->nama }}</h3>
                    @if ($cek_user->count() == 1)
                    <h3 class="profile-username text-center">{{ $cek_user->first()->name }}</h3>
                    @else
                    <p> Belum terdafrtar, Jika mau mendaftarkan klik tombol Daftarkan di bawah</p>
                    <form action="{{Route('data-warga.store_user')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="role_id" id="role_id" value="7">
                        <input type="hidden" name="email" id="email" value="{{$suami->email}}">
                        <input type="hidden" name="no_hp" id="no_hp" value="{{$suami->no_hp}}">
                        <input type="hidden" name="name" id="name" value="{{$suami->nama}}">
                        <input type="hidden" name="name" id="name" value="{{$suami->nama}}">
                        <input type="hidden" name="data_warga_id" id="data_warga_id" value="{{$suami->id}}">

                        <button type="submit" class="btn btn-danger"> DAFTARKAN </button> <br>
                        <label for="" class="text-danger">Belum punya akun login</label>
                    </form>
                    @endif

                    <!-- setatus aktif -->
                    @if ($cek_user->count() == 1)
                    @if($cek_user->first()->is_active == 1)
                    <label for="" class="text-success text-center" style="font-size: 13px">Aktif</label>
                    @else
                    <label for="" class="text-danger text-center" style="font-size: 13px">Tidak Aktif</label>
                    @endif
                    @endif
                    <!-- <p class="text-muted text-center">{{ Auth::user()->role }}</p> -->
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b>
                            @if ($cek_user->count() == 1 )
                            <!-- Awal untuk ferifikasi -->
                            (@if($cek_user->first()->email_verified_at == true)
                            <label for="" class="text-success " style="font-size: 13px">Terverifiksi</label>
                            @else
                            <label for="" class="text-danger " style="font-size: 13px">Belum di Verifiksi</label>
                            @endif)
                            @endif
                            @if($suami->email == false)
                            <p class="float-right">Belum ada email yang terkait <br> Tidak bisa masuk ke aplikasi</p>
                            @else
                            <a class="float-right">{{ $suami->email }}</a>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <b>No HP</b> <a class="float-right">{{ $suami->no_hp }}</a>
                        </li>
                                     @if (Auth::user()->role_id <= 6 ) @if ($cek_user->count() == 1 )
                            <li class="list-group-item">
                                <b>Hubungkan Akun</b> <a class="float-right">
                                    <form action="{{Route('user.hubungkan_akun')}}" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" name="id_hub" id="id_hub" value="{{$cek_user->first()->id}}">
                                        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                                        @if($cek_user->first()->user_id == False ) <button type="submit" class="btn btn-danger"> Tidak Tersambung</button>
                                        @else
                                        <button type="submit" class="btn btn-success"> Tersambung</button>
                                        @endif
                                    </form>
                                </a>
                            </li>
                            @endif
                            @endif
                    </ul>
                    <table id="example1" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{$suami->nama}}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelammin</td>
                                <td>:</td>
                                <td>{{$suami->jenis_kelamin}}</td>
                            </tr>
                            <tr>
                                <td>Tempat, Tgl Lahir</td>
                                <td>:</td>
                                <td>{{$suami->tempat_lahir}}, {{$suami->tanggal_lahir}}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{$suami->alamat}}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td>{{$suami->agama}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{$suami->status}}</td>
                            </tr>
                            <tr>
                                <td>Status Pernikahan</td>
                                <td>:</td>
                                <td>{{$suami->status_pernikahan}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- /.table-body -->
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('data-warga.update',Crypt::encrypt($suami->id)) }}" method="post" enctype="multipart/form-data">
    @method('PATCH')
    {{csrf_field()}}
    <div class="row">
        <div class="col-12 col-sm-4">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-body">
                    <center>
                        <h5 class="text-bold card-header bg-light p-0"> EDIT DATA suami</h5>
                    </center>
                    <hr>
                    <div class="form-group row">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama',$suami->nama) }}" placeholder="Nama Lengkap" class="form-control col-12 @error('nama') is-invalid @enderror">
                        @error('nama')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="select2bs4 form-control col-12 @error('jenis_kelamin') is-invalid @enderror">
                            @if(old('jenis_kelamin',$suami->jenis_kelamin) == true)
                            <option value="{{old('jenis_kelamin',$suami->jenis_kelamin)}}">{{old('jenis_kelamin',$suami->jenis_kelamin)}}</option>
                            @endif
                            <option value="">-- Pilih Jenis kelamin --</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir',$suami->tempat_lahir) }}" placeholder="Masukan Tempat Anda Lahir" class="form-control col-12 @error('tempat_lahir') is-invalid @enderror">
                        @error('tempat_lahir')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir',$suami->tanggal_lahir) }}" placeholder="tanggal_lahir Sub Menu" class="form-control col-12 @error('tanggal_lahir') is-invalid @enderror">
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-body">
                    <center>
                        <h5 class="text-bold card-header bg-light p-0"> ALAMAT</h5>
                        <label for="" class="text-danger">Kosongkan Jika tidak mau merubah !</label>
                    </center>

                    <div class="form-group">
                        <label>Provinsi:</label><br />
                        <select name="provinsi" id="provinsi5" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                    <div class=" form-group">
                        <label>Kab/Kota:</label><br />
                        <select name="kota" id="kota5" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kecamatan:</label><br />
                        <select name="kecamatan" id="kecamatan5" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelurahan:</label><br />
                        <select name="kelurahan" id="kelurahan5" class="form-control">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kampung">Jalan / Kampung</label> <br>
                        <input type="text" name="kampung" id="kampung" class="form-control col-12" value="">
                    </div>
                    <div class="form-group">
                        <label for="rt/re">RT</label>
                        <input type="number" name="rt" id="rw" class="  col-4" value="">
                        <label for="">RW</label>
                        <input type="number" class=" col-4" name="rw" id="rw" value="">
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-body">
                    <center>
                        <h5 class="text-bold card-header bg-light p-0"> DATA LAINNYA</h5>
                    </center>

                    <div class="form-group row">
                        <label for="no_hp">No Hp / WA</label>
                        <input type="number" id="no_hp" name="no_hp" value="{{ old('no_hp',$suami->no_hp) }}" placeholder="081xx xxxx xxxx" class="form-control col-12 @error('no_hp') is-invalid @enderror">
                        @error('no_hp')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="agama">Agama</label>
                        <select id="agama" name="agama" class="select2bs4 form-control @error('agama') is-invalid @enderror">
                            @if(old('agama',$suami->agama) == true)
                            <option value="{{old('agama',$suami->agama)}}">{{old('agama',$suami->agama)}}</option>
                            @endif
                            <option value="">-- Pilih Agama --</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Khonghucu">Khonghucu</option>
                        </select>
                        @error('agama')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status_pernikahan">Status Pernikahan</label>
                        <select id="status_pernikahan" name="status_pernikahan" class="select2bs4 form-control @error('status_pernikahan') is-invalid @enderror">
                            @if(old('status_pernikahan',$suami->status_pernikahan) == true)
                            <option value="{{old('status_pernikahan',$suami->status_pernikahan)}}">{{old('status_pernikahan',$suami->status_pernikahan)}}</option>
                            @endif
                            <option value="">-- Pilih Status Pernikahan --</option>
                            <option value="Menikah">Menikah</option>
                            <option value="Cerai Hidup">Cerai Hidup</option>
                            <option value="Cerai Mati">Cerai Mati</option>
                        </select>
                        @error('status_pernikahan')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="select2bs4 form-control @error('status') is-invalid @enderror">
                            @if(old('status',$suami->status) == true)
                            <option value="">{{old('status',$suami->status)}}</option>
                            @endif
                            <option value="">-- Pilih Status --</option>
                            <option value="Bekerja">Bekerja</option>
                            <option value="Tidak Bekerja">Tidak Bekerja</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control col-12 @error('foto') is-invalid @enderror" id="foto" value="{{ old('foto') }}">
                        <label class="text-danger" for="">kosongkan jika tidak mau upload</label>
                        @error('foto')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{$suami->email}}" class="form-control col-12" placeholder="Jika Ingin Mengaktifkan Akun/ bisa Login ke aplikasi , Harap Masukan Email">
                    </div>
                    <hr>
                    <hr>
                    <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Ganti</button>
                    <div id="tombol_proses"></div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

</form>