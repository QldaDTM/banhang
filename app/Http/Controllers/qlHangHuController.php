<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\qlHangHu;
use App\nhapkho;
use App\khoVatLieuChinh;
class qlHangHuController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function qlHangHu() {
    $qlHangHu = new qlHangHu();
    $hanghu = $qlHangHu->ncctable();
    return view('qlHangHu',["hanghu"=>$hanghu]);
  }	
  public function insert(Request $request){
    $qlHangHu = new qlHangHu();
    $HangHu = $qlHangHu->TaoPhieuNhapKho($request);
    return redirect()->back();
  }
  public function update(Request $request) {
    $qlHangHu = qlHangHu::where(
    'MaSanPham',$request->suamasp)->where('MaNhapKhoHong', $request->suamancc)
    ->update(
      ['TinhTrang' => $request->suaemailncc]);
    return redirect()->back();
  } 
  public function delete(Request $request){
    $qlHangHu = new qlHangHu();
    $mang=explode(';',$request->xoancc);
    $qlHangHu->xoaKhoHong($mang[0]);
    return redirect()->back();
  }
  public function search(Request $Request){
    $hanghong = new qlHangHu();
    $nhapkho= new nhapkho();


    if (isset($Request->ktgspkh)){
     return $hanghong->kiemtramaxk($Request->ktgspkh);
    }
    if (isset($Request->gspkh)){
     
     return json_encode($hanghong->getmasp($Request->gspkh));
    }
    if (isset($Request->selectkh)){
      
      return json_encode( $hanghong->getselectkho($Request->selectkh));
    }
    if (isset($Request->getsoluonghdxk)){
      return $hanghong->getsoluonghdxk($Request->getsoluonghdxk,$Request->getsoluonghdxk1);
    }

    if (isset($Request->getidkh)){
      return $hanghong->getidtoinsert();
    }

  }
}
?>