@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                  Konfigurasi Jam Kerja
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
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
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-12">
                                        <a href="#" class="btn btn-success" id="btntambahjk">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                    </svg>Tambah Jam Kerja
                                    </a>
                                    </div>
                                </div>
                                <div class="row mt-2">
                        <div class="col-12">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Jam Kerja</th>
                                <th>Nama Jam Kerja</th>
                                <th>Awal Jam Masuk</th>
                                <th>Jam Masuk</th>
                                <th>Akhir Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($jam_kerja as $d)
                        <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->kode_jam_kerja }}</td>
                                <td>{{ $d->nama_jam_kerja }}</td>
                                <td>{{ $d->awal_jam_masuk }}</td>
                                <td>{{ $d->jam_masuk }}</td>
                                <td>{{ $d->akhir_jam_masuk }}</td>
                                <td>{{ $d->jam_pulang }}</td>
                                <td>
                                <div class="btn-group">
                                    <a href="#" class="edit btn btn-info btn-sm" kode_jam_kerja="{{ $d->kode_jam_kerja }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                    </svg>
                                    </a>
                                    <form action="/konfigurasi/{{ $d->kode_jam_kerja }}/delete" method="POST" style="margin-left: 5px">
                                        @csrf
                                        <a class="btn btn-danger btn-sm delete-confirm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor"></path>
                                        <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor"></path>
                                        </svg>
                                        </a>
                                    </form>
                                    </div>
                                </td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-inputjk" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Jam Kerja</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/konfigurasi/storejamkerja" method="POST" id="formjk" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-code-dots" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M15 12h.01" />
                                <path d="M12 12h.01" />
                                <path d="M9 12h.01" />
                                <path d="M6 19a2 2 0 0 1 -2 -2v-4l-1 -1l1 -1v-4a2 2 0 0 1 2 -2" />
                                <path d="M18 19a2 2 0 0 0 2 -2v-4l1 -1l-1 -1v-4a2 2 0 0 0 -2 -2" />
                                </svg>
                                </span>
                                <input type="text" value="" id="kode_jam_kerja" class="form-control" name="kode_jam_kerja" placeholder="Kode Jam Kerja">
                              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-abc" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 16v-6a2 2 0 1 1 4 0v6" />
                                <path d="M3 13h4" />
                                <path d="M10 8v6a2 2 0 1 0 4 0v-1a2 2 0 1 0 -4 0v1" />
                                <path d="M20.732 12a2 2 0 0 0 -3.732 1v1a2 2 0 0 0 3.726 1.01" />
                                </svg>
                                </span>
                                <input type="text" value="" id="nama_jam_kerja" class="form-control"
                                name="nama_jam_kerja" placeholder="Nama Jam Kerja">
                              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-7" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 12l-2 3" />
                                <path d="M12 7v5" />
                                </svg>
                                </span>
                                <input type="text" value="" id="awal_jam_masuk" class="form-control"
                                name="awal_jam_masuk" placeholder="Awal Jam Masuk">
                              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-8" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 12l-3 2" />
                                <path d="M12 7v5" />
                                </svg>
                                </span>
                                <input type="text" value="" id="jam_masuk" class="form-control"
                                name="jam_masuk" placeholder="Jam Masuk">
                              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-12" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 7v5" />
                                </svg>
                                </span>
                                <input type="text" value="" id="akhir_jam_masuk" class="form-control"
                                name="akhir_jam_masuk" placeholder="Akhir Jam Masuk">
                              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-5" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M12 12l2 3" />
                                <path d="M12 7v5" />
                                </svg>
                                </span>
                                <input type="text" value="" id="jam_pulang" class="form-control"
                                name="jam_pulang" placeholder="Jam Pulang">
                              </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-success ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                        <path d="M14 4l0 4l-6 0l0 -4"></path>
                        </svg>Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal modal-blur fade" id="modal-editjk" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Jam Kerja</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="loadeditform">

          </div>
        </div>
      </div>
    </div>
@endsection
@push('myscript')
<script>
    $(function(){
        $("#btntambahjk").click(function(){
            $("#modal-inputjk").modal("show");
        });
        $(".delete-confirm").click(function(e){
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
            title: 'Anda Yakin ?',
            text: "Ingin Hapus Data ini ! ",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus !'
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                'Terhapus!',
                'Data Berhasil di Hapus',
                'success'
                )
            }
            })
        });

        $("#formjk").submit(function(){
            var kode_jam_kerja = $("#kode_jam_kerja").val();
            var nama_jam_kerja = $("#nama_jam_kerja").val();
            var awal_jam_masuk = $("#awal_jam_masuk").val();
            var jam_masuk = $("#jam_masuk").val();
            var akhir_jam_masuk = $("#akhir_jam_masuk").val();
            var jam_pulang = $("#jam_pulang").val();
            if(kode_jam_kerja == ""){
                Swal.fire({
                title: 'Warning!',
                text: 'Kode Jam Kerja harus di isi !',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#kode_jam_kerja").focus();

                });
                return false;
            }else if(nama_jam_kerja == ""){
                Swal.fire({
                title: 'Warning!',
                text: 'Nama Jam Kerja Harus di isi !',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#nama_jam_kerja").focus();

                });
                return false;
            }else if(awal_jam_masuk == ""){
                Swal.fire({
                title: 'Warning!',
                text: 'Awal Jam Masuk harus di isi !',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#awal_jam_masuk").focus();

                });
                return false;

            }else if(jam_masuk == ""){
                Swal.fire({
                title: 'Warning!',
                text: 'Jam Masuk Harus di isi !',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#jam_masuk").focus();
                });
                return false;
            }else if(akhir_jam_masuk == ""){
                Swal.fire({
                title: 'Warning!',
                text: 'Akhir Jam Masuk Harus di isi !',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#akhir_jam_masuk").focus();
                });
                return false;
            }else if(jam_pulang == ""){
                Swal.fire({
                title: 'Warning!',
                text: 'Jam Pulang Harus di isi !',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#jam_pulang").focus();
                });
                return false;
            }
        });
        $(".edit").click(function(){
            var kode_jam_kerja = $(this).attr('kode_jam_kerja');
            $.ajax({
                type: 'POST',
                url:'/konfigurasi/editjamkerja',
                cache: false,
                data: {
                    _token: "{{ csrf_token(); }}",
                    kode_jam_kerja: kode_jam_kerja
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });
            $("#modal-editjk").modal("show");
        });
    });
</script>
@endpush
