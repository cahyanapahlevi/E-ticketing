<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ManagerController extends Controller
{
    public function login(){
        return view('manager/login');
    }

    public function masuk(Request $request)
    {

        $nama_manager =$request->nama_manager;
        $pass     =$request->pass;
        $data = DB::table('manager')->where('USERNAME_MANAGER',$nama_manager)->first();
        if($data){ 
            if(DB::table('manager')->where('PASSWORD_MANAGER',$pass)->first()){
                Session::put('ID',$data->ID_MANAGER);
                Session::put('nama',$data->USERNAME_MANAGER);
                Session::put('login',TRUE);
                return redirect('manager/home');
            }
            else{

                return redirect('manager')->with('alert','Data Tidak Sesuai Silahkan Login Ulang!');
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
  public function ticket()
    {
		$lihat = DB::table('proyek')->get()->all();
				return view('manager/ticket',compact('lihat'));
    }
    public function dticket()
    {
        $users = DB::table('proyek')
            ->rightJoin('programer', 'proyek.ID_PROGRAMER', '=', 'programer.ID_PROGRAMER')
            ->get()->all();
			
			$deretakhir = DB::table('programer')->orderBy('ID_PROGRAMER','desc')->first();
		
		if( ! $deretakhir)
			$angka = 0;
		else
			$angka = substr($deretakhir->ID_PROGRAMER,3);
			$cetak = 'PR'. sprintf('%04d', intval($angka)+1);
        return view('manager/dticket',compact('users'),compact('cetak'));
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
		$programer = DB::table('programer')->get();
		
        return view('manager/user',['programer' => $programer]);
    }
    public function edituser()
    {
		$tabel_programer = DB::table('programer')->where('ID_PROGRAMER',$ID_PROGRAMER)->get();
        return view('manager/edituser');
    }
	
	public function hapus($ID_PROGRAMER)
{
	DB::table('programer')->where('ID_PROGRAMER',$ID_PROGRAMER)->delete();
	return redirect('manager/user');
}
	
	public function tambah()
    
	{
		$deretakhir = DB::table('programer')->orderBy('ID_PROGRAMER','desc')->first();
		
		if( ! $deretakhir)
			$angka = 0;
		else
			$angka = substr($deretakhir->ID_PROGRAMER,3);
			$cetak = 'P'. sprintf('%03d', intval($angka)+1);
		
        return view('manager/tuser', compact('cetak'));
    }
	public function tambahuser(Request $request)
{
	
	DB::table('programer')->insert([
		'ID_PROGRAMER' => $request->ID_PROGRAMER,
		//'id_aplikasi' => $request->id_aplikasi,
		'USERNAME_PROGRAMER' => $request->USERNAME_PROGRAMER,
		'PASSWORD_PROGRAMER' => $request->PASSWORD_PROGRAMER,
		'DIVISI_PROGRAMER' => $request->DIVISI_PROGRAMER,
		'BIDANG_PROGRAMER' => $request->BIDANG_PROGRAMER
	]);
	
	return redirect('/manager/user');
 
}


public function edit($ID_PROGRAMER)
{
	
	$programer = DB::table('programer')->where('ID_PROGRAMER',$ID_PROGRAMER)->get();
	
	return view('manager/euser',['programer' => $programer]);
 
}


public function update(Request $request)
{
	
	DB::table('programer')->where('ID_PROGRAMER',$request->ID_PROGRAMER)->update([
		'USERNAME_PROGRAMER' => $request->USERNAME_PROGRAMER,
		'PASSWORD_PROGRAMER' => $request->PASSWORD_PROGRAMER,
		'DIVISI_PROGRAMER' => $request->DIVISI_PROGRAMER,
		'BIDANG_PROGRAMER' => $request->BIDANG_PROGRAMER
		
	]);
	
	return redirect('/manager/user');
}
public function tticket(Request $request)
    {
        
        DB::table('proyek')->insert([
        'ID_PROYEK' => $request->ID_PROYEK,
        'ID_PROGRAMER' => $request->ID_PROGRAMER,
        'PROGRAMER1' => $request->PROGRAMER1,
        'PROGRAMER2' => $request->PROGRAMER2,
        'NAMA_PROYEK' => $request->NAMA_PROYEK,
        'INSTANSI_PROYEK' => $request->INSTANSI_PROYEK,
        'DESKRIPSI_PROYEK' => $request->DESKRIPSI_PROYEK,
        'PLATFORM_PROYEK' => $request->PLATFORM_PROYEK,
        'DEADLINE_PROYEK' => $request->DEADLINE_PROYEK,
        'STATUS_PROYEK' => $request->STATUS_PROYEK
]);
				return redirect('manager/ticket');
        
        
    }
    public function updateticket(Request $request)
    {
        DB::table('proyek')->where('ID_PROYEK',$request->ID_PROYEK)->update([
        'STATUS_PROYEK' => $request->STATUS_PROYEK
        ]);
        
        return redirect('manager/ticket');
    }
    public function aktifitas()
    {
        return view('manager/aktifitas');
    }

}
