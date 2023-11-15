@extends('backend.template_backend.layout')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">DETAIL DATA KATEGORI</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table" style="margin-top: -10px;">
            <tr>
                <td>Kategori</td>
                <td>:</td>
                <td>{{$kategori->nama_kategori}}</td>
            </tr>
            <tr>
                <td>Kode</td>
                <td>:</td>
                <td>{{$kategori->kode}}</td>
            </tr>
        </table>
        <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
            <hr>
            <center>
                <p>Penjelasan</p>
            </center>
            <p> {!! $kategori->deskripsi !!}</p>
        </table>
    </div>
</div>
@endsection