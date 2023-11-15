@extends('backend.template_backend.layout')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h5 class="text-bold card-header bg-light p-2 text-center"> Program yang sudah ada</h5>
            </div>
            @foreach($data_program as $data)
            <div class="card-body">
                <table class="table" style="margin-top: -21px;">
                    <tr>
                        <td width="50"><i class="nav-icon fas fa-thin fa-bars"></i></td>
                        <td> <a href="{{Route('program.show',Crypt::encrypt($data->id))}}" class="text-dark">{{$data->nama_program}}<a></td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection