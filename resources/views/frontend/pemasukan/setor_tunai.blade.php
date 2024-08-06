@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                        <center>
    <h5 class="text-bold card-header bg-light p-0"> FORM SETOR TUNAI</h5>
</center>
<hr>
<p>Kanggo penginputan Nominal di Form sesuai keun sareng nu tertera di Web, aya Nominal sesuai hitungan. Pami teu teu sesuai hitungan mangga cek datana</p>
<p>Perjelas di keterangan Setor Tunai Pembayaran nu saha Saha na, Sareng Naha d input Sesuai web</p>
  <p>Contoh Keterangan :</p>
  <p>Setor Tunai 160.000 anu pembayaran <br> 
  Kas Aldi 50.000 <br>
  Bayar Pinjaman Aldi  110.000 <br>
  
   </p>
  
  <center>
    <h5 class="text-bold card-header bg-light p-0">Artos nu teu acan di Transfer <br> {{"Rp" . number_format( $saldo_akhir->total_diluar,2,',','.')}}</h5>
</center>
  
  
                        @if($saldo_akhir->total_diluar <= 1)
                        <p>
                            <center>
                            Teu aya artos nu di luar, Janten teu aya Form kanggo setor Tunai
                            </center>

                        </p>
                        @else
                      @include('backend.transaksi.pengajuan.form.form_setor_tunai')
                        @endif
            </div>
            <!-- /.card -->
        </div>
    </div>
    </div>
    <!-- /.row -->
    @endsection