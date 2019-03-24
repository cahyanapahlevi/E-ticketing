<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

                return redirect('manager')->with('Data tidak sesuai, Silahkan Login ulang!!!');
            }
        }
        else{
            return redirect('manager')->with('alert','Password atau Email, Salah!');
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
	/*Penambahan Pagination tiket (rita)*/
    public function ticket()
    {
    	$lihat = DB::table('permintaan')->paginate(2);
		
		return view('manager/ticket',compact('lihat'));
    }
    public function dticket()
    {
        $users = DB::table('PROYEK')
            ->rightJoin('PROGRAMMER', 'PROYEK.ID_PROGRAMMER', '=', 'PROGRAMMER.ID_PROGRAMMER')
            ->get()->all();
        return view('manager/dticket',compact('users'));
    }
	public function eticket()
    {
        return view('manager/eticket');
    }
	/*Penambahan pagination pada halaman report (rita)*/
	    public function report()
    {
         $page = DB::table('permintaan')->paginate(2);
		
		return view('manager/report',compact('page'));
    }
	/*Pnambahan untuk melihat report sesuai dengan bulan dan tahun yang dipilih(rita)*/
	 public function showreport(Request $req)
    {
        $month = $req->month;
		$year = $req->year;
		$page =DB::table('permintaan')->whereYear('timeline', '=', $year)
              ->whereMonth('timeline', '=', $month)
              ->paginate(5);
			return view('manager/report',compact('page'));
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



public function tticket(Request $request)
    {
		
        DB::table('PROYEK')->insert([
		'ID_PROYEK' => $request->ID_PROYEK,
		'ID_PROGRAMMER' => $request->ID_PROGRAMMER,
		'PROGRAMMER1' => $request->PROGRAMMER1,
		'PROGRAMMER2' => $request->PROGRAMMER2,
		'NAMA_PROYEK' => $request->NAMA_PROYEK,
		'INSTANSI_PROYEK' => $request->INSTANSI_PROYEK,
		'DESKRIPSI_PROYEK' => $request->DESKRIPSI_PROYEK,
		'PLATFORM_PROYEK' => $request->PLATFORM_PROYEK,
		'DEADLINE_PROYEK' => $request->DEADLINE_PROYEK,
		'STATUS_PROYEK' => $request->STATUS_PROYEK
		
		]);
		
		return redirect('manager/dticket');
    }
	public function update(Request $request)
    {
        DB::table('PROYEK')->where('ID_PROYEK',$request->ID_PROYEK)->update([
		'STATUS_PROYEK' => $request->STATUS_PROYEK
		]);
		
		return redirect('manager/ticket');
    }
	/*Penambahan proses menu aktifitas (rita)*/
	public function aktifitas()
    {
		
	   $siswa = DB::table('tiket')
            ->join('permintaan', 'tiket.id_permintaan', '=', 'permintaan.id_permintaan')
            ->select('tiket.id_tiket', 'tiket.task', 'tiket.aktifitas', 'tiket.progress', 'tiket.timeline2', 'permintaan.permintaan_app')
            ->paginate(2);
		
		return view('manager/aktifitas',compact('siswa'));
    }
	/*Penambahan untuk mecari data sesuai proyek di menu aktifitas(rita)*/
	public function cari(Request $request)
	{
		$cari = $request->cari;
		
		$siswa = DB::table('tiket')
		->join('permintaan', 'tiket.id_permintaan', '=', 'permintaan.id_permintaan')
        ->where('permintaan_app','like',"%".$cari."%")
		->get();
		
		return view('manager/aktifitas',compact('siswa'));
	}

}
