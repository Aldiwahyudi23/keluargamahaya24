@extends('backend.template_backend.layout')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DETAIL DATA FILE LAPORAN</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table" style="margin-top: -10px;">
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td>{{$file_laporan->judul}}</td>
                    </tr>
                    <tr>
                        <td>File</td>
                        <td>:</td>
                        <td><a href="{{ route('download-file', $file_laporan->file) }}">Download File</a></td>
                    </tr>

                </table>
                <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                    <p> {!! $file_laporan->deskripsi !!}</p>
                </table>
                <embed src="{{ asset($file_laporan->file) }}" type="application/pdf" width="100%" height="600px" />

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