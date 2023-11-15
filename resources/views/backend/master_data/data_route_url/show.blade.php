@extends('backend.template_backend.layout')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">DETAIL DATA ROUTE</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table" style="margin-top: -10px;">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{$route_url->nama}}</td>
            </tr>
            <tr>
                <td>Route Name</td>
                <td>:</td>
                <td>{{$route_url->route_name}}</td>
            </tr>
        </table>
        <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
            <hr>
            <center>
                <p>Penjelasan</p>
            </center>
            <p> {!! $route_url->deskripsi !!}</p>
        </table>
    </div>
</div>
@endsection