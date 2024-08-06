
<?php

            use Carbon\Carbon;
            
            $tanggal = Carbon::now();
           $cek_bayar_pinjaman = $saldo_akhir->total_kas + $saldo_akhir->bunga_neo + $saldo_akhir->bunga_tabungan + $saldo_akhir->jumlah_lebih_pinjaman;
           $bayar_pinjaman = $cek_bayar_pinjaman - $saldo_akhir->saldo_atm_kas;
           //cek bayar Pinjaman apakah ada lebih dari saldo atam 
           $cek_total_kas = $saldo_akhir->saldo_kas + $saldo_akhir->saldo_darurat + $saldo_akhir->saldo_amal + $saldo_akhir->saldo_pinjaman + $saldo_akhir->bunga_neo + $saldo_akhir->bunga_tabungan + $saldo_akhir->jumlah_lebih_pinjaman;;
           //mengambil data bayar pinjaman
           $kas = ($cek_total_kas - $saldo_akhir->saldo_atm_kas) - $bayar_pinjaman ;
           //mengambil data Tabungan 
           $tabungan =$saldo_akhir->total_tabungan - $saldo_akhir->saldo_atm_tabungan;
            ?>
            
<form id="formPembayaran" action="{{Route('pemasukan.store')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    
    <div class="form-group row">
    <label for="account-company">Bukti Transfer</label>
    <input type="file" class="form-control col-12" name="foto" id="foto" required />
    <span class="text-danger" style="font-size: 13px">Harap kirim tanda bukti transferan.</span>
    </div>
   @if($kas > 1)
    <div class="form-group row">
        <label for="jumlah">Nominal KAS ( {{$kas}} )</label>
        <input type="number" id="kas" name="kas" value="{{ old('kas',$kas) }}" placeholder="Maukan Nominal Tanpa titik dan koma" class="form-control col-12 @error('kas') is-invalid @enderror">
        
    <!-- Penanda untuk menampilkan pesan validasi jumlah pembayaran 1 -->
    <div id="pesanValidasi1" style="color: red;"></div>
        @error('kas')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
    </div>
  @endif
  @if($bayar_pinjaman > 1)
    <div class="form-group row">
        <label for="jumlah">Nominal Bayar Pinjaman ( {{$bayar_pinjaman}} )</label>
        <input type="number" id="bayar_pinjaman" name="bayar_pinjaman" value="{{ old('bayar_pinjaman',$bayar_pinjaman) }}" placeholder="Maukan Nominal Tanpa titik dan koma" class="form-control col-12 @error('bayar_pinjaman') is-invalid @enderror">
        <!-- Penanda untuk menampilkan pesan validasi jumlah pembayaran 2 -->
    <div id="pesanValidasi2" style="color: red;"></div>
        @error('bayar_pinjaman')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
    </div>
  @endif
  @if($tabungan > 1)
    <div class="form-group row">
        <label for="jumlah">Nominal TABUNGAN ( {{$tabungan}} )</label>
        <input type="number" id="tabungan" name="tabungan" value="{{ old('tabungan',$tabungan) }}" placeholder="Maukan Nominal Tanpa titik dan koma" class="form-control col-12 @error('tabungan') is-invalid @enderror">
        <!-- Penanda untuk menampilkan pesan validasi jumlah pembayaran 3 -->
    <div id="pesanValidasi3" style="color: red;"></div>
        @error('tabungan')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
    </div>
  @endif
    <div class="form-group">
        <label for="ket">Keterangan</label>
        <textarea name="ket" class="textarea form-control bg-light @error('ket') is-invalid @enderror" id="summernote" rows="6" value="{{ old('ket') }}">{{ old('ket') }}</textarea>
        @error('ket')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
    </div>
    <hr>
    <input type="hidden" name="pengaju_id" id="pengaju_id" value="{{Auth::user()->data_warga_id}}">
    <input type="hidden" name="data_warga" id="data_warga" value="{{Auth::user()->data_warga_id}}">
    <input type="hidden" name="pembayaran" id="pembayaran" value="Transfer">
    <input type="hidden" name="kategori_id" id="kategori_id" value="3">
    <input type="hidden" name="tanggal" id="tanggal" value="{{$tanggal}}">
    <input type="hidden" name="cek_data" id="cek_data" value="admin">
   
    <button onclick="tombol_kas()" id="myBtn_kas" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Setor Tunai </button>
    <div id="tombol_proses"></div>
</form>


@section('script')



<script>
    // Ambil elemen form dan pesan validasi
    const formPembayaran = document.getElementById('formPembayaran');

    // Tambahkan event listener untuk form saat disubmit
    formPembayaran.addEventListener('submit', function(event) {
        // Ambil nilai setiap input jumlah pembayaran
        const jumlahPembayaran1 = parseFloat(document.getElementById('jumlahPembayaran1').value);
        const jumlahPembayaran2 = parseFloat(document.getElementById('jumlahPembayaran2').value);
        const jumlahPembayaran3 = parseFloat(document.getElementById('jumlahPembayaran3').value);

        // Reset pesan validasi sebelum memeriksa setiap input
        resetPesanValidasi();

        // Lakukan validasi untuk setiap input secara terpisah
        if (jumlahPembayaran1 > 100) {
            // Jika jumlah pembayaran 1 melebihi 100, tampilkan pesan validasi di bawah input tersebut
            event.preventDefault();
            const pesanValidasi1 = document.getElementById('pesanValidasi1');
            pesanValidasi1.textContent = 'Jumlah pembayaran 1 melebihi batas!';
        }
        if (jumlahPembayaran2 > 100) {
            // Jika jumlah pembayaran 2 melebihi 100, tampilkan pesan validasi di bawah input tersebut
            event.preventDefault();
            const pesanValidasi2 = document.getElementById('pesanValidasi2');
            pesanValidasi2.textContent = 'Jumlah pembayaran 2 melebihi batas!';
        }
        if (jumlahPembayaran3 > 100) {
            // Jika jumlah pembayaran 3 melebihi 100, tampilkan pesan validasi di bawah input tersebut
            event.preventDefault();
            const pesanValidasi3 = document.getElementById('pesanValidasi3');
            pesanValidasi3.textContent = 'Jumlah pembayaran 3 melebihi batas!';
        }
    });

    // Fungsi untuk mereset pesan validasi
    function resetPesanValidasi() {
        document.getElementById('pesanValidasi1').textContent = '';
        document.getElementById('pesanValidasi2').textContent = '';
        document.getElementById('pesanValidasi3').textContent = '';
    }
</script>


@endsection