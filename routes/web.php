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
    return view('welcome');
});
Route::get('my-home', 'HomeController@myHome');
Route::get('my-users', 'HomeController@myUsers');

Route::get('ql-nhacungcap', 'qlNhaCungCapController@qlNhaCungCap');
Route::post('ql-nhacungcap-them', 'qlNhaCungCapController@insert');
Route::post('ql-nhacungcap-sua', 'qlNhaCungCapController@update');
Route::post('ql-nhacungcap-xoa', 'qlNhaCungCapController@delete');

Route::get('ql-vatlieu', 'qlVatLieuController@qlNhaCungCap');
Route::post('ql-vatlieu-them', 'qlVatLieuController@insert');
Route::post('ql-vatlieu-sua', 'qlVatLieuController@update');
Route::post('ql-vatlieu-xoa', 'qlVatLieuController@delete');

Route::get('nhap-kho', 'nhapKhoController@NhapKho');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');