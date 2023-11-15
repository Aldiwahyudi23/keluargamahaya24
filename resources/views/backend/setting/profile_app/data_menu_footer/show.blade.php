@extends('backend.template_backend.layout')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">DETAIL DATA MENU FOOTER</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table" style="margin-top: -10px;">
            <tr>
                <td>Menu</td>
                <td>:</td>
                <td>{{$menu_footer->nama}}</td>
            </tr>
            <tr>
                <td>Program</td>
                <td>:</td>
                @if($menu_footer->program_id >= 1)
                <td>{{$menu_footer->program->nama_program}}</td>
                @else
                <td>Tidak Terikat Program (selalu muncul )</td>
                @endif
            </tr>
            <tr>
                <td>kategori</td>
                <td>:</td>
                @if($menu_footer->kategori >= 1)
                <td>Keluarga</td>
                @else
                <td>Hanya Terikat Dengan Keluarga (suami/istri)</td>
                @endif
            </tr>
            <tr>
                <td>Gambar Icon</td>
                <td>:</td>
                <td> <i class="{{$menu_footer->icon}}"> </i> {{$menu_footer->nama}}</td>
            </tr>
            <tr>
                <td>Url</td>
                <td>:</td>
                <td>{{$menu_footer->route_url->nama}}</td>
            </tr>
        </table>
        <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
            <hr>
            <center>
                <p>Penjelasan</p>
            </center>
            <p> {!! $menu_footer->deskripsi !!}</p>
        </table>
    </div>
</div>
@endsection