<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qlSanPham;
use App\nhapKho;
use Illuminate\Support\Facades\DB;

class nhapKhoController extends Controller
{
  public function NhapKho() {
    if(isset($request->gspnknhapkhosubmit)){
      echo '<script>alert("Nhập thành công!");</script>';
    }
    $qlsp = new qlSanPham();
    $masp = $qlsp->getmasp();
    return view('nhapKho',["masp"=>$masp]);
  }

  public function searchKho(Request $request) {
 
    if(isset($request->getidnk)){
      $nk = new nhapKho();
      return $nk->getIdToInsert();
    }

    if(isset($request->selectkhonk)){
      $masp = $request->selectkhonk;
      $sql = 'select * from kho where MaSanPham = :masp';
      $result = DB::select($sql, ["masp"=>$masp]);
     return $result;
    }

    if(isset($request->gspnk)){
      $qlsp = new qlSanPham();
     return $qlsp->getmasp();
    }
  }
}
?>
