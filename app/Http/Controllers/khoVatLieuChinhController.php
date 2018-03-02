<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\khoVatLieuChinh;
use App\qlSanPham;
class khoVatLieuChinhController extends Controller
{
  public function __construct()
  {
        $this->middleware('auth');
  }

  public function khoVatLieuChinh() {
    $khoVatLieuChinh = khoVatLieuChinh::all();
    $sanpham = qlSanPham::all();
    return view('khoVatLieuChinh',["khoVatLieuChinh"=>$khoVatLieuChinh, "sanpham"=>$sanpham]);
  }
	public function insert(Request $request){
    	$khoVatLieuChinh = new khoVatLieuChinh;
    	$khoVatLieuChinh->MaKhu = $request->themmaksp;
    	$khoVatLieuChinh->TenKhu = $request->themtenksp;
    	$khoVatLieuChinh->MaSanpham = $request->themmspksp;
    	$khoVatLieuChinh->SoLuongChuaToiDa = $request->themsltdksp;
      $khoVatLieuChinh->SoLuongDangChua = 0;
    	$khoVatLieuChinh->save();
    	return redirect()->back();
  }
  public function update(Request $request){
    
  	$khoVatLieuChinh = khoVatLieuChinh::where(
  		'MaKhu',$request->suamaksp)
  		->update(
  			['TenKhu' => $request->suatenksp,
  			'MaSanpham' => $request->suamspksp,
  			'SoLuongChuaToiDa' => $request->suasltdksp]);
  	return redirect()->back();
  }
  public function delete(Request $request){
  	$khoVatLieuChinh = khoVatLieuChinh::where('MaKhu',$request->xoaksp)->delete();
  	return redirect()->back();
  }
}
?>