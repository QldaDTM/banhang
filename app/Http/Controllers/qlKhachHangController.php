<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qlKhachHang;

class qlKhachHangController extends Controller
{
  public function __construct()
  {
        $this->middleware('auth');
  }

  public function qlKhachHang() {
    $khachhang = qlKhachHang::all();
    return view('qlKhachHang',["khachhang"=>$khachhang]);
  }
	public function insert(Request $request){
    	$khachhang = new qlKhachHang;
    	$khachhang->MaKhachHang = $request->themmakh;
    	$khachhang->TenKhachHang = $request->themtenkh;
      $khachhang->SDT = $request->themsdtkh;
    	$khachhang->DiaChi = $request->themdckh;

    	$khachhang->save();
    	return redirect()->back();
  }
  public function update(Request $request){
  	$khachhang = qlKhachHang::where(
  		'MaKhachHang',$request->suamakh)
  		->update(
  			['TenKhachHang' => $request->suatenkh,
          'SDT' => $request->suasdtkh,
  			 'DiaChi' => $request->suadckh]);
  	return redirect()->back();
  }
  public function delete(Request $request){
  	$khachhang = qlKhachHang::where('MaKhachHang',$request->xoakh)->delete();
  	return redirect()->back();
  }
}
?>