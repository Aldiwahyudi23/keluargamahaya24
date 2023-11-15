 <thead>
     <tr>
         <th>No</th>
         <th>ID Transaksi</th>
         <th>Bulan</th>
         <th>Nominal</th>
         <th>Di Input oleh </th>
         <th>Pembayaran</th>
         <th>Ket</th>
         <th>Tanggal Input</th>
         <th>Tanggal di Setujui</th>
         <th>Di Setujui Oleh</th>
         <th>Aksi</th>
     </tr>
 </thead>
 <tbody>
     <?php $no = 0; ?>
     @php
     $total = 0;
     @endphp
     @foreach($data_pemasukan_kas_user as $data)
     <?php $no++; ?>
     <tr>
         <td>{{$no}}</td>
         <td>{{$data->kode}}</td>
         <td>{{date('M-y',strtotime($data->tanggal)) }}</td>
         <td>{{ "Rp " . number_format($data->jumlah) }}</td>
         <td>{{$data->pengaju->nama}}</td>
         <td>{{$data->pembayaran}}</td>
         <td style="width:100%;"> {!!$data->keterangan!!}</td>
         <td>{{$data->tanggal}}</td>
         <td>{{$data->created_at}}</td>
         <td>{{$data->pengurus->nama}}</td>
         <td>
             <form action="{{route('pemasukan.destroy',Crypt::encrypt($data->id))}}" method="POST">
                 @csrf
                 @method('delete')
                 <a href="{{route('pemasukan.show',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-book"></i></a>
                 @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Sekertaris')
                 <a href="{{route('pemasukan.edit',Crypt::encrypt($data->id))}}" class=""><i class="nav-icon fas fa-pencil-alt"></i></a>
                 @endif
                 @if (auth()->user()->role == 'Admin')
                 <button class="btn btn-link btn-sm mt-2"><i class="nav-icon fas fa-trash-alt" onclick="return confirm('Leres bade ngahapus data anu namina   ?')"></i> </button>
                 @endif
             </form>
         </td>

     </tr>

     @endforeach
 </tbody>