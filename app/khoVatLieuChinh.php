<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khoVatLieuChinh extends Model
{
  protected $table= 'kho';
  public $timestamps = false;
public function sanpham(){
		return $this->belongsTo('App\qlSanPham','MaSanPham','MaSanPham');
  }
}