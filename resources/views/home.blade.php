@extends('backend.template_backend.layout')

         
@section('content')

<?php
    use App\Models\AccessProgram;
    use App\Models\Konter;
    
    
           $cek_bayar_pinjaman = $saldo_akhir->total_kas + $saldo_akhir->bunga_neo + $saldo_akhir->bunga_tabungan + $saldo_akhir->jumlah_lebih_pinjaman;
           $bayar_pinjaman = $cek_bayar_pinjaman - $saldo_akhir->saldo_atm_kas;
           //cek bayar Pinjaman apakah ada lebih dari saldo atam 
           $cek_total_kas = $saldo_akhir->saldo_kas + $saldo_akhir->saldo_darurat + $saldo_akhir->saldo_amal + $saldo_akhir->saldo_pinjaman + $saldo_akhir->bunga_neo + $saldo_akhir->bunga_tabungan + $saldo_akhir->jumlah_lebih_pinjaman;;
           //mengambil data bayar pinjaman
           $kas = ($cek_total_kas - $saldo_akhir->saldo_atm_kas) - $bayar_pinjaman ;
           //mengambil data Tabungan 
           $tabungan =$saldo_akhir->total_tabungan - $saldo_akhir->saldo_atm_tabungan;
           //menghitung Total Kas
           $total_semua_kas = $saldo_akhir->total_kas + $saldo_akhir->bunga_neo + $saldo_akhir->bunga_tabungan + $saldo_akhir->jumlah_lebih_pinjaman + $kas;
           //menghitung Saldo Kas Keseluruhan
           $saldo_semua_kas = $saldo_akhir->saldo_kas + $saldo_akhir->bunga_neo + $saldo_akhir->bunga_tabungan + $saldo_akhir->jumlah_lebih_pinjaman + $kas;
           
           $cek_tagihan = Konter::where('user_input',Auth::user()->data_warga->nama)->where('status','Belum Lunas');
           
    ?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="card">
         <?php $access_program = AccessProgram::where('user_id', Auth::user()->id)->where('program_id', 1); ?>
        @if( $access_program->count() == 1)
        
            <div class="card-header">
                <h3 class="card-title">SALDO KAS</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-footer text-center">
                <a href="{{route('laporan_umum')}}">
                    <h3>{{"Rp" . number_format($total_semua_kas,2,',','.')}}</h3>
                </a>
            </div>
            <!-- /.card-footer -->
        
        
        @endif
        @if($cek_tagihan->count() > 0)
        <a href="#tagihan" class="btn btn-info" data-toggle="collapse">Tagihan <br> {{ "Rp " . number_format($cek_tagihan->sum('tagihan'),2,',','.') }}</a>
            <div id="tagihan" class="collapse">
            
            @foreach($cek_tagihan->get() as $data)
            <a href="{{route('konter-lihat',Crypt::encrypt($data->id))}}" class="">
            <div class="container">
            
        <div class="left-text" style="float: left;">{{$data->layanan}}</div>
        <div class="right-text" style="float: right;">{{ "Rp " . number_format($data->tagihan,2,',','.') }}</div>
    </div> </a><br>
    
            @endforeach
            </div>
        @endif
        </div>
        <!-- Halaman untuk menu -->
        <div class="row">
            <div class="col-md-12">
                <!-- USERS LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Menu</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            @foreach($sub_menu as $data)
                            @if ($data->sub_menu->is_active == 1)
                            <li>
                                <a class="users-list-name" href="{{Route($data->sub_menu->route_url->route_name)}}">
                                    <div class="info-box ">
                                        <span class="info-box-icon bg-success "><i class="{{$data->sub_menu->icon}}"></i></span>
                                    </div>
                                    <span class="text-bold users-list-date" style="font-size:14px;">{{$data->sub_menu->nama}}</span>
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!--/.card -->
            </div>
        </div>
        <div class="row">
            <!-- Left col -->

           @if( $access_program->count() == 1)
            <div class="col-md-6">
                <!-- TABLE: LATEST ORDERS -->
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_pengajuan_baru as $data)
                                    <tr>
                                        <td><a href="">{{$data->kode}}</a></td>
                                        <td>{{$data->kategori->nama_kategori}}</td>
                                        @if ($data->status == "Tunda")
                                        <td><span class="badge badge-warning">{{$data->status}}</span></td>
                                        @else
                                        <td><span class="badge badge-info">{{$data->status}}</span></td>
                                        @endif
                                        <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
                                    </tr>
                                    @endforeach
                                    @foreach($data_pemasukan_baru as $data)
                                    <tr>
                                        <td><a href="">{{$data->kode}}</a></td>
                                        <td>{{$data->kategori->nama_kategori}}</td>
                                        <td><span class="badge badge-success">Disetujui</span></td>
                                        <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
                                    </tr>
                                    @endforeach
                                    @foreach($data_pengeluaran_baru as $data)
                                    <tr>
                                        <td><a href="{{Route('pengeluaran-index')}}">{{$data->kode}}</a></td>
                                        <td>{{$data->anggaran->nama_anggaran}}</td>
                                        <td><span class="badge badge-success">Disetujui</span></td>
                                        <td>{{ "Rp " . number_format($data->jumlah,2,',','.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            @endif
            <div class="col-md-6">
                <!-- PRODUCT LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Riwayat Login</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <?php

                    use App\Models\FotoUser;
                    ?>
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            @foreach($data_login as $user_login)
                            <?php
                            $foto = FotoUser::where('data_warga_id', $user_login->data_warga_id)->where('is_active', 1)->first();
                            ?>
                            <li class="item">
                                <div class="product-img">
                                    <a href="{{ asset($foto->foto) }}" data-toggle="lightbox" data-title="Foto {{ $user_login->name }}" data-gallery="gallery">

                                        <img src="{{ asset($foto->foto) }}" alt="Product Image" class="img-size-50 img-circle">
                                    </a>
                                </div>
                                <div class="product-info">
                                    <a href="" class="product-title">{{$user_login->data_warga->nama}} </a>
                                    @if(Cache::has('user-is-online-' .$user_login->id))
                                    <span class="text-success badge float-right">Online</span>
                                    @else
                                    <span class="text-secondary badge float-right">Offline</span>
                                    @endif <br>
                                    <span class="badge float-right"><i class="far fa-clock"></i> {{Carbon\Carbon::parse($user_login->last_seen)->diffForHumans()}}</span>
                                </div>
                            </li>
                            @endforeach
                            <!-- /.item -->
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->

@endsection
@section('script')
<script>
    $("#Home").addClass("active");
</script>
@endsection