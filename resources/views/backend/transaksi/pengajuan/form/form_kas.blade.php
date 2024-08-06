<center>
    <img src="{{asset($layout_pemasukan->gambar)}}" alt="" width="50%">
    <h5 class="text-bold card-header bg-light p-0"> FORM BAYAR KAS</h5>
</center>
<?php
// mengambil tanggal ysng di resmikan pada table prograam

use App\Models\DataWarga;
use App\Models\HubunganWarga;
use App\Models\Program;
use App\Models\UpdateKerja;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

$program = Program::find(1); //find id 1 adalah mengambil id dari data program dengan id 1 ya itu kas keluarga
$setor = $program->jumlah - 1;

// mengambil data selisih yang tidak bekerja 
$update_kerja = UpdateKerja::where('user_id', Auth::user()->id)->sum('tenor');
// untuk menghitung sesilih bulan dari awal sampai sekarang khusu program kas
$date = date("Y-m-d");
$timeStart = strtotime("$program->tanggal");
$timeEnd = strtotime("$date");
// Menambah bulan ini + semua bulan pada tahun sebelumnya
$numBulan = 1 + (date("Y", $timeEnd) - date("Y", $timeStart)) * 12;
// menghitung selisih bulan
$numBulan += date("m", $timeEnd) - date("m", $timeStart);

// Jatah pembayaran kas yang harus di bayar
$all_kas = $numBulan - $update_kerja;
// menghitung sisa penbayaran kas yang di potong karena tida bekerja , mengambil data dari data update kerja selisih kerja
$all_kas_kerja = $all_kas * $program->jumlah;

$sisa_kas = $all_kas_kerja - $cek_pemasukan_terakhir_all;
$sisa_bulan = $sisa_kas / $program->jumlah;

$user = DataWarga::find(Auth::user()->data_warga_id);

if ($user->status_pernikahan == "Menikah"){
    $cek_user = User::find(Auth::user()->user_id);
   if(Auth::user()->user_id == false) {
        $data_user = Auth::user()->data_warga_id;
        $status_pekerjaan = $user->status;
        
    } else {
         $data_user = $cek_user->data_warga_id;
         $status_pekerjaan = $user->status;
         
         
    }
}else{
    $data_user = Auth::user()->data_warga_id;
    $status_pekerjaan = $user->status;
}

?>
@if ($cek_pemasukan_terakhir_total == 0)
<center>
    <h5>Teu acan aya kas nu masuk</h5>
</center>
@else
<table id="" class="table table-bordered ">
    <tbody>
        @foreach ($cek_pemasukan_terakhir as $data)
        <tr>
            <td>Pembayaran terakhir <b> {{$data->data_warga->nama}} </b> di Bulan <b> {{date('M-y',strtotime($data->tanggal)) }} </b> <br> <br>
                @if($status_pekerjaan == "Tidak Bekerja")
                Status Pekerjaan Akun Tidak Bekerja, jadi jika kalau emang status nya tidak bekerja maka tidak diwajibkan untuk bayar namun jika mau bayar bisa klik aja tombol di bawah <br> masa tidak bekerja {{$update_kerja}}, NUHUN. <br> Alhamdulilah Ayeuna teh nuju jalan bulan ka {{$numBulan}} <br>
                <a href="#demo" class="btn btn-info" data-toggle="collapse">Pami bade bayar, Klik wae atuh supados muncul</a>
                <!-- dab jika tida -->
                @else
                @if( $sisa_kas <= 0) <!-- Jika sisa kas yang harus di bayar kas kosong -->
                    luarrr biasa TUNTAS sadayana atos bayar ti awal sampe ayeuna bulan {{date("M-Y",$timeEnd)}} kapotong ku masa Tidak Bekerja selami <b>{{$update_kerja}}</b>, NUHUN. Alhamdulilah Ayeuna teh nuju jalan bulan ka {{$numBulan}} <br>
                    <a href="#demo" class="btn btn-info" data-toggle="collapse">Pami bade bayar deui, Klik wae atuh supados muncul</a>
                    <!-- dab jika tida -->
                    @else
                    sareng Aya <b>{{ "Rp " . number_format($sisa_kas,2,',','.') }}</b> atawa <b>{{$sisa_bulan}}</b> Bulanan nu teu acan di bayar kapotong ku masa Tidak Bekerja selami <b>{{$update_kerja}}</b> , Mangga cek wae dina story pembayaran di handap <br> Kas mulaina ti bulan {{date("M-Y",$timeStart)}}

                    @endif
                    @endif
            </td>
        </tr>
        <tr>
            <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
        </tr>
        <tr>
            <td>Tanggal pengajuan {{$data->tanggal}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="">
    <h6 class=" text-center">Keterangan</h6>
    {!!$data->keterangan!!}

</div>
@endif


@if($status_pekerjaan == "Tidak Bekerja" || $sisa_kas <= 0) <div id="demo" class="collapse">
    @else
    <div class="">
        @endif
        <form action="{{Route('pengajuan.store')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="pembayaran">Metode Pembayaran</label>
                <select name="pembayaran" id="pembayaran" class="select2bs4 form-control col-12 @error('pembayaran') is-invalid @enderror">
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
            <div class="form-group" id="noId"></div>
            <div class="form-group">
                <label for="jumlah">Nominal</label>
                <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="Maukan Nominal Tanpa titik dan koma" class="form-control col-12 @error('jumlah') is-invalid @enderror">
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
            <hr>
            <input type="hidden" name="data_warga" id="data_warga" value="{{$data_user}}">
            <input type="hidden" name="pengaju_id" id="pengaju_id" value="{{Auth::user()->data_warga_id}}">
            <input type="hidden" name="kategori_id" id="kategori_id" value="1">
            <input type="hidden" name="kode" id="kode" value="KA{{date('dmyhis') }}">

            <button onclick="tombol_kas()" id="myBtn_kas" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Yuuu Bayar</button>
            <div id="tombol_proses"></div>
        </form>
    </div>

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
            if (document.getElementById("jumlah").value <= <?php echo $setor ?>) {
                button_kas.disabled = true;
            } else {
                button_kas.disabled = false;
            }
        }
    </script>
    @endsection