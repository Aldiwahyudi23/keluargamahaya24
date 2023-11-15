@extends('backend.template_backend.layout')

@section('content')
<div class="card">
    <center>
        <h5 class="text-bold card-header bg-light p-0"> EDIT DATA {{$data_pengeluaran->anggaran->nama_anggaran}} {{$data_pengeluaran->data_warga->nama}}</h5>
    </center>
    <div class="card-body">
        <form action="{{Route('pengeluaran.update',Crypt::encrypt($data_pengeluaran->id))}}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            {{csrf_field()}}
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group row">
                            <label for="">Tanggal Input</label>
                            <input type="datetime-local" name="tanggal" id="tanggal" class="form-control col-12 @error('tanggal') is-invalid @enderror" value="">
                            <span class="text-danger" style="font: size 13px;">Di ubah jika bener-bener salah-Transaksi ini di buat pada tanggal {{$data_pengeluaran->tanggal}}</span>
                        </div>
                        @error('tanggal')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                        <div class="form-group">
                            <label for="pengaju_id">Anggota yang menginput</label>
                            <select name="pengaju_id" id="pengaju_id" class="select2bs4 col-12 form-control @error('pengaju_id') is-invalid @enderror">
                                @if($data_pengeluaran->pangaju_id = true)
                                <option value="{{$data_pengeluaran->pengaju_id}}">{{$data_pengeluaran->pengaju->nama}}</option>
                                @endif
                                @foreach($data_warga_program->get() as $data)
                                <option value="{{$data->user->data_warga_id}}">{{$data->user->data_Warga->nama}}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('pengaju_id')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                        <div class="form-group">
                            <label for="data_warga">Data Anggota</label>
                            <select name="data_warga" id="data_warga" class="select2bs4 col-12 form-control @error('data_warga') is-invalid @enderror">
                                @if($data_pengeluaran->data_warga_id == true)
                                <option value="{{$data_pengeluaran->data_warga_id}}">{{$data_pengeluaran->data_warga->nama}}</option>
                                @endif
                                @foreach($data_warga as $data)
                                <option value="{{$data->id}}">{{$data->nama}}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('data_warga')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                        <div class="form-group">
                            <label for="anggaran">Anggaran</label>
                            <select name="anggaran_id" id="anggaran_id" class="select2bs4 col-12 form-control @error('anggaran_id') is-invalid @enderror">
                                @if($data_pengeluaran->anggaran_id == true)
                                <option value="{{$data_pengeluaran->anggaran_id}}">{{$data_pengeluaran->anggaran->nama_anggaran}}</option>
                                @endif
                                @foreach($data_anggaran as $data)
                                <option value="{{$data->id}}">{{$data->nama_anggaran}}</option>
                                @endforeach
                            </select>
                            @error('anggaran_id')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group row" id="noId"></div>
                        <div class="form-group row">
                            <label for="jumlah">Nominal</label>
                            <input type="number" id="jumlah" name="jumlah" value="{{$data_pengeluaran->jumlah}}" placeholder="Maukan Nominal Tanpa titik dan koma" class="form-control col-12 @error('jumlah') is-invalid @enderror">
                            @error('jumlah')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="textarea form-control bg-light @error('keterangan') is-invalid @enderror" id="summernote" rows="6" value="{{ old('keterangan',$data_pengeluaran->alasan) }}">{{ old('keterangan',$data_pengeluaran->alasan) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="ketua">Laporan Ketua</label>
                            <textarea name="ketua" class="textarea form-control bg-light @error('ketua') is-invalid @enderror" id="summernote3" rows="6" value="{{ old('ketua') }}">{{ old('ketua',$data_pengeluaran->ketua) }}</textarea>
                            @error('ketua')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="sekertaris">Laporan Sekertaris</label>
                            <textarea name="sekertaris" class="textarea form-control bg-light @error('sekertaris') is-invalid @enderror" id="summernote1" rows="6" value="{{ old('sekertaris') }}">{{ old('sekertaris',$data_pengeluaran->sekertaris) }}</textarea>
                            @error('sekertaris')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bendahara">Laporan Bendahara</label>
                            <textarea name="bendahara" class="textarea form-control bg-light @error('bendahara') is-invalid @enderror" id="summernote2" rows="6" value="{{ old('bendahara') }}">{{ old('bendahara',$data_pengeluaran->bendahara) }}</textarea>
                            @error('bendahara')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pengurus_id">pengurus yang menyetujui</label>
                            <select name="pengurus_id" id="pengurus_id" class="select2bs4 col-12 form-control @error('pengurus_id') is-invalid @enderror">
                                @if($data_pengeluaran->pengurus_id == true)
                                <option value="{{$data_pengeluaran->pengurus_id}}">{{$data_pengeluaran->pengurus->nama}}</option>
                                @endif
                                @foreach($data_warga_program->get() as $data)
                                <option value="{{$data->user->data_warga_id}}">{{$data->user->data_Warga->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('pengurus_id')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="select2bs4 col-12 form-control @error('status') is-invalid @enderror">
                                @if($data_pengeluaran->status == true)
                                <option value="{{$data_pengeluaran->status}}">{{$data_pengeluaran->status}}</option>
                                @endif
                                <option value="">--Pilih--</option>
                                <option value="Nunggak">Nunggak</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                            <span class="text-danger" style="font-size: 13px">Di isi hanya untuk Anggaran Pinjaman.</span>
                        </div>
                        @error('status')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Leres bade di simpen hasil editanna ? , Pengeditan kedah sepengetahuan nu sanes !')">Gentos</button>
        </form>
    </div>
</div>
<!-- /.card -->

@endsection
@section('script')

<script>
    $("#bayar").addClass("active");
</script>
@endsection