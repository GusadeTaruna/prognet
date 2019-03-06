<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use User;
use Validator;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function landing(){

        $users = DB::table('tb_anggota')->count();
        return view ('dashboard',compact('users'));
    }

    public function index()

    {
        $dataAnggota = DB::table('tb_anggota')->select('tb_anggota.*','tb_users.nama as nama_user')
        ->join('tb_users', 'tb_anggota.user_id', '=', 'tb_users.id')
        ->get();

        return view('indexAnggota',compact('dataAnggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggota = DB::table('tb_anggota')
        ->get();
        return view('createAnggota', compact('anggota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpan(Request $request){

        $no = $request->no_anggota;
        $nama = $request->nama;
        $alamat = $request->alamat;
        $telp = $request->telp;
        $ktp=$request->ktp;
        $jk = $request->kelamin;
        $status=$request->status;
        $pendaftar=$request->admin;

        DB::table('tb_anggota')->insert(
            [
            'no_anggota' => $no,
            'nama' => $nama,
            'alamat' => $alamat,
            'telepon' => $telp,
            'noktp' => $ktp,
            'kelamin_id' => $jk,
            'status_aktif' => $status,
            'user_id' => $pendaftar
            ]
        );

        return response()->json(['success' => 'berhasil']);
    }

    public function ubah(Request $request,$id){
        $nama = $request->nama;
        $alamat = $request->alamat;
        $telp = $request->telp;
        $ktp=$request->ktp;
        $jk = $request->kelamin;
        $status=$request->status;

        DB::table('tb_anggota')
        ->where('id', $id)
        ->update([
            'nama' => $nama,
            'alamat' => $alamat,
            'telepon' => $telp,
            'noktp' => $ktp,
            'kelamin_id' => $jk,
            'status_aktif' => $status
        ]);

        return response()->json(['success' => 'berhasil']);

    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'noktp' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        } 

        else {
            return response()->json(['nama' => $request->nama , 'alamat' => $request->alamat, 'telepon' => $request->telepon
            , 'noktp' => $request->noktp]);
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
        $anggota = DB::table('tb_anggota')
                        ->where('id', $id)
                        ->get();
                    
        $transaksi = DB::table('tb_simpanan')->join('tb_jenis_transaksi', 'tb_jenis_transaksi.id','=','tb_simpanan.jenis_transaksi')
                        ->where("anggota_id", $id)
                        ->orderBy("tb_simpanan.id", "DESC")
                        ->get();

        $cekSaldo = DB::table('tb_simpanan')
            ->join('tb_jenis_transaksi', 'tb_jenis_transaksi.id', '=', 'tb_simpanan.jenis_transaksi')
            ->join('tb_anggota', 'tb_anggota.id', '=', 'tb_simpanan.anggota_id')
            ->where('anggota_id', $id)
            ->select(DB::raw('sum(tb_simpanan.nominal_transaksi * tb_jenis_transaksi.tipe) as saldo'))
            ->first();

            return view("detailAnggota", compact("anggota","cekSaldo", "transaksi"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anggota = DB::table('tb_anggota')
        ->where(['id'=>$id])
        ->get();
        return view('editAnggota',compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(){

    }
    public function check_update(Request $request)
    {
        
         $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'noktp' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        } 

        else {
            return response()->json(['nama' => $request->nama , 'alamat' => $request->alamat, 'telepon' => $request->telepon
            , 'noktp' => $request->noktp]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            DB::table('tb_anggota')
            ->where('id',$id)
            ->update(['status_aktif' => 2]);

        return redirect('/anggota');
    }

    public function aktif($id)
    {
            DB::table('tb_anggota')
            ->where('id',$id)
            ->update(['status_aktif' => 1]);

        return redirect('/anggota');
    }



}
