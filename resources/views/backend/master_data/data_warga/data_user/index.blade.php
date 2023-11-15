  @extends('backend.template_backend.layout')

  @section('content')
  <!-- ./row -->

  <div class="row">
      <div class="col-12 col-sm-12">
          <div class="card card-primary card-outline card-outline-tabs">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">DATA {{$data->data_warga->nama}} (
                          @if($data->is_active == 1)
                          Aktif
                          @else
                          Tidak Aktif
                          @endif)</h3>
                      @if($data->email_verified_at == true)
                      <label for="" class="text-success " style="font-size: 13px">Terverifiksi</label>
                      @else
                      <label for="" class="text-danger " style="font-size: 13px">Belum di Verifiksi</label>
                      @endif
                  </div>

                  <!-- /.card-header -->
                  <div class="card-body">
                      <form action="{{ route('user.update',Crypt::encrypt($data->id)) }}" method="post" enctype="multipart/form-data">
                          <table id="example1" class="table table-bordered table-striped">
                              <tbody>
                                  @method('PATCH')
                                  {{csrf_field()}}
                                  <tr>
                                      <td>Nama</td>
                                      <td>:</td>
                                      <td>{{$data->data_warga->nama}}</td>
                                  </tr>
                                  <tr>
                                      <td>User Name</td>
                                      <td>:</td>
                                      <td>
                                          <input type="text" class="col-12" name="name" id="name" value="{{$data->name}}">
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>Email</td>
                                      <td>:</td>
                                      <td>
                                          <input type="text" class="col-12" name="email" id="email" value="{{$data->email}}">
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>Kata Sandi</td>
                                      <td>:</td>
                                      <td>
                                          <input type="text" class="col-12" name="password" id="password"> <label class="text-danger " style="font-size: 13px">Jika tidak mau ganti kosongkan</label>
                                      </td>
                                  </tr>

                                  <tr>
                                      <td>Role </td>
                                      <td>:</td>
                                      <td>
                                          <select id="role_id" name="role_id" class="select2bs4 form-control @error('role_id') is-invalid @enderror">
                                              @if($data->role_id == true)
                                              <option value="{{$data->role_id}}">{{$data->role->nama_role}}</option>
                                              @endif
                                              @foreach($role as $data1)
                                              <option value="{{$data1->id}}">{{$data1->nama_role}}</option>
                                              @endforeach
                                          </select>
                                          @error('role_id')
                                          <div class="invalid-feedback">
                                              <strong>{{ $message }}</strong>
                                          </div>
                                          @enderror
                                      </td>
                                  </tr>

                              </tbody>
                          </table>
                          <button type="submit" class="btn btn-primary">Edit</button>
                      </form>
                      <!-- /.table-body -->

                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-12 col-sm-4">
          <div class="card card-primary card-outline card-outline-tabs">
              <div class="card">
                  <div class="card-body">
                      <center>
                          <h5 class="text-bold card-header bg-light p-0"> DATA PROGRAM</h5>
                      </center>
                      <hr>
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                              <tr class="bg-light">
                                  <th>No.</th>
                                  <th>Program</th>
                                  <th>Status</th>
                              </tr>
                          </thead>

                          <tbody>
                              <?php

                                use App\Models\AccessProgram;

                                $no = 0; ?>
                              @foreach($program as $data2)
                              <?php $no++;
                                $cek_access = AccessProgram::where('user_id', $data->id)->where('program_id', $data2->id);
                                ?>
                              <tr>
                                  <td>{{$no}}</td>
                                  <td>{{$data2->nama_program}}</td>
                                  <td>
                                      <form action="{{Route('access-program.store')}}" method="POST" enctype="multipart/form-data">
                                          {{csrf_field()}}
                                          <input type="hidden" name="user_id" id="user_id" value="{{$data->id}}">
                                          <input type="hidden" name="program_id" id="program_id" value="{{$data2->id}}">
                                          @if($cek_access->count() < '1' ) <button type="submit" class="btn btn-danger"> Belum Join</button>
                                              @else
                                              <button type="submit" class="btn btn-success"> Sudah Join</button>
                                              @endif
                                      </form>
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
      <div class="col-12 col-sm-4">
          <div class="card card-primary card-outline card-outline-tabs">
              <div class="card card-warning card-outline">
                  <div class="card-header">
                      <h5 class="text-bold card-header bg-light p-2 text-center"> Layouts App</h5>
                  </div>
                  <div class="card-body">
                      <form action="{{ Route('layout-app-user.update',Crypt::encrypt($data_layout_app->id)) }}" method="post" enctype="multipart/form-data">
                          @method('PATCH')
                          {{csrf_field()}}
                          <div class="form-group col-12">
                              <label for="navbar">Bagian Atas</label>
                              <input type="hidden" name="user_id" id="user_id" value="{{$data->id}}">
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
              <!-- /.card -->
          </div>
      </div>
      <div class="col-12 col-sm-4">
          <div class="card card-primary card-outline card-outline-tabs">

              <!-- /.card -->
          </div>
      </div>
  </div>
  </form>
  @endsection