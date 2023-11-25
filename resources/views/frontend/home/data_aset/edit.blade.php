@extends('backend.template_backend.layout')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- ./row -->
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-body">
                        <center>
                            <h5 class="text-bold card-header bg-light p-0"> TEDIT DATA ASET</h5>
                        </center>
                        <hr>
                        <form action="{{ route('aset.update',Crypt::encrypt($data_aset->id)) }}" method="post" enctype="multipart/form-data">
                            @method('PATCH')
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="kode">Kode Barang</label>
                                <input type="text" id="kode" name="kode" value="{{ $data_aset->kode}}" placeholder="Kode barang" class="form-control col-12 @error('kode') is-invalid @enderror" disabled>
                                @error('kode')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="program_id">Program</label>
                                <select name="program_id" id="program_id" class="form-control select2bs4 @error('program_id') is-invalid @enderror">
                                    @if (old('program_id',$data_aset->program_id) == true)
                                    <option value="{{old('program_id',$data_aset->program_id)}}">{{old('program_id', $data_aset->program->nama_program)}}</option>
                                    @endif
                                    <option value="">-- Pilih Program --</option>
                                    @foreach($data_program as $program)
                                    <option value="{{$program->id}}">{{$program->nama_program}}</option>
                                    @endforeach
                                </select>
                                @error('program_id')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="nama_aset">Nama Aset</label>
                                <input type="hidden" name="id" value="{{ $data_aset->id }}">
                                <input type="text" id="nama_aset" name="nama_aset" value="{{ old('nama_aset',$data_aset->nama_aset) }}" placeholder="Nama aset" class="form-control col-12 @error('nama_aset') is-invalid @enderror">
                                @error('nama_aset')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" class="textarea form-control bg-light @error('deskripsi') is-invalid @enderror" id="summernote" rows="6" value="{{ old('deskripsi') }}">{!! $data_aset->deskripsi !!}</textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="tanggal">Tanggal Pembelian</label>
                                <input type="datetime" id="tanggal" name="tanggal" value="{{ old('tanggal',$data_aset->tanggal) }}" placeholder="Tangal Pembelian" class="form-control col-12 @error('tanggal') is-invalid @enderror">
                                @error('tanggal')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="persen">Kondisi berdasarekan persen</label>
                                <input value="{{old('persen',$data_aset->persen)}}" name="persen" type="text" class="form-control bg-light @error('persen') is-invalid @enderror" id="persen">
                                @error('persen')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="qty">Jumlah Barang</label>
                                <input value="{{old('qty',$data_aset->qty)}}" name="qty" type="number" class="form-control bg-light @error('qty') is-invalid @enderror" id="qty">
                                @error('qty')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="kondisi">Kondisi</label>
                                <input value="{{old('kondisi',$data_aset->kondisi)}}" name="kondisi" type="text" class="form-control bg-light @error('kondisi') is-invalid @enderror" id="kondisi">
                                @error('kondisi')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="lokasi">Lokasi / Penyimpanan Terakhir</label>
                                <input value="{{old('lokasi',$data_aset->lokasi)}}" name="lokasi" type="text" class="form-control bg-light @error('lokasi') is-invalid @enderror" id="lokasi">
                                @error('lokasi')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <label for="account-company">Foto Barang</label>
                                <input type="file" class="form-control" name="foto" id="foto" />
                                <span class="text-danger" style="font-size: 14px">Harap Upload Gambar Barang.</span>
                            </div>
                            <hr>
                            <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Geuntos</button>
                            <div id="tombol_proses"></div>

                            @if($data_aset->foto)
                            <hr>
                            <div class="product-img">
                                <a href="{{asset($data_aset->foto)}}" data-toggle="lightbox" data-title="Tanda Bukti" data-gallery="gallery">
                                    <img src="{{asset($data_aset->foto)}}" alt="Product Image" width="50%" class=" brand-image elevation-3" style="display:block; margin:auto">
                                </a>
                            </div>
                            @endif
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DATA ASET</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-light">
                                    <th>No.</th>
                                    <th>Foto</th>
                                    <th>Kode</th>
                                    <th>Nama aset</th>
                                    <th>Tanggal Pembelian</th>
                                    <th>Kondisi</th>
                                    <th>persen</th>
                                    <th>lokasi terakhir</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 0; ?>
                                @foreach($data_aset_all as $data)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>
                                        <a href="{{ asset($data->foto) }}" data-toggle="lightbox" data-title="Foto {{ $data->nama_aset }}" data-gallery="gallery">
                                            <img src="{{ asset($data->foto) }}" alt="Product Image" class="img-size-50 ">
                                        </a>
                                    </td>
                                    <td>{{$data->kode}}</td>
                                    <td>{{$data->nama_aset}}</td>
                                    <td>{{$data->tanggal}}</td>
                                    <td>{{$data->kondisi}}</td>
                                    <td>{{$data->persen}}</td>
                                    <td>{{$data->lokasi}}</td>
                                    <td>
                                        <form action="{{route('aset.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="{{route('aset.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-book"></i></a>
                                            <a href="{{route('aset.edit',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                                            @if (auth()->user()->role == 'Admin')
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
    </div><!--/. container-fluid -->
</section>
@endsection