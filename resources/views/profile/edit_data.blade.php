@extends('backend.template_backend.layout')

@section('content')

<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-data-diri-tab" data-toggle="pill" href="#custom-tabs-one-data-diri" role="tab" aria-controls="custom-tabs-one-data-diri" aria-selected="false">Data Diri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-data-ayah-tab" data-toggle="pill" href="#custom-tabs-one-data-ayah" role="tab" aria-controls="custom-tabs-one-data-ayah" aria-selected="false">Data Ayah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-data-ibu-tab" data-toggle="pill" href="#custom-tabs-one-data-ibu" role="tab" aria-controls="custom-tabs-one-data-ibu" aria-selected="false">Data Ibu</a>
                    </li>
                    @if($data_pribadi->status_pernikahan == 'Menikah' || $data_pribadi->status_pernikahan == 'Cerai Mati')
                    @if($data_pribadi->jenis_kelamin == 'Laki-Laki')
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-data-istri-tab" data-toggle="pill" href="#custom-tabs-one-data-istri" role="tab" aria-controls="custom-tabs-one-data-istri" aria-selected="false">Data Istri</a>
                    </li>
                    @endif
                    @if($data_pribadi->jenis_kelamin == 'Perempuan')
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-data-suami-tab" data-toggle="pill" href="#custom-tabs-one-data-suami" role="tab" aria-controls="custom-tabs-one-data-suami" aria-selected="false">Data Suami</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-data-anak-tab" data-toggle="pill" href="#custom-tabs-one-data-anak" role="tab" aria-controls="custom-tabs-one-data-anak" aria-selected="false">Data Anak</a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-data-diri" role="tabpanel" aria-labelledby="custom-tabs-one-data-diri-tab">
                        @include('profile.form_profile.form_pribadi')
                    </div>
                    <!-- Data Ayah -->
                    <div class="tab-pane fade" id="custom-tabs-one-data-ayah" role="tabpanel" aria-labelledby="custom-tabs-one-data-ayah-tab">
                        @if($cek_data_ayah->count() == false)
                        <div class="card card-light card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-cek-data-tab" data-toggle="pill" href="#custom-tabs-one-cek-data" role="tab" aria-controls="custom-tabs-one-cek-data" aria-selected="true">Cek Data Ayah Yang Sudah Ada</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-input-tab" data-toggle="pill" href="#custom-tabs-one-input" role="tab" aria-controls="custom-tabs-one-input" aria-selected="true">Input Data Ayah</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-cek-data" role="tabpanel" aria-labelledby="custom-tabs-one-cek-data-tab">
                                        <form action="{{Route('data-hubungan-warga.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-body">
                                                    <center>
                                                        <h5 class="text-bold card-header bg-light p-0"> INPUT DATA AAYAH</h5>
                                                    </center>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="data_warga_id">Jenis Kelamin</label>
                                                        <select id="data_warga_id" name="data_warga_id" class="select3bs4 form-control col-12 @error('data_warga_id') is-invalid @enderror">
                                                            @if(old('data_warga_id') == true)
                                                            <option value="{{old('data_warga_id')}}">{{old('data_warga_id')}}</option>
                                                            @endif
                                                            <option value="">-- Pilih Keluarga --</option>
                                                            @foreach($data_warga_ayah as $data)
                                                            <option value="{{$data->id}}">{{$data->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('data_warga_id')
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                        @enderror
                                                        <input type="hidden" name="warga_id" id="warga_id" value="{{$data_pribadi->id}}">
                                                        <input type="hidden" name="hubungan" id="hubungan" value="Ayah">
                                                        <hr>
                                                        <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambahkan Ayah</button>
                                                        <div id="tombol_proses"></div>
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade show" id="custom-tabs-one-input" role="tabpanel" aria-labelledby="custom-tabs-one-input-tab">
                                        <form action="{{Route('data-warga.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-body">
                                                    <center>
                                                        <h5 class="text-bold card-header bg-light p-0"> INPUT DATA</h5>
                                                    </center>
                                                    <hr>
                                                    <input type="hidden" name="user" id="user" value="{{$data_pribadi->id}}"> <!-- Umtuk membedakan input dari pribadi dan admin-->
                                                    <input type="hidden" name="hubungan" id="hubungan" value="Ayah"> <!-- Umtuk membedakan input dari pribadi dan admin-->
                                                    <input type="hidden" name="jenis_kelamin" id="jenis_kelamin" value="Laki-Laki">
                                                    @include('profile.form_profile.form_input_data')
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        @include('profile.form_profile.form_ayah')
                        @endif
                    </div>
                    <!-- Data Ibu -->
                    <div class="tab-pane fade" id="custom-tabs-one-data-ibu" role="tabpanel" aria-labelledby="custom-tabs-one-data-ibu-tab">
                        @if($cek_data_ibu->count() == false)
                        <div class="card card-light card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-cek-ibu-tab" data-toggle="pill" href="#custom-tabs-one-cek-ibu" role="tab" aria-controls="custom-tabs-one-cek-ibu" aria-selected="true">Cek Data Ibu Yang Sudah Ada</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-input-ibu-tab" data-toggle="pill" href="#custom-tabs-one-input-ibu" role="tab" aria-controls="custom-tabs-one-input-ibu" aria-selected="true">Input Data Ibu</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-cek-ibu" role="tabpanel" aria-labelledby="custom-tabs-one-cek-ibu-tab">
                                        <form action="{{Route('data-hubungan-warga.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-body">
                                                    <center>
                                                        <h5 class="text-bold card-header bg-light p-0"> INPUT DATA IBU</h5>
                                                    </center>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="data_warga_id">Jenis Kelamin</label>
                                                        <select id="data_warga_id" name="data_warga_id" class="select3bs4 form-control col-12 @error('data_warga_id') is-invalid @enderror">
                                                            @if(old('data_warga_id') == true)
                                                            <option value="{{old('data_warga_id')}}">{{old('data_warga_id')}}</option>
                                                            @endif
                                                            <option value="">-- Pilih Keluarga --</option>
                                                            @foreach($data_warga_ibu as $data)
                                                            <option value="{{$data->id}}">{{$data->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('data_warga_id')
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                        @enderror
                                                        <input type="hidden" name="warga_id" id="warga_id" value="{{$data_pribadi->id}}">
                                                        <input type="hidden" name="hubungan" id="hubungan" value="Ibu">
                                                        <hr>
                                                        <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambahkan Ibu</button>
                                                        <div id="tombol_proses"></div>
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade show" id="custom-tabs-one-input-ibu" role="tabpanel" aria-labelledby="custom-tabs-one-input-ibu-tab">
                                        <form action="{{Route('data-warga.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-body">
                                                    <center>
                                                        <h5 class="text-bold card-header bg-light p-0"> INPUT DATA</h5>
                                                    </center>
                                                    <hr>
                                                    <input type="hidden" name="user" id="user" value="{{$data_pribadi->id}}"> <!-- Umtuk membedakan input dari pribadi dan admin-->
                                                    <input type="hidden" name="hubungan" id="hubungan" value="Ibu"> <!-- Umtuk membedakan input dari pribadi dan admin-->
                                                    <input type="hidden" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan">
                                                    @include('profile.form_profile.form_input_data')
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        @include('profile.form_profile.form_ibu')
                        @endif
                    </div>
                    <!-- Data Suami -->
                    <div class="tab-pane fade" id="custom-tabs-one-data-suami" role="tabpanel" aria-labelledby="custom-tabs-one-data-suami-tab">
                        @if($cek_data_suami->count() == false)
                        <div class="card card-light card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-cek-suami-tab" data-toggle="pill" href="#custom-tabs-one-cek-suami" role="tab" aria-controls="custom-tabs-one-cek-suami" aria-selected="true">Cek Data suami Yang Sudah Ada</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-input-suami-tab" data-toggle="pill" href="#custom-tabs-one-input-suami" role="tab" aria-controls="custom-tabs-one-input-suami" aria-selected="true">Input Data suami</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-cek-suami" role="tabpanel" aria-labelledby="custom-tabs-one-cek-suami-tab">
                                        <form action="{{Route('data-hubungan-warga.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-body">
                                                    <center>
                                                        <h5 class="text-bold card-header bg-light p-0"> INPUT DATA SUAMI</h5>
                                                    </center>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="data_warga_id">Jenis Kelamin</label>
                                                        <select id="data_warga_id" name="data_warga_id" class="select3bs4 form-control col-12 @error('data_warga_id') is-invalid @enderror">
                                                            @if(old('data_warga_id') == true)
                                                            <option value="{{old('data_warga_id')}}">{{old('data_warga_id')}}</option>
                                                            @endif
                                                            <option value="">-- Pilih Keluarga --</option>
                                                            @foreach($data_warga_ayah as $data)
                                                            <option value="{{$data->id}}">{{$data->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('data_warga_id')
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                        @enderror
                                                        <input type="hidden" name="warga_id" id="warga_id" value="{{$data_pribadi->id}}">
                                                        <input type="hidden" name="hubungan" id="hubungan" value="Suami">
                                                        <hr>
                                                        <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambahkan suami</button>
                                                        <div id="tombol_proses"></div>
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade show" id="custom-tabs-one-input-suami" role="tabpanel" aria-labelledby="custom-tabs-one-input-suami-tab">
                                        <form action="{{Route('data-warga.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-body">
                                                    <center>
                                                        <h5 class="text-bold card-header bg-light p-0"> INPUT DATA</h5>
                                                    </center>
                                                    <hr>
                                                    <input type="hidden" name="user" id="user" value="{{$data_pribadi->id}}"> <!-- Umtuk membedakan input dari pribadi dan admin-->
                                                    <input type="hidden" name="hubungan" id="hubungan" value="Suami"> <!-- Umtuk membedakan input dari pribadi dan admin-->
                                                    <input type="hidden" name="jenis_kelamin" id="jenis_kelamin" value="Laki-Laki">
                                                    @include('profile.form_profile.form_input_data')
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        @include('profile.form_profile.form_suami')
                        @endif
                    </div>
                    <div class=" tab-pane fade" id="custom-tabs-one-data-istri" role="tabpanel" aria-labelledby="custom-tabs-one-data-istri-tab">
                        @if($cek_data_istri->count() == false)
                        <div class="card card-light card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-cek-istri-tab" data-toggle="pill" href="#custom-tabs-one-cek-istri" role="tab" aria-controls="custom-tabs-one-cek-istri" aria-selected="true">Cek Data istri Yang Sudah Ada</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-input-istri-tab" data-toggle="pill" href="#custom-tabs-one-input-istri" role="tab" aria-controls="custom-tabs-one-input-istri" aria-selected="true">Input Data istri</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-cek-istri" role="tabpanel" aria-labelledby="custom-tabs-one-cek-istri-tab">
                                        <form action="{{Route('data-hubungan-warga.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-body">
                                                    <center>
                                                        <h5 class="text-bold card-header bg-light p-0"> INPUT DATA ISTRI</h5>
                                                    </center>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="data_warga_id">Jenis Kelamin</label>
                                                        <select id="data_warga_id" name="data_warga_id" class="select3bs4 form-control col-12 @error('data_warga_id') is-invalid @enderror">
                                                            @if(old('data_warga_id') == true)
                                                            <option value="{{old('data_warga_id')}}">{{old('data_warga_id')}}</option>
                                                            @endif
                                                            <option value="">-- Pilih Keluarga --</option>
                                                            @foreach($data_warga_ibu as $data)
                                                            <option value="{{$data->id}}">{{$data->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('data_warga_id')
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                        @enderror
                                                        <input type="hidden" name="warga_id" id="warga_id" value="{{$data_pribadi->id}}">
                                                        <input type="hidden" name="hubungan" id="hubungan" value="Istri">
                                                        <hr>
                                                        <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambahkan istri</button>
                                                        <div id="tombol_proses"></div>
                                                    </div>
                                                    <!-- /.card -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade show" id="custom-tabs-one-input-istri" role="tabpanel" aria-labelledby="custom-tabs-one-input-istri-tab">
                                        <form action="{{Route('data-warga.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-body">
                                                    <center>
                                                        <h5 class="text-bold card-header bg-light p-0"> INPUT DATA</h5>
                                                    </center>
                                                    <hr>
                                                    <input type="hidden" name="user" id="user" value="{{$data_pribadi->id}}"> <!-- Umtuk membedakan input dari pribadi dan admin-->
                                                    <input type="hidden" name="hubungan" id="hubungan" value="Istri"> <!-- Umtuk membedakan input dari pribadi dan admin-->
                                                    <input type="hidden" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan">

                                                    @include('profile.form_profile.form_input_data_suami_istri')
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        @include('profile.form_profile.form_istri')
                        @endif
                    </div>
                    <div class=" tab-pane fade" id="custom-tabs-one-data-anak" role="tabpanel" aria-labelledby="custom-tabs-one-data-anak-tab">
                        <div class="card card-light card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-cek-anak-tab" data-toggle="pill" href="#custom-tabs-one-cek-anak" role="tab" aria-controls="custom-tabs-one-cek-anak" aria-selected="true">Cek Data anak Yang Sudah Ada</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-input-anak-tab" data-toggle="pill" href="#custom-tabs-one-input-anak" role="tab" aria-controls="custom-tabs-one-input-anak" aria-selected="true">Input Data anak</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-cek-anak" role="tabpanel" aria-labelledby="custom-tabs-one-cek-anak-tab">
                                        <form action="{{Route('data-hubungan-warga.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-body">
                                                    <center>
                                                        <h5 class="text-bold card-header bg-light p-0"> INPUT DATA ANAK</h5>
                                                    </center>
                                                    <div class="form-group">
                                                        <label for="data_warga_id">Data Keluarga</label>
                                                        <select id="data_warga_id" name="data_warga_id" class="select3bs4 form-control col-12 @error('data_warga_id') is-invalid @enderror">
                                                            @if(old('data_warga_id') == true)
                                                            <option value="{{old('data_warga_id')}}">{{old('data_warga_id')}}</option>
                                                            @endif
                                                            <option value="">-- Pilih Keluarga --</option>
                                                            @foreach($data_warga as $data)
                                                            <option value="{{$data->id}}">{{$data->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('data_warga_id')
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <?php

                                                    use App\Models\DataWarga;
                                                    use App\Models\HubunganWarga;
                                                    use Illuminate\Support\Facades\Auth;

                                                    if (Auth::user()->data_warga->jenis_kelamin == "Laki-Laki") {
                                                        $cek_data_hubungan = HubunganWarga::where('hubungan', 'Suami')->where('data_warga_id', Auth::user()->data_warga_id)->count();
                                                    }
                                                    if (Auth::user()->data_warga->jenis_kelamin == "Perempuan") {
                                                        $cek_data_hubungan = HubunganWarga::where('hubungan', 'Istri')->where('data_warga_id', Auth::user()->data_warga_id)->count();
                                                    }

                                                    if (Auth::user()->data_warga->status_pernikahan == "Menikah") {
                                                        if ($cek_data_hubungan == 1) {
                                                            if (Auth::user()->data_warga->jenis_kelamin == "Laki-Laki") {
                                                                $data_hubungan_ayah = HubunganWarga::where('hubungan', 'Suami')->where('data_warga_id', Auth::user()->data_warga_id)->first();
                                                                $data_hubungan = DataWarga::find($data_hubungan_ayah->warga_id);
                                                            }
                                                            if (Auth::user()->data_warga->jenis_kelamin == "Perempuan") {
                                                                $data_hubungan_istri = HubunganWarga::where('hubungan', 'Istri')->where('data_warga_id', Auth::user()->data_warga_id)->first();
                                                                $data_hubungan = DataWarga::find($data_hubungan_istri->warga_id);
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    @if(Auth::user()->data_warga->status_pernikahan == "Menikah")
                                                    @if ($cek_data_hubungan == 1)
                                                    <div class="form-group">
                                                        <label for="warga_id_1">Nama Ayah </label>
                                                        <select id="warga_id_1" name="warga_id_1" class="select3bs4 form-control col-12 @error('warga_id_1') is-invalid @enderror">
                                                            <option value="{{$data_hubungan->id}}">{{$data_hubungan->nama}}</option>
                                                            <option value="">Bukan</option>
                                                        </select>
                                                    </div>
                                                    @endif
                                                    @endif
                                                    <input type="hidden" name="warga_id" id="warga_id" value="{{$data_pribadi->id}}">
                                                    <input type="hidden" name="hubungan" id="hubungan" value="Anak">
                                                    <hr>
                                                    <button onclick="tombol()" id="myBtn" type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Tambahkan anak</button>
                                                    <div id="tombol_proses"></div>
                                                    <!-- /.card -->

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade show" id="custom-tabs-one-input-anak" role="tabpanel" aria-labelledby="custom-tabs-one-input-anak-tab">
                                        <form action="{{Route('data-warga.store')}}" method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="card card-primary card-outline card-outline-tabs">
                                                <div class="card-body">
                                                    <center>
                                                        <h5 class="text-bold card-header bg-light p-0"> INPUT DATA</h5>
                                                    </center>
                                                    <hr>
                                                    <input type="hidden" name="user" id="user" value="{{$data_pribadi->id}}"> <!-- Umtuk membedakan input dari pribadi dan admin-->
                                                    <input type="hidden" name="hubungan" id="hubungan" value="Anak"> <!-- Umtuk membedakan input dari pribadi dan admin-->

                                                    @include('profile.form_profile.form_input_anak')
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php

                        use App\Models\FotoUser;
                        ?>
                        @foreach($cek_data_anak->get() as $data)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column" id="myMenu">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title"> <b>{{$data->data_warga->nama}}</b>
                                    </h5>

                                    <div class="card-tools">
                                        <button type="button" class="  btn btn-tool " data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php

                                $lahir    = new DateTime($data->data_warga->tanggal_lahir);
                                $today        = new DateTime();
                                $umur = $today->diff($lahir);

                                $foto = FotoUser::where('data_warga_id', $data->data_warga->id)->where('is_active', 1)->first();
                                ?>
                                <div class="card-body pt-0" id="card">
                                    <div class="row">
                                        <div class="col-7">
                                            <a href="{{Route('data_warga_detail',Crypt::encrypt($data->data_warga->id))}}" class="">
                                                <h2 class="lead" id="nama"><b>{{$data->data_warga->nama}}</b> ( {{$umur->y}} )</h2>
                                                <p class="text-muted text-sm"><b>Status: </b> {{$data->data_warga->status}} </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat: {{$data->data_warga->alamat}}</li>
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: {{$data->data_warga->no_hp}}</li>
                                                </ul>
                                            </a>
                                        </div>
                                        <div class="col-5 text-center">
                                            <a href="{{ asset($foto->foto) }}" data-toggle="lightbox" data-title="Foto {{ $data->data_warga->name }}" data-gallery="gallery">
                                                <img src="{{ asset($foto->foto) }}" alt="user-avatar" class="img-circle img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <a href="{{Route('data_hubungan_anak',Crypt::encrypt($data->data_warga->id))}}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-user"></i> Lihat Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<!-- /.row -->
@endsection

@section('script')
<script>
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataKeluarga").addClass("active");
</script>

@endsection