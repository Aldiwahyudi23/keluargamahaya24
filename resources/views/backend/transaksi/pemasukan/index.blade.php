@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <a href="#input" class="btn btn-info" data-toggle="collapse">Tambah Pemasukan</a>
            <div id="input" class="collapse">
                <div class="card-body">
                    <center>
                        <h5 class="text-bold card-header bg-light p-0"> FORM PENGAJUAN</h5>
                    </center>
                    <hr>
                    <form action="{{Route('pemasukan.store')}}" method="POST" enctype="multipart/form-data">
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
                                        <?php

                                        use App\Models\User;
                                        ?>
                                        <option value="">--Pilih Anggota--</option>
                                        @foreach($data_warga_program->get() as $data)
                                        <?php
                                        $warga_program = User::find($data->user_id);
                                        ?>
                                        <option value="{{$warga_program->data_warga_id}}">{{$warga_program->data_Warga->nama}}</option>
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
                                        <option value="">--Pilih Metode kategori--</option>
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
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="pembayaran">Metode Pembayaran</label>
                                    <select name="pembayaran" id="pembayaran" class="select2bs4 col-12 form-control @error('pembayaran') is-invalid @enderror">
                                        <option value="">--Pilih Metode Pembayaran--</option>
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
                                <hr>
                                <input type="hidden" name="cek_data" id="cek_data" value="input_admin">
                                <button onclick="tombol_kas()" id="myBtn_kas" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Yuuu Bayar</button>
                                <div id="tombol_proses"></div>
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
                <h3 class="card-title">DATA SEMUA PEMASUKAN</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>ID transaksi</th>
                            <th>Kategori</th>
                            <th>Nama Anggota</th>
                            <th>Nominal</th>
                            <th>Tanggal Input</th>
                            <th>Pembayaran</th>
                            <th>Di Input Oleh</th>
                            <th>Di Setujui Oleh</th>

                            <th>Katerangan</th>
                            <th>created at</th>
                            <th>updated at</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data_pemasukan as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->kode}}</td>
                            <td>{{$data->kategori->nama_kategori}}</td>
                            <td>{{$data->data_warga->nama}}</td>
                            <td>{{$data->jumlah}}</td>
                            <td>{{$data->tanggal}}</td>
                            <td>{{$data->pembayaran}}</td>
                            <td>{{$data->pengaju->nama}}</td>
                            <td>{{$data->pengurus->nama}}</td>

                            <td>{!!$data->keterangan!!}</td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->updated_at}}</td>
                            <td>
                                <img src="{{asset($data->foto)}}" alt="" width="50%">
                            </td>
                            <td>
                                <form action="{{route('pemasukan.destroy',Crypt::encrypt($data->id))}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <a href="{{route('pemasukan.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-book"></i></a>
                                    <a href="{{route('pemasukan.edit',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
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


@section('script')
<!-- SCrip Untuk tanda bukti pembayaran -->
<script>
    $(document).ready(function() {
        $('#pembayaran').change(function() {
            var kel = $('#pembayaran option:selected').val();
            if (kel == "Transfer") {
                $("#noId").html('<label for="account-company">Bukti Transfer</label><input type="file" class="form-control col-12" name="foto" id="foto" required /><span class="text-danger" style="font-size: 13px">Harap kirim tanda bukti transferan.</span>');
            } else {
                $("#noId").html('');
            }
        });
    });
</script>

<script>
    function tombol_kas() {
        if (document.getElementById("myBtn_kas").hidden = true) {
            // membuat objek elemen
            // alert("Nuju di proses...");
            var hasil = document.getElementById("tombol_proses");
            hasil.innerHTML = "Nuju di proses ...";
        }
    }
</script>

<script>
    let jumlah_kas = document.getElementById("jumlah");
    let button_kas = document.getElementById("myBtn_kas");
    button_kas.disabled = true;
    jumlah_kas.addEventListener("change", stateHandle);

    function stateHandle() {
        if (document.getElementById("jumlah").value <= 49999) {
            button_kas.disabled = true;
        } else {
            button_kas.disabled = false;
        }
    }
</script>
@endsection