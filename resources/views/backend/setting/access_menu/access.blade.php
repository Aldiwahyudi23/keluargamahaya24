@extends('backend.template_backend.layout')

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Access Menu : <b>{{$data_role->nama_role}}</b> </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Nama Menu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        use App\Models\AccessMenu;

                        $no = 0; ?>
                        @foreach($data_menu as $data)
                        <?php $no++;

                        $cek_access = AccessMenu::where('menu_id', $data->id)->where('role_id', $data_role->id);
                        ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->nama}}</td>
                            <td>
                                <form action="{{Route('access-menu.store')}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <input type="hidden" name="menu_id" id="menu_id" value="{{$data->id}}">
                                    <input type="hidden" name="role_id" id="role_id" value="{{$data_role->id}}">
                                    @if($cek_access->count() < '1' ) <button type="submit" class="btn btn-danger"> OFF</button>
                                        @else
                                        <button type="submit" class="btn btn-success"> ON</button>
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