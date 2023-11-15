@extends('backend.template_backend.layout')

@section('content')
<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <center>
                    <h5 class="text-bold card-header bg-light p-0"> TAMBAH DATA PROGRAM</h5>
                </center>
                <hr>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-light">
                            <th>No.</th>
                            <th>Nama User</th>
                            <th>Program</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        use App\Models\AccessProgram;

                        $no = 0; ?>
                        @foreach($data_user as $data)
                        <?php $no++;
                        $data_access_program = AccessProgram::where('user_id', $data->id)->get();
                        ?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$data->name}}</td>
                            <td>
                                @foreach($data_access_program as $data)
                                - {{$data->program->nama_program}} <br>
                                @endforeach
                            </td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- /.table-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- /.row -->
@endsection