@extends('backend.template_backend.layout')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">DETAIL DATA SUB MENU</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table" style="margin-top: -10px;">
            <tr>
                <td>Menu</td>
                <td>:</td>
                <td>{{$submenu->menu->nama}}</td>
            </tr>
            <tr>
                <td>Sub Menu</td>
                <td>:</td>
                <td> <i class="{{$submenu->icon}}"> </i> {{$submenu->nama}}</td>
            </tr>
            <tr>
                <td>Url</td>
                <td>:</td>
                <td>{{$submenu->route_url->nama}}</td>
            </tr>
        </table>
        <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
            <hr>
            <center>
                <p>Penjelasan</p>
            </center>
            <p> {!! $submenu->deskripsi !!}</p>
        </table>
    </div>
</div>
@endsection