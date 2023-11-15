    <center>
        <h5 class="text-bold card-header bg-light p-0"> FORM LAPORAN</h5>
    </center>
    <form id="basic-form" action="{{Route('pengeluaran.store')}}" method="POST" enctype="multipart/form-data" novalidate>
        {{csrf_field()}}

        <div class="form-group row">
            <label for="anggaran_id">Nama Anggaran</label>
            <select id="anggaran_id" name="anggaran_id" class="select2 form-control @error('anggaran_id') is-invalid @enderror">
                @if (old('anggaran_id') == true)
                <option value="{{old('anggaran_id')}}">{{old('nama')}}</option>
                @endif
                <option value="">-- Pilih Anggaran --</option>
                @foreach ($data_anggaran as $data)
                <option value="{{$data->id}}"> {{$data->nama_anggaran}}</option>
                @endforeach
            </select>
            @error('anggaran_id')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
        <?php

        use Carbon\Carbon;

        $tanggal = Carbon::now();
        ?>
        <div class="form-group row">
            <label for="jumlah">Nominal</label>
            <input type="hidden" name="data_warga" id="data_warga" value="{{Auth::user()->data_warga_id}}">
            <input type="hidden" name="pengaju_id" id="pengaju_id" value="{{Auth::user()->data_warga_id}}">
            <input type="hidden" name="tanggal" id="tanggal" value="{{$tanggal}}">

            <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="Cont : 50000    jangan pake titik ataupun koma" class="form-control col-12 @error('jumlah') is-invalid @enderror">
            @error('jumlah')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
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
            <hr>
            <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> LAPORKAN</button>
            <div id="tombol_proses"></div>
    </form>