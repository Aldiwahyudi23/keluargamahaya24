<form action="{{ route('transactions.preview') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf

    <div class="form-group">
        <label for="id_listrik">ID Listrik:</label>
        <input type="number" class="form-control" name="id_listrik" id="id_listrik" value="{{ old('id_listrik') }}">
    </div>

    <div id="id_listrik_message"></div>

    <div class="form-group {{ old('id_listrik') ? '' : 'hidden' }}" id="nama_group">
        <label for="nama">Nama Listrik:</label>
        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}">
    </div>

    <div class="form-group {{ old('id_listrik') ? '' : 'hidden' }}" id="no_hp_group">
        <label for="no_hp">No yang Bisa di Hubungi:</label>
        <input type="number" class="form-control" name="no_hp" id="no_hp" value="{{ old('no_hp') }}">
    </div>

    <div class="form-group {{ old('id_listrik') ? '' : 'hidden' }}" id="nominal_group">
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
<div class="form-group {{ old('payment_method') == 'Hutang' ? '' : 'hidden' }}" id="payment_duration_group">
    <label for="payment_duration">Durasi Pembayaran:</label>
    <div id="payment_duration_container">
        <!-- Durasi buttons will be appended here by JavaScript -->
    </div>
    <input type="hidden" class="form-control" name="payment_duration_input" id="payment_duration_input" value="{{ old('payment_duration_input') }}">
</div>



    <div class="form-group {{ old('nominal_input') ? '' : 'hidden' }}" id="harga_jual_group">
        <label for="harga_jual">Harga Jual:</label>
        <input type="text" class="form-control" name="harga_jual" id="harga_jual" value="{{ old('harga_jual') }}" readonly>
    </div>

    <input type="hidden" name="kategori" value="Listrik">
    <input type="hidden" name="layanan" Value="Token Listrik">
    <input type="hidden" name="user_input" id="user_input" >
    <input type="hidden" name="harga_beli" id="harga_beli" >
    

    <button type="submit" id="submit_button" class="btn btn-primary" disabled>Beli</button>
</form>

<script>
    function updateHargaJual() {
        var nominal = parseFloat($('#nominal_input').val());
        var layanan = 'Token Listrik';
        var kategori = 'Listrik'; // Set your kategori value here
        var duration = $('#payment_duration_input').val();
        var hargaJual;

        $.ajax({
            type: "GET",
            url: "{{ route('get.harga.jual') }}",
            data: { kategori: kategori, layanan: layanan, nominal: nominal },
            success: function(res) {
                var hargaCash = parseFloat(res.harga_cash);
                
                if ($('#payment_method').val() === 'Hutang') {
                    // Logika harga berdasarkan durasi
                    switch (duration) {
                        case '1-7':
                            hargaJual = hargaCash; // Harga normal
                            break;
                        case '8-17':
                            hargaJual = hargaCash + 1000; // Tambah 1000
                            break;
                        case '18-30':
                            hargaJual = hargaCash + 2000; // Tambah 2000
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
        var id_listrik = $('#id_listrik').val();
        var nominal = $('#nominal_input').val();
        var payment_method = $('#payment_method').val();
        var payment_type = $('#payment_type').val();
        var keterangan = $('#keterangan').val();
        var nama = $('#nama').val();
        var no_hp = $('#no_hp').val();
        var payment_duration = $('#payment_duration_input').val();

        if (id_listrik && nominal && nama && no_hp) {
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
        $('#id_listrik, #nominal_input, #payment_method, #payment_type, #keterangan, #nama, #no_hp').on('input change', function() {
            validateForm();
        });

        // Tambahkan tombol durasi waktu
        var durations = [
            { text: "1-7 Hari", value: "1-7" },
            { text: "8-17 Hari", value: "8-17" },
            { text: "18-30 Hari", value: "18-30" },
            
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

        $('#id_listrik').on('input', function() {
            var id_listrik = $(this).val();
            if (id_listrik) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('check.id_listrik') }}",
                    data: { id_listrik: id_listrik },
                    success: function(res) {
                        if (res.exists) {
                            $('#user_input').val(res.user_input);
                            $('#nama').val(res.nama);
                            $('#no_hp').val(res.no_hp);
                            $('#nama_group').removeClass('hidden');
                            $('#no_hp_group').removeClass('hidden');
                            
                        } else {
                            $('#user_input').val('');
                            $('#nama').val('');
                            $('#no_hp').val('');
                            $('#nama_group').removeClass('hidden');
                            $('#no_hp_group').removeClass('hidden');
                        }
                        
                        $('#nominal_container').empty();
                        $.each(res.nominals, function(key, value) {
                            $('#nominal_container').append('<button type="button" class="btn btn-outline-primary m-1 nominal-btn" data-value="' + value + '">' + value + '</button>');
                        });

                        $('#nominal_group').removeClass('hidden');
                        $('#payment_method_group').addClass('hidden');
                        $('#harga_jual_group').addClass('hidden');
                        $('#additional_payment_group').addClass('hidden');
                        $('#keterangan_group').addClass('hidden');
                        $('#payment_method').prop('disabled', true);
                        $('#harga_jual').val('');
                        
                        if (res.status === 'Pengajuan') {
                
                            $('#id_listrik_message').text('No Listrik / Id listrik masih dalam pengajuan harap Konfirmasi ke Admin');
                            $('#id_listrik_message').addClass('text-danger');
                            $('#submit_button').prop('disabled', true);
                            $('#nama_group, #no_hp_group, #nominal_group, #payment_method_group, #additional_payment_group, #keterangan_group').addClass('hidden');
                            return;
                        } else {
                            $('#id_listrik_message').text('');
                            $('#id_listrik_message').removeClass('text-danger');
                            $('#submit_button').prop('disabled', false);
                        }
                        
                        validateForm();
                    }
                });
            } else {
                $('#user_input').val('');
                $('#nama').val('');
                $('#no_hp').val('');
                $('#nama_group').addClass('hidden');
                $('#no_hp_group').addClass('hidden');
                $('#nominal_group').addClass('hidden');
                $('#payment_method_group').addClass('hidden');
                $('#harga_jual_group').addClass('hidden');
                $('#additional_payment_group').addClass('hidden');
                $('#keterangan_group').addClass('hidden');
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

        $('#submit_button').click(function() {
            if (!isFormValid()) {
                $(this).prop('disabled', false).text('Beli');
            }
        });

        $(window).on('pageshow', function(event) {
            $('#submit_button').prop('disabled', false).text('Beli');
        });

        $('#id_listrik').trigger('input');
    });
</script>
