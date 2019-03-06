<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Simpanan;
use App\Anggota;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;

class SimpananController extends Controller
{
    

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataSimpanan = DB::table('tb_simpanan')->select('tb_simpanan.*','tb_users.nama as nama_user','tb_anggota.no_anggota as nomer')
            ->join('tb_users', 'tb_simpanan.id_user', '=', 'tb_users.id')
            ->join('tb_anggota', 'tb_simpanan.anggota_id', '=', 'tb_anggota.id')
            ->get();
        return view('indexSimpanan',compact('dataSimpanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        $simpanan = DB::table('tb_simpanan')
            ->select('tb_simpanan.id','tb_simpanan.anggota_id','tb_anggota.no_anggota','tb_anggota.nama',DB::raw('SUM(nominal_transaksi * tipe) as saldo')) 
            ->join('tb_anggota','tb_simpanan.anggota_id','=','tb_anggota.id')
            ->join('tb_jenis_transaksi','tb_simpanan.jenis_transaksi','=','tb_jenis_transaksi.id')
            ->groupBy('tb_simpanan.anggota_id')
            ->get();
        $jenistransaksi = DB::table('tb_jenis_transaksi')->get();
        $anggota = DB::table('tb_anggota')->get();

        return view("createSimpanan",compact("anggota","jenistransaksi","simpanan","hasil"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $anggotaAktif = DB::table('tb_anggota')
            ->join('tb_users', 'tb_users.id', '=', 'tb_anggota.user_id')
            ->where('tb_anggota.id', $request->anggota_id)
            ->select('tb_anggota.*', 'tb_users.nama as nama_user')
            ->first();

        $cekSaldo = DB::table('tb_simpanan')
            ->join('tb_jenis_transaksi', 'tb_jenis_transaksi.id', '=', 'tb_simpanan.jenis_transaksi')
            ->join('tb_anggota', 'tb_anggota.id', '=', 'tb_simpanan.anggota_id')
            ->where('anggota_id', $request->anggota_id)
            ->select(DB::raw('sum(tb_simpanan.nominal_transaksi * tb_jenis_transaksi.tipe) as saldo'))
            ->first();

        $dataSimpanan = DB::table('tb_simpanan')
            ->select('tb_simpanan.*','tb_users.nama as nama_user','tb_anggota.nama as nama_anggota','tb_anggota.no_anggota as no_anggota','tb_jenis_transaksi.transaksi as transaksi','tb_jenis_transaksi.id as id_transaksi','tb_jenis_transaksi.tipe as tipe')
            ->join('tb_anggota', 'tb_simpanan.anggota_id', '=', 'tb_anggota.id')
            ->join('tb_users', 'tb_simpanan.id_user', '=', 'tb_users.id')
            ->join('tb_jenis_transaksi', 'tb_simpanan.jenis_transaksi', '=', 'tb_jenis_transaksi.id')
            ->where('tb_anggota.id', $request->anggota_id)
            ->orderByRaw('tb_simpanan.tanggal ')
            ->get();
        
        $saldo = 0;

        if ($request->jenis_transaksi == 2 && $request->nominal_transaksi>$cekSaldo->saldo) {
            echo "<script>alert('Saldo tidak mencukupi untuk melakukan transaksi')</script>";

             return view('detailSimpanan',compact('anggotaAktif','cekSaldo','dataSimpanan','saldo'));

        } 
        else {
            echo "<script>alert('Berhasil melakukan transaksi')</script>";
            $no = $request->anggota_id;
            $jenis = $request->jenis_transaksi;
            $nominal = $request->nominal_transaksi;
            $tanggal = $request->tanggal;
            $pendaftar=$request->id_user;

            DB::table('tb_simpanan')->insert(
                [
                'anggota_id' => $no, 
                'tanggal' => $tanggal,
                'jenis_transaksi' => $jenis,
                'nominal_transaksi' => $nominal,
                'id_user' => $pendaftar
                ]
            );

            $cekSaldo = DB::table('tb_simpanan')
                ->join('tb_jenis_transaksi', 'tb_jenis_transaksi.id', '=', 'tb_simpanan.jenis_transaksi')
                ->join('tb_anggota', 'tb_anggota.id', '=', 'tb_simpanan.anggota_id')
                ->where('anggota_id', $request->anggota_id)
                ->select(DB::raw('sum(tb_simpanan.nominal_transaksi * tb_jenis_transaksi.tipe) as saldo'))
                ->first();

            $dataSimpanan = DB::table('tb_simpanan')
                ->select('tb_simpanan.*','tb_users.nama as nama_user','tb_anggota.nama as nama_anggota','tb_anggota.no_anggota as no_anggota','tb_jenis_transaksi.transaksi as transaksi','tb_jenis_transaksi.id as id_transaksi','tb_jenis_transaksi.tipe as tipe')
                ->join('tb_anggota', 'tb_simpanan.anggota_id', '=', 'tb_anggota.id')
                ->join('tb_users', 'tb_simpanan.id_user', '=', 'tb_users.id')
                ->join('tb_jenis_transaksi', 'tb_simpanan.jenis_transaksi', '=', 'tb_jenis_transaksi.id')
                ->where('tb_anggota.id', $request->anggota_id)
                ->orderBy('tb_simpanan.tanggal','DESC')->take(10)
                ->get();

            $saldo = 0;

            return view('detailSimpanan',compact('anggotaAktif','cekSaldo','dataSimpanan','saldo'))->with('alert-success','Berhasil Menambahkan Data!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $simpanan = DB::table('tb_simpanan')
            ->where(['id'=>$id])
            ->get();

        return view('editSimpanan',compact('simpanan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $no = $request->input('id_anggota');
        $jenis = $request->input('jenis');
        $nominal = $request->input('nominal');
        $tanggal = $request->input('tgl');
        $pendaftar=$request->input('admin');

        DB::table('tb_simpanan')
        ->where('id', $id)
        ->update(
            [
            'anggota_id' => $no, 
            'tanggal' => $tanggal,
            'jenis_transaksi' => $jenis,
            'nominal_transaksi' => $nominal,
            'id_user' => $pendaftar
            ]
        );

        return redirect('/simpanan')->with('alert-success','Berhasil Menambahkan Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('tb_simpanan')
            ->where('id', $id)
            ->delete();

        return redirect('/simpanan');
    }

    public function jenisTrx(){
        $jenis = DB::table('tb_jenis_transaksi')
            ->get();

        return view('indexJenisTransaksi',compact('jenis'));    
    }

    public function report(){

         $sal = DB::table('tb_simpanan')->select('tb_simpanan.*','tb_anggota.no_anggota as nomer','tb_anggota.nama','tb_jenis_transaksi.transaksi','tb_simpanan.nominal_transaksi')
        ->join('tb_anggota', 'tb_simpanan.anggota_id', '=', 'tb_anggota.id')
        ->join('tb_jenis_transaksi','tb_simpanan.jenis_transaksi','=','tb_jenis_transaksi.id')
        ->get();
        return view('report',compact('sal'));
    }

    public function cariAnggota(Request $request){

        $anggotaAktif = DB::table('tb_anggota')
            ->join('tb_users', 'tb_users.id', '=', 'tb_anggota.user_id')
            ->where('tb_anggota.no_anggota', $request->idanggota) 
            ->select('tb_anggota.*', 'tb_users.nama as nama_user')
            ->first();

        $dataSimpanan = DB::table('tb_simpanan')
            ->select('tb_simpanan.*','tb_users.nama as nama_user','tb_anggota.nama as nama_anggota','tb_anggota.no_anggota as no_anggota','tb_jenis_transaksi.transaksi as transaksi','tb_jenis_transaksi.id as id_transaksi','tb_jenis_transaksi.tipe as tipe')
            ->join('tb_anggota', 'tb_simpanan.anggota_id', '=', 'tb_anggota.id')
            ->join('tb_users', 'tb_simpanan.id_user', '=', 'tb_users.id')
            ->join('tb_jenis_transaksi', 'tb_simpanan.jenis_transaksi', '=', 'tb_jenis_transaksi.id')
            ->where('tb_anggota.no_anggota', $request->idanggota)
            ->orderBy('tb_simpanan.tanggal','DESC')->take(10)
            ->get();
        
        $saldo = 0;

        if (empty($anggotaAktif)) {
             echo "<script> alert('Data Nasabah Tidak Ditemukan') </script>";

             return view('createSimpanan');
        }else if ($anggotaAktif->status_aktif==2) {
            echo "<script> alert('Nasabah telah nonaktif') </script>";

            return view('createSimpanan');
        }else{
            $cekSaldo = DB::table('tb_simpanan')
                ->join('tb_jenis_transaksi', 'tb_jenis_transaksi.id', '=', 'tb_simpanan.jenis_transaksi')
                ->join('tb_anggota', 'tb_anggota.id', '=', 'tb_simpanan.anggota_id')
                ->where('anggota_id', $anggotaAktif->id)
                ->select(DB::raw('sum(tb_simpanan.nominal_transaksi * tb_jenis_transaksi.tipe) as saldo'))
                ->first();  

            return view('detailSimpanan', compact('anggotaAktif', 'dataSimpanan','cekSaldo','saldo'));
    
        }
    }

}
