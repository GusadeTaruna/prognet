<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function nasabah()
    {
        $nasabah = DB::table('tb_simpanan') 
            ->join('tb_jenis_transaksi', 'tb_jenis_transaksi.id','=','tb_simpanan.jenis_transaksi')
            ->join('tb_anggota', 'tb_anggota.id', '=', 'tb_simpanan.anggota_id')
            ->select(DB::raw('sum(tb_simpanan.nominal_transaksi * tb_jenis_transaksi.tipe) as saldo'), 'tb_anggota.*')
            ->groupBy('tb_anggota.id')
            ->get();

        return view('reportNasabah',compact('nasabah'));
    }

    public function show($id)
    {
            $riwayat = DB::table('tb_simpanan')->join('tb_jenis_transaksi', 'tb_jenis_transaksi.id','=','tb_simpanan.jenis_transaksi')
            ->join('tb_anggota', 'tb_anggota.id', '=', 'tb_simpanan.anggota_id')
            ->select('no_anggota','nama','tanggal','transaksi','nominal_transaksi','jenis_transaksi')
            ->where('tb_anggota.id','=',$id)->orderBy('tb_simpanan.tanggal','ASC')
            ->get();

            return view('riwayatNasabah',compact('riwayat'));
    }

    public function indexHarian()
    {
        return view('reportHarian');
    }

    public function harian(Request $request)
    {

        $harian= DB::table('tb_simpanan')->join('tb_jenis_transaksi', 'tb_jenis_transaksi.id','=',
        'tb_simpanan.jenis_transaksi')
        ->select(DB::raw('date(tanggal) as tanggal'),'transaksi','nominal_transaksi','jenis_transaksi')
        ->where(DB::raw('date(tanggal)'),'=',$request->pilih_tanggal)
        ->get();

        return view('reportHarian',compact('harian'));
    }

    public function indexMingguan()
    {
        return view('reportMingguan');
    }

    public function mingguan(Request $request)
    {

        $angka = $_POST['pilih_tanggal'];
        $angka1 = str_replace("-W","", $angka);
        $week = substr($angka1, 4);
        $tahun = substr($angka1, 0,4);
        $mingguan = DB::table('tb_simpanan')->join('tb_jenis_transaksi', 'tb_jenis_transaksi.id','=','tb_simpanan.jenis_transaksi')
            ->select(DB::raw('week(tanggal) as minggu'),DB::raw('date(tanggal) as tanggal'),
        DB::raw('sum(nominal_transaksi) as total'),'transaksi','jenis_transaksi')
            ->where(DB::raw('week(tanggal)+1'),'=',$week)
            ->where(DB::raw('year(tanggal)'),'=',$tahun)
            ->groupBy('jenis_transaksi',DB::raw('date(tanggal)'))
            ->orderBy(DB::raw('date(tanggal)'))
            ->get();

        return view('reportMingguan',compact('mingguan','tahun','week','angka1','angka'));
    }

    public function indexBulanan()
    {
        return view('reportBulanan');
    }

    public function bulanan(Request $request)
    {
        $angka = $_POST['pilih_tanggal'];
        $angka1 = str_replace("-","", $angka);
        $bulan = substr($angka1, 4);
        $tahun = substr($angka1, 0,4);
        $bulanan = DB::table('tb_simpanan')
        ->join('tb_jenis_transaksi', 'tb_jenis_transaksi.id','=','tb_simpanan.jenis_transaksi')
        ->select(DB::raw('monthname(tanggal) as bulan'),DB::raw('week(tanggal)+1 as minggu'),
        DB::raw('sum(nominal_transaksi) as total'),'transaksi','jenis_transaksi')
            ->where(DB::raw('month(tanggal)'),'=',$bulan)->where(DB::raw('year(tanggal)'),'=',$tahun)
            ->groupBy('jenis_transaksi',DB::raw('week(tanggal)'))
            ->orderBy(DB::raw('week(tanggal)'))
            ->get();

        return view('reportBulanan',compact('bulanan','tahun','bulan','angka1','angka'));
    }
}
