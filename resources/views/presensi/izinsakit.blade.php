@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                  Data Izin / Sakit
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row">
                    <div class="col-12">
                        <form action="/presensi/izinsakit" method="GET" autocomplete="off">
                            <div class="row">
                                <div class="col-2">
                                <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M16 2a1 1 0 0 1 .993 .883l.007 .117v1h1a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h1v-1a1 1 0 0 1 1.993 -.117l.007 .117v1h6v-1a1 1 0 0 1 1 -1zm3 7h-14v9.625c0 .705 .386 1.286 .883 1.366l.117 .009h12c.513 0 .936 -.53 .993 -1.215l.007 -.16v-9.625z" stroke-width="0" fill="currentColor"></path>
                                <path d="M12 12a1 1 0 0 1 .993 .883l.007 .117v3a1 1 0 0 1 -1.993 .117l-.007 -.117v-2a1 1 0 0 1 -.117 -1.993l.117 -.007h1z" stroke-width="0" fill="currentColor"></path>
                                </svg>
                                </span>
                                <input type="text" value="{{Request('dari')}}" id="dari" class="form-control" name="dari" placeholder="Dari">
                              </div>
                            </div>
                    <div class="col-2">
                                <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M16 2a1 1 0 0 1 .993 .883l.007 .117v1h1a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h1v-1a1 1 0 0 1 1.993 -.117l.007 .117v1h6v-1a1 1 0 0 1 1 -1zm3 7h-14v9.625c0 .705 .386 1.286 .883 1.366l.117 .009h12c.513 0 .936 -.53 .993 -1.215l.007 -.16v-9.625z" stroke-width="0" fill="currentColor"></path>
                                <path d="M12 12a1 1 0 0 1 .993 .883l.007 .117v3a1 1 0 0 1 -1.993 .117l-.007 -.117v-2a1 1 0 0 1 -.117 -1.993l.117 -.007h1z" stroke-width="0" fill="currentColor"></path>
                                </svg>
                                </span>
                                <input type="text" value="{{Request('sampai')}}" id="sampai" class="form-control" name="sampai" placeholder="Sampai">
                              </div>
                            </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-3">
                              <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-123" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <path d="M3 10l2 -2v8"></path>
                                  <path d="M9 8h3a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-2a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h3"></path>
                                  <path d="M17 8h2.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-1.5h1.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1 -1.5 1.5h-2.5"></path>
                                </svg>
                                </span>
                                <input type="text" value="{{Request('nik')}}" id="nik" class="form-control" name="nik" placeholder="Nik">
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                  <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                                </span>
                                <input type="text" value="{{ Request('nama_lengkap')}}" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Nama Karyawan">
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <select name="status_approved" id="status_approved" class="form-select">
                                  <option value="">Pilih Status</option>
                                  <option value="0"{{Request('status_approved') === '0' ? 'selected' : '' }}>Pending</option>
                                  <option value="1"{{Request('status_approved') == 1 ? 'selected' : ''}}>Disetuji</option>
                                  <option value="2"{{Request('status_approved') == 2 ? 'selected' : ''}}>Ditolak</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-3">
                              <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                  <path d="M21 21l-6 -6"></path>
                                </svg>
                                Cari
                                </button>
                              </div>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nik</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Approval</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @foreach($izinsakit as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d-m-Y', strtotime($d->tgl_izin)) }}</td>
                                <td>{{ $d->nik }}</td>
                                <td>{{ $d->nama_lengkap }}</td>
                                <td>{{ $d->jabatan }}</td>
                                <td>{{ $d->status == "i" ? "Izin" : "Sakit" }}</td>
                                <td>{{ $d->keterangan }}</td>
                                <td>
                                    @if($d->status_approved ==1)
                                    <span class="badge bg-success">Disetujui</span>
                                    @elseif($d->status_approved ==2)
                                    <span class="badge bg-danger">Ditolak</span>
                                    @else
                                    <span class="badge bg-warning">Pending</span>
                                    @endif
                                    </td>
                                    <td>
                                        @if ($d->status_approved ==0)
                                        <a href="#" id="approve" class="btn btn-sm btn-primary" id="approve" id_izinsakit="{{$d->id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M9 12l2 2l4 -4"></path>
                                        <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
                                        </svg>
                                        </a>
                                        @else
                                        <a href="/presensi/{{$d->id}}/batalkan" class="btn btn-sm btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z"></path>
                                        <path d="M9 9l6 6m0 -6l-6 6"></path>
                                        </svg>Batalkan</a>
                                        @endif
                                    </td>
                            </tr>
                            @endforeach
                        </table>
                            {{ $izinsakit->links()}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Izin / Sakit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/presensi/approveizinsakit" method="POST">
                @csrf
                <input type="hidden" id="id_izinsakit_form" name="id_izinsakit_form">
                <div class="form-group">
                    <div class="row"><div class="col-12">
                        <div class="form-group">
                        <select name="status_approved" id="status_approved" class="form-select">
                            <option value="1">Disetujui</option>
                            <option value="2">Ditolak</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary w-100" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M14 4l0 4l-6 0l0 -4"></path>
                                </svg>Submit
                            </button>
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
@push('myscript')
<script>
    $(function(){
        $("#approve").click(function(e){
            e.preventDefault();
            var id_izinsakit = $(this).attr("id_izinsakit");
            $("#id_izinsakit_form").val(id_izinsakit);
            $("#modal-izinsakit").modal("show");
        });
        $("#dari, #sampai").datepicker({
        autoclose: true,
        todayHighlight: true,
        format : 'yyyy-mm-dd'
  });
    });
</script>
@endpush
