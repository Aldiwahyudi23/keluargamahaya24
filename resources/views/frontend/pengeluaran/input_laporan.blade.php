@extends('backend.template_backend.layout')

@section('content')
<!-- ./row -->
<div class="row">
    <div class="col-12 col-sm-6">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                @include('backend.transaksi.pengeluaran.form.anggaran')
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="card card-primary card-tabs">
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection