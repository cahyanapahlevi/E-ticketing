<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

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
                Session::put('ID_MANAGER',$data->ID_MANAGER);
                Session::put('NAMA_MANAGER',$data->USERNAME_MANAGER);
                Session::put('login_m',TRUE);
                
                //$cek_project = DB::table('proyek')->where('BACA','=','BELUM')->orderBy('ID_PROYEK','desc')->get();
                return redirect('manager/home');
                // return redirect('manager/home',['cek_project'=>$cek_project]);
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
                Session::put('login_m',TRUE);
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
        $pm= DB::table('proyek')->get();
        $op= DB::table('tiket')
		 ->select('tiket.ID_TIKET', 'tiket.TASK', 'tiket.AKTIFITAS_TIKET', 'tiket.PROGRESS_TIKET')
		 ->where('tiket.PROGRESS_TIKET', '<', 100)
		 ->get();
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
        
        
          if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
            return view('manager/home', ['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'pm'=>$pm, 'op'=>$op,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang,'foto'=>$foto]);
        }
    }
    
    public function baca($ID_PROYEK){
        DB::table('proyek')
            ->where('ID_PROYEK',$ID_PROYEK)
            ->update(['BACA' => 'SUDAH']);
        return redirect('manager/ticket/detail_tiket/'.$ID_PROYEK);
    }
    public function open($ID_PROYEK){
        DB::table('proyek')
            ->where('ID_PROYEK',$ID_PROYEK)
            ->update(['STATUS_PROYEK' => 'Open']);
        return redirect('manager/ticket/');
    }
     public function progress($ID_PROYEK){
        DB::table('proyek')
            ->where('ID_PROYEK',$ID_PROYEK)
            ->update(['STATUS_PROYEK' => 'On Progress']);
        return redirect('manager/ticket/');
    }
     public function closed($ID_PROYEK){
        DB::table('proyek')
            ->where('ID_PROYEK',$ID_PROYEK)
            ->update(['STATUS_PROYEK' => 'Closed']);
        return redirect('manager/ticket/');
    }
    
  public function ticket()
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
      if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
            //$lihat = DB::table('proyek')->join('programer', 'proyek.ID_PROGRAMER', '=', 'programer.ID_PROGRAMER')->select('proyek.ID_PROYEK', 'proyek.NAMA_PROYEK', 'proyek.INSTANSI_PROYEK','proyek.DESKRIPSI_PROYEK','proyek.PLATFORM_PROYEK','programer.USERNAME_PROGRAMER','proyek.DEADLINE_PROYEK','proyek.STATUS_PROYEK')->paginate(2);
		$lihat = DB::table('proyek')->paginate(2);
				return view('manager/ticket',compact('lihat'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
        $users = DB::table('proyek')
            ->get()->all();
			
			$deretakhir = DB::table('proyek')->orderBy('ID_PROYEK','desc')->first();
		
		if( ! $deretakhir)
			$angka = 0;
		else
			$angka = substr($deretakhir->ID_PROYEK,3);
			$cetak = 'PR'. sprintf('%04d', intval($angka)+1);
        return view('manager/dticket',compact('users','cetak','cek_project','cek_komentar','foto'),['datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
        Session::put('ID_PROYEK',$ID_PROYEK);
        $proyek = DB::table('proyek')->where('ID_PROYEK',$ID_PROYEK)->get();
       
        $komentar = DB::table('komentar AS k')
            
            ->leftjoin('programer AS p','p.ID_PROGRAMER','=','k.ID')
            ->leftjoin('manager AS m','m.ID_MANAGER','=','k.ID')
            ->where('k.ID','LIKE','%M%')
            ->orWHere('k.ID','LIKE','%P%')
          
            ->get();
        $use =  DB::table('programer')->select('ID_PROGRAMER','USERNAME_PROGRAMER')->get();
		$u2 = DB::table('proyek_user')->join('programer','proyek_user.ID_PROGRAMER','=','programer.ID_PROGRAMER')->select('proyek_user.ID_USER','programer.USERNAME_PROGRAMER')->get();
            return view('manager/detail_tiket',['komentar'=>$komentar,'proyek'=>$proyek,'cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang,'use'=>$use,'u2'=>$u2]);
        }
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
       if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
            $ID_MANAGER = Session::get('ID_MANAGER');
        DB::table('komentar')->insert([
            'ID' => $ID_MANAGER,
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
       
       return view('manager/detail_tiket',['komentar'=>$komentar,'proyek'=>$proyek,'cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
        
    }
    
	public function eticket()
    {
        return view('manager/eticket');
    }
    public function cetak()
    {
        $page1 = DB::table('proyek')->paginate(10);
        return view('manager/cetak',compact('page1'));
    }
	  /*Penambahan pagination pada halaman report (rita)*/
        public function report()
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
            if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
         $page = DB::table('proyek')->join('manager','proyek.ID_MANAGER','=','manager.ID_MANAGER')->select('manager.USERNAME_MANAGER','proyek.ID_PROYEK','proyek.NAMA_PROYEK','proyek.INSTANSI_PROYEK','proyek.DESKRIPSI_PROYEK','proyek.DESKRIPSI_PROYEK','proyek.PLATFORM_PROYEK','proyek.DEADLINE_PROYEK')->paginate();
		 $u2 = DB::table('proyek_user')->join('programer','proyek_user.ID_PROGRAMER','=','programer.ID_PROGRAMER')->select('proyek_user.ID_USER','programer.USERNAME_PROGRAMER')->get();
        
        return view('manager/report',compact('page','u2'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
    }
    /*Pnambahan untuk melihat report sesuai dengan bulan dan tahun yang dipilih(rita)*/
     public function showreport(Request $req)
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
         if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
        $month = $req->month;
        $year = $req->year;
	    $page = DB::table('proyek')->join('manager','proyek.ID_MANAGER','=','manager.ID_MANAGER')->select('manager.USERNAME_MANAGER','proyek.ID_PROYEK','proyek.NAMA_PROYEK','proyek.INSTANSI_PROYEK','proyek.DESKRIPSI_PROYEK','proyek.DESKRIPSI_PROYEK','proyek.PLATFORM_PROYEK','proyek.DEADLINE_PROYEK')->whereYear('DEADLINE_PROYEK', '=', $year)->whereMonth('DEADLINE_PROYEK', '=', $month)
              ->paginate();
		 $u2 = DB::table('proyek_user')->join('programer','proyek_user.ID_PROGRAMER','=','programer.ID_PROGRAMER')->select('proyek_user.ID_USER','programer.USERNAME_PROGRAMER')->get();
            return view('manager/report',compact('page','u2'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
    }
    
    /*Penambahan untuk menu dropdown report*/
	public function reportproyek()
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
         $page = DB::table('proyek')->join('manager','proyek.ID_MANAGER','=','manager.ID_MANAGER')->select('manager.USERNAME_MANAGER','proyek.ID_PROYEK','proyek.NAMA_PROYEK','proyek.INSTANSI_PROYEK','proyek.DESKRIPSI_PROYEK','proyek.DESKRIPSI_PROYEK','proyek.PLATFORM_PROYEK','proyek.DEADLINE_PROYEK')->paginate();
		 $u2 = DB::table('proyek_user')->join('programer','proyek_user.ID_PROGRAMER','=','programer.ID_PROGRAMER')->select('proyek_user.ID_USER','programer.USERNAME_PROGRAMER')->get();
		 
        
        return view('manager/reportproyek',compact('page','u2'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
    }
	public function reportorang()
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
            ->select('tiket.ID_TIKET', 'tiket.ID_PROGRAMER','tiket.TASK', 'tiket.AKTIFITAS_TIKET', 'tiket.PROGRESS_TIKET', 'tiket.TIMELINE_TIKET', 'proyek.NAMA_PROYEK')
            ->paginate(2);
        
        return view('manager/reportorang',compact('siswa'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
    }
    
	    public function user()
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
            if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
		$programer = DB::table('programer')->get();
		
        return view('manager/user',['programer' => $programer,'cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
    }
    public function edituser()
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
		$ID_MANAGER = Session::get('ID_MANAGER');
		$tabel_manager = DB::table('manager')->where('ID_MANAGER',$ID_MANAGER)->get();
	return view('manager/edituser', ['tabel_manager'=>$tabel_manager,'cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
	if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
            $fot = $request->file('foto');
            $nama = $fot->getClientOriginalName();
            $fot -> move(public_path().'/source/images/manager/',$nama);
	DB::table('manager')->where('ID_MANAGER',$request->ID_MANAGER)->update([
		'USERNAME_MANAGER' => $request->USERNAME_MANAGER,
		'PASSWORD_MANAGER' => $request->PASSWORD_MANAGER,
        'foto' =>$nama
	]);
	
	return redirect('/manager/home');
        }
}
		
	public function hapus($ID_PROGRAMER)
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
	DB::table('programer')->where('ID_PROGRAMER',$ID_PROGRAMER)->delete();
	return redirect('manager/user');
        }
}
	
	public function tambah(Request $request)
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
		$ID_PROGRAMER = $request->get('ID_PROGRAMER');
		
		 $deretakhir = DB::table('programer')->orderBy('ID_PROGRAMER','desc')->first();
	 
		if( ! $deretakhir)
			$angka = 0;
		else
			$angka = substr($deretakhir->ID_PROGRAMER,1,4);
			$cetak = 'P'. sprintf('%03d', intval($angka)+1);
		
		return view('manager/tuser', compact('cetak'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
    }
	public function tambahuser(Request $request)
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
	if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
	DB::table('programer')->insert([
		'ID_PROGRAMER' => $request->ID_PROGRAMER,
		//'id_aplikasi' => $request->id_aplikasi,
		'USERNAME_PROGRAMER' => $request->USERNAME_PROGRAMER,
		'PASSWORD_PROGRAMER' => $request->PASSWORD_PROGRAMER,
		'DIVISI_PROGRAMER' => $request->DIVISI_PROGRAMER,
		'BIDANG_PROGRAMER' => $request->BIDANG_PROGRAMER
	]);
	
	return redirect('/manager/user');
        }}



public function edit($ID_PROGRAMER)
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
	if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
	$programer = DB::table('programer')->where('ID_PROGRAMER',$ID_PROGRAMER)->get();
	
	return view('manager/euser',['programer' => $programer,'cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
}


public function update(Request $request)
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
	if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
	DB::table('programer')->where('ID_PROGRAMER',$request->ID_PROGRAMER)->update([
		'USERNAME_PROGRAMER' => $request->USERNAME_PROGRAMER,
		'PASSWORD_PROGRAMER' => $request->PASSWORD_PROGRAMER,
		'DIVISI_PROGRAMER' => $request->DIVISI_PROGRAMER,
		'BIDANG_PROGRAMER' => $request->BIDANG_PROGRAMER
		
	]);
	
	return redirect('/manager/user');
        }
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
$ID_PROYEK = $request->input('ID_PROYEK');
$ID_MANAGER = $request->input('ID_MANAGER');
$NAMA_PROYEK = $request->input('NAMA_PROYEK');
$INSTANSI_PROYEK = $request->input('INSTANSI_PROYEK');
$DESKRIPSI_PROYEK = $request->input('DESKRIPSI_PROYEK');
$PLATFORM_PROYEK = $request->input('PLATFORM_PROYEK');
$DEADLINE_PROYEK = $request->input('DEADLINE_PROYEK');
$data=array('ID_PROYEK'=>$ID_PROYEK,'ID_MANAGER'=>$ID_MANAGER,'ID_PROGRAMER'=>$prog,'NAMA_PROYEK'=>$NAMA_PROYEK,'INSTANSI_PROYEK'=>$INSTANSI_PROYEK,'DESKRIPSI_PROYEK'=>$DESKRIPSI_PROYEK,'PLATFORM_PROYEK'=>$PLATFORM_PROYEK,'STATUS_PROYEK'=>'Open','BACA'=>'BELUM','DEADLINE_PROYEK'=>$DEADLINE_PROYEK);
DB::table('proyek')->insert($data);
				return redirect('manager/ticket');
        
        }
    }
    public function updateticket(Request $request)
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
        DB::table('proyek')->where('ID_PROYEK',$request->ID_PROYEK)->update([
        'STATUS_PROYEK' => $request->STATUS_PROYEK
        ]);
        
        return redirect('manager/ticket');
        }
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
      $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
		if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
	   $siswa = DB::table('tiket')
            ->join('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
            ->select('tiket.ID_TIKET', 'tiket.TASK', 'tiket.AKTIFITAS_TIKET', 'tiket.PROGRESS_TIKET', 'tiket.TIMELINE_TIKET', 'proyek.NAMA_PROYEK')
            ->paginate(2);
		
		return view('manager/aktifitas',compact('siswa'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
		$cari = $request->cari;
		
		$siswa = DB::table('tiket')
		->join('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
        ->where('NAMA_PROYEK','like',"%".$cari."%")
		->paginate(2);
		
		return view('manager/aktifitas',compact('siswa'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
	}

	/*Penambahan untuk menu baru dat aktifitas*/
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
		 $dataak= DB::table('proyek')->paginate(2);
		
		return view('manager/dataaktifitas',compact('dataak'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
	}
	public function taktifitas()
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
		$aktif = DB::table('tiket')
            ->rightJoin('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
            ->get()->all();
        return view('manager/taktifitas',compact('aktif'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
	}
	public function tambahaktifitas(Request $request)
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
		if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
        DB::table('tiket')->insert([
		'ID_PROYEK' => $request->ID_PROYEK,
		'ID_TIKET' => $request->ID_TIKET,
		'TASK' => $request->TASK,
		'AKTIFITAS_TIKET' => $request->AKTIFITAS_TIKET
		
		]);
		
		return redirect('manager/dataaktifitas');
        }
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
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
		
		return view('manager/detailaktifitas',compact('daktif','sum','avg'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
        }
    }
    
	public function editaktifitas($ID_PROYEK)
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
	   $eaktif = DB::table('tiket')
            ->join('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
			->where('tiket.ID_PROYEK','=',$ID_PROYEK)
            ->select('tiket.ID_PROYEK', 'tiket.ID_TIKET', 'tiket.TASK', 'tiket.AKTIFITAS_TIKET', 'proyek.NAMA_PROYEK')
            ->paginate(2);
		
		return view('manager/editaktifitas',compact('eaktif'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang ]);
        }
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
		$ID_PROYEK=Session::get('ID_PROYEK');
	   DB::table('tiket')
            ->join('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
			->where('tiket.ID_TIKET','=',$request->ID_TIKET)
			->update([
		
		'NAMA_PROYEK' => $request->NAMA_PROYEK,
		'TASK' => $request->TASK,
		'AKTIFITAS_TIKET' => $request->AKTIFITAS_TIKET
		
	]);
	
	/*$daktif = DB::table('tiket')
            ->join('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
			->where('tiket.ID_PROYEK','=',$request->ID_PROYEK)
            ->select('tiket.ID_PROYEK', 'tiket.ID_TIKET', 'tiket.TASK', 'tiket.AKTIFITAS_TIKET', 'proyek.NAMA_PROYEK')
            ->paginate(2);*/
           
		
		return redirect('manager/detailaktifitas/'.$ID_PROYEK);
        }
    }
    
	public function hapusproyek($ID_PROYEK)
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
	if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
	DB::table('proyek')->where('ID_PROYEK',$ID_PROYEK)->delete();
		DB::table('tiket')->where('ID_PROYEK',$ID_PROYEK)->delete();
	
	return redirect('manager/dataaktifitas');
        }
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
        if(!Session::get('login_m')){
            return redirect('manager')->with('alert','Kamu harus login dulu');
        }
        else{
		$ID_PROYEK = Session::get('ID_PROYEK');
		DB::table('tiket')->where('ID_TIKET',$ID_TIKET)->delete();
	
	return redirect('manager/detailaktifitas/'.$ID_PROYEK);
        }
	}
    
    public function proyek()
	{
		 $pm= DB::table('proyek')->paginate(2);
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
		return view('manager/proyek',compact('pm'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
	}
    
    /*8-4-2019*/
	public function onprogress()
	{
		 $op= DB::table('tiket')
		 ->select('tiket.ID_TIKET', 'tiket.TASK', 'tiket.AKTIFITAS_TIKET', 'tiket.PROGRESS_TIKET')
		 ->where('tiket.PROGRESS_TIKET', '<', 100)
		 ->paginate(2);
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
		return view('manager/onprogress',compact('op'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
	}
    public function taktifitas2()
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
            $foto = DB::table('manager')->where('ID_MANAGER',Session::get('ID_MANAGER'))->get();
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
        
		$aktif = DB::table('tiket')
            ->rightJoin('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
            ->get()->all();
        return view('manager/taktifitas2',compact('aktif'),['cek_project'=>$cek_project, 'cek_komentar'=>$cek_komentar,'foto'=>$foto,'datediff'=>$datediff,'datediff1'=>$datediff1,'sekarang'=>$sekarang]);
	}
	public function tambahaktifitas2(Request $request)
    {
		
        DB::table('tiket')->insert([
		'ID_PROYEK' => $request->ID_PROYEK,
		'ID_TIKET' => $request->ID_TIKET,
		'TASK' => $request->Task,
		'AKTIFITAS_TIKET' => $request->AKTIFITAS_TIKET
		
		]);
		
		return redirect('manager/dataaktifitas');
    }
	public function tambahteam(Request $request)
    {
		
        DB::table('proyek_user')->insert([
		'ID_PROYEK' => $request->ID_PROYEK,
		'ID_MANAGER' => $request->ID_MANAGER,
		'ID_PROGRAMER' => $request->ID_PROGRAMER,
		'STATUS'=>'BELUM']);
		
		return redirect()->back();
    }
}
