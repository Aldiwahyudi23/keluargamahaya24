<div class="form-group row">
    <label for="nama">Nama Lengkap</label>
    <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap" class="form-control col-12 @error('nama') is-invalid @enderror">
    @error('nama')
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
<div class="form-group">
    <label for="jenis_kelamin">Jenis Kelamin</label>
    <select id="jenis_kelamin" name="jenis_kelamin" class="select2bs4 form-control col-12 @error('jenis_kelamin') is-invalid @enderror">
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
</div>
<!-- /.card -->
</div>
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
            <input type="text" name="kampung" id="kampung3" class="form-control col-12 @error('kampung') is-invalid @enderror">
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
<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-body">
        <center>
            <h5 class="text-bold card-header bg-light p-0"> DATA LAINNYA</h5>
        </center>

        <div class="form-group row">
            <label for="no_hp">No Hp / WA</label>
            <input type="number" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="081xx xxxx xxxx" class="form-control col-12 @error('no_hp') is-invalid @enderror">
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
        <!--  -->
        <hr>
        <input type="hidden" name="jk" id="jk" value="jk"> <!-- Umtuk membedakan input dari pribadi dan admin-->
        <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambihkeun</button>
        <div id="tombol_proses"></div>