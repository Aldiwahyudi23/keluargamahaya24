@extends('backend.template_backend.layout')
@section('content')
<div class="col-md-12">
  <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title text-capitalize">Ubah Email {{ Auth::user()->name }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('pengaturan.ubah-email') }}" method="post">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="email-old">Email Lama</label>
              <input id="email-old" type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
            </div>
            <div class="form-group">
              <label for="email">Email Baru</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" autofocus autocomplete="off">
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a href="#" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
        <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Update</button>
      </div>
    </form>
  </div>
  <!-- /.card -->
</div>
@endsection
@section('script')

<script>
  $("#Pengaturan").addClass("active");
</script>
@endsection