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

Route::get('ql-sanpham', 'qlSanPhamController@qlSanPham');
Route::post('ql-sanpham-them', 'qlSanPhamController@insert');
Route::post('ql-sanpham-sua', 'qlSanPhamController@update');
Route::post('ql-sanpham-xoa', 'qlSanPhamController@delete');

Route::post('search-sanpham', 'searchController@searchSanPham');

Route::get('nhap-kho', 'nhapKhoController@NhapKho');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');