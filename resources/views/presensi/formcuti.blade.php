@extends('layouts.presensi')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    .datepicker-modal{
        max-height: 500px !important;
    }

    .datepicker-date-display{
        background-color: #0f3a7e !important;
    }
</style>

@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Form Pengajuan Cuti</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
    @endsection
    @section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <form action="/presensi/storecuti" method="POST" id="frmcuti">
                @csrf
                        <div class="form-group">
                            <input type="text" id="tgl_cuti" name="tgl_cuti" class="form-control datepicker" placeholder="Tanggal Mulai Cuti">
                        </div>
                        <div class="form-group">
                            <select name="status_cuti" id="status_cuti" class="form-control">
                                <option value="">Status (Cuti)</option>
                                <option value="L1">Pernikahan Karyawan(3Hari)</option>
                                <option value="L2">Pernikahan Anak Karyawan(2Hari)</option>
                                <option value="L3">Khitan atau Pembaptisan Anak Karyawan(2Hari)</option>
                                <option value="L4">Cuti Istri Melahirkan(3Hari)</option>
                                <option value="L5">Orang Tua/Mertua/Anak/Istri Meninggal Dunia(2Hari)</option>
                                <option value="L6">Kematian Anggota Keluarga dalam satu Rumah(1Hari)</option>
                                <option value="L7">Cuti Haid(2Hari)</option>
                                <option value="L8">Cuti Tahunan</option>
                                <option value="L9">Cuti Bencana Alam(1Hari)</option>
                                <option value="M">Karyawati Keguguran(1,5Bulan)</option>
                                <option value="B">Karyawati Melahirkan(3Bulan)</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5" placeholder="Keterangan"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary w-100">Submit</button>
                        </div>
            </form>
        </div>
    </div>

    @endsection
    @push('myscript')
<script>
    var currYear = (new Date()).getFullYear();

$(document).ready(function() {
  $(".datepicker").datepicker({

    format: "yyyy-mm-dd"
  });

  $("#tgl_cuti").change(function(e){
    var tgl_cuti = $(this).val();
    $.ajax({
        type:'POST',
        url:'/presensi/cekcuti',
        data:{
            _token: "{{ csrf_token() }}",
            tgl_izin:tgl_izin
        },
        cache:false,
        success: function(respond){
            if (respond == 1) {
                Swal.fire({
                title: 'Oops !',
                text: 'Anda telah melakukan permohonan cuti hari ini !',
                icon: 'warning'
                }).then((result) => {
                    $("#tgl_cuti").val("");
                });
            }
        }
    });
  });

  $("#frmcuti").submit(function(){
    var tgl_cuti = $("#tgl_cuti").val();
    var status = $("#status").val();
    var keterangan = $("#keterangan").val();
    if (tgl_cuti == "") {
        Swal.fire({
        title: 'Oops !',
        text: 'Tanggal Harus di Isi !',
        icon: 'warning'
        });
        return false;
    }else if (status == "") {
        Swal.fire({
        title: 'Oops !',
        text: 'Status Harus di Isi !',
        icon: 'warning'
        });
        return false;
    }else if (keterangan == "") {
        Swal.fire({
        title: 'Oops !',
        text: 'Keterangan Harus di Isi !',
        icon: 'warning'
        });
        return false;
    }
  });
});
</script>
@endpush
