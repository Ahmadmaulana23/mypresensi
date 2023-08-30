@extends('layouts.presensi')

@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">History Presensi</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
    @endsection
@section('content')
<div class="row" style="margin-top:70px">
    <div class="col">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <select name="bulan" id="bulan" class="form-control">
                    <option value="">Bulan</option>
                    @for ($i=1; $i<=12; $i++)
                        <option value = "{{ $i }}"> {{ $namabulan[$i] }} </option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <select name="tahun" id="tahun" class="form-control">
                    <option value="">Tahun</option>
                    @php
                    $tahunmulai = 2022;
                    $tahunskrg = date("Y");
                    @endphp
                    @for ($tahun = $tahunmulai; $tahun <= $tahunskrg; $tahun++)
                    <option value = "{{ $tahun }}"> {{ $tahun }}  </option>
                    @endfor
                </select>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <button class="btn btn-primary btn-block" id="cari">Cari</button>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col" id="showhistori">
        </div>
    </div>
</div>
@endsection

@push('myscript')
<script>
    $(function(){
        $("#cari").click(function(e){
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            $.ajax({
                type: 'POST',
                url: '/gethistori',
                data: {
                    _token: "{{ csrf_token() }}",
                    bulan: bulan,
                    tahun: tahun
                },
                cache: false,
                success: function(respond) {
                    $("#showhistori").html(respond);
                }

            });

        });
    });


</script>

@endpush
