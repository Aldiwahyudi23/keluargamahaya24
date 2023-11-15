@extends('backend.template_backend.layout')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">DETAIL DATA ROLE</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table" style="margin-top: -10px;">
            <tr>
                <td>Role</td>
                <td>:</td>
                <td>{{$role->nama_role}}</td>
            </tr>
        </table>
        <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
            <hr>
            <center>
                <p>Penjelasan</p>
            </center>
            <p> {!! $role->deskripsi !!}</p>
        </table>
    </div>
</div>
@endsection