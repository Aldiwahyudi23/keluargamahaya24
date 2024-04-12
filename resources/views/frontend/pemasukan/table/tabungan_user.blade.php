 <thead>
     <tr>
         <th>No</th>
         <th>Nama</th>
         <th>Nominal</th>
         <th>Bulan</th>
         <th>Aksi</th>
     </tr>
 </thead>
 <tbody>
     <?php $no = 0; ?>
     @php
     $total = 0;
     @endphp
     @foreach($data_pemasukan_tabungan_user as $data)
     <?php $no++; ?>
     <tr>
         <td>{{$no}}</td>
         <td>{{$data->anggota->name}}</td>
         <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
         <td>{{date('M-y',strtotime($data->tanggal)) }}</td>
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