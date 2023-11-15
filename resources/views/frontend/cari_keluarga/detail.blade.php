@extends('backend.template_backend.layout')
@section('content')

<h4><i class="nav-icon fas fa-users my-1 btn-sm-1"></i> Data Anggota Keluarga</h4>
<hr>
<div class="row">
    <?php

    use App\Models\FotoUser;
    ?>
    @foreach($data_keluarga as $data)
    <div class="col-12 col-sm-4 col-md-4 d-flex align-items-stretch flex-column" id="myMenu">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header">
                <h5 class="card-title"> <b>{{$data->nama}}</b>
                </h5>

                <div class="card-tools">
                    <button type="button" class="  btn btn-tool " data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <?php

            $lahir    = new DateTime($data->tanggal_lahir);
            $today        = new DateTime();
            $umur = $today->diff($lahir);

            $foto = FotoUser::where('data_warga_id', $data->id)->where('is_active', 1)->first();
            ?>
            <div class="card-body pt-0" id="card">
                <div class="row">
                    <div class="col-7">
                        <a href="{{Route('data_warga_detail',Crypt::encrypt($data->id))}}" class="">
                            <h2 class="lead" id="nama"><b>{{$data->nama}}</b> ( {{$umur->y}} )</h2>
                            <p class="text-muted text-sm"><b>Status: </b> {{$data->status}} </p>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: {{$data->alamat}}</li>
                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: {{$data->no_hp}}</li>
                            </ul>
                        </a>
                    </div>
                    <div class="col-5 text-center">
                        <a href="{{ asset($foto->foto) }}" data-toggle="lightbox" data-title="Foto {{ $data->name }}" data-gallery="gallery">
                            <img src="{{ asset($foto->foto) }}" alt="user-avatar" class="img-circle img-fluid">
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <a href="http://wa.me/62{{$data->no_hp}}" class="btn btn-sm bg-teal">
                        <i class="fas fa-comments"> Chat</i>
                    </a>
                    <a href="{{Route('data_warga_detail',Crypt::encrypt($data->id))}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-user"></i> Lihat Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection