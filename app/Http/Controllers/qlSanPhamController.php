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
	public function insert(Request $request){
		$sanpham = new qlSanPham;
		$sanpham->MaSanPham = $request->themmacsp;
		$sanpham->TenSanpham = $request->themtencsp;
		$sanpham->MaNhaCungCap = $request->themncccsp;
		$sanpham->SoLuongTon = $request->themsltcsp;
		$sanpham->DonGia = $request->themdgcsp;
		$sanpham->DonVi= $request->themdvcsp;
		$sanpham->save();
		return redirect()->back();
	}
	public function update(Request $request){
		$nhacungcap = qlSanPham::where(
			'MaSanPham',$request->suamacsp)
			->update(
				['TenSanpham' => $request->suatencsp,
				'MaNhaCungCap' => $request->suancccsp,
				'SoLuongTon' => $request->suasltcsp,
				'DonGia' => $request->suadgcsp,
				'DonVi' => $request->suadvcsp ]);
		return redirect()->back();
	}
	public function delete(Request $request){
		$nhacungcap = qlSanPham::where('MaSanPham',$request->xoacsp)->delete();
		return redirect()->back();
	}
	public function search(Request $request){
		$sanpham = new qlSanPham();
		return $sanpham->search($request->searchcsp);
	}
}
?>
