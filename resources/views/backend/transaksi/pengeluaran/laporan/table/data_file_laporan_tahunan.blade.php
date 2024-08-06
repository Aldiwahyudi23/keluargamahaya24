 <thead>
     <tr>
         <th>No</th>
         <th>Judul</th>
         <th>Download</th>
     </tr>
 </thead>
 <tbody>
     <?php $no = 0; ?>
     @php
     $total = 0;
     @endphp
     @foreach($data_file_laporan as $data)
     <?php $no++; ?>
     <tr>
         <td>{{$no}}</td>
         <td><a href="{{route('file-laporan.show',Crypt::encrypt($data->id))}}">
                 {{$data->judul}}
             </a></td>
         <td>
             <a href="{{ route('download-file', $data->file) }}">Download File</a>
         </td>


     </tr>

     @endforeach
 </tbody>