
@extends('backend.template_backend.layout')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DETAIL DATA </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table" style="margin-top: -10px;">
                <tr>
                        <td>Di Input</td>
                        <td>:</td>
                        <td>{{$data_konter->user_input}}</td>
                    </tr>
                    <tr>
                        <td><b> Layanan</b></td>
                        <td>:</td>
                        <td><b> {{$data_konter->kategori}} {{$data_konter->layanan}}</b></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{$data_konter->nama}}</td>
                    </tr>
                    <tr>
                        <td><b>No Listrik</b></td>
                        <td>:</td>
                        <td><b">{{$data_konter->no_listrik}}</b></td>
                    </tr>
                    <tr>
                        <td>No Tujuan</td>
                        <td>:</td>
                        <td><a href="http://wa.me/62{{$data_konter->no_tujuan}}" id="dataToCopy">{{$data_konter->no_tujuan}}</a>
                        <button type="button" class="copy-button" onclick="copyToClipboard('dataToCopy')">Salin</button>
          <br><span >Cek no aktif atanapi hente, Klik no </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Di Input</td>
                        <td>:</td>
                        <td>{{$data_konter->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>{{$data_konter->status}}</td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>:</td>
                        <td>{{$data_konter->type}}</td>
                    </tr>
                    <tr>
                        <td>Nominal</td>
                        <td>:</td>
                        <td>{{$data_konter->nominal}}</td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td>{{$data_konter->harga}}</td>
                    </tr>
                    <tr>
                        <td>Tagihan</td>
                        <td>:</td>
                        <td>{{$data_konter->tagihan}}</td>
                    </tr>
                    <tr>
                        <td>Pembayaran</td>
                        <td>:</td>
                        <td>{{$data_konter->pembayaran}}</td>
                    </tr>
                    <tr>
                        <td>Keteranga</td>
                        <td>:</td>
                        <td>{{$data_konter->keterangan}}</td>
                    </tr>

                    

                </table>
                <hr>
                <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                    <p> {{$data_konter->keterangan}}</p>
                </table>
                
                
                @if($data_konter->foto)
                            <hr>
                            <div class="product-img">
                                <a href="{{asset($data_konter->foto)}}" data-toggle="lightbox" data-title="Tanda Bukti" data-gallery="gallery">
                                    <img src="{{asset($data_konter->foto)}}" alt="Product Image" width="50%" class=" brand-image elevation-3" style="display:block; margin:auto">
                                </a>
                            </div>
                            @endif
  @if($data_konter->status == "Pengajuan")                               
  @include('frontend.home.konter.form.transaksi')
  
  @endif                          
  @if($data_konter->status == "Belum Lunas")                        <center>
    <h5 class="text-bold card-header bg-light p-0">Pamin Tos Bayar Langsung Konfirmasi</h5>
</center>
                      <br>     
                <a href="#input" class="btn btn-info" data-toggle="collapse">Konfirmasi Pembayaran</a>
            <div id="input" class="collapse">            
             <form action="{{ route('konter-konfirmasi_pembayaran',Crypt::encrypt($data_konter->id)) }}" method="post" enctype="multipart/form-data">
                            @method('POST')
                            {{csrf_field()}}
                            
                            <div class="form-group row">
                                <label for="pembayaran">Pembayaran</label>
                               
                                <input type="text" id="pembayaran" name="pembayaran" value="{{ old('pembayaran',$data_konter->tagihan - $data_konter->pembayaran) }}" placeholder="Nama anggaran" class="form-control col-12 @error('pembayaran') is-invalid @enderror">
                                @error('pembayaran')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group ">
                             <label for="type_bayar">Metode Pembayaran</label> 
                             <select name="type_bayar" id="type_bayar" class="select2bs4 form-control col-12 @error('type_bayar') is-invalid @enderror"> 
                             <option value="">--Pilih Metode Pembayaran--</option>
                              <option value="Cash">Uang Tunai</option> 
                              <option value="Transfer">Transfer</option> 
                              </select>
                               @error('type_bayar') 
                               <div class="invalid-feedback"> 
                               <strong>{{ $message }}</strong> 
                               </div> 
                               @enderror
                            </div>
                            <input type="hidden" name="tagihan" value="{{$data_konter->tagihan}}">
                            <input type="hidden" name="sisa_bayar" value="{{$data_konter->pembayaran}}">
                            <input type="hidden" name="no_tujuan" value="{{$data_konter->no_tujuan}}">
                            
                            <hr>
                            <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-primary btn-sm"> Konfirmasi</button>
                            <div id="tombol_proses"></div>
                        </form>
               </div>
@endif
@if($data_konter->status == "Lunas")
<div>
                  Keuntungan yang di peroleh dari transaksi tersebut {{$data_konter->margin}} dan Di Tambah Diskon  {{$data_konter->diskon}} Jadi Uang yang di keluarkan dari trandaksi tersebut  {{$data_konter->uang_keluar}} karena dari Harga di kurangi Diskon
                </div>
                @endif
            </div>

        </div><!-- /.container-fluid -->
</section>

@endsection
@section('script')
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#Dataanggaran").addClass("active");
    
    function copyToClipboard(elementId) {
            const text = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('Teks berhasil disalin!');
            }).catch(err => {
                alert('Gagal menyalin teks: ' + err);
            });
        }
</script>
@endsection