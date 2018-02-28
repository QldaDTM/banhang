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
Route::get('ql-nhacungcap', 'HomeController@qlNhaCungCap');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');