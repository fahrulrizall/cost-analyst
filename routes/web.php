<?php

use App\Http\Controllers\Auth\LoginController;
use app\pt;
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

//halaman awal
Route::get('/','PagesController@home');


//untuk fgs
Route::get('/fgs/getubah','FgsController@getubah');
Route::post('/fgs','FgsController@store');
Route::get('/fgs/{plantfgs}','FgsController@index');
Route::delete('/fgs/{fg}','FgsController@destroy');
Route::post('/fgs/{fg}/update','FgsController@update');

//untuk macs
Route::get('/macs/getubah','MacsController@getubah');
Route::post('/macs','MacsController@store');
Route::get('/macs/{plantmacs}','MacsController@index');
Route::delete('/macs/{mac}','MacsController@destroy');
Route::post('/macs/{mac}/update','MacsController@update');

//untuk pts
Route::get('/pts/{plantpts}','PtsController@index');//halaman awal
Route::post('/pts','PtsController@store');//tambah pt
Route::get('/pts/{plantpts}/edit/{pt}','PtsController@show');// menuju pt yang di edit
Route::delete('/pts/{pt}','PtsController@destroy');// menghapus pt


//untuk item pada pts
Route::post('/pts/{fg}/add/{pt_name}','PtsController@add'); // menambah item pada pt
Route::delete('/pts/{id}/delete','PtsController@destroyitem');//hapus item pada pt
Route::post('/pts/{id}/update','PtsController@update');//update lbs dan loin
Route::get('/ptspt/getubah','PtsController@getubah');//get data for jquery

// untuk packagings
Route::get('/packagings/{plantpackagings}','PackagingsController@index');//halaman awal
Route::post('/packagings','PackagingsController@store');//halaman awal
Route::delete('/packagings/{packaging}','PackagingsController@destroy');//halaman awal




Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
