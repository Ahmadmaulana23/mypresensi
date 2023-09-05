@extends('layouts.presensi')
@section('header')
 <!-- App Header -->
 <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Presensi Gagal</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->

    <style>
    .webcam-capture,
    .webcam-capture video{
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 15px;

    }
    #map {
        height: 200px;
    }

    .jam-digital-malasngoding {

 background-color: #27272783;
 position: absolute;
 top: 65px;
 right: 10px;
 z-index: 9999;
 width: 150px;
 border-radius: 10px;
 padding: 5px;
}



.jam-digital-malasngoding p {
 color: #fff;
 font-size: 16px;
 text-align: center;
 margin-top: 0;
 margin-bottom: 0;
}
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
@endsection
@section('content')
<div class="row" style="margin-top : 60px">
<div class="col">
    <div class="alert alert-warning">
        <p>
            Maaf, Anda tidak memiliki jadwal kerja hari ini.
            Silahkan hubungi Leader !!!
        </p>
    </div>
    </div>
</div>






@endsection
