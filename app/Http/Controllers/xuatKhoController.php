<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qlSanPham;
use App\xuatKho;
use Illuminate\Support\Facades\DB;

class xuatKhoController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function XuatKho() {
    $sql = "select sp.MaSanPham as masp, sp.TenSanPham as tensp, ncc.TenNhaCungCap as tenncc, sp.SoLuongTon as sl, sp.DonVi as dv, sp.DonGia as dongia
    from sanpham sp, nhacungcap ncc
    where
    sp.MaNhaCungCap = ncc.MaNhaCungCap and
    sp.MaSanPham in (select MaSanPham from kho) and SoLuongTon <> 0";
    $details = DB::select($sql);
    $kho = DB::select("select * from kho");
    return view('xuatKho',["details"=>$details, "kho"=>$kho]);
  }

  public function getKho()
  {
    $sql="select * from kho";
    return DB::select($sql);
  }
}
?>
