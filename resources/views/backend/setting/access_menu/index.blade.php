@extends('backend.template_backend.layout')

@section('content')
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DATA MENU</h3>
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
                        $no = 0; ?>
                        @foreach($data_role as $data)
                        <?php $no++;
                        ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td><i class="{{$data->icon}}"></i> {{$data->nama_role}}</td>
                            <td><a href="{{route('access-menu.edit',Crypt::encrypt($data->id))}}" class="btn btn-primary">Access</a></td>
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