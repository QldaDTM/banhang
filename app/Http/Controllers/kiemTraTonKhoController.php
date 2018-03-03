<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\kiemTraTonKho;
class kiemTraTonKhoController extends Controller
{
  public function __construct()
  {
         $this->middleware('auth');
  }

  public function kiemTraTonKho() {
    $kiemTraTonKho = new kiemTraTonKho();
    $tonkho = $kiemTraTonKho->filter('tensp','asc','');
    return view('kiemTraTonKho',["tonkho"=>$tonkho]);
  }
  public function filter(Request $request) {
    $kiemTraTonKho = new kiemTraTonKho();
    if ($request->type == 'asc')
   {
       switch($request->name)
    {
    case 'sp'   : $tonkho = $kiemTraTonKho->filter('tensp','asc',$request->keys);break;
    case 'ncc'  : $tonkho = $kiemTraTonKho->filter('tenncc','asc',$request->keys);break;
    case 'sl' : $tonkho = $kiemTraTonKho->filter('sl','asc',$request->keys);break;
    default : $tonkho = $kiemTraTonKho->filter('dongia','asc',$request->keys);
    }
  }
  else
  {
    switch($request->name)
    {
    case 'sp'   : $tonkho = $kiemTraTonKho->filter('tensp','desc',$request->keys);break;
    case 'ncc'  : $tonkho = $kiemTraTonKho->filter('tenncc','desc',$request->keys);break;
    case 'sl' : $tonkho = $kiemTraTonKho->filter('sl','desc',$request->keys);break;
    default : $tonkho = $kiemTraTonKho->filter('dongia','desc',$request->keys);
    }
  }
  return $tonkho;
  }
	
}
?>