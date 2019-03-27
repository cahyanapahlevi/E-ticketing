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
		$proyek = DB::table('proyek')
		->join('tiket','proyek.ID_PROYEK', '=', 'tiket.ID_PROYEK')->get()->all();
		
    	return view ('programmer/project',compact('proyek'));
    }
    public function dproject()
    
		{
		$deretakhir = DB::table('proyek')->orderBy('ID_PROYEK','desc')->first();
		
		if( ! $deretakhir)
			$angka = 0;
		else
			$angka = substr($deretakhir->ID_PROYEK,4);
			$cetak = 'PR'. sprintf('%04d', intval($angka)+1);
			
		$deretakhir2 = DB::table('tiket')->orderBy('ID_TIKET','desc')->first();
		
		if( ! $deretakhir2)
			$angka2 = 0;
		else
			$angka2 = substr($deretakhir2->ID_TIKET,4);
			$cetak2 = 'T'. sprintf('%04d', intval($angka2)+1);
			
        return view('programmer/dproject', compact('cetak','cetak2'));
		}
    
	
		public function tambahproject(Request $request)
	{
		
		DB::transaction(function()use ($request){
			$ID_PROYEK = $request->input('ID_PROYEK');
		$ID_TIKET = $request->input('ID_TIKET');
		$NAMA_PROYEK = $request->input('NAMA_PROYEK');
		$INSTANSI_PROYEK = $request->input('INSTANSI_PROYEK');
		$DESKRIPSI_PROYEK = $request->input('DESKRIPSI_PROYEK');
		$PLATFORM_PROYEK = $request->input('PLATFORM_PROYEK');
		$DEADLINE_PROYEK = $request->input('DEADLINE_PROYEK');
		$STATUS_PROYEK = $request->input('STATUS_PROYEK');
		$AKTIFITAS_TIKET = $request->input('AKTIFITAS_TIKET');
		$PROGRESS_TIKET = $request->input('PROGRESS_TIKET');
		$TIMELINE_TIKET = $request->input('TIMELINE_TIKET');
$data=array('ID_PROYEK'=>$ID_PROYEK,"NAMA_PROYEK"=>$NAMA_PROYEK,"INSTANSI_PROYEK"=>$INSTANSI_PROYEK,"DESKRIPSI_PROYEK"=>$DESKRIPSI_PROYEK,"PLATFORM_PROYEK"=>$PLATFORM_PROYEK,"DEADLINE_PROYEK"=>$DEADLINE_PROYEK,"STATUS_PROYEK"=>$STATUS_PROYEK);

$data2=array('ID_TIKET'=>$ID_TIKET,"ID_PROYEK"=>$ID_PROYEK,"AKTIFITAS_TIKET"=>$AKTIFITAS_TIKET,"PROGRESS_TIKET"=>$PROGRESS_TIKET,"TIMELINE_TIKET"=>$TIMELINE_TIKET);

		DB::table('proyek')->insert($data);
	   DB::table('tiket')->insert($data2);
	
		});
		
	
	return redirect('/programmer/project');
  
	}
	
	public function edit($ID_PROYEK)
    {
		$p = DB::table('proyek')
		->join('tiket','proyek.ID_PROYEK','=','tiket.ID_PROYEK')->where('proyek.ID_PROYEK',$ID_PROYEK)->get()->all();
        return view('programmer/eproject',compact('p'));
    }
	
	public function updateproject(Request $request)
{
	DB::transaction(function()use ($request){
		$NAMA_PROYEK = $request->input('NAMA_PROYEK');
		$INSTANSI_PROYEK = $request->input('INSTANSI_PROYEK');
		$DESKRIPSI_PROYEK = $request->input('DESKRIPSI_PROYEK');
		$PLATFORM_PROYEK = $request->input('PLATFORM_PROYEK');
		$DEADLINE_PROYEK = $request->input('DEADLINE_PROYEK');
		$STATUS_PROYEK = $request->input('STATUS_PROYEK');
		$AKTIFITAS_TIKET = $request->input('AKTIFITAS_TIKET');
		$PROGRESS_TIKET = $request->input('PROGRESS_TIKET');
		$TIMELINE_TIKET = $request->input('TIMELINE_TIKET');
		
$data=array("NAMA_PROYEK"=>$NAMA_PROYEK,"INSTANSI_PROYEK"=>$INSTANSI_PROYEK,"DESKRIPSI_PROYEK"=>$DESKRIPSI_PROYEK,"PLATFORM_PROYEK"=>$PLATFORM_PROYEK,"DEADLINE_PROYEK"=>$DEADLINE_PROYEK,"STATUS_PROYEK"=>$STATUS_PROYEK);

$data2=array("AKTIFITAS_TIKET"=>$AKTIFITAS_TIKET,"PROGRESS_TIKET"=>$PROGRESS_TIKET,"TIMELINE_TIKET"=>$TIMELINE_TIKET);

		DB::table('proyek')->where('ID_PROYEK',$request->ID_PROYEK)->update($data);
	   DB::table('tiket')->where('ID_TIKET',$request->ID_TIKET)->update($data2);
	
		});
		
	
	return redirect('/programmer/project');
	
		

	
	}
	
	public function hapus(Request $request)
{
	DB::transaction(function()use ($request){
		$ID_PROYEK = $request->get('ID_PROYEK');
		$ID_TIKET = $request->get('ID_TIKET');
		$NAMA_PROYEK = $request->get('NAMA_PROYEK');
		$INSTANSI_PROYEK = $request->get('INSTANSI_PROYEK');
		$DESKRIPSI_PROYEK = $request->get('DESKRIPSI_PROYEK');
		$PLATFORM_PROYEK = $request->get('PLATFORM_PROYEK');
		$DEADLINE_PROYEK = $request->get('DEADLINE_PROYEK');
		$STATUS_PROYEK = $request->get('STATUS_PROYEK');
		$AKTIFITAS_TIKET = $request->get('AKTIFITAS_TIKET');
		$PROGRESS_TIKET = $request->get('PROGRESS_TIKET');
		$TIMELINE_TIKET = $request->get('TIMELINE_TIKET');
		
$data=array("ID_PROYEK"=>$ID_PROYEK,"NAMA_PROYEK"=>$NAMA_PROYEK,"INSTANSI_PROYEK"=>$INSTANSI_PROYEK,"DESKRIPSI_PROYEK"=>$DESKRIPSI_PROYEK,"PLATFORM_PROYEK"=>$PLATFORM_PROYEK,"DEADLINE_PROYEK"=>$DEADLINE_PROYEK,"STATUS_PROYEK"=>$STATUS_PROYEK);

$data2=array("ID_TIKET"=>$ID_TIKET,"AKTIFITAS_TIKET"=>$AKTIFITAS_TIKET,"PROGRESS_TIKET"=>$PROGRESS_TIKET,"TIMELINE_TIKET"=>$TIMELINE_TIKET);

		DB::table('proyek')->where('ID_PROYEK',$ID_PROYEK)->delete($data);
	   DB::table('tiket')->where('ID_TIKET',$ID_TIKET)->delete($data2);
	
		});
	return redirect('programer/project');
}
	
		
public function dproject2(Request $request)
    {
	$deretakhir = DB::table('tiket')->orderBy('ID_TIKET','desc')->first();
	
		
		if( ! $deretakhir)
			$angka = 0;
		else
			$angka = substr($deretakhir->ID_TIKET,4);
			$cetak = 'TA'. sprintf('%04d', intval($angka)+1);
			
			
		$deretakhir2 = DB::table('proyek')->orderBy('ID_PROYEK','desc')->first();
		
		if( ! $deretakhir2)
			$angka2 = 0;
		else
			$angka2 = substr($deretakhir->ID_PROYEK,4);
			$cetak2 = 'PR'. sprintf('%04d', intval($angka2)+1);
		
		
        return view('programmer/dproject2', compact('cetak','cetak2'));	
	
    }

public function tambahproject2(Request $request)
	{
		DB::table('tiket')->insert([
		'ID_TIKET'			=>$request->ID_TIKET,
		'ID_PROYEK'			=>$request->ID_PROYEK,
		'AKTIFITAS_TIKET' 	=> $request->AKTIFITAS_TIKET,
		'PROGRESS_TIKET'	=> $request->PROGRESS_TIKET,
		'TIMELINE_TIKET'	=> $request->TIMELINE_TIKET
	]);
	return redirect('/programmer/project');
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
