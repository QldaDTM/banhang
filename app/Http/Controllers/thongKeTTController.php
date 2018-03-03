<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\thongKeTT;

class thongKeTTController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function ThongKeTT() {
    $tktt = new thongKeTT();
    $details = $tktt->getDetails('manhap','asc','','','','0');
    return view('thongKeTT',["details"=>$details]);
  }

  public function AjaxRequest(Request $Request){
    $t = new thongKeTT;
    if ($Request->type == 'asc')
    {
      switch($Request->name)
      {
      case 'mp'	:
        echo $t->getDetails('manhap','asc',$Request->keys,$Request->dates,$Request->datee,$Request->tinhtrang);
        break;
      case 'nx'	: 
        echo $t->getDetails('ngaynhap','asc',$Request->keys,$Request->dates,$Request->datee,$Request->tinhtrang);
        break;
      case 'tensp'	: 
        echo $t->getDetails('tensp','asc',$Request->keys,$Request->dates,$Request->datee,$Request->tinhtrang);
        break;
      default: 
        echo $t->getDetails('sl','asc',$Request->keys,$Request->dates,$Request->datee,$Request->tinhtrang);
      }
    }
    else
    {
      switch($Request->name)
      {
      case 'mp'		: 
        echo $t->getDetails('manhap','desc',$Request->keys,$Request->dates,$Request->datee,$Request->tinhtrang);
        break;
      case 'nx'	: 
        echo $t->getDetails('ngaynhap','desc',$Request->keys,$Request->dates,$Request->datee,$Request->tinhtrang);
        break;
      case 'tensp'	: 
        echo $t->getDetails('tensp','desc',$Request->keys,$Request->dates,$Request->datee,$Request->tinhtrang);
        break;
      default: 
        echo $t->getDetails('sl','desc',$Request->keys,$Request->dates,$Request->datee,$Request->tinhtrang);
      }
    }
  }
}
?>
