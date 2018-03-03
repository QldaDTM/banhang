<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khoVatLieuHong extends Model
{
  protected $table= 'khohong';
  public $timestamps = false;
public function sanpham(){
		return $this->belongsTo('App\qlSanPham','MaSanPham','MaSanPham');
  }
}