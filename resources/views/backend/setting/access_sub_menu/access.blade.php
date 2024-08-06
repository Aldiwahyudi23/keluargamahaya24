@extends('backend.template_backend.layout')

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Access Menu : <b>{{$data_user->name}}</b> </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Nama Sub Menu</th>
                            <th>Nama Sub Menu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        use App\Models\AccessSubMenu;

                        $no = 0; ?>
                        @foreach($data_sub_menu as $data)
                        <?php $no++;

                        $cek_access = AccessSubMenu::where('sub_menu_id', $data->id)->where('user_id', $data_user->id);
                        ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->menu->nama}} </td>
                            <td>{{$data->nama}} </td>
                            <td>
                                <form action="{{Route('access-sub-menu.store')}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" name="sub_menu_id" id="sub_menu_id" value="{{$data->id}}">
                                    <input type="hidden" name="menu_id" id="menu_id" value="{{$data->menu_id}}">
                                    <input type="hidden" name="user_id" id="user_id" value="{{$data_user->id}}">
                                    @if($cek_access->count() < '1' ) <button id="submitBtn" type="submit" class="btn btn-danger"> OFF</button>
                                        @else
                                        <button  id="submitBtn" type="submit" class="btn btn-success"> ON</button>
                                        @endif
                                </form>
                            </td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- /.table-body -->

            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
@section('script')



<script>

$(document).ready(function() {
    // Ketika tombol Submit ditekan
    $('#submitBtn').click(function() {
        // Kirim permintaan Ajax ke Controller
        $.ajax({
            url: '/access-sub-menu/store',
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                // Tangani respons dari Controller
                
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan jika ada
                console.error(error);
            }
        });
    });
});
</script>

@endsection