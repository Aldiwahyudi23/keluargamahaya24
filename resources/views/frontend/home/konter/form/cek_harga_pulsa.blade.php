
                <form action="{{ route('transactions.preview') }}" method="POST" enctype="multipart/form-data" novalidate>
                @method('POST')
                            {{csrf_field()}}
       
                    

                    <div class="form-group">
                        <label for="no_hp">No Handphone:</label>
                        <input type="number" class="form-control" name="no_hp" id="no_hp" value="{{ old('no_hp') }}">
                    <div id="hp_message" class="small-red-label"></div>
                    </div>

                    

                    <div class="form-group {{ old('no_hp') ? '' : 'hidden' }}" id="layanan_group">
                        <label for="layanan">Layanan:</label>
                        <input type="text" class="form-control" name="layanan" id="layanan" value="{{ old('layanan') }}" readonly>
                    </div>
                    

                    <div class="form-group {{ old('no_hp') ? '' : 'hidden' }}" id="nominal_group">
                        <label for="nominal">Nominal:</label>
                        <div id="nominal_container">
                            <!-- Nominal buttons will be appended here by JavaScript -->
                        </div>
                        <input type="hidden" class="form-control" name="nominal_input" id="nominal_input" value="{{ old('nominal_input') }}">
                    </div>
                    

                    <div class="form-group {{ old('payment_method') ? '' : 'hidden' }}" id="payment_method_group">
                        <label for="payment_method">Metode Pembayaran:</label>
                        <select name="payment_method" class="form-control" id="payment_method">
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="Langsung" {{ old('payment_method') == 'Langsung' ? 'selected' : '' }}>Langsung</option>
                            <option value="Hutang" {{ old('payment_method') == 'Hutang' ? 'selected' : '' }}>Hutang</option>
                        </select>
                    </div>
                    

                    <div class="form-group {{ old('payment_method') == 'Langsung' ? '' : 'hidden' }}" id="additional_payment_group">
                        <label for="payment_type">Jenis Pembayaran:</label>
                        <select name="payment_type" class="form-control" id="payment_type">
                            <option value="">Pilih Jenis Pembayaran</option>
                            <option value="Cash" {{ old('payment_type') == 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Transfer" {{ old('payment_type') == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                        </select>
                    </div>
                    

                    <div class="form-group {{ old('payment_method') == 'Langsung' ? '' : 'hidden' }}" id="keterangan_group">
                        <label for="keterangan">Keterangan:</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{ old('keterangan') }}">
                        <small class="small-red-label">Jika Cash uang di kasih kesiapa</small>
                    </div>
                   <!-- Tambahkan Kontainer untuk Pilihan Durasi -->
<div class="form-group hidden" id="payment_duration_group">
    <label for="payment_duration">Durasi Pembayaran:</label>
    <div id="payment_duration_container">
        <!-- Tombol durasi akan ditambahkan di sini oleh JavaScript -->
    </div>
    <input type="hidden" class="form-control" name="payment_duration_input" id="payment_duration_input" value="{{ old('payment_duration_input') }}">
</div>


                    <div class="form-group {{ old('nominal_input') ? '' : 'hidden' }}" id="harga_jual_group">
                        <label for="harga_jual">Harga Jual:</label>
                        <input type="text" class="form-control" name="harga_jual" id="harga_jual" value="{{ old('harga_jual') }}" readonly>
                    </div>
                    <input type="hidden" name="kategori" Value="Pulsa">
                    <input type="hidden" name="user_input" id="nama" >
                    <input type="hidden" name="nama" id="nama" >
                    
                    <input type="hidden" name="harga_beli" id="harga_beli" >
            
            

                    <button type="submit" id="submit_button" class="btn btn-primary" disabled>Beli</button>
                    
    <div id="no_hp_message"></div>
                </form>
            

<script>
    function updateHargaJual() {
        var nominal = parseFloat($('#nominal_input').val());
        var layanan = $('#layanan').val();
        var kategori = 'Pulsa'; // Set your kategori value here
        var duration = $('#payment_duration_input').val();
        var hargaJual;

        $.ajax({
            type: "GET",
            url: "{{ route('get.harga.jual') }}",
            data: { kategori: kategori, layanan: layanan, nominal: nominal },
            success: function(res) {
                // Pastikan harga_cash adalah angka
                var hargaCash = parseFloat(res.harga_cash);
                
                if ($('#payment_method').val() === 'Hutang') {
                    // Logika harga berdasarkan durasi
                    switch (duration) {
                        case '1-7':
                            hargaJual = hargaCash; // Harga normal
                            break;
                        case '8-14':
                            hargaJual = hargaCash + 1000; // Tambah 1000
                            break;
                        case '15-21':
                            hargaJual = hargaCash + 2000; // Tambah 2000
                            break;
                        case '22-30':
                            hargaJual = hargaCash + 3000; // Tambah 3000
                            break;
                        default:
                            hargaJual = hargaCash;
                            break;
                    }
                } else {
                    hargaJual = hargaCash;
                }

                $('#harga_jual').val(hargaJual);
                $('#harga_beli').val(res.harga_beli);
                validateForm();
            }
        });
    }

    function validateForm() {
        var no_hp = $('#no_hp').val();
        var nominal = $('#nominal_input').val();
        var payment_method = $('#payment_method').val();
        var payment_type = $('#payment_type').val();
        var keterangan = $('#keterangan').val();
        var payment_duration = $('#payment_duration_input').val();

        if (no_hp.length >= 10 && no_hp.length <= 12 && nominal) {
            if (payment_method === 'Langsung') {
                if (payment_type && keterangan) {
                    $('#submit_button').prop('disabled', false);
                } else {
                    $('#submit_button').prop('disabled', true);
                }
            } else if (payment_method === 'Hutang') {
                if (payment_duration) {
                    $('#submit_button').prop('disabled', false);
                } else {
                    $('#submit_button').prop('disabled', true);
                }
            } else {
                $('#submit_button').prop('disabled', true);
            }
        } else {
            $('#submit_button').prop('disabled', true);
        }
    }

    $(document).ready(function() {
        $('#no_hp, #nominal_input, #payment_method, #payment_type, #keterangan, #payment_duration_input').on('input change', function() {
            validateForm();
        });

        // Tambahkan tombol durasi waktu
        var durations = [
            { text: "1-7 Hari", value: "1-7" },
            { text: "8-14 Hari", value: "8-14" },
            { text: "15-21 Hari", value: "15-21" },
            { text: "22-30 Hari", value: "22-30" }
        ];

        $.each(durations, function(index, duration) {
            $('#payment_duration_container').append('<button type="button" class="btn btn-outline-primary m-1 duration-btn" data-value="' + duration.value + '">' + duration.text + '</button>');
        });

        // Event handler untuk tombol durasi
        $(document).on('click', '.duration-btn', function() {
            var duration = $(this).data('value');
            $('#payment_duration_input').val(duration).trigger('input');
            updateHargaJual();

            $('.duration-btn').removeClass('active');
            $(this).addClass('active');
            validateForm();
        });

        $('#no_hp').on('input', function() {
            var no_hp = $(this).val();
            if (no_hp) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('check.phone') }}",
                    data: { no_hp: no_hp },
                    success: function(res) {
                        if (res.layanan) {
                            $('#layanan').val(res.layanan);
                            $('#layanan_group').removeClass('hidden');
                            $('#nominal_group').removeClass('hidden');
                            $('#payment_method_group').addClass('hidden');
                            $('#harga_jual_group').addClass('hidden');
                            $('#additional_payment_group').addClass('hidden');
                            $('#keterangan_group').addClass('hidden');
                            $('#payment_duration_group').addClass('hidden');
                            $('#nominal_container').empty();
                            $.each(res.nominals, function(key, value) {
                                $('#nominal_container').append('<button type="button" class="btn btn-outline-primary m-1 nominal-btn" data-value="' + value + '">' + value + '</button>');
                            });
                            $('#payment_method').prop('disabled', true);
                            $('#harga_jual').val('');
                        } else {
                            $('#layanan').val('');
                            $('#layanan_group').addClass('hidden');
                            $('#nominal_group').addClass('hidden');
                            $('#payment_method_group').addClass('hidden');
                            $('#harga_jual_group').addClass('hidden');
                            $('#additional_payment_group').addClass('hidden');
                            $('#keterangan_group').addClass('hidden');
                            $('#payment_duration_group').addClass('hidden');
                            $('#nominal_container').empty();
                            $('#payment_method').prop('disabled', true);
                            $('#harga_jual').val('');
                        }

                        if (res.exists) {
                            $('#hp_message').text('Hallooo ' + res.nama + ', Selamat bertransaksi PULSA');
                            $('#nama').val(res.nama);
                        } else {
                            $('#hp_message').text('No HP bukan milik anggota keluarga');
                            $('#nama').val('');
                        }
                        
                        validateForm();
                    }
                });
            } else {
                $('#layanan').val('');
                $('#layanan_group').addClass('hidden');
                $('#nominal_group').addClass('hidden');
                $('#payment_method_group').addClass('hidden');
                $('#harga_jual_group').addClass('hidden');
                $('#additional_payment_group').addClass('hidden');
                $('#keterangan_group').addClass('hidden');
                $('#payment_duration_group').addClass('hidden');
                $('#nominal_container').empty();
                $('#payment_method').prop('disabled', true);
                $('#harga_jual').val('');
                validateForm();
            }
        });

        $(document).on('click', '.nominal-btn', function() {
            var nominal = $(this).data('value');
            $('#nominal_input').val(nominal).trigger('input');
            $('#payment_method_group').removeClass('hidden');
            $('#harga_jual_group').removeClass('hidden');
            $('#payment_method').prop('disabled', false);
            updateHargaJual();

            $('.nominal-btn').removeClass('active');
            $(this).addClass('active');
            validateForm();
        });

        $('#payment_method').change(function() {
            if ($(this).val() === 'Langsung') {
                $('#additional_payment_group').removeClass('hidden');
                $('#keterangan_group').removeClass('hidden');
                $('#payment_duration_group').addClass('hidden');
            } else if ($(this).val() === 'Hutang') {
                $('#additional_payment_group').addClass('hidden');
                $('#keterangan_group').addClass('hidden');
                $('#payment_duration_group').removeClass('hidden');
            } else {
                $('#additional_payment_group').addClass('hidden');
                $('#keterangan_group').addClass('hidden');
                $('#payment_duration_group').addClass('hidden');
            }
            updateHargaJual();
            validateForm();
        });

        $('#payment_type').change(function() {
            if ($('#payment_method').val() === 'Langsung') {
                updateHargaJual();
            }
            validateForm();
        });

        $('#nominal_input').on('input', function() {
            updateHargaJual();
            validateForm();
        });

        $('#submitBtn').click(function() {
            if (!isFormValid()) {
                $(this).prop('disabled', false).text('Simpan');
            }
        });

        $(window).on('pageshow', function(event) {
            $('#submitBtn').prop('disabled', false).text('Simpan');
        });

        $('#no_hp').trigger('input');
    });
</script>
