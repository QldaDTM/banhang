<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\thongKe;

class thongKeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function NhapXuat() {
    $tk = new thongKe();
    $details = $tk->getDetailXuat('maphieu','asc','','','');
    return view('thongKeXN',["details"=>$details]);
  }

  public function AjaxRequest(Request $Request){
    $t = new thongKe;
    if (isset($Request->type))
    {
      if ($Request->type == 'asc')
      {
        switch($Request->name)
        {
        case 'mp'		: echo $t->getDetailXuat('maphieu','asc',$Request->keys,$Request->dates,$Request->datee);break;
        case 'nx'	: echo $t->getDetailXuat('ngayxuat','asc',$Request->keys,$Request->dates,$Request->datee);break;
        default: echo $t->getDetailXuat('tensp','asc',$Request->keys,$Request->dates,$Request->datee);
        }
      }
      else
      {
        switch($Request->name)
        {
        case 'mp'		: echo $t->getDetailXuat('maphieu','desc',$Request->keys,$Request->dates,$Request->datee);break;
        case 'nx'	: echo $t->getDetailXuat('ngayxuat','desc',$Request->keys,$Request->dates,$Request->datee);break;
        default: echo $t->getDetailXuat('tensp','desc',$Request->keys,$Request->dates,$Request->datee);
        }
      }
    }
  
    if (isset($Request->typen))
    {
      if ($Request->typen == 'asc')
      {
        switch($Request->namen)
        {
        case 'mp'		: echo $t->getDetailNhap('maphieu','asc',$Request->keys,$Request->dates,$Request->datee);break;
        case 'nx'	: echo $t->getDetailNhap('ngaynhap','asc',$Request->keys,$Request->dates,$Request->datee);break;
        default: echo $t->getDetailNhap('tensp','asc',$Request->keys,$Request->dates,$Request->datee);
        }
      }
      else
      {
        switch($Request->namen)
        {
        case 'mp'		: echo $t->getDetailNhap('maphieu','desc',$Request->keys,$Request->dates,$Request->datee);break;
        case 'nx'	: echo $t->getDetailNhap('ngaynhap','desc',$Request->keys,$Request->dates,$Request->datee);break;
        default	: echo $t->getDetailNhap('tensp','desc',$Request->keys,$Request->dates,$Request->datee);
        }
      }
    }
  
    if (isset($Request->loai))
    {
      if($Request->loai == "nhapkho")
      {
        echo $t->getDetailNhap('maphieu','asc','','','');
      }
      else
      {
        echo $t->getDetailXuat('maphieu','asc','','','');
      }
    }
  }


}
?>
