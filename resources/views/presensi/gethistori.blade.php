@if ($histori->isEmpty())
<div class="alert alert-warning">
    <p>Data Tidak Ditemukan!</p>
</div>
@endif
@foreach ($histori as $d)
<ul class="listview image-listview">
<li>
    <div class="item">
    @php
    $path = Storage::url('uploads/absensi/'.$d->foto_in);
    @endphp
        <img src="{{ url ($path) }}" alt="image" class="image">
            <div class="in">
                <div>
                    <b> {{ date("d-m-Y", strtotime($d->tgl_presensi)) }}</b><br>

                        </div>
                        <span class="badge-success {{ $d->jam_in }}">{{ $d->jam_in}}</span>
                        <span class="badge-danger {{ $d->jam_out }}">{{ $d->jam_out}}</span>
                    </div>
            </div>
        </li>
    </ul>
@endforeach
