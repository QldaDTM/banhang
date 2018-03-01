<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class qlSanPham extends Model
{
  protected $table= 'sanpham';
  public $timestamps = false;
  public function nhacungcap(){
		return $this->belongsTo('App\qlNhaCungCap','MaNhaCungCap','MaNhaCungCap');
  }
  
  public function getmasp(){
    $sql= 'select MaSanPham,TenSanPham from sanpham';
    return DB::select($sql);
  }
}