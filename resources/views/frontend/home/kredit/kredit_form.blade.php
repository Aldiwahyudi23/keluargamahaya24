<!DOCTYPE html>
<html lang="en">

<?php

use App\Models\ProfileApp;

$profile_app = ProfileApp::first();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$profile_app->nama}}</title>
    <link rel="shrotcut icon" href="{{$profile_app->logo}}">
    <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .result-table, .role-section {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Form Perhitungan Kredit</h2>
    <form id="creditForm">
        <div class="form-group">
            <label for="nominal">Nominal (Harga Barang)</label>
            <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Isi Berdasarkan Harga Beli keseluruhan" required>
        </div>
        <div class="form-group">
            <label for="dp">DP (Uang Muka)</label>
            <input type="text" class="form-control" id="dp" name="dp" placeholder="Kosongkan jika tidak menggunakan DP">
            <small id="dpInfo" class="form-text text-muted"></small>
        </div>
    </form>

    <div class="result-table">
        <h3>Hasil Perhitungan Kredit</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>Tenor (Bulan)</th>
                        <th>Angsuran per Bulan (Kas Kel. Ma Haya)</th>
                        <th>Angsuran per Bulan (Akulaku)</th>
                        <th>Angsuran per Bulan (Shopee)</th>
                        <th>Angsuran per Bulan (Lainnya)</th>
                    </tr>
                </thead>
                <tbody id="resultBody">
                    <!-- Results will be inserted here -->
                </tbody>
            </table>
        </div>
    </div>

    <div class="role-section">
        <h3>Data Perhitungan untuk Role User</h3>
        <p><strong>Nominal:</strong> <span id="netNominal"></span></p>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tenor (Bulan)</th>
                        <th>Bunga Keseluruhan (Kas Kel. Ma Haya)</th>
                        <th>Bunga Keseluruhan (Akulaku)</th>
                        <th>Bunga Keseluruhan (Shopee)</th>
                        <th>Bunga Keseluruhan (Lainnya)</th>
                    </tr>
                </thead>
                <tbody id="roleResultBody">
                    <!-- Results will be inserted here -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<marquee>
         <strong>{!!$profile_app->footer!!}</strong>
     </marquee>
<script>
    document.getElementById('nominal').addEventListener('input', formatAndCalculate);
    document.getElementById('dp').addEventListener('input', formatAndCalculate);

    function formatAndCalculate(event) {
        formatCurrency(event.target);
        displayDPInfo();
        calculateCredit();
    }

    function formatCurrency(input) {
        const value = input.value.replace(/[^,\d]/g, '').toString();
        const split = value.split(',');
        const sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            const separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = rupiah ? 'Rp ' + rupiah : '';
    }

    function displayDPInfo() {
        const dp = parseCurrency(document.getElementById('dp').value || 'Rp 0');
        const dpInfo = document.getElementById('dpInfo');

        if (dp > 0) {
            dpInfo.textContent = "Anda telah menggunakan DP, Maka Tenor yang Tepat adalah 9 Bulan";
        } else {
            dpInfo.textContent = "Jika Tidak Menggunakan DP disarankan Untuk mengambil yang 10 Bulan";
        }
    }

    function calculateCredit() {
        const nominal = parseCurrency(document.getElementById('nominal').value);
        const dp = parseCurrency(document.getElementById('dp').value || 'Rp 0');

        if (!nominal) return;

        const tenors = [ 3, 6, 9, 10, 12];
        const interestRates = {
            
            3: { default: 0.081, akulaku: 0.12, shopee: 0.0885, others: 0.17 },
            6: { default: 0.162, akulaku: 0.24, shopee: 0.177, others: 0.38 },
            9: { default: 0.243, akulaku: 0.36, shopee: null, others: 0.48 },
            10: { default: 0.27, akulaku: null, shopee: null, others: 0.25 },
            12: { default: 0.324, akulaku: 0.48, shopee: 0.354, others: 0.44 }
        };

        const resultBody = document.getElementById('resultBody');
        resultBody.innerHTML = '';

        const roleResultBody = document.getElementById('roleResultBody');
        roleResultBody.innerHTML = '';

        const netNominal = nominal - dp;
        document.getElementById('netNominal').textContent = formatCurrencyValue(netNominal);

        tenors.forEach(tenor => {
            const rates = interestRates[tenor];
            const totalCredit = netNominal;

            const totalPayableBase = totalCredit + (totalCredit * rates.default);
            const totalPayableAkulaku = rates.akulaku !== null ? totalCredit + (totalCredit * rates.akulaku) : null;
            const totalPayableShopee = rates.shopee !== null ? totalCredit + (totalCredit * rates.shopee) : null;
            const totalPayableOther = totalCredit + (totalCredit * rates.others);

            const monthlyInstallmentBase = totalPayableBase / tenor;
            const monthlyInstallmentAkulaku = totalPayableAkulaku !== null ? totalPayableAkulaku / tenor : '';
            const monthlyInstallmentShopee = totalPayableShopee !== null ? totalPayableShopee / tenor : '';
            const monthlyInstallmentOther = totalPayableOther / tenor;

            // Menambahkan baris ke tabel hasil umum
            const row = document.createElement('tr');
            row.innerHTML = `
                <td><button class="btn btn-primary" onclick="selectRow(${tenor}, ${monthlyInstallmentBase})">Pilih</button></td>
                <td>${tenor} Bulan</td>
                <td>${formatCurrencyValue(monthlyInstallmentBase)}</td>
                <td>${monthlyInstallmentAkulaku ? formatCurrencyValue(monthlyInstallmentAkulaku) : ''}</td>
                <td>${monthlyInstallmentShopee ? formatCurrencyValue(monthlyInstallmentShopee) : ''}</td>
                <td>${formatCurrencyValue(monthlyInstallmentOther)}</td>
            `;
            resultBody.appendChild(row);

            // Menambahkan baris ke tabel untuk role pengguna
            const roleRow = document.createElement('tr');
            roleRow.innerHTML = `
                <td>${tenor} Bulan</td>
                <td>${formatCurrencyValue(totalCredit * rates.default)}</td>
                <td>${totalPayableAkulaku !== null ? formatCurrencyValue(totalCredit * rates.akulaku) : ''}</td>
                <td>${totalPayableShopee !== null ? formatCurrencyValue(totalCredit * rates.shopee) : ''}</td>
                <td>${formatCurrencyValue(totalCredit * rates.others)}</td>
            `;
            roleResultBody.appendChild(roleRow);
        });

        document.querySelector('.result-table').style.display = 'block';

        // Pengecekan role pengguna dari PHP
        const userRole = '{{ $userRole }}';

        if (['Admin', 'Ketua', 'Sekertaris', 'Bendahara'].includes(userRole)) {
            document.querySelector('.role-section').style.display = 'block';
        } else {
            document.querySelector('.role-section').style.display = 'none';
        }
    }

    function parseCurrency(value) {
        return parseFloat(value.replace(/[^,\d]/g, '').replace(',', '.'));
    }

    function formatCurrencyValue(value) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
    }

    function selectRow(tenor, defaultValue) {
        const nominal = parseCurrency(document.getElementById('nominal').value);
        const dp = parseCurrency(document.getElementById('dp').value || 'Rp 0');
        const netNominal = nominal ;
        const queryString = `nominal=${netNominal}&dp=${dp}&tenor=${tenor}&angsuran=${defaultValue}`;
        window.location.href = `/invoice?${queryString}`;
    }
</script>
</body>
</html>
