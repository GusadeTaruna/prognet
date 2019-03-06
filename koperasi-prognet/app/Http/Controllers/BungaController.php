<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Date;

class BungaController extends Controller
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

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $dataMaster =  DB::table('tb_master_bunga_simpanan')
        ->get();
        return view('createBunga',compact('dataMaster'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $persentase = $request->persen;
        $tanggal = $request->berlaku;

        DB::table('tb_master_bunga_simpanan')
            ->insert(
            [
            'persentase' => $persentase, 
            'tanggal_mulai_berlaku' => $tanggal
            ]
        );

        return redirect('/bunga/create')->with('alert-success','Berhasil Menambahkan Data');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function prosesHitung(Request $request)
    {

        date_default_timezone_set('Asia/Makassar');
        $bulanNow = date('m');
        $tahunNow = date('Y');
        $dateNow = date('Y-m-d H:i:s');

        $getAnggota = DB::table('tb_anggota')->get();

        $cekTransaksiBulan = DB::table('tb_trx_perhitungan_bunga_simpanan')
            ->where([
                ['trx_bulan', '=', $bulanNow],
                ['trx_tahun', '=', $tahunNow]
            ])->select(DB::raw('count(*) as total'))
            ->get();

        $cekBunga = DB::table('tb_master_bunga_simpanan')
            ->select('tanggal_mulai_berlaku', 'persentase')
            ->orderByRaw('tanggal_mulai_berlaku DESC')
            ->where('tanggal_mulai_berlaku','<=', $dateNow)
            ->limit(1)
            ->get();

        foreach ($cekTransaksiBulan as $row) {
                
            if ($row->total > 0) {
                return redirect('/bunga');
            }
            
            else{
                foreach ($cekBunga as $bunga) {

                    DB::table('tb_trx_perhitungan_bunga_simpanan')
                        ->insert([
                            'trx_bulan' => $bulanNow,
                            'trx_tahun' => $tahunNow,
                            'tanggal_proses' => $dateNow,
                            'persentase_bunga' => $bunga->persentase,
                            'id_user' => $request->id_user
                        ]);

                    foreach ($getAnggota as $rowAnggota) {
                    
                        $cekTransaksiAnggota = DB::table('tb_simpanan')
                            ->where([
                                ['anggota_id', '=', $rowAnggota->id],
                                ['tanggal', '<=', DB::raw('DATE_SUB(NOW(), INTERVAL 1 MONTH)')]
                            ])
                            ->select('anggota_id','tanggal')
                            ->get();

                        foreach ($cekTransaksiAnggota as $rowAnggotaTransaksi) {
                            
                            if (!empty($rowAnggotaTransaksi->anggota_id)) {
                                
                                $cekSaldo = DB::table('tb_simpanan')
                                    ->join('tb_jenis_transaksi', 'tb_jenis_transaksi.id', '=', 'tb_simpanan.jenis_transaksi')
                                    ->join('tb_anggota', 'tb_anggota.id', '=', 'tb_simpanan.anggota_id')
                                    ->where('anggota_id', $rowAnggotaTransaksi->anggota_id)
                                    ->select(DB::raw('sum(tb_simpanan.nominal_transaksi * tb_jenis_transaksi.tipe) as saldo'))
                                    ->get();

                                foreach ($cekSaldo as $saldo) {

                                    $nominal_transaksi = $saldo->saldo * $bunga->persentase/100;
                                    DB::table('tb_simpanan')
                                    ->insert([
                                        'anggota_id' => $rowAnggotaTransaksi->anggota_id,
                                        'tanggal' => $dateNow,
                                        'jenis_transaksi' => '3',
                                        'nominal_transaksi' => $nominal_transaksi,
                                        'id_user' => $request->id_user
                                    ]);

                                }
                            }

                        }
                    }
                    
                }
                
                return redirect('/hitungbunga');
            }
        }

    }

    public function hitung(){
        date_default_timezone_set('Asia/Makassar');
        $bulanNow = date('m');
        $tahunNow = date('Y');
        $dateNow = date('Y-m-d H:i:s');

        $cekTransaksiBulan = DB::table('tb_trx_perhitungan_bunga_simpanan')
            ->where([
                ['trx_bulan', '=', $bulanNow],
                ['trx_tahun', '=', $tahunNow]
            ])->select(DB::raw('count(*) as total'))
            ->get();

        $dataMasterBunga = DB::table('tb_master_bunga_simpanan')
            ->orderByRaw('tanggal_mulai_berlaku DESC')
            ->where('tanggal_mulai_berlaku','<=', $dateNow)
            ->limit(1)
            ->get();

        return view('hitungBunga', compact('dataMasterBunga','cekTransaksiBulan','bulanNow','tahunNow'));
    }


}
