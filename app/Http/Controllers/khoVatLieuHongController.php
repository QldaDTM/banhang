<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\khoVatLieuHong;
use App\qlSanPham;
class khoVatLieuHongController extends Controller
{
  public function __construct()
  {
        $this->middleware('auth');
  }

  public function khoVatLieuHong() {
    $khoVatLieuHong = khoVatLieuHong::all();
    $sanpham = qlSanPham::all();
    return view('khoVatLieuHong',["khoVatLieuHong"=>$khoVatLieuHong, "sanpham"=>$sanpham]);
  }
	public function insert(Request $request){
    	$khoVatLieuHong = new khoVatLieuHong;
    	$khoVatLieuHong->MaKhu = $request->themmaksp;
    	$khoVatLieuHong->TenKhu = $request->themtenksp;
    	$khoVatLieuHong->MaSanpham = $request->themmspksp;
    	$khoVatLieuHong->SoLuongChuaToiDa = $request->themsltdksp;
      $khoVatLieuHong->SoLuongDangChua = 0;
    	$khoVatLieuHong->save();
    	return redirect()->back();
  }
  public function update(Request $request){
    
  	$khoVatLieuHong = khoVatLieuHong::where(
  		'MaKhu',$request->suamaksp)
  		->update(
  			['TenKhu' => $request->suatenksp,
  			'MaSanpham' => $request->suamspksp,
  			'SoLuongChuaToiDa' => $request->suasltdksp]);
  	return redirect()->back();
  }
  public function delete(Request $request){
  	$khoVatLieuHong = khoVatLieuHong::where('MaKhu',$request->xoaksp)->delete();
  	return redirect()->back();
  }
}
?>