@extends('backend.template_backend.layout')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline card-outline-tabs">
            <center>
                <h5 class="text-bold card-header bg-light p-0"> EDIT DATA {{$data_bayar_pinjaman->pengeluaran->kode}} {{$data_bayar_pinjaman->data_warga->nama}}</h5>
            </center>
            <div class="card-body">
                <form action="{{Route('pinjaman.update',Crypt::encrypt($data_bayar_pinjaman->id))}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="card-body table-responsive">
                        <div class="row">
                            <input type="hidden">
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label for="tanggal">ID Transaksi (hidden)</label>
                                    <input type="text" id="" name="" value="{{$data_bayar_pinjaman->kode}}" placeholder="ID Kosong" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="pengeluaran_id">pengeluaran</label>
                                    <select name="pengeluaran_id" id="pengeluaran_id" class="form-control select2bs4 @error('pengeluaran_id') is-invalid @enderror" required>
                                        @if ($data_bayar_pinjaman->pengeluaran_id == true)
                                        <option value="{{$data_bayar_pinjaman->pengeluaran_id}}">{{$data_bayar_pinjaman->pengeluaran->kode}} - {{$data_bayar_pinjaman->data_warga->nama}}</option>
                                        @endif
                                        <option value="">--Pilih pengeluaran--</option>
                                        @foreach($data_pinjaman as $data)
                                        <option value="{{$data->id}}">{{$data->pengeluaran->kode}} - {{$data_bayar_pinjaman->data_warga->nama}}</option>
                                        @endforeach
                                    </select>
                                    @error('pengeluaran_id')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Pengajuan (hidden) </label>
                                    <input type="datetime-local" id="" name="" value="{{$data_bayar_pinjaman->tanggal}}" placeholder="Nama inisial" class="form-control" disabled>
                                    <input type="hidden" id="tanggal" name="tanggal" value="{{$data_bayar_pinjaman->tanggal}}">
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Di Setujui (hidden)</label>
                                    <input type="datetime-local" id="" name="" value="{{$data_bayar_pinjaman->created_at}}" placeholder="Nama inisial" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">jumlah</label>
                                    <input type="text" id="jumlah" name="jumlah" value="{{$data_bayar_pinjaman->jumlah}}" placeholder="contoh@gmail.com" class="form-control @error('jumlah') is-invalid @enderror">
                                    @error('jumlah')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pembayaran">Metode Pembayaran</label>
                                    <select name="pembayaran" id="file" class="form-control select2bs4 @error('pembayaran') is-invalid @enderror" required>
                                        @if ($data_bayar_pinjaman->pembayaran == $data_bayar_pinjaman->pembayaran)
                                        <option value="{{$data_bayar_pinjaman->pembayaran}}">{{$data_bayar_pinjaman->pembayaran}}</option>
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
                                <div class="form-group" id="noId"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="data_warga">Anggota Keluarga</label>
                                    <select id="data_warga" name="data_warga" class="select2bs4 form-control @error('data_warga') is-invalid @enderror">
                                        @if (old('data_warga',$data_bayar_pinjaman->data_warga_id) == true)
                                        <option value="{{old('data_warga',$data_bayar_pinjaman->data_warga_id)}}">{{old('nama',$data_bayar_pinjaman->data_warga->nama)}}</option>
                                        @endif
                                        <option value="">-- Pilih Nama --</option>
                                        @foreach ($data_warga as $data)
                                        <option value="{{$data->id}}"> {{$data->nama}}</option>
                                        @endforeach
                                    </select>
                                    @error('data_warga')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pengaju_id">Pengaju </label>
                                        <select id="pengaju_id" name="pengaju_id" class="select2bs4 form-control @error('pengaju_id') is-invalid @enderror">
                                            @if (old('pengaju_id',$data_bayar_pinjaman->pengaju_id) == true)
                                            <option value="{{old('pengaju_id',$data_bayar_pinjaman->pengaju_id)}}">{{old('nama',$data_bayar_pinjaman->pengaju->nama)}}</option>
                                            @endif
                                            <option value="">-- Pilih Nama --</option>
                                            @foreach ($data_anggota as $data)
                                            <option value="{{$data->data_warga_id}}"> {{$data->data_warga->nama}}</option>
                                            @endforeach
                                        </select>
                                        @error('pengaju_id')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" class="textarea form-control bg-light @error('keterangan') is-invalid @enderror" id="summernote" rows="6" value="{{ old('keterangan') }}">{!!$data_bayar_pinjaman->keterangan!!}</textarea>
                                        @error('keterangan')
                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    @if($data_bayar_pinjaman->foto)
                                    <hr>
                                    <div class="product-img">
                                        <a href="{{asset($data_bayar_pinjaman->foto)}}" data-toggle="lightbox" data-title="Tanda Bukti" data-gallery="gallery">
                                            <img src="{{asset($data_bayar_pinjaman->foto)}}" alt="Product Image" width="50%" class=" brand-image elevation-3" style="display:block; margin:auto">
                                        </a>
                                    </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Leres bade di simpen hasil editanna ? , Pengeditan kedah sepengetahuan nu sanes !')">Gentos</button>
                </form>
            </div>
            <!-- /.card -->
        </div>

    </div><!--/. container-fluid -->
</section>
@endsection
@section('script')
<!-- Pemasukan edit -->
<script>
    $(document).ready(function() {
        $('#file').change(function() {
            var kel = $('#file option:selected').val();
            if (kel == "Transfer") {
                $("#noId").html('<div class="form-group"><label for="account-company">Bukti Transfer</label><input type="file" class="form-control" name="foto" id="foto" value="{{$data_bayar_pinjaman->foto}}" required /><span class="text-danger" style="font-size: 10px">Harap kirim tanda bukti transferan.</span>{{$data_bayar_pinjaman->foto}}</div>');
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