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


Route::get('/','AnggotaController@landing');
Route::get('/user','UserController@karyawan');
Route::post('/hitung','BungaController@prosesHitung');
Route::get('/hitungbunga','BungaController@hitung');
Route::resource('anggota','AnggotaController');
Route::resource('simpanan','SimpananController');
Route::resource('bunga','BungaController');
Route::post('anggota/{anggotum}','AnggotaController@aktif');
Route::get('hasil', 'SimpananController@getName');
Route::put('/simpanan', 'SimpananController@cariAnggota');
Route::get('/jenistransaksi', 'SimpananController@jenisTrx');
Route::get('/report', 'SimpananController@report');
Route::get('/tambahkaryawan', 'UserController@register');


Route::post('useraktif/{user}','UserController@aktif');
Route::delete('usernon/{user}','UserController@nonaktif');


Route::post('/user','UserController@validasi');
Route::post('/userinsert', 'UserController@signup');

Route::post('/testing-ajax','AnggotaController@simpan');
Route::put('anggota/{anggotum}','AnggotaController@ubah');
Route::post('/anggota-edit','AnggotaController@check_update');

Route::post('/simpananinsert','SimpananController@simpan');

Route::get('user/{user}','UserController@detail');
Route::get('user/{user}/edit','UserController@formedit');
Route::put('user/{user}','UserController@ubah');
Route::post('/karyawan-edit','UserController@check_update');

Route::get('/report_nasabah','ReportController@nasabah');
Route::get('/report_nasabah/{id}','ReportController@show');
Route::get('/report_bulanan','ReportController@indexBulanan');
Route::put('/report_bulanan','ReportController@bulanan');
Route::get('/report_harian','ReportController@indexHarian');
Route::put('/report_harian','ReportController@harian');
Route::get('/report_mingguan','ReportController@indexMingguan');
Route::put('/report_mingguan','ReportController@mingguan');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
