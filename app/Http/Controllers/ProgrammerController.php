<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProgrammerController extends Controller
{
    
     public function login(){
        return view('programmer/login');
    }

    public function proseslogin(Request $request)
    {

        $username_programer =$request->username_programer;
        $password     =$request->password;
        $data1 = DB::table('programer')->where('USERNAME_PROGRAMER',$username_programer)->first();
        if($data1){ 
            if(DB::table('programer')->where('PASSWORD_PROGRAMER',$password)->first()){
                Session::put('ID',$data1->ID_PROGRAMER);
                Session::put('nama',$data1->USERNAME_PROGRAMER);
                Session::put('login',TRUE);
                return redirect('programmer/home');
            }
            else{

                return redirect('programmer')->with('alert','Data Tidak Sesuai Silahkan Login Ulang!');
            }
        }
        else{
            
            return redirect('programmer')->with('alert','Password atau Email, Salah!');
        }
        /*$data= DB::table('programmer')->where([
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
        return redirect('programmer')->with('alert-success','Kamu sudah logout');
    }
    public function home()
    {
          if(!Session::get('login')){
            return redirect('programmer')->with('alert','Kamu harus login dulu');
        }
        else{
            return view('programmer/home');
        }
    }
    public function ticket()
    {
    	return view('programmer/ticket');
    }
    public function dticket()
    {
        return view('programmer/dticket');
    }
    public function project()
    {
    	return view('programmer/project');
    }
    public function dproject()
    {
		$deretakhir = DB::table('proyek')->orderBy('ID_PROYEK','desc')->first();
		$deretakhir1 = DB::table('tiket')->orderBy('ID_TIKET','desc')->first();
		if( ! $deretakhir && !$deretakhir1){
			$angka = 0;
		$angka1 = 0;}
		else{
			$angka = substr($deretakhir->ID_PROYEK,3);
			$cetak = 'PR'. sprintf('%04d', intval($angka)+1);
			$angka1 = substr($deretakhir1->ID_TIKET,5);
			$cetak1 = 'T'. sprintf('%03d', intval($angka1)+1);
		}
		$data = DB::table('proyek')
		->join('proyek','proyek.ID_PROYEK','=','proyek.ID_TIKET')
		->select('proyek.ID_PROYEK','proyek.NAMA_PROYEK','proyek.INSTANSI_PROYEK'.'proyek.DESKRIPSI_PROYEK'.'proyek.PLATFORM_PROYEK','proyek.DEADLINE_PROYEK','proyek.STATUS_PROYEK','tiket.AKTIFITAS_TIKET','tiket_PROGRESS_TIKET','tiket.TIMELINE_TIKET')
		->get();
		
        return view('programmer/dproject', ['cetak'=>$cetak, 'cetak1'=>$cetak1, 'data']);
    }
		public function tambahproject(Request $request)
{
	
	DB::table('proyek')->insert([
		'ID_PROYEK' => $request->ID_PROYEK,
		'NAMA_PROYEK' => $request->NAMA_PROYEK,
		'INSTANSI_PROYEK' => $request->INSTANSI_PROYEK,
		'DESKRIPSI_PROYEK' => $request->DESKRIPSI_PROYEK,
		'PLATFORM_PROYEK' => $request->PLATFORM_PROYEK,
		'DEADLINE_PROYEK' => $request->DEADLINE_PROYEK,
		'STATUS_PROYEK' => $request->STATUS_PROYEK
	'ID_TIKET'=> $request->ID_TIKET,
	'AKTIFITAS_TIKET' => $request->AKTIFITAS_TIKET,
		'PROGRESS_TIKET' => $request->PROGRESS_TIKET,
		'TIMELINE_TIKET' => $request->TIMELINE_TIKET
	]);
	return view('/manager/dproject');
 
}
	
	
    public function edituser()
    {
        return view('programmer/edituser');
    }
   public function aktifitas()
    {
        return view('programmer/aktifitas');
    }

}
