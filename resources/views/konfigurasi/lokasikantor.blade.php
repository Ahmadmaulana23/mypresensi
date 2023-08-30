@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                  Konfigurasi Lokasi
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                    @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                    @endif
                                    @if (Session::get('warning'))
                                    <div class="alert alert-warning">
                                        {{Session::get('warning')}}
                                    </div>
                                    @endif
                                <form action="/konfigurasi/updatelokasi"  method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-12">
                                                <div class="input-icon mb-3">
                                                            <span class="input-icon-addon">
                                                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M3 7l6 -3l6 3l6 -3v13l-6 3l-6 -3l-6 3v-13"></path>
                                                            <path d="M9 4v13"></path>
                                                            <path d="M15 7v13"></path>
                                                            </svg>
                                                            </span>
                                                            <input type="text" value="{{ $lokasi_kantor->lokasi_kantor}}" id="lokasi_kantor" class="form-control" name="lokasi_kantor" placeholder="Lokasi Kantor">
                                                        </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                            <div class="row">
                                                <div class="col-12">
                                                <div class="input-icon mb-3">
                                                            <span class="input-icon-addon">
                                                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-radar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M21 12h-8a1 1 0 1 0 -1 1v8a9 9 0 0 0 9 -9"></path>
                                                            <path d="M16 9a5 5 0 1 0 -7 7"></path>
                                                            <path d="M20.486 9a9 9 0 1 0 -11.482 11.495"></path>
                                                            </svg>
                                                            </span>
                                                            <input type="text" value="{{ $lokasi_kantor->radius}}" id="radius" class="form-control" name="radius" placeholder="Radius">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary w-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                                                        </svg>
                                                        Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
