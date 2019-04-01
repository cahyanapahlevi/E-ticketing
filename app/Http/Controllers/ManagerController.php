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
		$lihat = DB::table('proyek')->paginate(2);
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
        
            return view('manager/detail_tiket',['komentar'=>$komentar,'proyek'=>$proyek]);
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
       
       return view('manager/detail_tiket',['komentar'=>$komentar,'proyek'=>$proyek]);
        
    }
    
	public function eticket()
    {
        return view('manager/eticket');
    }
	  /*Penambahan pagination pada halaman report (rita)*/
        public function report()
    {
         $page = DB::table('proyek')->paginate(2);
        
        return view('manager/report',compact('page'));
    }
    /*Pnambahan untuk melihat report sesuai dengan bulan dan tahun yang dipilih(rita)*/
     public function showreport(Request $req)
    {
        $month = $req->month;
        $year = $req->year;
        $page =DB::table('proyek')->whereYear('DEADLINE_PROYEK', '=', $year)
              ->whereMonth('DEADLINE_PROYEK', '=', $month)
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
		$ID_MANAGER = Session::get('ID');
		$tabel_manager = DB::table('manager')->where('ID_MANAGER',$ID_MANAGER)->get();
	return view('manager/edituser', ['tabel_manager'=>$tabel_manager]);
    }
	
	public function update_profile(Request $request)
{
	
	DB::table('manager')->where('ID_MANAGER',$request->ID_MANAGER)->update([
		'USERNAME_MANAGER' => $request->USERNAME_MANAGER,
		'PASSWORD_MANAGER' => $request->PASSWORD_MANAGER
	]);
	
	return redirect('/manager/home');
}
		
	public function hapus($ID_PROGRAMER)
{
	DB::table('programer')->where('ID_PROGRAMER',$ID_PROGRAMER)->delete();
	return redirect('manager/user');
}
	
	public function tambah(Request $request)
	{
		$ID_PROGRAMER = $request->get('ID_PROGRAMER');
		
		 $numeric_id = intval(substr($ID_PROGRAMER, 1)); //retrieve numeric value of 'V001' (1)
  $numeric_id++; //increment
  if(mb_strlen($numeric_id) == 1)
  {
     $zero_string = '00';
  }elseif(mb_strlen($numeric_id) == 2)
  {
     $zero_string = '0';
  }else{
     $zero_string = '';
  }
  $new_id = 'P'.$zero_string.$numeric_id;
		
		return view('manager/tuser', compact('new_id'));
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
		
	   $siswa = DB::table('tiket')
            ->join('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
            ->select('tiket.ID_TIKET', 'tiket.TASK', 'tiket.AKTIFITAS_TIKET', 'tiket.PROGRESS_TIKET', 'tiket.TIMELINE_TIKET', 'proyek.NAMA_PROYEK')
            ->paginate(2);
		
		return view('manager/aktifitas',compact('siswa'));
    }
	/*Penambahan untuk mecari data sesuai proyek di menu aktifitas(rita)*/
	public function cari(Request $request)
	{
		$cari = $request->cari;
		
		$siswa = DB::table('tiket')
		->join('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
        ->where('NAMA_PROYEK','like',"%".$cari."%")
		->paginate(2);
		
		return view('manager/aktifitas',compact('siswa'));
	}

	/*Penambahan untuk menu baru dat aktifitas*/
	public function dataaktifitas()
	{
		 $dataak= DB::table('proyek')->paginate(2);
		
		return view('manager/dataaktifitas',compact('dataak'));
	}
	public function taktifitas()
	{
		$aktif = DB::table('tiket')
            ->rightJoin('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
            ->get()->all();
        return view('manager/taktifitas',compact('aktif'));
	}
	public function tambahaktifitas(Request $request)
    {
		
        DB::table('tiket')->insert([
		'ID_PROYEK' => $request->ID_PROYEK,
		'ID_TIKET' => $request->ID_TIKET,
		'TASK' => $request->TASK,
		'AKTIFITAS_TIKET' => $request->AKTIFITAS_TIKET
		
		]);
		
		return redirect('manager/dataaktifitas');
    }
	public function detailaktifitas($ID_PROYEK)
    {
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
		
		return view('manager/detailaktifitas',compact('daktif','sum','avg'));
    }
	public function editaktifitas($ID_PROYEK)
    {
	   $eaktif = DB::table('tiket')
            ->join('proyek', 'tiket.ID_PROYEK', '=', 'proyek.ID_PROYEK')
			->where('tiket.ID_PROYEK','=',$ID_PROYEK)
            ->select('tiket.ID_PROYEK', 'tiket.ID_TIKET', 'tiket.TASK', 'tiket.AKTIFITAS_TIKET', 'proyek.NAMA_PROYEK')
            ->paginate(2);
		
		return view('manager/editaktifitas',compact('eaktif'));
    }
	public function updateaktifitas(Request $request)
    {
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
	public function hapusproyek($ID_PROYEK)
	{
	
	DB::table('proyek')->where('ID_PROYEK',$ID_PROYEK)->delete();
		DB::table('tiket')->where('ID_PROYEK',$ID_PROYEK)->delete();
	
	return redirect('manager/dataaktifitas');
	}
	
	public function hapustiket($ID_TIKET)
	{
		$ID_PROYEK = Session::get('ID_PROYEK');
		DB::table('tiket')->where('ID_TIKET',$ID_TIKET)->delete();
	
	return redirect('manager/detailaktifitas/'.$ID_PROYEK);
	}
}
