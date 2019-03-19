<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Alert;

class ManagerController extends Controller
{
    public function login(){
        return view('manager/login');
    }

    public function masuk(Request $request)
    {

        $nama_manager =$request->nama_manager;
        $pass     =$request->pass;
        $data = DB::table('manager')->where('nama_manager',$nama_manager)->first();
        if($data){ 
            if(DB::table('manager')->where('pass',$pass)->first()){
                Session::put('name',$data->id_manager);
                Session::put('login',TRUE);
                return redirect('manager/home');
            }
            else{

                Alert::warning('Data tidak sesuai, Silahkan Login ulang!!!');
                return redirect('manager');
            }
        }
        else{
             Alert::error('Error Message', 'Optional Title')->autoclose(3500);

            //Alert::error('Password atau Email, Salah!');
            return redirect('manager');
        }
        /*$data= DB::table('manager')->where([
    ['nama_manager',$nama_manager],
    ['pass',$pass]
])->first();
        if($data){
                Session::put('name',$data->nama_manager);
                Session::put('login',TRUE);
                return redirect('manager/home');
            }
            else{
                return redirect('manager')->with('alert','Password atau Email, Salah!');
            }*/
        
}
     public function logout(){
        Session::flush();
        return redirect('manager')->with('alert-success','Kamu sudah logout');
    }
    public function home()
    {
          if(!Session::get('login')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
            return view('manager/home');
        }
    }
    public function ticket()
    {
    	return view('manager/ticket');
    }
    public function dticket()
    {
        return view('manager/dticket');
    }
	public function eticket()
    {
        return view('manager/eticket');
    }
	    public function report()
    {
        return view('manager/report');
    }
	    public function user()
    {
        return view('manager/user');
    }
    public function edituser()
    {
    $deretakhir = DB::table('manager')->orderBy('id_manager', 'desc')->first();

    if ( ! $deretakhir )
        $angka = 0;
    else 
        $angka = substr($deretakhir -> id_manager, 3); 
    $cetak = 'M' . sprintf('%04d', intval($angka) + 1);
     return view('manager/edituser',compact('cetak'));
}
 public function tambah(Request $request)
    {
        DB::table('manager')->insert([
            'id_manager' => $request->id_manager,
            'nama_manager' => $request->nama_manager,
            'pass' => $request->pass,
            'alamat' => $request->alamat]);
        return redirect('manager/edituser');
    }
}
