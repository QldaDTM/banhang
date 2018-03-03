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
Route::post('ql-sanpham-search', 'qlSanPhamController@search');

Route::get('khovatlieuchinh', 'khoVatLieuChinhController@khoVatLieuChinh');
Route::post('khovatlieuchinh-them', 'khoVatLieuChinhController@insert');
Route::post('khovatlieuchinh-sua', 'khoVatLieuChinhController@update');
Route::post('khovatlieuchinh-xoa', 'khoVatLieuChinhController@delete');

Route::get('khovatlieuhong', 'khoVatLieuHongController@khoVatLieuHong');
Route::post('khovatlieuhong-them', 'khoVatLieuHongController@insert');
Route::post('khovatlieuhong-sua', 'khoVatLieuHongController@update');
Route::post('khovatlieuhong-xoa', 'khoVatLieuHongController@delete');

Route::get('kiemtratonkho', 'kiemTraTonKhoController@kiemTraTonKho');
Route::get('kiemtratonkho-loc', 'kiemTraTonKhoController@filter');
Route::post('kiemtratonkho-inthongke', 'kiemTraTonKhoController@printer');

Route::get('ql-hanghu', 'qlHangHuController@qlHangHu');
Route::post('ql-hanghu-them', 'qlHangHuController@insert');
Route::post('ql-hanghu-sua', 'qlHangHuController@update');
Route::post('ql-hanghu-xoa', 'qlHangHuController@delete');
Route::get('ql-hanghu-tim', 'qlHangHuController@search');

Route::any('nhap-kho', 'nhapKhoController@NhapKho');
Route::post('nhap-kho-run', 'nhapKhoController@Nhap');
Route::any('search-kho', 'nhapKhoController@searchKho');

Route::any('xuat-kho', 'xuatKhoController@XuatKho');

Route::get('thong-ke-NX', 'thongKeController@NhapXuat');
Route::post('thong-ke-NX-ajax', 'thongKeController@AjaxRequest');
Route::get('thong-ke-TT', 'thongKeTTController@ThongKeTT');
Route::post('thong-ke-TT-ajax', 'thongKeTTController@AjaxRequest');

Auth::routes();
