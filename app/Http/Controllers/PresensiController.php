<?php

namespace App\Http\Controllers;

use App\Models\Pengajuancuti;
use App\Models\Pengajuanizin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function gethari()
    {
        $hari = date("D");

        switch ($hari) {
            case 'Sun':
                $hari_ini = "Minggu";
                break;
            case 'Mon':
                $hari_ini = "Senin";
                break;
            case 'Tue':
                $hari_ini = "Selasa";
                break;
            case 'Wed':
                $hari_ini = "Rabu";
                break;
            case 'Thu':
                $hari_ini = "Kamis";
                break;
            case 'Fri':
                $hari_ini = "Jumat";
                break;
            case 'Sat':
                $hari_ini = "Sabtu";
                break;
            default:
            $hari_ini = "Tidak di ketahui";
            break;

        }
        return $hari_ini;
    }
    public function create()
    {
        $hariini = date("Y-m-d");
        $namahari = $this->gethari();
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nik',$nik)->count();
        $lokasi_kantor = DB::table('konfig_lokasi')->where('id', 1)->first();
        $jamkerja = DB::table('konfig_jamkerja')
        ->join('jam_kerja','konfig_jamkerja.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('nik', $nik)->where('hari', $namahari)->first();
        if ($jamkerja ==null) {
            return view('presensi.notif');
        }else{
        return view('presensi.create', compact('cek', 'lokasi_kantor','jamkerja'));
        }
    }


    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        $lokasi_kantor = DB::table('konfig_lokasi')->where('id', 1)->first();
        $lok = explode(",",$lokasi_kantor->lokasi_kantor);
        $laltitudekantor = $lok[0];
        $longitudekantor = $lok[1];
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];
        $jarak = $this->distance($laltitudekantor, $longitudekantor,$latitudeuser, $longitudeuser);
        $radius = round($jarak["meters"]);
        $namahari = $this->gethari();
        $jamkerja = DB::table('konfig_jamkerja')
        ->join('jam_kerja','konfig_jamkerja.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('nik', $nik)->where('hari', $namahari)->first();

        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();


        if ($cek > 0) {
            $ket = "out";
        }else{
            $ket = "in";
        }
        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nik . "-" . $tgl_presensi . "-" . $ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath .$fileName;


        if ($radius > $lokasi_kantor->radius) {
            echo "error|Maaf Anda Berada Diluar Radius Kantor|";
        }else {

        if ($cek > 0) {
            if($jam < $jamkerja->jam_pulang) {
                echo "error|Maaf Belum Waktunya Pulang|out";
            }else{
                $data_pulang = [
                    'jam_out' => $jam,
                    'foto_out'=> $fileName,
                    'lokasi_out'=> $lokasi
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data_pulang);
                if ($update) {
                    echo "success|Terimakasih, Hati Hati Dijalan|out";
                    Storage::put($file, $image_base64);
                }else {
                    echo "error|Gagal Absen !|out";
                    }
                }
            }else{
                if ($jam < $jamkerja->awal_jam_masuk) {
                    echo "error|Belum Waktunya Melakukan Presensi|in";
                }else if ($jam > $jamkerja->akhir_jam_masuk) {
                    echo "error|Gagal, Waktu Melakukan Presensi Telah Habis|in";
                }else{
                    $data = [
                        'nik' => $nik,
                        'tgl_presensi' => $tgl_presensi,
                        'jam_in' => $jam,
                        'foto_in' => $fileName,
                        'lokasi_in' => $lokasi,
                        'kode_jam_kerja' => $jamkerja->kode_jam_kerja
                    ];
                    $simpan = DB::table('presensi')->insert($data);
                    if ($simpan) {
                        echo "success|Selamat Bekerja|in";
                        Storage::put($file, $image_base64);
                    }else {
                        echo "error|Gagagl Absen !|in";
                    }
                }
        }
    }

}

    //Radius Kantor
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editprofile()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        return view('presensi.editprofile', compact('karyawan'));
    }

    public function updateprofile(Request $request)
    {
        $nik =Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $jabatan = $request->jabatan;
        $password = Hash::make($request->password);
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        if ($request->hasFile('foto')){
            $foto = $nik.".". $request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = $karyawan->foto;
        }

        if (empty($request ->password)) {
                $data = [
                    'nama_lengkap' => $nama_lengkap,
                    'no_hp' => $no_hp,
                    'jabatan' => $jabatan,
                    'foto' => $foto
                ];
        }else{
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'jabatan' => $jabatan,
                'password' => $password,
                'foto' => $foto

            ];
        }

        $update = DB::table('karyawan')->where('nik', $nik)->update($data);
        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/uploads/karyawan/";
                $request->file('foto')-> storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        }else{
            return Redirect::back()->with(['error' => 'Data Gagal Diupdate !']);
        }
    }

    public function histori()
    {
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        return view('presensi.histori', compact('namabulan'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;
        $histori = DB::table('presensi')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan . '"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun . '"')
        ->orderBy('tgl_presensi')
        ->get();

        return view('presensi.gethistori', compact('histori'));
    }

    public function izin()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $dataizin = DB::table('perizinan')->where('nik', $nik)->get();
        return view('presensi.izin', compact('dataizin'));
    }

    public function formizin()
    {
        return view('presensi.formizin');
    }
    public function storeizin(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'nik' => $nik,
            'tgl_izin' => $tgl_izin,
            'status' => $status,
            'keterangan' => $keterangan
        ];

        $simpan = DB::table('perizinan')->insert($data);

        if ($simpan) {
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Disimpan']);
        }else {
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal Disimpan']);
        }
    }
    public function cuti()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $datacuti = DB::table('cuti')->where('nik', $nik)->get();
        return view('presensi.cuti', compact('datacuti'));
    }
    public function formcuti()
    {
        return view('presensi.formcuti');
    }
    public function storecuti(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_cuti_dari = $request->tgl_cuti_dari;
        $tgl_cuti_sampai = $request->tgl_cuti_sampai;
        $status_cuti = $request->status_cuti;
        $keterangan = $request->keterangan;

        $data = [
            'nik' => $nik,
            'tgl_cuti_dari' => $tgl_cuti_dari,
            'tgl_cuti_sampai' => $tgl_cuti_sampai,
            'status_cuti' => $status_cuti,
            'keterangan' => $keterangan
        ];

        $simpan = DB::table('cuti')->insert($data);

        if ($simpan) {
            return redirect('/presensi/cuti')->with(['success' => 'Pengajuan Cuti Berhasil Disimpan']);
        }else {
            return redirect('/presensi/cuti')->with(['error' => 'Pengajuan Cuti Gagal Disimpan']);
        }
    }

    public function monitoring()
    {
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')
        ->select('presensi.*','nama_lengkap','nama_dept','jam_masuk','nama_jam_kerja','jam_masuk','jam_pulang')
        ->leftJoin('jam_kerja', 'presensi.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->join('karyawan', 'presensi.nik','=','karyawan.nik')
        ->join('departemen','karyawan.kode_dept','=','departemen.kode_dept')
        ->where('tgl_presensi', $tanggal)
        ->get();

        return view('presensi.getpresensi', compact('presensi'));
    }
    public function showmap(Request $request)
    {
        $id = $request->id;
        $presensi = DB::table('presensi')->where('id', $id)
        ->join('karyawan', 'presensi.nik','=','karyawan.nik')
        ->first();
        return view('presensi.showmap', compact('presensi'));
    }
    public function laporan()
    {
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober",
        "November","Desember"];
        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')->get();
        return view('presensi.laporan', compact('namabulan', 'karyawan'));
    }
    public function print(Request $request)
    {
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober",
        "November","Desember"];
        $karyawan = DB::table('karyawan')->where('nik', $nik)
        ->join('departemen', 'karyawan.kode_dept','=','departemen.kode_dept')
        ->first();
        $presensi = DB::table('presensi')
        ->leftJoin('jam_kerja', 'presensi.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan . '"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun . '"')
        ->orderBy('tgl_presensi', 'asc')
        ->get();
        if (isset($_POST['export'])){
            $time = date("d-M-Y");
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename= Laporan Presensi $time.xls");
            return view('presensi.printexcel', compact('bulan', 'tahun','namabulan', 'karyawan','presensi'));
        }
        return view('presensi.print', compact('bulan', 'tahun','namabulan', 'karyawan','presensi'));
    }
    public function rekap()
    {
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober",
        "November","Desember"];
        return view('presensi.rekap', compact('namabulan'));
    }
    public function printrekap (Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober",
        "November","Desember"];
        $rekap = DB::table('presensi')
        ->selectRaw('presensi.nik,nama_lengkap,jam_masuk,jam_pulang,
        MAX(IF(DAY(tgl_presensi) = 1,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_1,
        MAX(IF(DAY(tgl_presensi) = 2,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_2,
        MAX(IF(DAY(tgl_presensi) = 3,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_3,
        MAX(IF(DAY(tgl_presensi) = 4,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_4,
        MAX(IF(DAY(tgl_presensi) = 5,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_5,
        MAX(IF(DAY(tgl_presensi) = 6,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_6,
        MAX(IF(DAY(tgl_presensi) = 7,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_7,
        MAX(IF(DAY(tgl_presensi) = 8,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_8,
        MAX(IF(DAY(tgl_presensi) = 9,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_9,
        MAX(IF(DAY(tgl_presensi) = 10,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_10,
        MAX(IF(DAY(tgl_presensi) = 11,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_11,
        MAX(IF(DAY(tgl_presensi) = 12,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_12,
        MAX(IF(DAY(tgl_presensi) = 13,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_13,
        MAX(IF(DAY(tgl_presensi) = 14,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_14,
        MAX(IF(DAY(tgl_presensi) = 15,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_15,
        MAX(IF(DAY(tgl_presensi) = 16,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_16,
        MAX(IF(DAY(tgl_presensi) = 17,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_17,
        MAX(IF(DAY(tgl_presensi) = 18,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_18,
        MAX(IF(DAY(tgl_presensi) = 19,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_19,
        MAX(IF(DAY(tgl_presensi) = 20,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_20,
        MAX(IF(DAY(tgl_presensi) = 21,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_21,
        MAX(IF(DAY(tgl_presensi) = 22,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_22,
        MAX(IF(DAY(tgl_presensi) = 23,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_23,
        MAX(IF(DAY(tgl_presensi) = 24,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_24,
        MAX(IF(DAY(tgl_presensi) = 25,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_25,
        MAX(IF(DAY(tgl_presensi) = 26,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_26,
        MAX(IF(DAY(tgl_presensi) = 27,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_27,
        MAX(IF(DAY(tgl_presensi) = 28,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_28,
        MAX(IF(DAY(tgl_presensi) = 29,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_29,
        MAX(IF(DAY(tgl_presensi) = 30,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_30,
        MAX(IF(DAY(tgl_presensi) = 31,CONCAT(jam_in,"-",IFNULL(jam_out,"Belum Absen")),"")) AS tgl_31')
        ->join('karyawan', 'presensi.nik','=', 'karyawan.nik')
        ->leftJoin('jam_kerja', 'presensi.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan . '"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun . '"')
        ->groupByRaw('presensi.nik,nama_lengkap,jam_masuk,jam_pulang')
        ->get();

        if (isset($_POST['export'])){
            $time = date("d-M-Y");
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename= Rekap Presensi $time.xls");
        }

        return view('presensi.printrekap', compact('bulan', 'tahun','namabulan', 'rekap'));
    }

    public function izinsakit(Request $request)
    {

        $query = Pengajuanizin::query();
        $query->select('id','tgl_izin', 'perizinan.nik', 'nama_lengkap', 'jabatan','status','status_approved', 'keterangan');
        $query->join('karyawan','perizinan.nik','=','karyawan.nik');
        if (!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('tgl_izin', [$request->dari, $request->sampai]);
        }
        if (!empty($request->nik)){
            $query->where('perizinan.nik', $request->nik);
        }
        if (!empty($request->nama_lengkap)){
            $query->where('nama_lengkap','like', '%'. $request->nama_lengkap . '%');
        }
        if ($request->status_approved == '0' || $request->status_approved == '1' || $request->status_approved == '2'){
            $query->where('status_approved', $request->status_approved);
        }
        $query->orderBy('tgl_izin', 'desc');
        $izinsakit = $query->paginate(10);
        $izinsakit->appends($request->all());
        return view('presensi.izinsakit' ,compact('izinsakit'));
    }
    public function approveizinsakit(Request $request)
    {
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;
        $update = DB::table('perizinan')->where('id', $id_izinsakit_form)->update([
            'status_approved' => $status_approved
        ]);
        if($update){
            return Redirect::back()->with(['success'=>'Data Berhasil Diupdate']);
        }else {
            return Redirect::back()->with(['warning'=>'Data Gagal Diupdate']);
        }

    }
    public function batalkan($id)
    {
        $update = DB::table('perizinan')->where('id', $id)->update([
            'status_approved' => 0
        ]);
        if($update){
            return Redirect::back()->with(['success'=>'Data Berhasil Diupdate']);
        }else {
            return Redirect::back()->with(['warning'=>'Data Gagal Diupdate']);
        }
    }
    public function cekizin(Request $request)
    {
        $tgl_izin = $request->tgl_izin;
        $nik = Auth::guard('karyawan')->user()->nik;

        $cek = DB::table('perizinan')->where('nik', $nik)->where('tgl_izin', $tgl_izin)->count();
        return $cek;
    }
    public function pengajuancuti(Request $request)
    {

        $query = Pengajuancuti::query();
        $query->select('id','tgl_cuti_dari', 'tgl_cuti_sampai','cuti.nik', 'nama_lengkap', 'jabatan','status_cuti','status_approved', 'keterangan');
        $query->join('karyawan','cuti.nik','=','karyawan.nik');
        if (!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('tgl_cuti_dari , tgl_cuti_sampai', [$request->dari, $request->sampai]);
        }
        if (!empty($request->nik)){
            $query->where('cuti.nik', $request->nik);
        }
        if (!empty($request->nama_lengkap)){
            $query->where('nama_lengkap','like', '%'. $request->nama_lengkap . '%');
        }
        if ($request->status_approved == '0' || $request->status_approved == '1' || $request->status_approved == '2'){
            $query->where('status_approved', $request->status_approved);
        }
        $query->orderBy('tgl_cuti_dari', 'desc');
        $pengajuancuti = $query->paginate(10);
        $pengajuancuti->appends($request->all());
        return view('presensi.pengajuancuti' ,compact('pengajuancuti'));
    }
    public function approvecuti(Request $request)
    {
        $status_approved = $request->status_approved;
        $id_cuti_form = $request->id_cuti_form;
        $update = DB::table('cuti')->where('id', $id_cuti_form)->update([
            'status_approved' => $status_approved
        ]);
        if($update){
            return Redirect::back()->with(['success'=>'Data Berhasil Diupdate']);
        }else {
            return Redirect::back()->with(['warning'=>'Data Gagal Diupdate']);
        }

    }
    public function batalkancuti($id)
    {
        $update = DB::table('cuti')->where('id', $id)->update([
            'status_approved' => 0
        ]);
        if($update){
            return Redirect::back()->with(['success'=>'Data Berhasil Diupdate']);
        }else {
            return Redirect::back()->with(['warning'=>'Data Gagal Diupdate']);
        }
    }

    public function cekcuti(Request $request)
    {
        $tgl_cuti = $request->tgl_cuti;
        $nik = Auth::guard('karyawan')->user()->nik;

        $cek = DB::table('cuti')->where('nik', $nik)->where('tgl_cuti', $tgl_cuti)->count();
        return $cek;
    }

}
