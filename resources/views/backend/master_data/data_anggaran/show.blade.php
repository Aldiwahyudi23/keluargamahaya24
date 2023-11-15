@extends('backend.template_backend.layout')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DETAIL DATA ANGGARAN</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table" style="margin-top: -10px;">
                    <tr>
                        <td><b> Program</b></td>
                        <td>:</td>
                        <td><b> {{$data_anggaran->program->nama_program}}</b></td>
                    </tr>
                    <tr>
                        <td>anggaran</td>
                        <td>:</td>
                        <td>{{$data_anggaran->nama_anggaran}}</td>
                    </tr>

                    @php
                    $bulan = date('m');
                    $tahun = date('Y');
                    @endphp
                    <tr>
                    <tr>
                        <td>Tahun</td>
                        <td>:</td>
                        <td>
                            @if ($bulan > 6)
                            {{ $tahun }}/{{ $tahun+1 }}
                            @else
                            {{ $tahun-1 }}/{{ $tahun }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Persen</td>
                        <td>:</td>
                        <td>{{$data_anggaran->persen}}</td>
                    </tr>
                    <tr>
                        <td>Limit Orang</td>
                        <td>:</td>
                        <td>{{$data_anggaran->max_orang}}</td>
                    </tr>
                    <tr>
                        <td>Limit Max Uang</td>
                        <td>:</td>
                        <td>{{$data_anggaran->nominal_max_anggaran}}</td>
                    </tr>

                </table>
                <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                    <p> {!! $data_anggaran->deskripsi !!}</p>
                </table>

            </div>

        </div><!-- /.container-fluid -->
</section>

@endsection
@section('script')
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#Dataanggaran").addClass("active");
</script>
@endsection