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
Route::get('/programmer/logout_p', 'ProgrammerController@logout_p');

//manager
Route::get('/manager', 'ManagerController@login');
Route::post('/manager/masuk', 'ManagerController@masuk');
Route::get('/manager/logout', 'ManagerController@logout');

//route programmer get page
Route::get('/programmer/home', 'ProgrammerController@home');
Route::get('/programmer/baca/{ID_PROYEK}', 'ProgrammerController@baca');
Route::get('/programmer/ticket', 'ProgrammerController@ticket');
Route::get('/programmer/dticket',array('as'=>'myform','uses'=>'ProgrammerController@dticket'));
Route::get('/programmer/dticket/myform/ajax/{id}',array('as'=>'myform.ajax','uses'=>'ProgrammerController@myformAjax'));
Route::get('/programmer/ticket/detail_tiket/{ID_PROYEK}', 'ProgrammerController@detail_tiket');
Route::get('/programmer/project', 'ProgrammerController@project');
Route::get('/programmer/dproject', 'ProgrammerController@dproject');
Route::get('/programmer/editprofil', 'ProgrammerController@editprofile');
Route::get('/programmer/aktifitas', 'ProgrammerController@aktifitas'); 
Route::get('/programmer/tambah','ProgrammerController@tambah');
Route::get('/programmer/dproject2', 'ProgrammerController@dproject2');
Route::get('/programmer/project/edit/{ID_PROYEK}', 'ProgrammerController@edit');
Route::get('/programmer/project/hapus/{ID_PROYEK}','ProgrammerController@hapus');
Route::get('/programmer/dataaktifitas', 'ProgrammerController@dataaktifitas');//tambahan untuk cari data proyek (rita)
Route::get('/programmer/detailaktifitas/{ID_PROYEK}', 'ProgrammerController@detailaktifitas');//tambahan ihat detail proyek (rita)
Route::get('/programmer/hapustiket/{ID_TIKET}', 'ProgrammerController@hapustiket');//tambahan untuk hapus tiket atau per aktifitas
Route::get('/programmer/editaktifitas/{ID_TIKET}', 'ProgrammerController@editaktifitas');//tambahan edit tiket (aktifitas) (rita)
Route::get('/programmer/dticketprog', 'ProgrammerController@dticketprog');
Route::get('/programmer/cari', 'ProgrammerController@cari');
Route::get('/programmer/dticket','ProgrammerController@dticket');
Route::get('/programmer/dticket/caritiket', 'ProgrammerController@caritiket');
Route::get('/programmer/dticket/caritiket/edit/{ID_TIKET}', 'ProgrammerController@caritiket');
//route Manager get page
Route::get('/manager/home', 'ManagerController@home');
Route::get('/manager/baca/{ID_PROYEK}', 'ManagerController@baca');
Route::get('/manager/open/{ID_PROYEK}', 'ManagerController@open');
Route::get('/manager/progress/{ID_PROYEK}', 'ManagerController@progress');
Route::get('/manager/closed/{ID_PROYEK}', 'ManagerController@closed');
Route::get('/manager/ticket', 'ManagerController@ticket');
Route::get('/manager/ticket/detail_tiket/{ID_PROYEK}', 'ManagerController@detail_tiket');
Route::get('/manager/dticket', 'ManagerController@dticket');
Route::get('/manager/eticket', 'ManagerController@eticket');
Route::get('/manager/report', 'ManagerController@report');
Route::get('/manager/user','ManagerController@user');
Route::get('/manager/editprofil','ManagerController@edituser');
Route::get('/manager/tambah','ManagerController@tambah');
Route::get('/manager/user/edit/{ID_PROGRAMER}','ManagerController@edit');
Route::get('/manager/user/hapus/{ID_PROGRAMER}}','ManagerController@hapus');
Route::get('/manager/aktifitas', 'ManagerController@aktifitas');
Route::get('/manager/cetak', 'ManagerController@cetak'); 
Route::get('/manager/cari', 'ManagerController@cari'); 
Route::get('/manager/cari', 'ManagerController@cari'); //tambahan untuk cari data proyek (rita)
Route::get('/manager/dataaktifitas', 'ManagerController@dataaktifitas');//tambahan untuk cari data proyek (rita)
Route::get('/manager/taktifitas', 'ManagerController@taktifitas');//tambahan untuk cari data proyek (rita)
Route::get('/manager/detailaktifitas/{ID_PROYEK}', 'ManagerController@detailaktifitas');//tambahan untuk cari data proyek (rita)
Route::get('/manager/editaktifitas/{ID_PROYEK}', 'ManagerController@editaktifitas');//tambahan untuk cari data proyek (rita)
Route::get('/manager/hapusproyek/{ID_PROYEK}', 'ManagerController@hapusproyek');//
Route::get('/manager/hapustiket/{ID_TIKET}', 'ManagerController@hapustiket');//
Route::get('/manager/proyek', 'ManagerController@proyek'); 
Route::get('/manager/reportproyek', 'ManagerController@reportproyek');//tambahan untuk dropdown report (rita)
Route::get('/manager/reportorang', 'ManagerController@reportorang');//tambahan untuk dropdown report (rita)
Route::get('/manager/onprogress', 'ManagerController@onprogress'); /*8-4-2019*/
Route::get('/manager/taktifitas2', 'ManagerController@taktifitas2');



//Route for proses data into database
Route::post('/manager/baca', 'ManagerController@baca');
Route::post('/manager/tambahuser','ManagerController@tambahuser');
Route::post('/manager/user/update','ManagerController@update');
Route::post('/manager/profile/update_profile','ManagerController@update_profile');
Route::post('/manager/tticket', 'ManagerController@tticket');
Route::post('/manager/ticket/tambah_komen', 'ManagerController@tambah_komen');
Route::post('/manager/update', 'ManagerController@updateticket');
Route::post('/manager/showreport', 'ManagerController@showreport');
Route::post('/manager/tambahaktifitas', 'ManagerController@tambahaktifitas');//tambahan untuk cari data proyek (rita)
Route::post('/manager/updateaktifitas', 'ManagerController@updateaktifitas');//tambahan untuk cari data proyek (rita)
Route::post('/manager/tambahaktifitas2', 'ManagerController@tambahaktifitas2');


//Route for proses data into database
Route::post('/programmer/baca', 'ProgrammerController@baca');
Route::post('/programmer/tambahproject','ProgrammerController@tambahproject');
Route::post('/programmer/tambahproject2','ProgrammerController@tambahproject2');
Route::post('/programmer/updateproject','ProgrammerController@updateproject');
Route::post('/programmer/dproject2','ProgrammerController@dproject2');
Route::post('/programmer/ticket/tambah_komen', 'ProgrammerController@tambah_komen');
Route::post('/programmer/profile/update_profile','ProgrammerController@update_profile');
Route::post('/programmer/updateaktifitas', 'ProgrammerController@updateaktifitas');//tambahan untuk edit aktifitas (rita)
Route::post('/programmer/tticket', 'ProgrammerController@tticket');
Route::post('/programmer/updateticket', 'ProgrammerController@updateticket');
