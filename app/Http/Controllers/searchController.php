<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\qlNhaCungCap;
use App\qlSanPham;
use App\qlHangHu;
use App\nhapkho;
class searchController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function getAjax(Request $Request){

  }
}
?>
