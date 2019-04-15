<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

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
                Session::put('ID_PROGRAMER',$data1->ID_PROGRAMER);
                Session::put('NAMA_PROGRAMER',$data1->USERNAME_PROGRAMER);
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
     public function logout_p(){
        Session::flush();
        return redirect('programmer')->with('alert-success','Kamu sudah logout');
    }
    public function home()
    {
		 
        $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
          if(!Session::get('login')){
            return redirect('programmer')->with('alert','Kamu harus login dulu');
        }
        else{
            return view('programmer/home',['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
    }
    public function baca($ID_PROYEK){
        DB::table('proyek')
            ->where('ID_PROYEK',$ID_PROYEK)
            ->update(['BACA' => 'SUDAH']);
        return redirect('programmer/ticket/detail_tiket/'.$ID_PROYEK);
    }
    
    public function ticket()
    {
        $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
    	$lihat = DB::table('proyek')->paginate(2);
				return view('programmer/ticket',compact('lihat'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
    }
   public function dticket()
    {
       $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();			
		   $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
       $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
		 $tiket = DB::table('proyek')->select('NAMA_PROYEK','proyek.ID_PROYEK')->get();
			
        return view('programmer/dticket',['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang],compact('proyek','tiket'));

    }
		public function caritiket(Request $request) {
			$cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
$foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();			
		   $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
		 $tiket = DB::table('proyek')->get()->all();
		   if(!Session::get('login')){
            return redirect('programmer')->with('alert','Kamu harus login dulu');
        }
        else{
        $ID_PROYEK = $request->NAMA_PROYEK;
        $tiket2 = DB::table('proyek')->join('tiket','proyek.ID_PROYEK','=','tiket.ID_PROYEK')->where([['proyek.NAMA_PROYEK', 'LIKE', '%' . $ID_PROYEK . '%'],['tiket.STATUS_TIKET','=','SINGLE']])->select('tiket.ID_TIKET','tiket.TASK','tiket.AKTIFITAS_TIKET')->get();
		
		if (count ( $tiket2 ) > 0){
        return view('/programmer/dticket',compact('tiket2','tiket'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang,'foto'=>$foto])->withDetails ( $tiket2 )->withQuery ( $ID_PROYEK );
		}else{
        return view('/programmer/dticket',compact('proyek','tiket'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang,'foto'=>$foto])->withMessage ( 'No Details found. Try to search again !' );
        }
		}
} 	
		
    public function detail_tiket($ID_PROYEK)
	{
        $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
        Session::put('ID_PROYEK',$ID_PROYEK);
        $proyek = DB::table('proyek')->where('ID_PROYEK',$ID_PROYEK)->get();
       
        $komentar = DB::table('komentar AS k')
            
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
          
            ->get();
		$u2 = DB::table('proyek_user')->join('programer','proyek_user.ID_PROGRAMER','=','programer.ID_PROGRAMER')->select('proyek_user.ID_USER','programer.USERNAME_PROGRAMER')->where('proyek_user.ID_PROYEK',$ID_PROYEK)->get();
		$u3 = DB::table('proyek')->join('manager','proyek.ID_MANAGER','=','manager.ID_MANAGER')->select('manager.USERNAME_MANAGER')->where('proyek.ID_PROYEK',$ID_PROYEK)->get();
        
            return view('programmer/detail_tiket',['komentar'=>$komentar,'proyek'=>$proyek,'cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang,'u2'=>$u2,'u3'=>$u3]);
    }
    
    public function tambah_komen(Request $request)
    {
       $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
        DB::table('komentar')->insert([
            'ID' => session::get('ID_PORGRAMER'),
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
       
       return view('programmer/detail_tiket',['komentar'=>$komentar,'proyek'=>$proyek,'cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        
    }
    
    public function project()
    {
        $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
		$proyek = DB::table('proyek')
		->join('tiket','proyek.ID_PROYEK', '=', 'tiket.ID_PROYEK')->get()->all();
		
    	return view ('programmer/project',compact('proyek'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
    }
    public function dproject()
    
		{
        $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
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
			
        return view('programmer/dproject', compact('cetak','cetak2'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
		}
    
	
		public function tambahproject(Request $request)
	{
		$cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
            $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
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
        $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
		$p = DB::table('proyek')
		->join('tiket','proyek.ID_PROYEK','=','tiket.ID_PROYEK')->where('proyek.ID_PROYEK',$ID_PROYEK)->get()->all();
        return view('programmer/eproject',compact('p'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
    }
	
	public function updateproject(Request $request)
{
        $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
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
        $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
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
    $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
    $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
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
		
		
        return view('programmer/dproject2', compact('cetak','cetak2'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);	
	
    }

public function tambahproject2(Request $request)
	{
    $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
    $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
		DB::table('tiket')->insert([
		'ID_TIKET'			=>$request->ID_TIKET,
		'ID_PROYEK'			=>$request->ID_PROYEK,
		'AKTIFITAS_TIKET' 	=> $request->AKTIFITAS_TIKET,
		'PROGRESS_TIKET'	=> $request->PROGRESS_TIKET,
		'TIMELINE_TIKET'	=> $request->TIMELINE_TIKET
	]);
	return redirect('/programmer/project');
	}
    
    public function editprofile()
    {
        $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
		$ID_PROGRAMER = Session::get('ID_PROGRAMER');
		$tabel_programmer = DB::table('programer')->where('ID_PROGRAMER',$ID_PROGRAMER)->get();
	return view('programmer/edituser', ['tabel_programmer'=>$tabel_programmer,'cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
    }
	
	public function update_profile(Request $request)
{
	$cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
            $fot = $request->file('foto');
            $nama = $fot->getClientOriginalName();
            $fot -> move(public_path().'/source/images/programmer/',$nama);
	DB::table('programer')->where('ID_PROGRAMER',$request->ID_PROGRAMER)->update([
		'USERNAME_PROGRAMER' => $request->USERNAME_PROGRAMER,
		'PASSWORD_PROGRAMER' => $request->PASSWORD_PROGRAMER,
        'foto' => $nama
	   ]);
	return redirect('/programmer/home');
}
   public function aktifitas()
    {
		$cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
       $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
		
       $siswa = DB::table('tiket')
           ->join('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
           ->select(DB::raw("DATEDIFF(tiket.TIMELINE_TIKET,'$sekarang') selisih, tiket.TASK, tiket.AKTIFITAS_TIKET, tiket.PROGRESS_TIKET, tiket.ID_TIKET, tiket.TIMELINE_TIKET, proyek.NAMA_PROYEK"))->where('tiket.STATUS_TIKET','=','PAIRED')->paginate(2);
       
		return view('programmer/aktifitas',compact('siswa'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
    }
	/*Penambahan untuk mecari data sesuai proyek di menu aktifitas(rita)*/
	public function cari(Request $request)
	{
        $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
		$cari = $request->cari;
		
		$siswa = DB::table('proyek')
        ->where('NAMA_PROYEK','like',"%".$cari."%") 
		->paginate(2);
		
		return view('programmer/hasilcari',compact('siswa'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
	}
	
	public function dataaktifitas()
	{
        $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
		 $dataak= DB::table('proyek')->paginate(2);
		
		return view('programmer/dataaktifitas',compact('dataak'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
	}
	public function detailaktifitas($ID_PROYEK)
    {
        $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
		Session::put('ID_PROYEK',$ID_PROYEK);
	   $daktif = DB::table('tiket')
            ->join('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
			->where('tiket.ID_PROYEK','=',$ID_PROYEK)
            ->select('tiket.ID_PROYEK', 'tiket.ID_TIKET', 'tiket.TASK', 'tiket.AKTIFITAS_TIKET', 'tiket.PROGRESS_TIKET', 'proyek.NAMA_PROYEK')
            ->paginate(2);
			
			$sum = DB::table('tiket')
			->where('tiket.ID_PROYEK','=',$ID_PROYEK)
			->sum('PROGRESS_TIKET');
			
			$avg = DB::table('tiket')
			->where('tiket.ID_PROYEK','=',$ID_PROYEK)
			->average('PROGRESS_TIKET');
		
		return view('programmer/detailaktifitas',compact('daktif','sum','avg'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
    }
	public function hapustiket($ID_TIKET)
	{
	$cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
	DB::table('tiket')->where('ID_TIKET',$ID_TIKET)->delete();
	
	return redirect('programmer/aktifitas');
	}
	public function editaktifitas($ID_TIKET)
	{
	$cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
	$eaktif = DB::table('tiket')
            ->join('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
			
			->where('tiket.ID_TIKET','=',$ID_TIKET)
            ->select('tiket.ID_PROYEK', 'tiket.ID_TIKET', 'tiket.PROGRESS_TIKET', 'tiket.TASK', 'tiket.AKTIFITAS_TIKET', 'proyek.NAMA_PROYEK', 'tiket.TIMELINE_TIKET')
            ->paginate(2);
		
		return view('programmer/editaktifitas',compact('eaktif'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
	}
	public function updateaktifitas(Request $request)
    {
		$cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
	   DB::table('tiket')
            ->join('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
			->where('tiket.ID_TIKET','=',$request->ID_TIKET)
			->update([
		
		'TASK' => $request->TASK,
		'AKTIFITAS_TIKET' => $request->AKTIFITAS_TIKET,
		'PROGRESS_TIKET' => $request->PROGRESS_TIKET,
		'TIMELINE_TIKET' => $request->TIMELINE_TIKET
	]);
		
		return redirect('programmer/aktifitas');
    }
	 public function dticketprog()
    {
         $cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
         $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
        $users = DB::table('tiket')
            ->rightJoin('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
            ->get()->all();
        return view('programmer/dticketprog',compact('users'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
    }
	public function tticket(Request $request)
    {
		$cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
            $cek_komentar = DB::table('komentar AS k')
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->leftjoin('proyek AS y','y.ID_PROYEK','=','k.ID_PROYEK')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
            ->orderBy('TGL_KOMENTAR','desc')
            ->limit(5)
            ->get();
            $foto = DB::table('programer')->where('ID_PROGRAMER',Session::get('ID_PROGRAMER'))->get();
        $sekarang = Carbon::now()->format('Y-m-d');
       
        $datediff = DB::table('proyek')
            ->select(
            DB::raw("ID_PROYEK, NAMA_PROYEK, DEADLINE_PROYEK, DATEDIFF(DEADLINE_PROYEK,'$sekarang') selisih"))
            ->where('STATUS_PROYEK','=','On Progress')->orWhere('STATUS_PROYEK','=','open')
          ->get();
        $datediff1 = DB::table('proyek')
            ->select(
            DB::raw("DATEDIFF(DEADLINE_PROYEK,'$sekarang') as selisih,  NAMA_PROYEK, DEADLINE_PROYEK, ID_PROYEK")
          )->orderBy('DEADLINE_PROYEK','asc')->paginate(5);
        DB::table('tiket')->insert([
		'ID_TIKET' => $request->ID_TIKET,
		'TASK' => $request->TASK,
		'AKTIFITAS_TIKET' => $request->AKTIFITAS_TIKET,
		'PROGRESS_TIKET' => $request->PROGRESS_TIKET,
		'TIMELINE_TIKET' => $request->TIMELINE_TIKET,
		'ID_PROYEK' => $request->ID_PROYEK
		
		
		]);
		
		return redirect('programmer/aktifitas');
    }
	public function ambiltiket($ID_TIKET){
        DB::table('tiket')
            ->where('ID_TIKET',$ID_TIKET)
            ->update(['STATUS_TIKET' => 'PAIRED','PROGRESS_TIKET' => '0 %','ID_PROGRAMER'=>SESSION::GET('ID_PROGRAMER')]);
        return redirect('programmer/aktifitas');
    }
	 public function open($ID_PROYEK){
        DB::table('proyek')
            ->where('ID_PROYEK',$ID_PROYEK)
            ->update(['STATUS_PROYEK' => 'Open']);
        return redirect('programmer/ticket/');
    }
     public function progress($ID_PROYEK){
        DB::table('proyek')
            ->where('ID_PROYEK',$ID_PROYEK)
            ->update(['STATUS_PROYEK' => 'On Progress']);
        return redirect('programmer/ticket/');
    }
     public function closed($ID_PROYEK){
        DB::table('proyek')
            ->where('ID_PROYEK',$ID_PROYEK)
            ->update(['STATUS_PROYEK' => 'Closed']);
        return redirect('programmer/ticket/');
    }

}
