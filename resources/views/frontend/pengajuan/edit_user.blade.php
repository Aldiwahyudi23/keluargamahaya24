@extends('backend.template_backend.layout')

@section('content')
<div class="card">
    <center>
        <h5 class="text-bold card-header bg-light p-0"> EDIT DATA PENGAJUAN</h5>
    </center>
    <div class="card-body">
        <form action="{{Route('pengajuan.update',Crypt::encrypt($data_pengajuan->id))}}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            {{csrf_field()}}
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="data_warga">Data Anggota</label>
                            <input type="hidden" name="pengaju_id" id="pengaju_id" value="{{$data_pengajuan->pengaju_id}}">
                            <select name="data_warga" id="data_warga" class="select2bs4 col-12 form-control @error('data_warga') is-invalid @enderror">
                                @if($data_pengajuan->data_warga_id == true)
                                <option value="{{$data_pengajuan->data_warga_id}}">{{$data_pengajuan->data_warga->nama}}</option>
                                @endif
                                <option value="{{Auth::user()->data_warga_id}}">-- Pilih Data Warga --</option>
                                @foreach ($data_hubungan as $data)
                                <option value="{{$data->data_warga_id}}"> {{$data->data_warga->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('data_warga')
                        <div class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </div>
                        @enderror
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="select2bs4 col-12 form-control @error('kategori_id') is-invalid @enderror">
                                @if($data_pengajuan->kategori_id == true)
                                <option value="{{$data_pengajuan->kategori_id}}">{{$data_pengajuan->kategori->nama_kategori}}</option>
                                @endif
                                @foreach($data_kategori as $data)
                                <option value="{{$data->id}}">{{$data->nama_kategori}}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pembayaran">Metode Pembayaran</label>
                            <select name="pembayaran" id="file" class="form-control select2bs4 @error('pembayaran') is-invalid @enderror" required>
                                @if ($data_pengajuan->pembayaran == $data_pengajuan->pembayaran)
                                <option value="{{$data_pengajuan->pembayaran}}">{{$data_pengajuan->pembayaran}}</option>
                                @endif
                                <option value="">--Pilih Pembayaran--</option>
                                <option value="Cash">Uang Tunai</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                            @error('pembayaran')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row" id="noId"></div>
                        <div class="form-group row">
                            <label for="jumlah">Nominal</label>
                            <input type="number" id="jumlah" name="jumlah" value="{{$data_pengajuan->jumlah}}" placeholder="Maukan Nominal Tanpa titik dan koma" class="form-control col-12 @error('jumlah') is-invalid @enderror">
                            @error('jumlah')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" class="textarea form-control bg-light @error('keterangan') is-invalid @enderror" id="summernote" rows="6" value="{{ old('keterangan',$data_pengajuan->keterangan) }}">{{ old('keterangan',$data_pengajuan->keterangan) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
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
    $(document).ready(function() {
        $('#file').change(function() {
            var kel = $('#file option:selected').val();
            if (kel == "Transfer") {
                $("#noId").html('<div class="form-group"><label for="account-company">Bukti Transfer</label><input type="file" class="form-control" name="foto" id="foto" value="{{$data_pengajuan->foto}}" required /><span class="text-danger" style="font-size: 10px">Harap kirim tanda bukti transferan.</span>{{$data_pengajuan->foto}}</div>');
            } else {
                $("#noId").html('');
            }
        });
    });
</script>
<script>
    $("#bayar").addClass("active");
</script>
@endsection