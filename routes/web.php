<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

//login

//programmer
Route::get('/programmer','ProgrammerController@login');
Route::post('/programmer/masuk', 'ProgrammerController@proseslogin');
Route::get('/programmer/logout', 'ProgrammerController@logout');

//manager
Route::get('/manager', 'ManagerController@login');
Route::post('/manager/masuk', 'ManagerController@masuk');
Route::get('/manager/logout', 'ManagerController@logout');

//route programmer get page
Route::get('/programmer/home', 'ProgrammerController@home');
Route::get('/programmer/ticket', 'ProgrammerController@ticket');
Route::get('/programmer/dticket', 'ProgrammerController@dticket');
Route::get('/programmer/ticket/detail_tiket/{ID_PROYEK}', 'ProgrammerController@detail_tiket');
Route::get('/programmer/project', 'ProgrammerController@project');
Route::get('/programmer/dproject', 'ProgrammerController@dproject');
Route::get('/programmer/edituser', 'ProgrammerController@edituser');
Route::get('/programmer/aktifitas', 'ProgrammerController@aktifitas'); 
Route::get('/programmer/tambah','ProgrammerController@tambah');


//route Manager get page
Route::get('/manager/home', 'ManagerController@home');
Route::get('/manager/ticket', 'ManagerController@ticket');
Route::get('/manager/ticket/detail_tiket/{ID_PROYEK}', 'ManagerController@detail_tiket');
Route::get('/manager/dticket', 'ManagerController@dticket');
Route::get('/manager/eticket', 'ManagerController@eticket');
Route::get('/manager/report', 'ManagerController@report');
Route::get('/manager/user','ManagerController@user');
Route::get('/manager/tambah','ManagerController@tambah');
Route::get('/manager/user/edit/{ID_PROGRAMER}','ManagerController@edit');
Route::get('/manager/user/hapus/{ID_PROGRAMER}}','ManagerController@hapus');
Route::get('/manager/aktifitas', 'ManagerController@aktifitas');
Route::get('/manager/cetak', 'ManagerController@cetak'); 
Route::get('/manager/cari', 'ManagerController@cari'); 


//Route for proses data into database
Route::post('/manager/tambahuser','ManagerController@tambahuser');
Route::post('/manager/user/update','ManagerController@update');
Route::post('/manager/tticket', 'ManagerController@tticket');
Route::post('/manager/ticket/tambah_komen', 'ManagerController@tambah_komen');
Route::post('/manager/update', 'ManagerController@updateticket');
Route::post('/manager/showreport', 'ManagerController@showreport');


//Route for proses data into database
Route::post('/programmer/tambahproject','ProgrammerController@tambahproject');
Route::post('/programmer/dproject2','ProgrammerController@dproject2');
Route::post('/programmer/ticket/tambah_komen', 'ManagerController@tambah_komen');