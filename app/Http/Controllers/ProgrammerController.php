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
        return view('programmer/dproject');
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
