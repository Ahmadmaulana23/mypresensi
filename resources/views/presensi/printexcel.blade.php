<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A4 }
h3 { font-family: 'Times New Roman', Times, serif;
}

.tabledatakaryawan{
    margin-top: 40px;
}
.tabledatakaryawan tr td {
    padding: 5px;
}

.tablepresensi{
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}
.tablepresensi tr th {
    border: 1px solid #131212;
    padding: 6px;
    background-color: #eee;

}
.tablepresensi tr td{
    border: 1px solid #131212;
    padding: 5px;
}
.foto{
    width: 40px;
    height: 50px;
}
</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
    <table style="width: 100%">
        <tr>
            <td style="width: 30px">
                <img src="{{asset('assets/img/maxxis_logo.png')}}" width="170" height="130" alt="">
            </td>
            <td>
                <h3><center>LAPORAN ABNORMAL PRESENSI KARYAWAN<br>
                PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
                SECTION BUILDING</center></h3>
            </td>
        </tr>
    </table>
    <table class="tabledatakaryawan">
        <tr>
            <td rowspan="6">
                @php
                $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
                @endphp
                <img src="{{url($path)}}" alt="" width="150px" height="150px">
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{$karyawan->nik}}</td>
        </tr>
        <tr>
            <td>Nama </td>
            <td>:</td>
            <td>{{$karyawan->nama_lengkap}}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{$karyawan->jabatan}}</td>
        </tr>
         <tr>
            <td>Dept / Sect</td>
            <td>:</td>
            <td>{{$karyawan->nama_dept}}</td>
        </tr>
        <tr>
            <td>No. HP</td>
            <td>:</td>
            <td>{{$karyawan->no_hp}}</td>
        </tr>
    </table>
    <table class="tablepresensi">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
            <th>Keterangan</th>
        </tr>
        @foreach ($presensi as $d)
        @php
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ date("d-m-Y", strtotime($d->tgl_presensi)) }}</td>
            <td>{{$d->jam_in}}</td>
            <td>{{$d->jam_out != null ? $d->jam_out : 'Belum Absen'}}</td>
            <td>
                @if ($d->jam_in > '07:33')
                Terlambat
                @else
                Tepat Waktu
                @endif
            </td>
        </tr>
        @endforeach
    </table>
    <table width=100% style="margin-top : 100px">
    <tr>
        <td colspan="2" style="text-align: right;">Cikarang, {{ date('d-m-Y') }}</td>
    </tr>
        <tr>
            <td style="text-align: center; vertical-align:bottom" height= "200px">
                <u>Mamat</u> <br>
                <i><b>Spv Building</b></i>
            </td>
            <td style="text-align: center;vertical-align:bottom" height= "200px">
                <u>Marlon</u> <br>
                <i><b>HRD Manager</b></i>
            </td>
        </tr>
    </table>
  </section>

</body>

</html>
