<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
     public function login()
    {
        return view('manager/login');
    }
    public function home()
    {
    	return view('manager/home');
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
		$tabel_programer = DB::table('tabel_programer')->get();
		
        return view('manager/user',['tabel_programer' => $tabel_programer]);
    }
    public function edituser()
    {
		$tabel_programer = DB::table('tabel_programer')->where('id_programer',$id_programer)->get();
        return view('manager/edituser');
    }
	
	public function hapus($id_software)
{
	DB::table('software')->where('id_software',$id_software)->delete();
	return redirect('manager/user');
}
	
	public function tambah()
    
	{
		$deretakhir = DB::table('software')->orderBy('id_software','desc')->first();
		
		if( ! $deretakhir)
			$angka = 0;
		else
			$angka = substr($deretakhir->id_software,3);
			$cetak = 'P'. sprintf('%03d', intval($angka)+1);
		
        return view('manager/tuser', compact('cetak'));
    }
	public function tambahuser(Request $request)
{
	
	DB::table('software')->insert([
		'id_software' => $request->id_software,
		//'id_aplikasi' => $request->id_aplikasi,
		'username_software' => $request->username_software,
		'password_software' => $request->password_software,
		'divisi_software' => $request->divisi_software,
		'bidang_software' => $request->bidang_software
	]);
	
	return redirect('/manager/user');
 
}


public function edit($id_software)
{
	
	$software = DB::table('software')->where('id_software',$id_software)->get();
	
	return view('manager/euser',['software' => $software]);
 
}


public function update(Request $request)
{
	// update data pegawai
	DB::table('software')->where('id_software',$request->id_software)->update([
	//id_aplikasi' => $request->id_aplikasi,
		'username_software' => $request->username_software,
		'password_software' => $request->password_software,
		'divisi_software' => $request->divisi_software,
		'bidang_software' => $request->bidang_software
		
	]);
	
	return redirect('/manager/user');
}

}