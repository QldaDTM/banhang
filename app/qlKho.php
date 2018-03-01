<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class qlKho extends Model
{
  protected $table= 'sanpham';
  public $timestamps = false;

  public function getmasp(){
    $sql= 'select MaSanPham,TenSanPham from sanpham';
    return DB::select($sql);
  }
}