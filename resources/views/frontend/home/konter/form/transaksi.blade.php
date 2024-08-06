
    <form action="{{ route('konter-konfirmasi_transaksi',Crypt::encrypt($data_konter->id)) }}" method="post" enctype="multipart/form-data">
                            @method('POST')
                            {{csrf_field()}}
       
                <div class="form-group">
                    <label for="no_tujuan">No Tujuan:</label>
                    <input type="number" name="no_tujuan" id="no_tujuan" placeholder="Masukan No HP atau Token Listrik" class="form-control @error('tujuan') is-invalid @enderror" value="{{ old('tujuan',$data_konter->no_tujuan) }}">
                
                @error('tujuan')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                
                <div class="form-group">
                    <label for="nama">Nama :</label>
                    <input type="text" name="nama" id="nama" placeholder="Masukan nama pembeli" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama',$data_konter->nama) }}">
                    @error('nama')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                
                
                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror">
                     @if(old('kategori',$data_konter->kategori) == true)
                       <option value="{{old('kategori',$data_konter->kategori)}}">{{old('kategori',$data_konter->kategori)}}</option>
                     @endif
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->kategori }}">{{ $category->kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                

                <div class="form-group">
                    <label for="layanan">Layanan:</label>
                    <select name="layanan" id="layanan" class="form-control @error('layanan') is-invalid @enderror" value="{{ old('layanan') }}" disabled>
                    @if(old('layanan',$data_konter->layanan) == true)
                       <option value="{{old('layanan',$data_konter->layanan)}}">{{old('layanan',$data_konter->layanan)}}</option>
                     @endif
                        <option value="">Pilih Layanan</option>
                    </select>
                  @error('layanan')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
               </div>
                
                

                <div class="form-group">
                    <label for="nominal">Nominal:</label>
                    
                    @if($data_konter->layanan == "Tagihan Listrik")
                    <input type="text" name="nominal2" id="nominal_input" value="{{old('nominal2',$data_konter->nominal)}}" Class="form-control  @error('nominal2') is-invalid @enderror" placeholder="Masukan Jumlah tagihan dan admin layanan" >
                    
                    @error('nominal2')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                @else
                
                <select name="nominal" id="nominal" class="form-control"   disabled>
                    @if(old('nominal',$data_konter->nominal) == true)
                       <option value="{{old('nominal',$data_konter->nominal)}}">{{old('nominal',$data_konter->nominal)}}</option>
                     @endif
                        <option value="">Pilih Nominal</option>
                    </select>
                    
                    <input type="hidden" name="nominal1" id="nominal1" value="{{old('nominal1',$data_konter->nominal)}}" class="form-control @error('nominal1') is-invalid @enderror">
                @endif
                </div>
                

                <div class="form-group">
                    <label for="payment_method">Type Bayar:</label>
                    <select name="payment_method" id="payment_method" class="form-control  @error('payment_method') is-invalid @enderror" disabled>
                    @if(old('payment_method',$data_konter->type) == true)
                       <option value="{{$data_konter->type}}">{{old('payment_method',$data_konter->type)}}</option>
                     @endif
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="Langsung">Langsung</option>
                        <option value="Hutang">Hutang</option>
                    </select>
                    <input type="hidden" name="payment_method" Value="{{$data_konter->type}}">
                    @error('payment_method')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                
                <div class="form-group" id="noId"></div>

                <div class="form-group">
                    <label for="harga_beli">Harga Beli:</label>
                    <input type="number" name="harga_beli" id="harga_beli" placeholder="Isi otomatis, kecuali khusus Tagihan Listrik manual" class="form-control @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli',$data_konter->harga) }}" >
                    @error('harga_beli')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                

                <div class="form-group">
                    <label for="harga_jual">Harga Jual:</label>
                    <input type="number" name="harga_jual" id="harga_jual" placeholder="Isi otomatis, kecuali khusus Tagihan Listrik manual" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual',$data_konter->tagihan) }}" readonly>
                    @error('harga_jual')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                

               @if($data_konter->layanan = "Token Listrik")
                
                <div class="form-group">
                    <label for="token">Masukan Token:</label>
                    <input type="text" name="token" id="token" class="form-control" placeholder="Masukan Token Listrik di sini" required>
                       
                </div>
               @endif
                
                <div class="form-group">
                    <label for="diskon">Diskon:</label>
                    <input type="number" name="diskon" id="diskon" class="form-control" placeholder="Jika tidak ada diskon/vocer masukan 0" required>
                       
                </div>
                
                <div class="form-group">
                    <label for="keuntungan">Keuntungan Plus Diskon:</label>
                    <input type="text" name="keuntungn" id="keuntungan" placeholder="Otomatis" class="form-control @error('nama') is-invalid @enderror" value="{{ old('keuntungn') }}" readonly>
                    @error('keuntungan')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                
                <div class="form-group">
                    <label for="uang_keluar">Uang yang di keluarkan:</label>
                    <input type="text" name="uang_keluar" id="uang_keluar" placeholder="Otomatis" class="form-control @error('nama') is-invalid @enderror" value="{{ old('uang_keluar') }}" readonly>
                    @error('uang_keluar')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                
                <input type="hidden" name="margin" id="margin" class="form-control">
                
                
                <div class="form-group">
                 <label for="account-company">Bukti Transfer</label>
                 <input type="file" class="form-control col-12" name="foto" id="foto" required />
                 <span class="text-danger" style="font-size: 13px">Harap Cantumkan Bukti Transaksi.</span>
                </div>
<div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" name="keterangan" id="keterangan" placeholder="Tambah keterangan tambahan, Jika Token listrik masukan Token nya" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('keterangan') }}">
                    @error('keterangan')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                </div>
                
                <button type="submit" class="btn btn-primary" >Simpan</button>
            </form>

@section('script')
  

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('#kategori').change(function(){
            var kategori = $(this).val();
            if(kategori){
                $.ajax({
                    type:"GET",
                    url:"{{ route('get.services') }}",
                    data:{kategori:kategori},
                    success:function(res){
                        if(res){
                            $("#layanan").empty();
                            $("#layanan").append('<option value="">Pilih Layanan</option>');
                            $.each(res,function(key,value){
                                $("#layanan").append('<option value="'+key+'">'+value+'</option>');
                            });
                            $('#layanan').prop('disabled', false);
                        }else{
                            $("#layanan").empty();
                        }
                    }
                });
            }else{
                $("#layanan").empty();
                $('#layanan').prop('disabled', true);
            }
        });

        $('#layanan').change(function(){
            var layanan = $(this).val();
            if(layanan){
                if(layanan === 'Tagihan Listrik'){
                    $('#nominal').prop('disabled', true);
                    $('#nominal').css('display', 'none');
                    $('#nominal1').prop('disabled', true);
                    $('#nominal1').css('display', 'none');
                    $('#nominal_input').css('display', 'block');
                    $('#payment_method').prop('disabled', false);
                }else{
                    $('#nominal').prop('disabled', false);
                    $('#nominal1').prop('disabled', false);
                    $('#nominal_input').css('display', 'none');
                    $('#nominal').css('display', 'block');
                     $('#nominal1').css('display', 'block');
                    $('#payment_method').prop('disabled', true);
                }
                $.ajax({
                    type:"GET",
                    url:"{{ route('get.prices') }}",
                    data:{kategori:$("#kategori").val(), layanan:layanan},
                    success:function(res){
                        if(res){
                            $("#nominal").empty();
                            $("#nominal").append('<option value="">Pilih Nominal</option>');
                            $.each(res,function(key,value){
                                $("#nominal").append('<option value="'+key+'">'+value+'</option>');
                            });
                            $('#nominal').prop('disabled', false);
                        }else{
                            $("#nominal").empty();
                        }
                    }
                });
            }else{
                $("#nominal").empty();
                $('#nominal').prop('disabled', true);
            }
        });

        $('#nominal').change(function(){
            var nominal_id = $(this).val();
            if(nominal_id){
                $.ajax({
                    type:"GET",
                    url:"{{ route('get.price.details') }}",
                    data:{nominal:nominal_id, payment_method: $("#payment_method").val()},
                    success:function(res){
                        if(res){
                            $("#harga_beli").val(res.harga_beli);
                            $("#harga_jual").val(res.harga_jual);
                            $("#nominal1").val(res.nominal);
                        }
                    }
                });
                $('#payment_method').prop('disabled', false);
            }else{
                $("#harga_beli").val('');
                $("#harga_jual").val('');
                $("#nominal1").val('');
                $('#payment_method').prop('disabled', true);
            }
        });

        $('#payment_method').change(function(){
            var nominal_id = $("#nominal").val();
            if(nominal_id){
                $.ajax({
                    type:"GET",
                    url:"{{ route('get.price.details') }}",
                    data:{nominal:nominal_id, payment_method: $(this).val()},
                    success:function(res){
                        if(res){
                            $("#harga_beli").val(res.harga_beli);
                            $("#harga_jual").val(res.harga_jual);
                            $("#nominal1").val(res.nominal);
                        }
                    }
                });
            }
        });
        $('#nominal_input').change(function(){
    var nominal_input = $(this).val();
    $("#harga_beli").val(nominal_input); // Set harga beli sama dengan nominal yang diinput
    var harga_jual = parseInt(nominal_input);
    if ($("#payment_method").val() === 'Langsung') {
        harga_jual += 2000; // Jika pembayaran cash, tambahkan 3000 ke harga jual
    } else if ($("#payment_method").val() === 'Hutang') {
        harga_jual += 5000; // Jika pembayaran hutang, tambahkan 5000 ke harga jual
    }
    $("#harga_jual").val(harga_jual);
});

$('#payment_method').change(function(){
    var nominal_input = $("#nominal_input").val();
    var harga_jual = parseInt(nominal_input);
    if ($(this).val() === 'Langsung') {
        harga_jual += 2000; // Jika pembayaran cash, tambahkan 3000 ke harga jual
    } else if ($(this).val() === 'Hutang') {
        harga_jual += 5000; // Jika pembayaran hutang, tambahkan 5000 ke harga jual
    }
    $("#harga_jual").val(harga_jual);
});

    </script>
  
       <script>
        $('#diskon, #harga_beli, #harga_jual').on('input', function() {
    var diskon = $('#diskon').val();
    var harga_beli = $('#harga_beli').val();
    var harga_jual = $('#harga_jual').val();

    if (diskon && harga_beli && harga_jual) {
        var informasiDiskon = parseFloat(harga_jual) - parseFloat(harga_beli) + parseFloat(diskon);
        var informasiUang = parseFloat(harga_beli) - parseFloat(diskon);
        var informasiMargin = parseFloat(harga_jual) - parseFloat(harga_beli);
        $('#informasi_diskon').text(informasiDiskon);
        $('#informasi_uang').text(informasiUang);
        $('#keuntungan').val(informasiDiskon);
        $('#uang_keluar').val(informasiUang);
        $('#margin').val(informasiMargin);
    } else {
        $('#keuntungan').text('Masukan diskon/vocer, jika tidak ada input 0');
    }
});

    </script>
    <!-- SCrip Untuk tanda bukti pembayaran -->
    <script>
        $(document).ready(function() {
            $('#payment_method').change(function() {
                var kel = $('#payment_method option:selected').val();
                if (kel == "Langsung") {
                    $("#noId").html('<label for="type_bayar">Metode Pembayaran</label> <select name="type_bayar" id="type_bayar" class="select2bs4 form-control col-12 @error('type_bayar') is-invalid @enderror"> <option value="">--Pilih Metode Pembayaran--</option> <option value="Cash">Uang Tunai</option> <option value="Transfer">Transfer</option> </select> @error('type_bayar') <div class="invalid-feedback"> <strong>{{ $message }}</strong> </div> @enderror');
                } else {
                    $("#noId").html('');
                }
            });
        });
    </script>
  
    
@endsection