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
Route::get('/programmer/masuk','ProgrammerController@login');
Route::get('/manager', 'ManagerController@login');
Route::post('/manager/masuk', 'ManagerController@masuk');
Route::get('/manager/logout', 'ManagerController@logout');

//route programmer
Route::get('/programmer/home', 'ProgrammerController@home');
Route::get('/programmer/ticket', 'ProgrammerController@ticket');
Route::get('/programmer/dticket', 'ProgrammerController@dticket');
Route::get('/programmer/project', 'ProgrammerController@project');
Route::get('/programmer/dproject', 'ProgrammerController@dproject');
Route::get('/programmer/edituser', 'ProgrammerController@edituser');

//route Manager
Route::get('/manager/home', 'ManagerController@home');
Route::get('/manager/ticket', 'ManagerController@ticket');
Route::get('/manager/dticket', 'ManagerController@dticket');
Route::get('/manager/eticket', 'ManagerController@eticket');
Route::get('/manager/report', 'ManagerController@report');
Route::get('/manager/user','ManagerController@user');
Route::get('/manager/tambah','ManagerController@tambah');
Route::get('/manager/user/edit/{id_programer}','ManagerController@edit');
Route::get('/manager/user/hapus/{id_programer}','ManagerController@hapus');

//Route Manager
Route::post('/manager/tambahuser','ManagerController@tambahuser');
Route::post('/manager/user/update','ManagerController@update');
Route::post('/manager/tticket', 'ManagerController@tticket');
Route::post('/manager/update', 'ManagerController@update');