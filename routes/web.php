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

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Route::get('ql-nhacungcap', 'qlNhaCungCapController@qlNhaCungCap');
Route::post('ql-nhacungcap-them', 'qlNhaCungCapController@insert');
Route::post('ql-nhacungcap-sua', 'qlNhaCungCapController@update');
Route::post('ql-nhacungcap-xoa', 'qlNhaCungCapController@delete');

Route::get('ql-sanpham', 'qlSanPhamController@qlSanPham');
Route::post('ql-sanpham-them', 'qlSanPhamController@insert');
Route::post('ql-sanpham-sua', 'qlSanPhamController@update');
Route::post('ql-sanpham-xoa', 'qlSanPhamController@delete');

Route::get('khovatlieuchinh', 'khoVatLieuChinhController@khoVatLieuChinh');
Route::post('khovatlieuchinh-them', 'khoVatLieuChinhController@insert');
Route::post('khovatlieuchinh-sua', 'khoVatLieuChinhController@update');
Route::post('khovatlieuchinh-xoa', 'khoVatLieuChinhController@delete');

Route::post('search-sanpham', 'searchController@searchSanPham');

Route::any('nhap-kho', 'nhapKhoController@NhapKho');
Route::any('search-kho', 'nhapKhoController@searchKho');
Auth::routes();
