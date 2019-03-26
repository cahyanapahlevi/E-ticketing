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
    	$lihat = DB::table('proyek')->paginate(2);
				return view('programmer/ticket',compact('lihat'));
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
        return view('programmer/dticket',compact('users'),compact('cetak'));
    }
    
    public function detail_tiket($ID_PROYEK)
    {
        Session::put('ID_PROYEK',$ID_PROYEK);
        $proyek = DB::table('proyek')->where('ID_PROYEK',$ID_PROYEK)->get();
       
        $komentar = DB::table('komentar AS k')
            
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
          
            ->get();
        
            return view('programmer/detail_tiket',['komentar'=>$komentar,'proyek'=>$proyek]);
    }
    
    public function tambah_komen(Request $request)
    {
       
        DB::table('komentar')->insert([
            'ID' => session::get('ID'),
            'ISI_KOMENTAR' => $request -> ISI_KOMENTAR,
            'ID_PROYEK' => $request -> ID_PROYEK
        ]);
        
        $proyek = DB::table('proyek')->where('ID_PROYEK',$request->ID_PROYEK)->get();
        
       $komentar = DB::table('komentar AS k')
           
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
           
            ->get();
       
       return view('programmer/detail_tiket',['komentar'=>$komentar,'proyek'=>$proyek]);
        
    }
    
    public function project()
    {
    	return view('programmer/project');
    }
    public function dproject()
    {
		$deretakhir = DB::table('proyek')->orderBy('ID_PROYEK','desc')->first();
		if( !$deretakhir)
			$angka = 0;
		else
			$angka = substr($deretakhir->ID_PROYEK,3);
			$cetak = 'PR'. sprintf('%04d', intval($angka)+1);
			
		$deretakhir1 = DB::table('tiket')->orderBy('ID_TIKET','desc')->first();
		if( !$deretakhir1)
			$angka1 = 0;
		else
			$angka1 = substr($deretakhir1->ID_TIKET,5);
			$cetak1 = 'T'. sprintf('%03d', intval($angka1)+1);
			
			
		$data = DB::table('proyek')
		->join('tiket','proyek.ID_PROYEK','=','tiket.ID_TIKET')
		->select('proyek.ID_PROYEK','proyek.NAMA_PROYEK','proyek.INSTANSI_PROYEK','proyek.DESKRIPSI_PROYEK','proyek.PLATFORM_PROYEK','proyek.DEADLINE_PROYEK','proyek.STATUS_PROYEK','tiket.AKTIFITAS_TIKET','tiket.PROGRESS_TIKET','tiket.TIMELINE_TIKET')
		->get();
		
        return view('programmer/dproject', compact('angka','angka1','cetak','cetak1','data'));
    }
		public function tambahproject(Request $request)
	{
	
	/*$data = DB::table('proyek')->insert([
		'ID_PROYEK' => $request->ID_PROYEK,
		'NAMA_PROYEK' => $request->NAMA_PROYEK,
		'INSTANSI_PROYEK' => $request->INSTANSI_PROYEK,
		'DESKRIPSI_PROYEK' => $request->DESKRIPSI_PROYEK,
		'PLATFORM_PROYEK' => $request->PLATFORM_PROYEK,
		'DEADLINE_PROYEK' => $request->DEADLINE_PROYEK,
		'STATUS_PROYEK' => $request->STATUS_PROYEK,
		])->outputinserted.';'
	'ID_TIKET'=> $request->ID_TIKET,
	'AKTIFITAS_TIKET' => $request->AKTIFITAS_TIKET,
		'PROGRESS_TIKET' => $request->PROGRESS_TIKET,
		'TIMELINE_TIKET' => $request->TIMELINE_TIKET
	]);*/
	return view('/manager/dproject');
 
	}
public function dproject2()
    {
        return view('programmer/dproject2');
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
