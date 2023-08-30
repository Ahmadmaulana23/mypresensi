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
    font-size: 10px;

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
<body class="A4 landscape">

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
                <h3><center>REKAP ABNORMAL PRESENSI KARYAWAN<br>
                PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
                SECTION BUILDING</center></h3>
            </td>
        </tr>
    </table>
    <table class="tablepresensi">
        <tr>
            <th rowspan="2">Nik</th>
            <th rowspan="2">Nama Karyawan</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">Total <br> Hadir</th>
            <th rowspan="2">Total <br> Terlambat</th>

        </tr>
        <tr>
            <?php
            for($i=1; $i<=31; $i++){
                ?>
                <th>{{ $i }}</th>
                <?php
            }
            ?>

        </tr>
        @foreach ($rekap as $d)
        <tr>
        <td>{{$d->nik}}</td>
        <td>{{$d->nama_lengkap}}</td>
        <?php
        $totalhadir = 0;
        $totalterlambat = 0;
            for($i=1; $i<=31; $i++){
                $tgl = "tgl_" .$i;
                if (empty($d->$tgl)) {
                    $hadir = ['',''];
                    $totalhadir += 0;
                }else{
                    $hadir = explode("-",$d->$tgl);
                    $totalhadir += 1;
                    if ($hadir[0] > $d->jam_masuk) {
                        $totalterlambat +=1;
                    }
                }
                ?>
                <td>
                    <span style="color:  {{ $hadir[0]> $d->jam_masuk? "red" : "" }}">{{ !empty($hadir[0] && $d->$tgl) ?  $hadir[0] : '' }}</span><br>
                    <span style="color:  {{ $hadir[1]< $d->jam_pulang ? "red" : "" }}">{{ !empty($hadir[1] && $d->$tgl) ?  $hadir[1] : '' }}</span>
                </td>

                <?php
            }
            ?>
            <td>{{$totalhadir}}</td>
            <td>{{$totalterlambat}}</td>
        </tr>
        @endforeach
    </table>

    <table width=100% style="margin-top : 100px">
    <tr>
        <td></td>
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
