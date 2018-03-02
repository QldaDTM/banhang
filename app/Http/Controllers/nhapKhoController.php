<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qlSanPham;
use App\nhapKho;
use Illuminate\Support\Facades\DB;

class nhapKhoController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function NhapKho() {
    $qlsp = new qlSanPham();
    $masp = $qlsp->getmasp();
    return view('nhapKho',["masp"=>$masp]);
  }

  public function Nhap(Request $request) {
    // if(isset($request)){
    //   $nk = new nhapKho();
    //   if($nk->TaoPhieuNhapKho($request))
    //     echo "<script>alert('thanh cong!')</script>";
    //   else echo "<script>alert('that bai!')</script>";
    //   return redirect()->back();
    // }
    $nk = new nhapKho();
    $nk->TaoPhieuNhapKho($request);
       
    //return redirect()->back();
    //echo "<script>console.log(''".$request."'')</script>";
    //return redirect()->back();
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
