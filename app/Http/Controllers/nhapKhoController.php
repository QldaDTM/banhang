<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qlSanPham;

class nhapKhoController extends Controller
{
  public function NhapKho() {
    $qlsp = new qlSanPham();
    $masp = $qlsp->getmasp();
    return view('nhapKho',["masp"=>$masp]);
  }
}
?>
