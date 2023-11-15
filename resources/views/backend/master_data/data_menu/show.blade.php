@extends('backend.template_backend.layout')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">DETAIL DATA MENU</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table" style="margin-top: -10px;">
            <tr>
                <td>Kategori</td>
                <td>:</td>
                <td></i> {{$menu->kategori}}</td>
            </tr>
            <tr>
                <td>Menu</td>
                <td>:</td>
                <td><i class="{{$menu->icon}}"></i> {{$menu->nama}}</td>
            </tr>
            <tr>
                <td>Url</td>
                <td>:</td>
                <td>{{$menu->route_url->nama}}</td>
            </tr>
            <tr>
                <td>Type Class</td>
                <td>:</td>
                <td>{{$menu->class}}</td>
            </tr>
        </table>
        <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
            <hr>
            <center>
                <p>Penjelasan</p>
            </center>
            <p> {!! $menu->deskripsi !!}</p>
        </table>
    </div>
</div>
@endsection