@extends('backend.template_backend.layout')

@section('content')
<?php

            use Illuminate\Support\Facades\DB;
            use App\Models\Pengeluaran;
            use App\Models\AccessProgram;


            $program_tabungan = AccessProgram::where('user_id', Auth::user()->id)->where('program_id', 2)->count();

            $tabungan = DB::table('pemasukans')->where('pemasukans.kategori_id', '=', "2");
            $total_tabungan = $tabungan->where('pemasukans.data_warga_id', '=', Auth::user()->data_warga_id)
                ->sum('pemasukans.jumlah');
            $pengeluaran_tabungan = Pengeluaran::where('data_warga_id', Auth::user()->data_warga_id)->where('anggaran_id', 7)->sum('jumlah');
            ?>

<div class="col-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="box-profile justify-content: space-between">
            <h3 class="profile-username text-center">{{ Auth::user()->data_warga->nama }}</h3>
            <h3 class="profile-username text-center"> {{ "Rp " . number_format($total_tabungan-$pengeluaran_tabungan,2,',','.') }}</h3>
           
           <div class="container">
        <div class="left-text" style="float: left;">Pemasukan</div>
        <div class="right-text" style="float: right;">Penarikan</div>
    </div>
    <br>
           <div class="container">
        <div class="left-text" style="float: left;">{{ "Rp " . number_format($total_tabungan,2,',','.') }}</div>
        <div class="right-text" style="float: right;">{{ "Rp " . number_format($pengeluaran_tabungan,2,',','.') }}</div>
        
    </div>
     <br>
     <hr>
<div class="container">
        <div class="left-text" style="float: left;">
        <a href="#pemasukan" class="btn btn-success left-text" style="float: left;" data-toggle="collapse">Tambah Saldo</a>
        </div>
        <div class="right-text" style="float: right;">   
          <a href="#tarik" class="btn btn-info center-text" style="float: rightq;" data-toggle="collapse">Tarik</a></div>
        
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<br>
<div class="alert alert-info alert-dismissible fade show col-12" role="alert">
    <center><b> NABUNG LAH !!!</b> <br> "Seringkali, semakin banyak uang yang Anda hasilkan, semakin banyak pengeluaran Anda. Alasan tersebutlah yang menjadi penyebab uang yang Anda miliki tersebut tidak bisa membuat Anda kaya, namun yang membuat Anda kaya adalah aset." – Robert T. Kiyosaki.</center>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6">
            <div id="pemasukan" class="collapse">
            <!-- Akses kanggo form biasa -->
                        @if($cek_pengajuan_tabungan >= 1)

                        <body class="justify-content-center">
                            {!!$layout_pemasukan->info_proses!!}
                        </body>
                        @else
                <div class="card">
                    <div class="card-body">
                        @include('backend.transaksi.pengajuan.form.form_tabungan')
                    </div>
                </div>
                @endif
                
              </div>
     
            <div id="tarik" class="collapse">
            <!-- Akses kanggo form biasa -->
                        @if($cek_pengajuan_tarik >= 1)

                        <body class="justify-content-center">
                            {!!$layout_pemasukan->info_proses!!}
                        </body>
                        @else
                <div class="card">
                    <div class="card-body">
                        @include('backend.transaksi.pengajuan.form.form_tarik_tabungan')
                    </div>
               </div>
               @endif
               
            </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link show active" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Tabungan Masuk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Mutasi</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                <table id="table2" class="table table-bordered table-striped table-responsive">
                                    @include('frontend.home.tabungan.pemasukan')
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                                <table id="table3" class="table table-bordered table-striped table-responsive">
                                    @include('frontend.home.tabungan.pengeluaran')
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div><!--/. container-fluid -->
</section>
@endsection
@section('script')
<script>
    $("#bayar").addClass("active");
</script>

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
$(document).ready(function() {
           $('#penarikan').change(function() {
               var kel = $('#penarikan option:selected').val();
               if (kel == "Transfer") {
                   $("#form").html('<div class="form-group"><label for="account-company">NO Req</label><input type="number" class="form-control" name="no_req" id="no_req" required ><span class="text-danger" style="font-size: 13px">Harap cantumkan No Req.</span></div>    <div class="form-group"><label for="account-company">Nama Bank</label><input type="text" class="form-control" name="nama_bank" id="nama_bank" required ><span class="text-danger" style="font-size: 13px">Harap cantumkan Nama Bank.</span></div>     <div class="form-group"><label for="account-company">Atas Nama</label><input type="text" class="form-control" name="ana" id="ana" required ><span class="text-danger" style="font-size: 13px">Harap cantumkan Atas Nama.</span></div>');
               } else {
                   $("#form").html('<label for="account-company">Pengambilan Uang</label><input type="text" class="form-control" name="pengambilan" id="pengambilan" required ><span class="text-danger" style="font-size: 13px">Harap Cantumkan Gimana cara pengambilan jika cash</span>');
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
<?php
$sisa = $total_tabungan-$pengeluaran_tabungan;
?>

    let jumlah_kas = document.getElementById("jumlahh");
    let button_kas = document.getElementById("TarikBtn");
    button_kas.disabled = true;
    jumlah_kas.addEventListener("change", stateHandle);

    function stateHandle() {
        if (document.getElementById("jumlahh").value >=  <?php echo $sisa + 1 ?>) {
            button_kas.disabled = true;
        } else {
            button_kas.disabled = false;
        }
    }
</script>
@endsection