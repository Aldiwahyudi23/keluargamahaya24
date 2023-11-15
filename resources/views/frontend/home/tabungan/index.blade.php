@extends('backend.template_backend.layout')

@section('content')
<div class="col-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <h3 class="profile-username text-center">{{ Auth::user()->data_warga->nama }}</h3>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<div class="alert alert-info alert-dismissible fade show col-12" role="alert">
    <center><b> NABUNG LAH !!!</b> <br> "Seringkali, semakin banyak uang yang Anda hasilkan, semakin banyak pengeluaran Anda. Alasan tersebutlah yang menjadi penyebab uang yang Anda miliki tersebut tidak bisa membuat Anda kaya, namun yang membuat Anda kaya adalah aset." – Robert T. Kiyosaki.</center>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        @include('backend.transaksi.pengajuan.form.form_tabungan')
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link show active" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Tabungan Masuk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Mutasi</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                <table id="table2" class="table table-bordered table-striped table-responsive">
                                    @include('frontend.home.tabungan.pemasukan')
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                                <table id="table3" class="table table-bordered table-striped table-responsive">
                                    @include('frontend.home.tabungan.pengeluaran')
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div><!--/. container-fluid -->
</section>
@endsection
@section('script')
<script>
    $("#bayar").addClass("active");
</script>
@endsection