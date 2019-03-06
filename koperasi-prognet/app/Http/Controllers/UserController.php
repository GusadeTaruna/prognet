<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class UserController extends Controller
{
    public function login(){
    	return view('login');
    }	

    public function signin(Request $req){
    	$username = $req->input('username');
    	$password = $req->input('password');

    	$ceklogin = DB::table('tb_users')
        	->where(['username'=>$username,'password'=>$password])
        	->get();
    	if(count($ceklogin)>0){
    		return redirect('/dashboard')->with('alert-success','Login Sukses !');
    	}else{
    		echo "Login Gagal";
    	}
    }

    public function register(){
        return view('createKaryawan');
    }

    public function validasi(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'nik' => 'required',
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        } 

        else {
            return response()->json(['nik' => $request->nik , 'nama' => $request->nama, 'username' => $request->username
            , 'password' => $request->password]);
        }

    }

    public function signup(Request $request){
    	$nik = $request->nik;
    	$nama = $request->nama;
    	$uname = $request->username;
    	$pass = $request->password;
    	$u_role=$request->user_role;
        $status=$request->status_aktif;

    	DB::table('tb_users')->insert(
    		[
    		'nik' => $nik, 
    		'nama' => $nama,
    		'username' => $uname,
    		'password' => bcrypt($pass),
    		'user_role' => $u_role,
            'status_aktif' => $status
    		]
		);


        return response()->json(['success' => 'berhasil']);
    }

    public function dashboard(){
        $users = DB::table('tb_anggota')->count();
    	return view('dashboard',compact('users'));
    }

    public function karyawan(){
        $dataUser=DB::table('tb_users')->get();
        return view('indexUser',compact('dataUser'));
    }

    public function formedit($id)
    {
        $karyawan = DB::table('tb_users')
        ->where(['id'=>$id])
        ->get();
        return view('editKaryawan',compact('karyawan'));
    }

    public function detail($id)
    {
            $karyawan = DB::table('tb_users')
                        ->where('id', $id)
                        ->get();
                    
            $transaksi = DB::table('tb_simpanan')->select('tb_anggota.nama','tb_simpanan.*')
            ->join('tb_jenis_transaksi', 'tb_jenis_transaksi.id','=','tb_simpanan.jenis_transaksi')
            ->join('tb_anggota', 'tb_anggota.id', '=', 'tb_simpanan.anggota_id')
                        ->where("id_user", $id)
                        ->get();

            return view("detailKaryawan", compact("karyawan", "transaksi"));
    }

    public function nonaktif($id)
    {
            DB::table('tb_users')
            ->where('id',$id)
            ->update(['status_aktif' => 0]);

        return redirect('/user');
    }

    public function aktif($id)
    {
            DB::table('tb_users')
            ->where('id',$id)
            ->update(['status_aktif' => 1]);

        return redirect('/user');
    }

    public function check_update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nik' => 'required',
            'nama' => 'required',
            'user_role' => 'required'

        ]);
        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()->all()]);
        } 

        else {
            return response()->json(['nik' => $request->nik , 'nama' => $request->nama, 'user_role' => $request->user_role]);
        }

    }

    public function ubah(Request $request,$id){

        $nik = $request->nik;
        $nama = $request->nama;
        $uname = $request->username;
        $pass = $request->password;
        $u_role=$request->user_role;
        $status=$request->status_aktif;

        DB::table('tb_users')
        ->where('id', $id)
        ->update(
            [
            'nik' => $nik, 
            'nama' => $nama,
            'username' => $uname,
            'password' => bcrypt($pass),
            'user_role' => $u_role,
            'status_aktif' => $status
            ]
        );


        return response()->json(['success' => 'berhasil']);

    }



}
