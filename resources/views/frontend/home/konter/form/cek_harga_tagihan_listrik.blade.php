<!-- resources/views/cek_tagihan_listrik.blade.php -->
<form action="{{ route('transactions.preview') }}" method="POST" enctype="multipart/form-data" novalidate>
    @method('POST')
    {{ csrf_field() }}

    <div class="form-group">
        <label for="id_listrik">No Listrik/ Meteran:</label>
        <input type="number" class="form-control" name="id_listrik" id="id_listrik" value="{{ old('id_listrik') }}">
        <small id="id_listrik_message" class="form-text text-danger"></small>
    </div>

    <div class="form-group hidden" id="nama_group">
        <label for="nama">Nama:</label>
        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') }}">
    </div>

    <div class="form-group hidden" id="no_hp_group">
        <label for="no_hp">No yang bisa dihubungi:</label>
        <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{ old('no_hp') }}">
    </div>

    <div class="form-group hidden" id="payment_method_group">
        <label for="payment_method">Metode Pembayaran:</label>
        <select name="payment_method" class="form-control" id="payment_method">
            <option value="">Pilih Metode Pembayaran</option>
            <option value="Langsung" {{ old('payment_method') == 'Langsung' ? 'selected' : '' }}>Langsung</option>
            <option value="Hutang" {{ old('payment_method') == 'Hutang' ? 'selected' : '' }}>Hutang</option>
        </select>
    </div>

    <div class="form-group hidden" id="additional_payment_group">
        <label for="payment_type">Jenis Pembayaran:</label>
        <select name="payment_type" class="form-control" id="payment_type">
            <option value="">Pilih Jenis Pembayaran</option>
            <option value="Cash" {{ old('payment_type') == 'Cash' ? 'selected' : '' }}>Cash</option>
            <option value="Transfer" {{ old('payment_type') == 'Transfer' ? 'selected' : '' }}>Transfer</option>
        </select>
    </div>

    <div class="form-group hidden" id="keterangan_group">
        <label for="keterangan">Keterangan:</label>
        <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{ old('keterangan') }}">
        <small class="small-red-label">Jika Cash uang di kasih kesiapa</small>
    </div>

    <input type="hidden" name="nominal_input" value="Nominal Input Setelah Transaksi karena Belum tau Tagihannya berapa">
    <input type="hidden" name="kategori" value="Listrik">
    <input type="hidden" name="layanan" Value="Tagihan Listrik">
    <input type="hidden" name="user_input" id="user_input" >
    <input type="hidden" name="harga_beli" Value="0" >
    <input type="hidden" class="form-control" name="payment_duration_input" id="payment_duration_input" value="Tagihan akan di sesuaikan dengan durasi ketika pembayaran">
    
    <input type="hidden" Class="form-control" name="harga_jual" id="harga_jual" Readonly>

    <button type="submit" id="submit_button" class="btn btn-primary" disabled>Bayar</button>
</form>

<script>
    function validateForm() {
        var id_listrik = $('#id_listrik').val();
        var payment_method = $('#payment_method').val();
        var payment_type = $('#payment_type').val();
        var keterangan = $('#keterangan').val();

        if (id_listrik && payment_method) {
            if (payment_method === 'Langsung') {
                if (payment_type && keterangan) {
                    $('#submit_button').prop('disabled', false);
                } else {
                    $('#submit_button').prop('disabled', true);
                }
            } else if (payment_method === 'Hutang') {
                $('#submit_button').prop('disabled', false);
            } else {
                $('#submit_button').prop('disabled', true);
            }
        } else {
            $('#submit_button').prop('disabled', true);
        }
    }

    $(document).ready(function() {
        $('#id_listrik, #payment_method, #payment_type, #keterangan').on('input change', function() {
            validateForm();
        });

        $('#id_listrik').on('input', function() {
            var id_listrik = $(this).val();
            if (id_listrik) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('check.id_listrik_status') }}",
                    data: { id_listrik: id_listrik },
                    success: function(res) {
                        if (res.status === 'Pengajuan') {
                            $('#id_listrik_message').text('ID Listrik masih dalam pengajuan. Harap konfirmasi ke Admin.');
                            $('#id_listrik_message').addClass('text-danger');
                            $('#submit_button').prop('disabled', true);
                            $('#nama_group, #no_hp_group, #payment_method_group, #additional_payment_group, #keterangan_group').addClass('hidden');
                        } else if (res.status === 'Tersedia') {
                            $('#id_listrik_message').text('');
                            $('#id_listrik_message').removeClass('text-danger');
                            $('#user_input').val(res.user_input);
                            $('#nama').val(res.nama);
                            $('#no_hp').val(res.no_hp);
                            $('#nama_group, #no_hp_group, #payment_method_group').removeClass('hidden');
                            $('#submit_button').prop('disabled', false);
                        } else {
                            $('#id_listrik_message').text('');
                            $('#id_listrik_message').removeClass('text-danger');
                            $('#user_input').val();
                            $('#nama').val('');
                            $('#no_hp').val('');
                            $('#nama_group, #no_hp_group, #payment_method_group').removeClass('hidden');
                            $('#submit_button').prop('disabled', true);
                        }
                        validateForm();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#id_listrik_message').text('');
                $('#id_listrik_message').removeClass('text-danger');
                $('#nama_group, #no_hp_group, #payment_method_group, #additional_payment_group, #keterangan_group').addClass('hidden');
                $('#submit_button').prop('disabled', true);
                validateForm();
            }
        });

        $('#payment_method').change(function() {
            if ($(this).val() === 'Langsung') {
                $('#additional_payment_group').removeClass('hidden');
                $('#keterangan_group').removeClass('hidden');
                $('#harga_jual').val('Dari jumlah Tagihan di tambah 2,000');
            } else {
                $('#additional_payment_group').addClass('hidden');
                $('#keterangan_group').addClass('hidden');
                $('#harga_jual').val('Dari jumlah Tagihan di tambah 5.000');
            }
            validateForm();
        });

        $('#payment_type').change(function() {
            validateForm();
        });

        validateForm();
    });
</script>
