@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <a href="#input" class="btn btn-info" data-toggle="collapse">Tambah Pengeluaran</a>
            <div id="input" class="collapse">
                <div class="card-body">
                    <center>
                        <h5 class="text-bold card-header bg-light p-0"> FORM INPUT PENGELUARAN</h5>
                    </center>
                    <hr>
                    <form action="{{Route('pengeluaran.store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group row">
                                    <label for="">Tanggal Input</label>
                                    <input type="datetime-local" name="tanggal" id="tanggal" class="form-control col-12 @error('tanggal') is-invalid @enderror">
                                </div>
                                @error('tanggal')
                                <div class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </div>
                                @enderror
                                <div class="form-group">
                                    <label for="pengaju_id">Anggota yang menginput</label>
                                    <select name="pengaju_id" id="pengaju_id" class="select2bs4 col-12 form-control @error('pengaju_id') is-invalid @enderror">
                                        <option value="">--Pilih Anggota--</option>
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
                                        <option value="">--Pilih Anggota--</option>
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
                                        <option value="">--Pilih Metode anggaran--</option>
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
                                    <input type="number" id="jumlah" name="jumlah" value="" placeholder="Maukan Nominal Tanpa titik dan koma" class="form-control col-12 @error('jumlah') is-invalid @enderror">
                                    @error('jumlah')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" class="textarea form-control bg-light @error('keterangan') is-invalid @enderror" id="summernote" rows="6" value="{{ old('keterangan') }}">{{ old('keterangan') }}</textarea>
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
                                    <textarea name="ketua" class="textarea form-control bg-light @error('ketua') is-invalid @enderror" id="summernote3" rows="6" value="{{ old('ketua') }}">{{ old('ketua') }}</textarea>
                                    @error('ketua')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sekertaris">Laporan Sekertaris</label>
                                    <textarea name="sekertaris" class="textarea form-control bg-light @error('sekertaris') is-invalid @enderror" id="summernote1" rows="6" value="{{ old('sekertaris') }}">{{ old('sekertaris') }}</textarea>
                                    @error('sekertaris')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bendahara">Laporan Bendahara</label>
                                    <textarea name="bendahara" class="textarea form-control bg-light @error('bendahara') is-invalid @enderror" id="summernote2" rows="6" value="{{ old('bendahara') }}">{{ old('bendahara') }}</textarea>
                                    @error('bendahara')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pengurus_id">pengurus yang menyetujui</label>
                                    <select name="pengurus_id" id="pengurus_id" class="select2bs4 col-12 form-control @error('pengurus_id') is-invalid @enderror">
                                        <option value="">--Pilih Anggota--</option>
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

                        <hr>
                        <input type="hidden" name="cek_data" id="cek_data" value="input_admin">
                        <button onclick="tombol_kas()" id="myBtn_kas" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> SIMPEN</button>
                        <div id="tombol_proses"></div>
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
                <h3 class="card-title">DATA SEMUA PENGELUARAN</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>ID transaksi</th>
                            <th>Anggaran</th>
                            <th>Nama Anggota</th>
                            <th>Nominal</th>
                            <th>Tanggal Input</th>

                            <th>Di Input Oleh</th>
                            <th>Di Setujui Oleh</th>
                            <th>Status</th>
                            <th>Katerangan</th>
                            <th>Ketua</th>
                            <th>Sekertaris</th>
                            <th>Bendahara</th>
                            <th>created at</th>
                            <th>updated at</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data_pengeluaran as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->kode}}</td>
                            <td>{{$data->anggaran->nama_anggaran}}</td>
                            <td>{{$data->data_warga->nama}}</td>
                            <td>{{$data->jumlah}}</td>
                            <td>{{$data->tanggal}}</td>
                            <td>{{$data->pengaju->nama}}</td>
                            <td>{{$data->pengurus->nama}}</td>
                            <td>{{$data->status}}</td>
                            <td>{!!$data->alasan!!}</td>
                            <td>{!!$data->ketua!!}</td>
                            <td>{!!$data->sekertaris!!}</td>
                            <td>{!!$data->bendahara!!}</td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->updated_at}}</td>
                            <td>
                                <form action="{{route('pengeluaran.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('pengeluaran.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-book"></i></a>
                                    <a href="{{route('pengeluaran.edit',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                    @if (auth()->user()->role->nama_role == 'Admin')
                                    <button class="btn btn-link btn-sm mt-2"><i class="nav-icon fas fa-trash-alt" onclick="return confirm('Leres bade ngahapus data anu namina {{$data->nama}}  ?')"></i> </button>
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