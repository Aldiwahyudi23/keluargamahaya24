 <thead>
     <tr class="bg-light">
         <th>Nama</th>
         <th>Kas</th>
         @if (Auth::user()->role->nama_role == "Admin" || Auth::user()->role->nama_role == "Bendahara" || Auth::user()->role->nama_role == "Sekertaris")
         <th>Tabungan</th>
         @endif
     </tr>
 </thead>
 <tbody>
     <?php

        use App\Models\AccessProgram;
        use Illuminate\Support\Facades\DB;
        use App\Models\Pengeluaran;

        // mengambil tanggal ysng di resmikan pada table prograam
        use App\Models\Program;
        use App\Models\UpdateKerja;
        use Illuminate\Support\Facades\Auth;

        $no = 0; ?>
     @foreach($data_anggota as $anggota)
     <?php $no++; ?>
     <tr>
         <td>{{$anggota->data_warga->nama}}</td>
         <?php
            $id = $anggota->data_warga_id;

            $setor = DB::table('pemasukans')->where('pemasukans.kategori_id', '=', "1");
            $total_setor = $setor->where('pemasukans.data_warga_id', '=', $id)
                ->sum('pemasukans.jumlah');

            $cek_pemasukan_terakhir_all = $setor->where('data_warga_id', $id)->sum('jumlah');

            $tabungan = DB::table('pemasukans')->where('pemasukans.kategori_id', '=', "2");
            $total_tabungan = $tabungan->where('pemasukans.data_warga_id', '=', $id)
                ->sum('pemasukans.jumlah');
            $pengeluaran_tabungan = Pengeluaran::where('data_warga_id', $id)->where('anggaran_id', 7)->sum('jumlah');

            $jumlah = $total_setor;
            $jumlah_tabungan = $total_tabungan;
            // hitung sisa bayaran ==========================================



            $program = Program::find(1); //find id 1 adalah mengambil id dari data program dengan id 1 ya itu kas keluarga

            // mengambil data selisih yang tidak bekerja 
            $update_kerja = UpdateKerja::where('user_id', $anggota->id)->sum('tenor');
            // untuk menghitung sesilih bulan dari awal sampai sekarang khusu program kas
            $date = date("Y-m-d");
            $timeStart = strtotime("$program->tanggal");
            $timeEnd = strtotime("$date");
            // Menambah bulan ini + semua bulan pada tahun sebelumnya
            $numBulan = 1 + (date("Y", $timeEnd) - date("Y", $timeStart)) * 12;
            // menghitung selisih bulan
            $numBulan += date("m", $timeEnd) - date("m", $timeStart);

            // Jatah pembayaran kas yang harus di bayar
            $all_kas = $numBulan - $update_kerja;
            // menghitung sisa penbayaran kas yang di potong karena tida bekerja , mengambil data dari data update kerja selisih kerja
            $all_kas_kerja = $all_kas * $program->jumlah;

            $sisa_kas = $all_kas_kerja - $cek_pemasukan_terakhir_all;
            $sisa_bulan = $sisa_kas / $program->jumlah;
            // =============================================================
            $user = DB::table('users')->find($anggota->id);
            $data_program_kas = AccessProgram::where('user_id', $anggota->id)->where('program_id', 1)->count();
            $data_program_tabungan = AccessProgram::where('user_id', $anggota->id)->where('program_id', 2)->count();
            ?>


         @if ( $data_program_kas == 1)
         <td> <a href="{{route('detail.anggota.kas',Crypt::encrypt($anggota->id))}}"> {{ "Rp " . number_format( $jumlah,2,',','.') }} </a> <br>

             @if( $sisa_kas <= 0) <!-- Jika sisa kas yang harus di bayar kas kosong -->
                 TUNTAS sadayana atos bayar ti awal sampe ayeuna bulan {{date("M-Y",$timeEnd)}} kapotong Tidak Bekerja selami <b>{{$update_kerja}}</b> bulan,jalan bulan ka {{$numBulan}} <br>

                 <!-- dab jika tida -->
                 @else
                 <b>{{ "Rp " . number_format($sisa_kas,2,',','.') }}</b> atawa <b>{{$sisa_bulan}}</b> Bulanan nu teu acan di bayar kapotong Tidak Bekerja selami <b>{{$update_kerja}}</b> bulan , Mangga cek wae dina story pembayaran<br> Kas mulaina ti bulan {{date("M-Y",$timeStart)}}

                 @endif
         </td>
         @else
         <td></td>
         @endif
         @if (Auth::user()->role->nama_role == "Admin" || Auth::user()->role->nama_role == "Bendahara" || Auth::user()->role->nama_role == "Sekertaris")
         @if ( $data_program_tabungan == 1)
         <td><a href="{{route('detail.anggota.tabungan',Crypt::encrypt($anggota->id))}}">{{ "Rp " . number_format( $jumlah_tabungan-$pengeluaran_tabungan,2,',','.') }} </a></td>
         @else
         <td></td>
         @endif
         @endif
     </tr>

     @endforeach
 </tbody>