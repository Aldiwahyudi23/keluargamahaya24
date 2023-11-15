@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <center>
                    <h5 class="text-bold card-header bg-light p-0"> HALAMAN LAYOUT PENGELUARAN</h5>
                </center>
                <hr>

                <form action="{{ Route('layout-halaman-pengeluaran.update',Crypt::encrypt($layout_pengeluaran->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label for="tittle">tittle Menu</label>
                        <input type="text" id="tittle" name="tittle" value="{{ old('tittle',$layout_pengeluaran->tittle) }}" placeholder="tittle Pengeluaran" class="form-control col-12 @error('tittle') is-invalid @enderror">
                        @error('tittle')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="nominal_min">Minimal Pengajuan</label>
                        <input type="text" id="nominal_min" name="nominal_min" value="{{ old('nominal_min',$layout_pengeluaran->nominal_min) }}" placeholder="nominal_min Pengeluaran" class="form-control col-12 @error('nominal_min') is-invalid @enderror">
                        @error('nominal_min')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="gambar">Gambar Form Pengeluaran</label>
                        <input type="file" id="gambar" name="gambar" placeholder="fas fe-call" class="form-control col-12 @error('gambar') is-invalid @enderror">
                        @error('gambar')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>
                    <img src="{{asset($layout_pengeluaran->gambar)}}" alt="">
                    <div class="form-group">
                        <label for="info_proses">info Sedang Proses</label>
                        <textarea name="info_proses" class="textarea form-control bg-light @error('info_proses') is-invalid @enderror" id="summernote" rows="6" value="{{ old('info_proses') }}">{{ old('info_proses',$layout_pengeluaran->info_proses) }}</textarea>
                        @error('info_proses')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="info_full">Info Pengajuan Sudah Full</label>
                        <textarea name="info_full" class="textarea form-control bg-light @error('info_full') is-invalid @enderror" id="summernote1" rows="6" value="{{ old('info_full') }}">{{ old('info_full',$layout_pengeluaran->info_full) }}</textarea>
                        @error('info_full')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="info_nunggak">Info Pengajuan Masih Nungak</label>
                        <textarea name="info_nunggak" class="textarea form-control bg-light @error('info_nunggak') is-invalid @enderror" id="summernote2" rows="6" value="{{ old('info_nunggak') }}">{{ old('info_nunggak',$layout_pengeluaran->info_nunggak) }}</textarea>
                        @error('info_nunggak')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="info_saldo">Info Saldo Belum Cukup</label>
                        <textarea name="info_saldo" class="textarea form-control bg-light @error('info_saldo') is-invalid @enderror" id="summernote3" rows="6" value="{{ old('info_saldo') }}">{{ old('info_saldo',$layout_pengeluaran->info_saldo) }}</textarea>
                        @error('info_saldo')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="temp_keterangan">Template Keterangan</label>
                        <textarea name="temp_keterangan" class="textarea form-control bg-light @error('temp_keterangan') is-invalid @enderror" id="summernote4" rows="6" value="{{ old('temp_keterangan') }}">{{ old('temp_keterangan',$layout_pengeluaran->temp_keterangan) }}</textarea>
                        @error('temp_keterangan')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="info_proses_bayar">Info Proses Bayar Pinjaman</label>
                        <textarea name="info_proses_bayar" class="textarea form-control bg-light @error('info_proses_bayar') is-invalid @enderror" id="summernote5" rows="6" value="{{ old('info_proses_bayar') }}">{{ old('info_proses_bayar',$layout_pengeluaran->info_proses_bayar) }}</textarea>
                        @error('info_proses_bayar')
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

                </div>
                <!-- table akses -->

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