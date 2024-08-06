@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <a href="#input" class="btn btn-info" data-toggle="collapse">Tambah Pemasukan</a>
            <div id="input" class="collapse">

            
            
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DATA SEMUA KONTER</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Pengaju</th>
                            <th>Kategori</th>
                            <th>Layanan</th>
                            <th>No Tukuan</th>
                            <th>Nama</th>
                            <th>No Listrik</th>
                            <th>Nominal</th>
                            <th>Harga</th>
                            <th>Diskon</th>
                            <th>Uang yang diKeluarkan</th>
                            <th>Tagihan</th>
                            <th>Margin</th>
                            <th>Type</th>
                            <th>Konfirmasi</th>
                            <th>Pembayaran</th>
                            <th>Tanggal Bayar</th>
                            <th>Type Bayar</th>
                            <th>Status</th>
                            <th>Jatuh Tempo</th>

                            <th>Katerangan</th>
                            <th>created at</th>
                            <th>updated at</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 0; ?>
                        @foreach($data_konter as $data)
                        <?php $no++; ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->user_input}}</td>
                            <td>{{$data->kategori}}</td>
                            <td>{{$data->layanan}}</td>
                            <td>{{$data->no_tujuan}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->no_listrik}}</td>
                            <td>{{$data->nominal}}</td>
                            <td>{{$data->harga}}</td>
                            <td>{{$data->diskon}}</td>
                            <td>{{$data->uang_keluar}}</td>
                            <td>{{$data->tagihan}}</td>
                            <td>{{$data->margin}}</td>
                            <td>{{$data->type}}</td>
                            <td>{{$data->konfirmasi}}</td>
                            <td>{{$data->pembayaran}}</td>
                            <td>{{$data->tanggal_bayar}}</td>
                            <td>{{$data->type_bayar}}</td>
                            <td>{{$data->status}}</td> 
                            <td>{{$data->jatuh_tempo}}</td> 

                            <td>{!!$data->keterangan!!}</td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->updated_at}}</td>
                            <td>
                                <img src="{{asset($data->foto)}}" alt="" width="50%">
                            </td>
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


@endsection