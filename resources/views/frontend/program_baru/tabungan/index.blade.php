 @extends('template.home')
 @section('content')
 <div class="col-12">
     <!-- Profile Image -->
     <div class="card card-primary card-outline">
         <div class="card-body box-profile">
             <div class="text-center">
                 <img src="{{ asset( Auth::user()->foto) }}" width="130px" class="profile-user-img img-fluid img-circle" alt="User profile picture">
             </div>
             <h3 class="profile-username text-center">{{ $user->nama }}</h3>
             <h5 class="profile-username text-center">( {{ $user->name }} )</h5>
             <!-- <p class="text-muted text-center">{{ Auth::user()->role }}</p> -->
             <ul class="list-group list-group-unbordered mb-3">
                 <li class="list-group-item">
                     <b>Program </b> <a href="{{route('detail.anggota.kas',Crypt::encrypt($user->id))}}" class="float-right">{{ $user->program1 }}</a>
                 </li>
                 @if (Auth::user()->role == "Admin" || Auth::user()->role == "Bendahara" || Auth::user()->role == "Sekertaris")
                 <li class="list-group-item">
                     <b></b> <a href="{{route('detail.anggota.tabungan',Crypt::encrypt($user->id))}}" class="float-right">{{ $user->program2 }}</a>
                 </li>
                 @endif
             </ul>
         </div>
         <!-- /.card-body -->
     </div>
     <!-- /.card -->
 </div>
 <div class="alert alert-info alert-dismissible fade show col-12" role="alert">
     <center><b> NABUNG a LAH !!!</b> <br> "Seringkali, semakin banyak uang yang Anda hasilkan, semakin banyak pengeluaran Anda. Alasan tersebutlah yang menjadi penyebab uang yang Anda miliki tersebut tidak bisa membuat Anda kaya, namun yang membuat Anda kaya adalah aset." – Robert T. Kiyosaki.</center>
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
                         @include('pengajuan.form_tabungan')
                     </div>
                 </div>
             </div>
             <div class="col-12 col-sm-6">
                 <div class="card">
                     <div class="card-body">
                         <table id="example1" class="table table-bordered table-striped table-responsive">
                             @include('pemasukan.table.kas_user')
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div><!--/. container-fluid -->
 </section>
 @endsection

 
 @section('script')
<!-- SCrip Untuk tanda bukti pembayaran -->
<script>
    $(document).ready(function() {
        $('#pembayaran').change(function() {
            var kel = $('#pembayaran option:selected').val();
            if (kel == "Transfer") {
                $("#noId").html('<label for="account-company">Bukti Transfer</label><input type="file" class="form-control col-12" name="foto" id="foto" required /><span class="text-danger" style="font-size: 13px">Harap kirim tanda bukti transferan.</span>');
            } else {
                $("#noId").html('');
            }
        });
    });
</script>

<script>
    function tombol_kas() {
        if (document.getElementById("myBtn_kas").hidden = true) {
            // membuat objek elemen
            // alert("Nuju di proses...");
            var hasil = document.getElementById("tombol_proses");
            hasil.innerHTML = "Nuju di proses ...";
        }
    }
</script>

<script>
    let jumlah_kas = document.getElementById("jumlah");
    let button_kas = document.getElementById("myBtn_kas");
    button_kas.disabled = true;
    jumlah_kas.addEventListener("change", stateHandle);

    function stateHandle() {
        if (document.getElementById("jumlah").value <= 49999) {
            button_kas.disabled = true;
        } else {
            button_kas.disabled = false;
        }
    }
</script>
@endsection