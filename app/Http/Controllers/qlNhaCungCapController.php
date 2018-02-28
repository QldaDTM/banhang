<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\qlNhaCungCap;

class qlNhaCungCapController extends Controller
{
  public function qlNhaCungCap()
    {
        $nhacungcap = qlNhaCungCap::all();
        return view('qlNhaCungCap',["nhacungcap"=>$nhacungcap]);
    }
}
?>