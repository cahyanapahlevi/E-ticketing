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
Route::get('/programmer','ProgrammerController@login');
Route::get('/manager', 'ManagerController@login');

//route programmer
Route::get('/programmer/home', 'ProgrammerController@home');
Route::get('/programmer/ticket', 'ProgrammerController@ticket');
Route::get('/programmer/dticket', 'ProgrammerController@dticket');
Route::get('/programmer/project', 'ProgrammerController@project');
Route::get('/programmer/dproject', 'ProgrammerController@dproject');
Route::get('/programmer/edituser', 'ProgrammerController@edituser');
Route::get('/programmer/aktifitas', 'ProgrammerController@aktifitas');
Route::get('/programmer/dataaktifitas', 'ProgrammerController@dataaktifitas');//tambahan untuk cari data proyek (rita)
Route::get('/programmer/detailaktifitas/{id_permintaan}', 'ProgrammerController@detailaktifitas');//tambahan untuk cari data proyek (rita)
Route::get('/programmer/hapustiket/{id_tiket}', 'ProgrammerController@hapustiket');//
Route::get('/programmer/editaktifitas/{id_tiket}', 'ProgrammerController@editaktifitas');//tambahan untuk cari data proyek (rita)
Route::post('/programmer/tticket', 'ProgrammerController@tticket');
Route::post('/programmer/updateaktifitas', 'ProgrammerController@updateaktifitas');//tambahan untuk cari data proyek (rita)
//route Manager
Route::get('/manager/home', 'ManagerController@home');
Route::get('/manager/ticket', 'ManagerController@ticket');
Route::get('/manager/dticket', 'ManagerController@dticket');
Route::get('/manager/eticket/{id_permintaan}', 'ManagerController@eticket');
Route::get('/manager/report', 'ManagerController@report');
Route::get('/manager/user','ManagerController@user');
Route::get('/manager/aktifitas', 'ManagerController@aktifitas');
Route::get('/manager/cari', 'ManagerController@cari'); 
Route::get('/manager/dataaktifitas', 'ManagerController@dataaktifitas');//tambahan untuk cari data proyek (rita)
Route::get('/manager/taktifitas', 'ManagerController@taktifitas');//tambahan untuk cari data proyek (rita)
Route::get('/manager/detailaktifitas/{id_permintaan}', 'ManagerController@detailaktifitas');//tambahan untuk cari data proyek (rita)
Route::get('/manager/editaktifitas/{id_permintaan}', 'ManagerController@editaktifitas');//tambahan untuk cari data proyek (rita)
Route::get('/manager/hapus/{id_permintaan}', 'ManagerController@hapus');//
Route::get('/manager/hapus2/{id_tiket}', 'ManagerController@hapus2');//
//route manager post
Route::post('/manager/tticket', 'ManagerController@tticket');
Route::post('/manager/update', 'ManagerController@update');
Route::post('/manager/showreport', 'ManagerController@showreport');
Route::post('/manager/tambahaktifitas', 'ManagerController@tambahaktifitas');//tambahan untuk cari data proyek (rita)
Route::post('/manager/updateaktifitas', 'ManagerController@updateaktifitas');//tambahan untuk cari data proyek (rita)
