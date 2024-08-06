@if(session('sukses'))
<div class="container">
    <div class="callout callout-success alert alert-success alert-dismissible fade show" role="alert">
        <h5><i class="fas fa-check"></i> Sukses :</h5>
        {{session('sukses')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

@if(session('kuning'))
<div class="container">
    <div class="callout callout-warning alert alert-warning alert-dismissible fade show" role="alert">
        <h5><i class="fas fa-info"></i> Informasi :</h5>
        {{session('kuning')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if(session('infoes'))
<div class="container">
    <div class="callout callout-primary alert alert-primary alert-dismissible fade show" role="alert">
        <h5><i class="fas fa-info"></i> Informasi :</h5>
        {{session('infoes')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
@if ($errors->any())
<div class="container">
    <div class="callout callout-danger alert alert-danger alert-dismissible fade show">
        <h5><i class="fas fa-exclamation-triangle"></i> Peringatan :</h5>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
<?php
use Carbon\Carbon;
use App\Models\Pengeluaran;
use App\Models\Konter;
use App\Models\BayarPinjaman;
use Illuminate\Support\Facades\Auth;

$today = Carbon::today();

    // Menentukan rentang tanggal dari 3 bulan lalu hingga 7 hari dari sekarang
    $startDate = $today->copy()->subMonths(3)->startOfDay();
    $endDate = $today->copy()->addDays(8)->subMonths(3)->endOfDay();
    $startDateKonter = $today->copy()->subMonths(1)->startOfDay();
    $endDateKonter = $today->copy()->addDays(7)->subMonths(1)->endOfDay();

    // Mendapatkan data pinjaman yang tanggal pengajuannya mendekati jatuh tempo (3 bulan dari tanggal pengajuan)
    $pinjamanJatuhTempo = Pengeluaran::where('anggaran_id', 3)
        ->where('status', "Nunggak")
        ->where('pengaju_id', Auth::user()->data_warga_id)
        ->whereBetween('tanggal', [$startDate, $endDate])
        ;
    $konter = Konter::where('status', "Belum Lunas")
        ->where('user_input', Auth::user()->data_warga->nama)
        ->whereBetween('created_at', [$startDateKonter, $endDateKonter])
        ;
?>
<!-- Alert untuk pinjaman yang mendekati jatuh tempo -->
        @if($pinjamanJatuhTempo->count() > 0 || $konter->count() > 0)
            <div class="callout callout-warning alert alert-warning alert-dismissible fade show" role="alert">
                <h5><i class="fas fa-info"></i> TAGIHAN :</h5>
                @foreach($pinjamanJatuhTempo->get() as $data)
                <?php
                $data_bayarPinjaman =BayarPinjaman::where('pengeluaran_id',$data->id)->sum('jumlah');
                $sisa = $data->jumlah - $data_bayarPinjaman;
                $cek_tanggal = strtotime($data->tanggal);
                $tanggal = strtotime("+3 months", $cek_tanggal);
                $tempo = date("Y-m-d", $tanggal);
                ?>
                <a href="{{Route('form.bayar.pinjaman',Crypt::encrypt($data->id))}}" class="">
                <div>
                PINJAMAN ({{$data->kode}}) <br>
                Nama  :{{$data->data_warga->nama}} <br>
                Sisa   : {{ "Rp " . number_format($sisa,2,',','.') }}<br>
                Jatuh Tempo = {{$tempo}}
                </a><br></div>
                _________________________________
                @endforeach
                <br>
                
                @foreach($konter->get() as $data)
                <?php
                $cek_tanggal = strtotime($data->created_at);
                $tanggal = strtotime("+1 months", $cek_tanggal);
                $tempo = date("Y-m-d", $tanggal);
                ?>
                Layanan  :{{$data->kategori}} ( {{$data->layanan}} ) <br>
                Nama  :{{$data->user_input}} <br>
                Sisa   : {{ "Rp " . number_format($data->tagihan,2,',','.') }}<br>
                Jatuh Tempo = {{$tempo}}<br>
                _________________________________
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        
