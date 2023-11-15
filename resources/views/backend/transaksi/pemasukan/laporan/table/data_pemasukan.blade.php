                             <thead>
                                 <tr>
                                     <th>No</th>
                                     <th>ID transaksi</th>
                                     <th>Bulan Pembayaran</th>
                                     <th>Nominal Kas</th>
                                     <th>Disetujui</th>
                                     <th>Tanggal Pengajuan</th>
                                     <th>Tanggal di Setujui</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $no = 0; ?>
                                 @php
                                 $total = 0;
                                 @endphp
                                 @foreach($data_pemasukan as $data)
                                 <?php $no++; ?>
                                 <tr>
                                     <td>{{$no}}</td>
                                     <td>{{$data->kode}}</td>
                                     <td>{{date('M-y',strtotime($data->tanggal)) }}</td>
                                     <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
                                     <td>{{$data->pengurus->nama}}</td>
                                     <td>{{$data->tanggal}}</td>
                                     <td>{{$data->created_at}}</td>

                                 </tr>
                                 @endforeach
                             </tbody>