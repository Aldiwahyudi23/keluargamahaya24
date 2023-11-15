@extends('backend.template_backend.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">DETAIL DATA PROGRAM</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table" style="margin-top: -10px;">
            <tr>
                <td>program</td>
                <td>:</td>
                <td>{{$data_program->nama_program}}</td>
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
                <td> Di resmikan pada tanggal</td>
                <td>:</td>
                <td>{{$data_program->tanggal}}</td>
            </tr>
            <tr>
                <td> Jumlah yang harus di bayar</td>
                <td>:</td>
                <td>{{$data_program->jumlah}}</td>
            </tr>

        </table>
        <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
            <hr>
            <p> {!! $data_program->deskripsi !!}</p>
            <hr>
            <p>{!! $data_program->SnK!!}</p>
        </table>

        <hr>
        @if($cek_access_program >= 1)
        @else
        <form action="{{Route('access-program.store')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="program_id" id="program_id" value="{{$data_program->id}}">
            <hr>
            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Bade Ngiringan kana Program</button>
        </form>
        @endif
    </div>
</div>

@endsection