@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <a href="#input" class="btn btn-info" data-toggle="collapse">Tambah Data Warga</a>
            <div id="input" class="collapse">
                <div class="card-body">
                    <center>
                        <h5 class="text-bold card-header bg-light p-0"> FORM INPUT WARGA</h5>
                    </center>
                    <hr>
                    <form action="{{Route('data-warga.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="card card-primary card-outline card-outline-tabs">
                                    <div class="card-body">
                                        <center>
                                            <h5 class="text-bold card-header bg-light p-0"> DATA PRIBADI</h5>
                                        </center>
                                        <hr>
                                        <div class="form-group row">
                                            <label for="nama">Nama Lengkap</label>
                                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap" class="form-control col-12 @error('nama') is-invalid @enderror">
                                            @error('nama')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select id="jenis_kelamin" name="jenis_kelamin" class="select2bs4 form-control col-12 @error('jenis_kelamin') is-invalid @enderror">
                                                @if(old('jenis_kelamin') == true)
                                                <option value="{{old('jenis_kelamin')}}">{{old('jenis_kelamin')}}</option>
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
                                            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Masukan Tempat Anda Lahir" class="form-control col-12 @error('tempat_lahir') is-invalid @enderror">
                                            @error('tempat_lahir')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="tanggal_lahir Sub Menu" class="form-control col-12 @error('tanggal_lahir') is-invalid @enderror">
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
                                        </center>

                                        <div class="form-group">
                                            <label>Provinsi:</label><br />
                                            <select name="provinsi" id="provinsi" class=" form-control col-12 @error('provinsi') is-invalid @enderror">
                                                <option value="">Pilih</option>
                                            </select>
                                            @error('provinsi')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class=" form-group">
                                            <label>Kab/Kota:</label><br />
                                            <select name="kota" id="kota" class="form-control col-12 @error('kota') is-invalid @enderror">
                                                <option value="">Pilih</option>
                                            </select>
                                            @error('kota')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Kecamatan:</label><br />
                                            <select name="kecamatan" id="kecamatan" class="form-control col-12 @error('kecamatan') is-invalid @enderror">
                                                <option value="">Pilih</option>
                                            </select>
                                            @error('kecamatan')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Kelurahan:</label><br />
                                            <select name="kelurahan" id="kelurahan" class="form-control col-12 @error('kelurahan') is-invalid @enderror">
                                                <option value="">Pilih</option>
                                            </select>
                                            @error('kelurahan')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="kampung">Jalan / Kampung</label> <br>
                                            <input type="text" name="kampung" id="kampung" class="form-control col-12 @error('kampung') is-invalid @enderror">
                                            @error('kampung')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="rt">RT</label>
                                            <input type="number" name="rt" id="rw" class=" col-4 @error('rt') is-invalid @enderror">
                                            @error('rt')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                            <label for="">RW</label>
                                            <input type="number" class=" col-4 @error('rw') is-invalid @enderror" name="rw" id="rw">
                                            @error('rw')
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
                                            <h5 class="text-bold card-header bg-light p-0"> DATA LAINNYA</h5>
                                        </center>

                                        <div class="form-group row">
                                            <label for="no_hp">No Hp / WA</label>
                                            <input type="number" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="62 81xx xxxx xxxx" class="form-control col-12 @error('no_hp') is-invalid @enderror">
                                            @error('no_hp')
                                            <div class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="agama">Agama</label>
                                            <select id="agama" name="agama" class="select2bs4 form-control @error('agama') is-invalid @enderror">
                                                @if(old('agama') == true)
                                                <option value="{{old('agama')}}">{{old('agama')}}</option>
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
                                                @if(old('status_pernikahan') == true)
                                                <option value="{{old('status_pernikahan')}}">{{old('status_pernikahan')}}</option>
                                                @endif
                                                <option value="">-- Pilih Status Pernikahan --</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
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
                                                @if(old('status') == true)
                                                <option value="{{old('status')}}">{{old('status')}}</option>
                                                @endif
                                                <option value="">-- Pilih Status Pernikahan --</option>
                                                <option value="Tidak Sekolah">Tidak Sekolah</option>
                                                <option value="Sekolah">Sekolah</option>
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
                                        <hr>
                                        <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambihkeun</button>
                                        <div id="tombol_proses"></div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DATA WARGA</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama Warga</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>Account</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        use App\Models\FotoUser;
                        use App\Models\User;

                        $no = 0; ?>
                        @foreach($data_warga as $data)
                        <?php $no++;
                        $foto = FotoUser::where('data_warga_id', $data->id)->where('is_active', 1)->first();
                        $cek_akun = User::where('data_Warga_id', $data->id);
                        if ($cek_akun->count() == 1) {
                            $akun = "ON";
                        } else {
                            $akun = "OFF";
                        }
                        ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>
                                <div class="product-img">
                                    <a href="{{ asset($foto->foto) }}" data-toggle="lightbox" data-title="Foto {{ $data->nama }}" data-gallery="gallery">
                                        <img src="{{ asset($foto->foto) }}" alt="Product Image" class="img-size-50 img-circle" style="height:50px;widht:100px;">
                                    </a>
                                </div>
                            </td>
                            <td> <a href="{{route('data-warga.show',Crypt::encrypt($data->id))}}">{{$data->nama}}</a> </td>
                            <td> {{$data->email}} </td>
                            <td> {{$data->jenis_kelamin}}</td>

                            @if($akun == "OFF" )
                            <td>
                                <!-- fomr ini untuk jika akun belum terhubung ke akun user atau belum bisa login -->
                                <form action="{{Route('data-warga.store_user')}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    @if($data->email == false)
                                    <input type="text" name="email" id="email" value="{{$data->email}}">
                                    @else
                                    <input type="hiiden" name="email" id="email" value="{{$data->email}}"> <br>
                                    @endif
                                    <input type="hidden" name="role_id" id="role_id" value="7">
                                    <input type="hidden" name="name" id="name" value="{{$data->nama}}">
                                    <input type="hidden" name="data_warga_id" id="data_warga_id" value="{{$data->id}}">

                                    <button type="submit" class="btn btn-danger"> DAFTAR </button> <br>
                                    <label for="" class="text-danger">Belum punya akun login</label>
                            </td>
                            <!-- ----------------------- -->
                            @else
                            <!-- fORM DI BAWAH UNTUK JIKA AKUN SUDAH TERHBUNG KE AKUN USER -->
                            <td>
                                <form action="{{ route('data-wargas.is_active',Crypt::encrypt($cek_akun->first()->id)) }}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    @if($cek_akun->first()->is_active < 1 ) <button type="submit" class="btn btn-danger"> Tidak Aktif</button><br>
                                        <label for="" class="text-danger"> Akun di Non Aktif kan, tidak bisa mengakses semua halaman</label>
                                        @else
                                        <button type="submit" class="btn btn-success"> Aktif</button> <br>
                                        <label for="" class="text-success"> Akun Sudah Aktif, dapat di gunakan</label>
                                        @endif
                                </form>
                                <a href="{{Route('user.edit',Crypt::encrypt($cek_akun->first()->id))}}" class="btn btn-success">Lihat Account</a>
                            </td>
                            @endif
                            </form>
                            <!-----------------  -->
                            <td>
                                <form action="{{route('data-warga.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('data-warga.edit',Crypt::encrypt($data->id))}}" class="btn btn-primary"><i class="nav-icon fas fa-book"></i> Show & Edit</a>
                                    @if (auth()->user()->role->nama_role == 'Admin')
                                    <button class="btn btn-warning btn-sm mt-2"><i class="nav-icon fas fa-trash-alt" onclick="return confirm('Leres bade ngahapus data anu namina {{$data->nama}}  ?')"></i> Hapus</button>
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
    $("#DataKeluarga").addClass("active");
</script>
@endsection