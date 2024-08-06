<center>
    <img src="{{asset($layout_pemasukan->gambar)}}" alt="" width="50%">
    <h5 class="text-bold card-header bg-light p-0"> FORM PENGAJUAN</h5>
</center>
<hr>
<form action="{{Route('pemasukan.store')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group">
        <label for="data_warga">Data Anggota</label>
        <select name="data_warga" id="data_warga" class="select2bs4 col-12 form-control @error('data_warga') is-invalid @enderror">
            <?php

            use App\Models\User;
            use Carbon\Carbon;
            
            $tanggal = Carbon::now();
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
    <hr>
    <input type="hidden" name="pengaju_id" id="pengaju_id" value="{{Auth::user()->data_warga_id}}">
    <input type="hidden" name="tanggal" id="tanggal" value="{{$tanggal}}">
    <input type="hidden" name="cek_data" id="cek_data" value="admin">
    <button onclick="tombol_kas()" id="myBtn_kas" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Yuuu Bayar</button>
    <div id="tombol_proses"></div>
</form>

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
        if (document.getElementById("jumlah").value <= 99) {
            button_kas.disabled = true;
        } else {
            button_kas.disabled = false;
        }
    }
</script>
@endsection