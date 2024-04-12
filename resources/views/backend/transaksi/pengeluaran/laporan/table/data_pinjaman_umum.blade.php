<thead>
    <tr class="bg-light">
        <th>No.</th>
        <th>ID Transaksi</th>
        <th>Status</th>
        <th>Nominal di Setujui</th>
        <th>Tanggal</th>
    </tr>
</thead>
<tbody>
    <?php
    $no = 0;
    ?>
    @php
    $total = 0;
    @endphp
    @foreach( $dana_pinjam as $data)
    <?php $no++;
    ?>
    <tr>
        <td>{{$no}}</td>
        <td>{{$data->kode}}</td>
        <td>{{$data->status}}</td>
        <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
        <td>{{date('M-y',strtotime($data->tanggal)) }}</td>

    </tr>
    @endforeach
</tbody>