<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qlSanPham;
use App\qlNhaCungCap;
class qlSanPhamController extends Controller
{
	public function __construct()
  {
    $this->middleware('auth');
  }

  public function qlSanPham() {
    $sanpham = qlSanPham::all();
    $nhacungcap = qlNhaCungCap::all();
    return view('qlSanPham',["sanpham"=>$sanpham, "nhacungcap" => $nhacungcap]);
  }
	// public function insert(Request $request){
 //    	$nhacungcap = new qlSanPham;
 //    	$nhacungcap->MaNhaCungCap = $request->themmancc;
 //    	$nhacungcap->TenNhaCungCap = $request->themtenncc;
 //    	$nhacungcap->DiaChi = $request->themdcncc;
 //    	$nhacungcap->SDT = $request->themsdtncc;
 //    	$nhacungcap->Email = $request->thememailncc;
 //    	$nhacungcap->MaSoThue= $request->themmstncc;
 //    	$nhacungcap->save();
 //    	return redirect()->back();
 //  }
 //  public function update(Request $request){
 //  	$nhacungcap = qlSanPham::where(
 //  		'MaNhaCungCap',$request->suamancc)
 //  		->update(
 //  			['TenNhaCungCap' => $request->suatenncc,
 //  			'DiaChi' => $request->suadcncc,
 //  			'SDT' => $request->suasdtncc,
 //  			'Email' => $request->suaemailncc,
 //  			'MaSoThue' => $request->suamstncc ]);
 //  	return redirect()->back();
 //  }
 //  public function delete(Request $request){
 //  	$nhacungcap = qlSanPham::where('MaNhaCungCap',$request->xoancc)->delete();
 //  	return redirect()->back();
 //  }
}
?>
