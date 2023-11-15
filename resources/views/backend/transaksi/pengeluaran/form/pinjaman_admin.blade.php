    <center>
        <img src="{{asset($layout_pengeluaran->gambar)}}" alt="" width="50%">
        <h5 class="text-bold card-header bg-light p-0"> FORM PINJAMAN</h5>
    </center>
    <form id="basic-form" action="{{Route('pengajuan.store')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="form-group row">
            <label for="data_warga">Nama data_warga</label>
            <select id="data_warga" name="data_warga" class="select2 form-control @error('data_warga') is-invalid @enderror">
                @if (old('data_warga') == true)
                <option value="{{old('data_warga')}}">{{old('nama')}}</option>
                @endif
                <option value="">-- Pilih Data Warga --</option>
                @foreach ($data_warga as $data)
                <option value="{{$data->id}}"> {{$data->nama}}</option>
                @endforeach
            </select>
            @error('data_warga')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
        <div class="form-group row">
            <label for="jumlah">Nominal</label>
            <input type="hidden" name="pengaju_id" id="pengaju_id" value="{{Auth::user()->data_warga_id}}">
            <input type="hidden" name="kategori_id" id="kategori_id" value="4">
            <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="Cont : 50000    jangan pake titik ataupun koma" class="form-control col-12 @error('jumlah') is-invalid @enderror">
            @error('jumlah')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
            <span class="text-dark" style="font-size: 10px">Jatah perorang {{$data_anggaran_max_pinjaman->persen}} % tina jumlah sadayana anggaran pinjaman yaeta {{"Rp" . number_format(1000,2,',','.')}}, teu kengeng ngalebihi.</span>
        </div>
        <div class="form-group">
            <label for="pembayaran">Metode Pembayaran</label>
            <select name="pembayaran" id="pinjam" class="form-control select2bs4 col-12 @error('pembayaran') is-invalid @enderror">

                <option value="">--Pilih Pembayaran--</option>
                <option value="Cash">Uang Tunai</option>
                <option value="Transfer">Transfer</option>
            </select>
            @error('pembayaran')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
        <div id="form"></div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="textarea form-control bg-light @error('keterangan') is-invalid @enderror" id="summernote" rows="6" value="{{ old('keterangan') }}">{{ old('keterangan') }}
            <p id="keterangann"></p>
            </textarea>
            @error('keterangan')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
        <p id="keterangan"></p>
        <div class="form-group row">
            <label for="tanggal_pengembalian">Tanggal di Kembalikan</label>
            <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" value="{{ old('tanggal_pengembalian') }}" placeholder="Harap Cantumkan Tanggal pengembalian" class="form-control col-12 @error('tanggal_pengembalian') is-invalid @enderror" required>
            @error('tanggal_pengembalian')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>

        <hr>
        <button onclick="tombol_pinjam()" id="myBtn_pinjam" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> PINJAM</button>
        <div id="tombol_proses"></div>
        <span class="text-dark" style="font-size: 10px">Pinjaman di batasi Jatah {{$data_anggaran_max_pinjaman->max_orang}} Orang sesuai anggaran nu aya. <br> Ayeuna nembe aya nu Nambut {{$cek_pengeluaran_pinjaman}} Orang, Masih aya sisa jatah {{$data_anggaran_max_pinjaman->max_orang - $cek_pengeluaran_pinjaman }} Orang deui</span>
    </form>

    @section('script')
    <script>
        $("#bayar").addClass("active");
    </script>

    <!-- scrip Untuk elemen Button -->
    <script>
        function tombol_pinjam() {
            if (document.getElementById("myBtn_pinjam").hidden = true) {
                // membuat objek elemen
                // alert("Nuju di proses...");
                var hasil = document.getElementById("tombol_proses");
                hasil.innerHTML = "Nuju di proses ...";
            }
        }
        <?php

        use App\Models\Anggaran;
        use App\Models\BayarPinjaman;
        use App\Models\Pemasukan;

        $total_pembayaran_cash = Pemasukan::where('pembayaran', 'Cash')->sum('jumlah');
        // menghitung jumlah setor tunai
        $total_setor_tunai = Pemasukan::where('kategori_id', 3)->sum('jumlah');
        // Uang nu teu acan di transfer
        $total_bayar_pinjaman_cash = BayarPinjaman::where('pembayaran', 'Cash')->sum('jumlah');
        $uang_blum_diTF = $total_pembayaran_cash - $total_setor_tunai + $total_bayar_pinjaman_cash;
        // Data Anggaran
        $data_anggaran = Anggaran::all();
        $data_anggaran_max_pinjaman = Anggaran::find(3);
        $cek_semua_pemasukan = Pemasukan::where('kategori_id', 1)->sum('jumlah');
        $cek_pemasukan_2 = $cek_semua_pemasukan / 2; // Membagi jumlah semua pemasukan
        $tahap_1 = $cek_pemasukan_2 * 90 / 100; // Menghitung Jumlah anggaran pinjaman dari hasil pembagian 2,
        $cek_total_pinjaman = $tahap_1 / 2; // Menghitung total Anggaran
        $jatah = $cek_total_pinjaman * $data_anggaran_max_pinjaman->persen / 100; //Jath Persenan di ambil dari data anggaran
        ?>
        let jumlah_pinjam = document.getElementById("jumlah");
        let button_pinjam = document.getElementById("myBtn_pinjam");
        button_pinjam.disabled = true;
        jumlah_pinjam.addEventListener("change", stateHandle);

        function stateHandle() {
            if (document.getElementById("jumlah").value <= 49999) {
                button_pinjam.disabled = true;
                document.getElementById("keterangann").innerHTML = "";
            } else if (document.getElementById("jumlah").value >= <?php echo $jatah ?>) {
                button_pinjam.disabled = true;
                document.getElementById("keterangann").innerHTML = "";
            } else {
                button_pinjam.disabled = false;
                document.getElementById("keterangann").innerHTML = "<b> Alasan</b>    : <br> ";
            }

        }
    </script>

    <script>
        $(document).ready(function() {
            $('#pinjam').change(function() {
                var kel = $('#pinjam option:selected').val();
                if (kel == "Transfer") {
                    $("#form").html('<div class="form-group"><label for="account-company">NO Req</label><input type="number" class="form-control" name="no_req" id="no_req" required ><span class="text-danger" style="font-size: 13px">Harap cantumkan No Req.</span></div>    <div class="form-group"><label for="account-company">Nama Bank</label><input type="text" class="form-control" name="nama_bank" id="nama_bank" required ><span class="text-danger" style="font-size: 13px">Harap cantumkan Nama Bank.</span></div>     <div class="form-group"><label for="account-company">Atas Nama</label><input type="text" class="form-control" name="ana" id="ana" required ><span class="text-danger" style="font-size: 13px">Harap cantumkan Atas Nama.</span></div>');
                } else {
                    $("#form").html('<label for="account-company">Pengambilan Uang</label><input type="text" class="form-control" name="pengambilan" id="pengambilan" required ><span class="text-danger" style="font-size: 13px">Harap Cantumkan Gimana cara pengambilan jika cash</span>');
                }
            });
        });
    </script>
    @endsection