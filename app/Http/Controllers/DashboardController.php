<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini = date("d-m-Y");
        $bulanini = date("m")*1;
        $tahunini = date("Y");
        $nik = Auth::guard('karyawan')->user()->nik;
        $presensihariini = DB::table('presensi')->where('nik', $nik)->where('tgl_presensi', $hariini)->first();
        $historibulanini = DB::table('presensi')->whereRaw('MONTH(tgl_presensi)="'.$bulanini . '"')
        ->leftJoin('jam_kerja', 'presensi.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulanini . '"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahunini . '"')
        ->orderBy('tgl_presensi', 'desc')
        ->get();

        $rekap = DB::table('presensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > jam_masuk ,1,0)) as jmlterlambat')
        ->leftJoin('jam_kerja','presensi.kode_jam_kerja', '=', 'jam_kerja.kode_jam_kerja')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulanini . '"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahunini . '"')
        ->first();

        $leaderboard = DB::table('presensi')
        ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
        ->where('tgl_presensi', $hariini)
        ->orderBy('jam_in', 'asc')
        ->get();
        $namabulan = ["", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $rekapizin = DB::table('perizinan')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_izin)="'.$bulanini . '"')
        ->whereRaw('YEAR(tgl_izin)="'.$tahunini . '"')
        ->where('status_approved', 1)
        ->first();
        $rekapcuti = DB::table('cuti')
        ->selectRaw('COUNT(status_cuti) as jmlcuti')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_cuti_dari)="'.$bulanini . '"')
        ->whereRaw('YEAR(tgl_cuti_dari)="'.$tahunini . '"')
        ->where('status_approved', 1)
        ->first();
        return view('dashboard.dashboard', compact('presensihariini', 'historibulanini', 'namabulan', 'bulanini', 'tahunini'
        ,'rekap', 'leaderboard', 'rekapizin', 'rekapcuti'));
    }

    public function dashboardadmin()
    {
        $hariini = date("Y-m-d");
        $rekap = DB::table('presensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > "07:33",1,0)) as jmlterlambat')
        ->where('tgl_presensi', $hariini)
        ->first();

        $rekapizin = DB::table('perizinan')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('tgl_izin', $hariini)
        ->where('status_approved', 1)
        ->first();

        $rekapcuti = DB::table('cuti')
        ->selectRaw('COUNT(status_cuti) as jmlcuti')
        ->where('tgl_cuti_dari', $hariini)
        ->where('tgl_cuti_sampai', $hariini)
        ->where('status_approved', 1)
        ->first();

        return view('dashboard.dashboardadmin', compact('rekap', 'rekapizin', 'rekapcuti'));
    }

}
