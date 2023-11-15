 <thead>
     <tr>
         <th>No</th>
         <th>Id Transaksi</th>
         <th>Anggaran</th>
         <th>Nominal</th>
         <th>Bulan</th>
     </tr>
 </thead>
 <tbody>
     <?php $no = 0; ?>
     @php
     $total = 0;
     @endphp
     @foreach($dana_amal as $data)
     <?php $no++; ?>
     <tr>
         <td>{{$no}}</td>
         <td>{{$data->kode}}</td>
         <td>
             <a href="{{route('laporan.pengeluaran.detail',Crypt::encrypt($data->id))}}">
                 {{$data->anggaran->nama_anggaran}}
             </a>
         </td>
         <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
         <td>{{date('M-y',strtotime($data->tanggal)) }}</td>


     </tr>

     @endforeach
 </tbody>