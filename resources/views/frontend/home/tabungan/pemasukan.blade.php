 <thead>
     <tr>
         <th>No</th>
         <th>ID Transaksi</th>
         <th>Nominal</th>
         <th>Bulan</th>
     </tr>
 </thead>
 <tbody>
     <?php $no = 0; ?>
     @php
     $total = 0;
     @endphp
     @foreach($data_tabungan_user as $data)
     <?php $no++; ?>
     <tr>
         <td>{{$no}}</td>
         <td>
             <a href="{{route('pemasukan.show',Crypt::encrypt($data->id))}}" class="">
                 {{$data->kode}}
             </a>
         </td>
         <td>
             <a href="{{route('pemasukan.show',Crypt::encrypt($data->id))}}" class="">
                 {{ "Rp " . number_format($data->jumlah,2,',','.') }}
             </a>
         </td>
         <td>{{date('M-y',strtotime($data->tanggal)) }}</td>

     </tr>

     @endforeach
 </tbody>