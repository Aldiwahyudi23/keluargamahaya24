@extends('backend.template_backend.layout')

@section('content')
<!-- Hanya Akses Admin, bendahara, dan Sekertaris -->
@if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <b><i class="fas fa-info"></i> INFO !!!</b> <br>
    Data anu di handap nyaeta data pemasukan ti anggota anu atos bayar. Supados data lebet kana pendataan kas Punten ka bendahara <b>KONFIRMASI PEMABAYARAN </b> ieu sesuai keterangan anu atos anggota input
    <br> <br> Tombol<b> KONFORMASI</b> nu di handap Fungsina kanggo ngakomfirmasi bahwa pembayaran eta bener.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<!-- Kanggo pengeditan Hanya Akses Admin, dan Sekertaris -->
@if(Auth::user()->role->nama_role == "Admin" | Auth::user()->role->nama_role == "Sekertaris")
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Data nu di handap atos leres ?
    <br> Klik <a href="{{Route('pengajuan.edit',Crypt::encrypt($data_pengajuan->id))}}" type="" class="btn btn-primary btn-sm" onclick="return confirm('Leres bade ngedit data ieu ? , Pengeditan kedah sepengetahuan nu sanes !')">Edit</a> kanggo ngedit data,Jangkauan terbatas .
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@endif
<!-- Akses all -->
@if(Auth::user()->data_warga->id == $data_pengajuan->pengaju->id)
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <b><i class="fas fa-info"></i> INFO !!!</b> <br>
    Data masih di proses nuju di cek ku pengurus, nuju di<b>KONFIRMASI </b> heula.
    <br> <br> mangga<b> Cek deui</b>bilih aya nu lepat, pami bade ngedit mangga klik wae tombol <a href="{{Route('pengajuan.edit.user',Crypt::encrypt($data_pengajuan->id))}}" type="" class="btn btn-primary btn-sm" onclick="return confirm('Leres bade ngedit data ieu ? , Pengeditan kedah sepengetahuan nu sanes !')">Gentos data</a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="card">
                    <!-- /.card-header -->
                    <center>
                        <h5 class="text-bold card-header bg-light p-0"> {{$data_pengajuan->status}}</h5>
                    </center>
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-hover">
                            <tbody>
                            <tr>
                                    <td width="150px">ID Transaksi</td>
                                    <td width="10px">:</td>
                                    <td>{{ $data_pengajuan->kode }}</td>
                                </tr>
                                <tr>
                                    <td width="150px">Pengajuan</td>
                                    <td width="10px">:</td>
                                    <td>{{ $data_pengajuan->kategori->nama_kategori }}</td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Nama Anggoota</td>
                                    <td>:</td>
                                    <td>{{ $data_pengajuan->data_warga->nama }}</td>
                                </tr>
                                <tr>
                                    <td>Di Input Oleh</td>
                                    <td>:</td>
                                    <td>{{ $data_pengajuan->pengaju->nama }}</td>
                                </tr>
                                <td>Nominal</td>
                                <td>:</td>
                                <td>{{ "Rp " . number_format($data_pengajuan->jumlah,2,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td>Pembayaran</td>
                                    <td>:</td>
                                    <td>{{ $data_pengajuan->pembayaran }}</td>
                                </tr>
                                <tr>
                                    <td>Tangaal Pengajuan</td>
                                    <td>:</td>
                                    <td>{{$data_pengajuan->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="">
                            <h5 class=" text-center">Keterangan</h5>
                            {!!$data_pengajuan->keterangan!!}
                            @if($data_pengajuan->foto)
                            <hr>
                            <div class="product-img">
                                <a href="{{asset($data_pengajuan->foto)}}" data-toggle="lightbox" data-title="Tanda Bukti" data-gallery="gallery">
                                    <img src="{{asset($data_pengajuan->foto)}}" alt="Product Image" width="50%" class=" brand-image elevation-3" style="display:block; margin:auto">
                                </a>
                            </div>
                            @endif
                        </div>
                        <hr>

                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                @if(Auth::user()->role->nama_role == "Ketua" | Auth::user()->role->nama_role == "Admin")
                <form action="{{Route('pinjaman.pengeluaran')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="pengeluaran_id" name="pengeluaran_id" value="{{$data_pengajuan->pengeluaran_id}}">
                    {{csrf_field()}}

                    <input type="hidden" id="pengajuan_id" name="pengajuan_id" value="{{ $data_pengajuan->id }}">
                    <input type="hidden" id="kode" name="kode" value="{{ $data_pengajuan->kode }}">
                    <input type="hidden" id="data_warga" name="data_warga" value="{{ $data_pengajuan->data_warga_id }}">
                    <input type="hidden" id="pengaju_id" name="pengaju_id" value="{{ $data_pengajuan->pengaju_id }}">
                    <input type="hidden" id="jumlah" name="jumlah" value=" {{ $data_pengajuan->jumlah }}">
                    <input type="hidden" id="keterangan" name="keterangan" value="{{ $data_pengajuan->keterangan }}">
                    <input type="hidden" id="tanggal" name="tanggal" value="{{ $data_pengajuan->created_at }}">
                    <input type="hidden" id="kategori_id" name="kategori_id" value="{{ $data_pengajuan->kategori_id }}">
                    <input type="hidden" id="pembayaran" name="pembayaran" value="{{ $data_pengajuan->pembayaran }}">
                    <input type="hidden" id="foto1" name="foto1" value="{{ $data_pengajuan->foto }}">

                    <div class="card">
                        <center>
                            <input type="hidden" id="bendahara" name="bendahara" value="{{ $data_pengajuan->bendahara }}">
                            <h5 class="text-bold card-header bg-light p-0"> LAPORAN BENDAHARA</h5>
                        </center>
                        <div class="card-body">
                            <div>{!!$data_pengajuan->bendahara!!}</div>
                        </div>
                    </div>
                    <div class="card">
                        <center>
                            <input type="hidden" id="sekertaris" name="sekertaris" value="{{ $data_pengajuan->sekertaris }}">
                            <h5 class="text-bold card-header bg-light p-0"> LAPORAN SEKERTARIS</h5>
                        </center>
                        <div class="card-body">
                            <div>{!!$data_pengajuan->sekertaris!!}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ketua">LAPORAN KETUA</label>
                        <textarea name="ketua" class="textarea form-control bg-light @error('ketua') is-invalid @enderror" id="summernote" rows="6" value="{{ old('ketua') }}">{{ old('sekertaris',$data_pengajuan->ketua) }}</textarea>
                        @error('ketua')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Konfirmasi</label>
                        <select name="status" id="file" class="form-control select2bs4 @error('status') is-invalid @enderror" required>
                            <option value="">--Pilih Keputusan--</option>
                            <option value="Nunggak">Setujui</option>
                            <option disabled value="Tunda">Tunda</option>
                        </select>
                    </div>
                    <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-primary btn-sm"><i class="fas fa-send"></i> SUBMIT</button>
                    <div id="tombol_proses"></div>
                </form>
                @endif
                @if(Auth::user()->role->nama_role == "Sekertaris" | Auth::user()->role->nama_role == "Bendahara")
                <form action="{{Route('pengajuan.update',Crypt::encrypt($data_pengajuan->id))}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <input type="hidden" id="pengeluaran_id" name="pengeluaran_id" value="{{$data_pengajuan->pengeluaran_id}}">

                    <input type="hidden" id="pengajuan_id" name="pengajuan_id" value="{{ $data_pengajuan->id }}">
                    <input type="hidden" id="kode" name="kode" value="{{ $data_pengajuan->kode }}">
                    <input type="hidden" id="data_warga" name="data_warga" value="{{ $data_pengajuan->data_warga_id }}">
                    <input type="hidden" id="pengaju_id" name="pengaju_id" value="{{ $data_pengajuan->pengaju_id }}">
                    <input type="hidden" id="jumlah" name="jumlah" value=" {{ $data_pengajuan->jumlah }}">
                    <input type="hidden" id="keterangan" name="keterangan" value="{{ $data_pengajuan->keterangan }}">
                    <input type="hidden" id="tanggal" name="tanggal" value="{{ $data_pengajuan->created_at }}">
                    <input type="hidden" id="kategori_id" name="kategori_id" value="{{ $data_pengajuan->kategori_id }}">
                    <input type="hidden" id="pembayaran" name="pembayaran" value="{{ $data_pengajuan->pembayaran }}">
                    <input type="hidden" id="foto1" name="foto1" value="{{ $data_pengajuan->foto }}">
                    @if(Auth::user()->role->nama_role == "Bendahara")
                    <div class="card">
                        <center>
                            <input type="hidden" id="sekertaris" name="sekertaris" value="{{ $data_pengajuan->sekertaris }}">
                            <h5 class="text-bold card-header bg-light p-0"> LAPORAN SEKERTARIS</h5>
                        </center>
                        <div class="card-body">
                            <div>{!!$data_pengajuan->sekertaris!!}</div>
                        </div>
                    </div>
                    <div class="card">
                        <center>
                            <h5 class="text-bold card-header bg-light p-0"> LAPORAN BENDAHARA</h5>
                        </center>
                        <textarea name="bendahara" class="textarea form-control bg-light @error('bendahara') is-invalid @enderror" id="summernote" rows="6" value="{{ old('bendahara') }}">{{ old('sekertaris',$data_pengajuan->bendahara) }}</textarea>
                        @error('bendahara')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    @endif
                    @if(Auth::user()->role->nama_role == "Sekertaris")
                    <div class="card">
                        <center>
                            <input type="hidden" id="bendahara" name="bendahara" value="{{ $data_pengajuan->bendahara }}">
                            <h5 class="text-bold card-header bg-light p-0"> LAPORAN BENDAHARA</h5>
                        </center>
                        <div class="card-body">
                            <div>{!!$data_pengajuan->bendahara!!}</div>
                        </div>
                    </div>
                    <div class="card">
                        <center>
                            <h5 class="text-bold card-header bg-light p-0"> LAPORAN SEKERTARIS</h5>
                        </center>
                        <textarea name="sekertaris" class="textarea form-control bg-light @error('sekertaris') is-invalid @enderror" id="summernote" rows="6" value="{{ old('sekertaris') }}">{{ old('sekertaris',$data_pengajuan->sekertaris) }}</textarea>
                        @error('sekertaris')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    @endif
                    <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-primary btn-sm"><i class="fas fa-send"></i> LAPORKAN</button>
                    <div id="tombol_proses"></div>
                </form>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#file').change(function() {
            var kel = $('#file option:selected').val();
            if (kel == "Nunggak") {
                $("#noId").html('<button onclick="tombol()" id="myBtn" type="submit"  class="btn btn-primary btn-sm"><i class="fas fa-send"></i> SUBMIT</button><div id="tombol_proses"></div>');
            } else {
                $("#noId").html('<button onclick="tombol()" id="myBtn" type="submit" class="btn btn-warning btn-sm"><i class="fas fa-send"></i> TUNDA </button><div id="tombol_proses"></div><span class="text-danger" style="font-size: 10px">Jika emang benar keputusan nya untuk menunda sementara waktu, Mohon dengan sangat Laporan yang di buat harus sedetail mungkin.</span>');
            }
        });
    });
</script>
<script>
    $("#bayar").addClass("active");
</script>
@endsection