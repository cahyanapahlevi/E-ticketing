<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProgrammerController extends Controller
{
    public function login()
    {
        return view('programmer/login');
    }
    public function home()
    {
    	return view('programmer/home');
    }
    public function ticket()
    {
    	$lihat2 = DB::table('permintaan')->paginate(2);
		
		
		return view('programmer/ticket',compact('lihat2'));
    }
    public function dticket()
    {
        $users = DB::table('tiket')
            ->rightJoin('permintaan', 'tiket.id_permintaan', '=', 'permintaan.id_permintaan')
            ->get()->all();
        return view('programmer/dticket',compact('users'));
    }
	public function tticket(Request $request)
    {
		
        DB::table('tiket')->insert([
		'id_tiket' => $request->id_tiket,
		'task' => $request->task,
		'aktifitas' => $request->aktifitas,
		'progress' => $request->progress,
		'timeline2' => $request->timeline2,
		'id_permintaan' => $request->id_permintaan
		
		
		]);
		
		return redirect('programmer/aktifitas');
    }
    public function project()
    {
    	return view('programmer/project');
    }
    public function dproject()
    {
        return view('programmer/dproject');
    }
    public function edituser()
    {
        return view('programmer/edituser');
    }
	public function aktifitas()
    {
		
	   $siswa = DB::table('tiket')
            ->join('permintaan', 'tiket.id_permintaan', '=', 'permintaan.id_permintaan')
            ->select('tiket.id_tiket', 'tiket.task', 'tiket.aktifitas', 'tiket.progress', 'tiket.timeline2', 'permintaan.permintaan_app')
            ->paginate(2);
		
		return view('programmer/aktifitas',compact('siswa'));
    }
/*Penambahan untuk mecari data sesuai proyek di menu aktifitas(rita)*/
	public function cari(Request $request)
	{
		$cari = $request->cari;
		
		$siswa = DB::table('tiket')
		->join('permintaan', 'tiket.id_permintaan', '=', 'permintaan.id_permintaan')
        ->where('permintaan_app','like',"%".$cari."%")
		->paginate(2);
		
		return view('programmer/aktifitas',compact('siswa'));
	}
	public function dataaktifitas()
	{
		 $dataak= DB::table('permintaan')->paginate(2);
		
		return view('programmer/dataaktifitas',compact('dataak'));
	}
	public function detailaktifitas($id_permintaan)
    {
		Session::put('id_permintaan',$id_permintaan);
	   $daktif = DB::table('tiket')
            ->join('permintaan', 'tiket.id_permintaan', '=', 'permintaan.id_permintaan')
			->where('tiket.id_permintaan','=',$id_permintaan)
            ->select('tiket.id_permintaan', 'tiket.id_tiket', 'tiket.task', 'tiket.aktifitas', 'tiket.progress', 'permintaan.permintaan_app')
            ->paginate(2);
			
			$sum = DB::table('tiket')
			->where('tiket.id_permintaan','=',$id_permintaan)
			->sum('progress');
			
			$avg = DB::table('tiket')
			->where('tiket.id_permintaan','=',$id_permintaan)
			->average('progress');
		
		return view('programmer/detailaktifitas',compact('daktif','sum','avg'));
    }
	public function hapustiket($id_tiket)
	{
	
	DB::table('tiket')->where('id_tiket',$id_tiket)->delete();
	
	return redirect('programmer/aktifitas');
	}
	public function editaktifitas($id_tiket)
	{
	
	$eaktif = DB::table('tiket')
            ->join('permintaan', 'tiket.id_permintaan', '=', 'permintaan.id_permintaan')
			
			->where('tiket.id_tiket','=',$id_tiket)
            ->select('tiket.id_permintaan', 'tiket.id_tiket', 'tiket.progress', 'tiket.task', 'tiket.aktifitas', 'permintaan.permintaan_app', 'tiket.timeline2')
            ->paginate(2);
		
		return view('programmer/editaktifitas',compact('eaktif'));
	}
	public function updateaktifitas(Request $request)
    {
		
	   DB::table('tiket')
            ->join('permintaan', 'tiket.id_permintaan', '=', 'permintaan.id_permintaan')
			->where('tiket.id_tiket','=',$request->id_tiket)
			->update([
		
		'task' => $request->task,
		'aktifitas' => $request->aktifitas,
		'progress' => $request->progress,
		'timeline2' => $request->timeline2
	]);
		
		return redirect('programmer/aktifitas');
    }
}
