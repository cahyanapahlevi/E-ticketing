<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgrammerController extends Controller
{
    
     public function login(){
        return view('programmer/login');
    }

    public function masuk(Request $request)
    {

        $nama_programer =$request->USERNAME_PROGRAMER;
        $pass     =$request->PASSWORD_PROGRAMER;
        $data = DB::table('programer')->where('USERNAME_PROGRAMER',$nama_manager)->first();
        if($data){ 
            if(DB::table('programer')->where('PASSWORD_PROGRAMER',$pass)->first()){
                Session::put('ID',$data->ID_PROGRAMER);
                Session::put('nama',$data->USERNAME_PROGRAMER);
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
        return view('programmer/dproject');
    }
    public function edituser()
    {
        return view('programmer/edituser');
    }

}
