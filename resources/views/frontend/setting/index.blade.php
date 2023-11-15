@extends('backend.template_backend.layout')

@section('content')
<?php

use App\Models\AccessMenu;
use App\Models\AccessSubMenu;
use App\Models\LayoutAppUser;
use App\Models\ProfileApp;
use Illuminate\Support\Facades\Auth;

$profile_app = ProfileApp::first();
$warna_sid = LayoutAppUser::where('user_id', Auth::user()->id)->first();
$access_menu = AccessMenu::orderByRaw('created_at DESC')->where('role_id', Auth::user()->role_id)->get();

?>
<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-12 ">

        @foreach($access_menu as $data)
        @if($data->menu->kategori == 'setting')
        <div class="card card-primary card-outline dialog-scrollable">
            <div class="card-header">
                <h5 class="text-bold card-header bg-light p-2 text-center">{{$data->menu->nama}}</h5>
            </div>
            <?php
            $sub_menu = AccessSubMenu::where('menu_id', $data->menu_id)->where('user_id', Auth::user()->id)->get();
            ?>
            @foreach($sub_menu as $data1)
            <div class="card-body">
                <table class="table" style="margin-top: -21px;">
                    <tr>
                        <td width="50"><i class="nav-icon {{$data1->sub_menu->icon}}"></i></td>
                        <td> <a href="{{Route($data1->sub_menu->route_url->route_name)}}" class="text-dark">{{$data1->sub_menu->nama}}<a></td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>
        @endif
        @endforeach

        <div class="card card-warning card-outline">
            <div class="card-header">
                <h5 class="text-bold card-header bg-light p-2 text-center"> Ganti Warna</h5>
            </div>
            <div class="card-body">
                <form action="{{ Route('layout-app-user.update',Crypt::encrypt($data_layout_app->id)) }}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="form-group col-12">
                        <label for="navbar">Bagian Atas</label>
                        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                        <input type="color" name="navbar" id="navbar" value="{{$data_layout_app->navbar}}">
                    </div>
                    <div class="form-group col-12">
                        <label for="sider">Bagian Samping</label>
                        <input type="color" name="sider" id="sider" value="{{$data_layout_app->sider}}">
                    </div>
                    <div class="form-group col-12">
                        <label for="menu">Bagian Bawah</label>
                        <input type="color" name="menu" id="menu" value="{{$data_layout_app->menu}}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ganti</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection
@section('script')
<script>
    $("#aa").addClass("active");
</script>
@endsection