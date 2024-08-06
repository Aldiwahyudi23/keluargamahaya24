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
                            <h5 class="text-bold card-header bg-light p-0"> TAMBAH DATA ANGGARAN</h5>
                        </center>
                        <hr>
                        <form action="{{ route('konter.update',Crypt::encrypt($data_konter->id)) }}" method="post" enctype="multipart/form-data">
                            @method('PATCH')
                            {{csrf_field()}}
                                                
<div class="form-group">
                    <label for="tujuan">No Tujuan:</label>
                    <input type="number" name="tujuan" id="tujuan" placeholder="Masukan No HP atau Token Listrik" class="form-control @error('tujuan') is-invalid @enderror" value="{{ old('tujuan',$data_konter->tujuan) }}">
                
                @error('tujuan')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                
                <div class="form-group">
                    <label for="nama">Nama :</label>
                    <input type="text" name="nama" id="nama" placeholder="Masukan nama pembeli" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama',$data_konter->nama) }}">
                    @error('nama')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                
                
                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror">
                     @if(old('kategori') == true)
                       <option value="old('kategori')">{{old('kategori')}}</option>
                     @endif
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->kategori }}">{{ $category->kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                

                <div class="form-group">
                    <label for="layanan">Layanan:</label>
                    <select name="layanan" id="layanan" class="form-control @error('layanan') is-invalid @enderror" value="{{ old('layanan') }}" disabled>
                    @if(old('layanan') == true)
                       <option value="old('layanan')">{{old('layanan')}}</option>
                     @endif
                        <option value="">Pilih Layanan</option>
                    </select>
                  @error('layanan')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
               </div>
                
                

                <div class="form-group">
                    <label for="nominal">Nominal:</label>
                    <select name="nominal" id="nominal" class="form-control"   disabled>
                    @if(old('nominal') == true)
                       <option value="{{old('nominal')}}">{{old('nominal')}}</option>
                     @endif
                        <option value="">Pilih Nominal</option>
                    </select>
                    
                    <input type="hidden" name="nominal1" id="nominal1" value="{{old('nominal1')}}" class="form-control @error('nominal1') is-invalid @enderror">
                    <input type="text" name="nominal2" id="nominal_input" Class="form-control  @error('nominal2') is-invalid @enderror" placeholder="Masukan Jumlah tagihan dan admin layanan" style="display: none;">
                    
                    @error('nominal2')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                

                <div class="form-group">
                    <label for="payment_method">Metode Pembayaran:</label>
                    <select name="payment_method" id="payment_method" class="form-control  @error('payment_method') is-invalid @enderror" disabled>
                    @if(old('payment_method') == true)
                       <option value="old('payment_method')">{{old('payment_method')}}</option>
                     @endif
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="Cash">Cash</option>
                        <option value="Hutang">Hutang</option>
                    </select>
                    @error('payment_method')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>

                <div class="form-group">
                    <label for="harga_beli">Harga Beli:</label>
                    <input type="number" name="harga_beli" id="harga_beli" placeholder="Isi otomatis, kecuali khusus Tagihan Listrik manual" class="form-control @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli') }}" >
                    @error('harga_beli')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                

                <div class="form-group">
                    <label for="harga_jual">Harga Jual:</label>
                    <input type="number" name="harga_jual" id="harga_jual" placeholder="Isi otomatis, kecuali khusus Tagihan Listrik manual" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual') }}" readonly>
                    @error('harga_jual')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                


                
                <div class="form-group">
                    <label for="diskon">Diskon:</label>
                    <input type="number" name="diskon" id="diskon" class="form-control" placeholder="Jika tidak ada diskon/vocer masukan 0" required>
                       
                </div>
                
                <div class="form-group">
                    <label for="keuntungan">Keuntungan Plus Diskon:</label>
                    <input type="text" name="keuntungn" id="keuntungan" placeholder="Otomatis" class="form-control @error('nama') is-invalid @enderror" value="{{ old('keuntungn') }}" readonly>
                    @error('keuntungan')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                
                <div class="form-group">
                    <label for="uang_keluar">Uang yang di keluarkan:</label>
                    <input type="text" name="uang_keluar" id="uang_keluar" placeholder="Otomatis" class="form-control @error('nama') is-invalid @enderror" value="{{ old('uang_keluar') }}" readonly>
                    @error('uang_keluar')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                
                <input type="hidden" name="margin" id="margin" class="form-control">
                
                
                <div class="form-group">
                 <label for="account-company">Bukti Transfer</label>
                 <input type="file" class="form-control col-12" name="foto" id="foto" required />
                 <span class="text-danger" style="font-size: 13px">Harap Cantumkan Bukti Transaksi.</span>
                </div>
<div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" name="keterangan" id="keterangan" placeholder="Tambah keterangan tambahan, Jika Token listrik masukan Token nya" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('keterangan') }}">
                    @error('keterangan')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                            <hr>
                            <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-primary btn-sm"><i class="fas fa-pen"></i> Geuntos</button>
                            <div id="tombol_proses"></div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DATA ANGGARAN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-light">
                                    <th>No.</th>
                                    <th>Kode anggaran</th>
                                    <th>Nama anggaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 0; ?>
                                @foreach($data_konter_all as $data)
                                <?php $no++; ?>
                                <tr>
                                    <td>{{$no}}</td>
                                    <td>{{$data->nama}}</td>
                                    <td>{{$data->layanan}}</td>
                                    <td>
                                        <form action="{{route('konter.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <a href="{{route('konter.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-book"></i></a>
                                            <a href="{{route('konter.edit',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
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
    </div><!--/. container-fluid -->
</section>
@endsection