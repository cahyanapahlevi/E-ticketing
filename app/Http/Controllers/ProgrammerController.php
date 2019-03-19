<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
